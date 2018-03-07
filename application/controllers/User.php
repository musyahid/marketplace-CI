<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/* mengatur pesan error */
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		/*memanggil bahasa/ language bawaan ion_auth*/
		$this->lang->load('auth');

		/* memanggil model untuk ditampilkan pada masing2 modul*/
		$this->load->model('Ion_auth_model');

		$this->data['title'] = "MarketPlace";
	}

	public function register()
	{
		if ($this->ion_auth->logged_in()){redirect(base_url());}

		$this->data['page'] = "Daftar Member Baru";

		/* setting bawaan ionauth */
		$tables 					= $this->config->item('tables','ion_auth');
		$identity_column 	= $this->config->item('identity','ion_auth');

		$this->data['identity_column'] = $identity_column;

		// validasi form input
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[users.nama]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'No. HP', 'trim|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');

		$this->form_validation->set_message('required', '{field} mohon diisi');
		$this->form_validation->set_message('valid_email', 'Format email tidak benar');
		$this->form_validation->set_message('numeric', 'No. HP harus angka');
		$this->form_validation->set_message('matches', 'Password baru dan konfirmasi harus sama');
		$this->form_validation->set_message('is_unique', '%s telah terpakai, silahkan ganti dengan yang lain');

		/* jalan form validasi */
		if ($this->form_validation->run() == true)
		{
			$email    = strtolower($this->input->post('email'));
			$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'nama' 				=> $this->input->post('nama'),
				'username'  	=> $this->input->post('username'),
				'alamat'    	=> $this->input->post('alamat'),
				'phone'      	=> $this->input->post('phone'),
				'usertype'    => '3',
				'uploader'        => $this->session->userdata('identity')
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
		{
			// check to see if we are creating the user | redirect them back to the admin page
			$this->session->set_flashdata('message', '<div class="alert alert-success alert">Registrasi Berhasil, silahkan cek email Anda untuk aktivasi.</div>');
			redirect('user/register');
		}
			else
			{
				// display the create user form | set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

				$this->data['nama'] = array(
					'name'  => 'nama',
					'id'    => 'nama',
					'type'  => 'text',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('nama'),
				);
				$this->data['username'] = array(
					'name'  => 'username',
					'id'    => 'username',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('username'),
				);
				$this->data['alamat'] = array(
					'name'  => 'alamat',
					'id'    => 'alamat',
					'class'  => 'form-control',
					'cols'  => '2',
					'rows'  => '2',
					'value' => $this->form_validation->set_value('alamat'),
				);
				$this->data['email'] = array(
					'name'  => 'email',
					'id'    => 'email',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('email'),
				);
				$this->data['phone'] = array(
					'name'  => 'phone',
					'id'    => 'phone',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('phone'),
				);
				$this->data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('password'),
				);
				$this->data['password_confirm'] = array(
					'name'  => 'password_confirm',
					'id'    => 'password_confirm',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('password_confirm'),
				);

				$this->_render_page('front/user/register', $this->data);
			}
	}

	public function login()
	{
		// hanya yang belum login yang bisa masuk ke halaman ini
		if ($this->ion_auth->logged_in()){redirect(base_url());}

		$this->load->library('Recaptcha');

		$this->data['captcha'] = $this->recaptcha->getWidget();
		$this->data['script_captcha'] = $this->recaptcha->getScriptTag();

		$recaptcha = $this->input->post('g-recaptcha-response');
    $response = $this->recaptcha->verifyResponse($recaptcha);

		/* menyiapkan data yang akan disertakan/ ditampilkan pada view */
		$this->data['page'] 	= "Login";

		/* validasi form input */
		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
		$this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');

		$this->form_validation->set_message('required', '{field} mohon diisi');

		/* pengecekan validasi form */
		if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] === FALSE)
		{
			/* menyiapkan data dalam format array */
			$this->data['username'] = array(
				'name' => 'username',
				'id'    => 'username',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('username'),
			);
			$this->data['password'] = array(
				'name' => 'password',
				'id'   => 'password',
				'class'  => 'form-control'
			);

			$this->load->view('front/user/login', $this->data);
		}
			else
			{
				// check to see if the user is logging in
				// check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login_front($this->input->post('username'), $this->input->post('password'), $remember))
				{
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', '<div class="col-lg-12"><div class="alert alert-success">Login berhasil</div></div>');

					redirect('/', 'refresh');
				}
					else
					{
						// if the login was un-successful
						// redirect them back to the login page
						$this->data['message'] = '<div class="alert alert-danger alert">Gagal login</div>';
						redirect('user/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}
			}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url());
	}

	// Edit data user
	public function edit_profil($id){
		$this->data['page'] = 'Edit Profil';

		// Mencegah user mengubah akun orang lain yang tidak sesuai session
		if($this->session->userdata('user_id') != $id)
		{
			redirect(base_url(), 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();

		// validate form input
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'No. HP', 'trim|numeric');

		// Validasi form
		$this->form_validation->set_message('required', '{field} mohon diisi');
		$this->form_validation->set_message('numeric', 'No. HP harus angka');
		$this->form_validation->set_message('valid_email', 'Format email salah');
		$this->form_validation->set_message('min_length', 'Password minimal 8 huruf');
		$this->form_validation->set_message('max_length', 'Password maksimal 20 huruf');
		$this->form_validation->set_message('matches', 'Password baru dan konfirmasi harus sama');

		if (isset($_POST) && !empty($_POST))
		{
			// mengecek validitas request update data
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')){
				show_error($this->lang->line('error_csrf'));
			}

			// update password jika dimasukkan/ diisi
			if ($this->input->post('password')){
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				/* 4 adalah menyatakan tidak ada file yang diupload*/
				if ($_FILES['userfile']['error'] <> 4)
				{
					$id = $this->input->post('id');

					$delete = $this->Ion_auth_model->del_by_id($id);

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($delete)
          {
						// menyimpan lokasi gambar dalam variable
	          $dir = "assets/images/user/".$delete->userfile.$delete->userfile_type;
	          $dir_thumb = "assets/images/user/".$delete->userfile.'_thumb'.$delete->userfile_type;

	          // Hapus foto
	          unlink($dir);
	          unlink($dir_thumb);

						$nmfile = strtolower(url_title($this->input->post('nama'))).date('YmdHis');

						/* memanggil library upload ci */
						$config['upload_path']      = 'assets/images/user/';
						$config['allowed_types']    = 'jpg|jpeg|png|gif';
						$config['max_size']         = '2048'; // 2 MB
						$config['file_name']        = $nmfile; //nama yang terupload nantinya

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload())
						{
							//file gagal diupload -> kembali ke form tambah
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

							redirect('user/edit_profil/'.$id);
						}
							//file berhasil diupload -> lanjutkan ke query INSERT
							else
							{
								$userfile = $this->upload->data();
								$thumbnail                = $config['file_name'];
								// library yang disediakan codeigniter
								$config['image_library']  = 'gd2';
								// gambar yang akan dibuat thumbnail
								$config['source_image']   = 'assets/images/user/'.$userfile['file_name'].'';
								// membuat thumbnail
								$config['create_thumb']   = TRUE;
								// rasio resolusi
								$config['maintain_ratio'] = FALSE;
								// lebar
								$config['width']          = 250;
								// tinggi
								$config['height']         = 250;

								$this->load->library('image_lib', $config);
								$this->image_lib->resize();

								// $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
								// $password = $this->input->post('password');

								$data = array(
									'nama' 			=> $this->input->post('nama'),
									'username'  => $this->input->post('username'),
									'email'     => strtolower($this->input->post('email')),
									'alamat'  	=> $this->input->post('alamat'),
									'phone'     => $this->input->post('phone'),
									'userfile'        => $nmfile,
                  'userfile_type'   => $userfile['file_ext'],
                  'uploader'        => $this->session->userdata('identity')
								);

								// jika password terisi
								if ($this->input->post('password')){
									$data['password'] = $this->input->post('password');
								}

								// mengecek apakah sedang mengupdate data user
								if($this->ion_auth->update($user->id, $data))
								{
									$this->session->set_flashdata('message', '
					        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
										<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Berhasil
					        </div>');
					        redirect(base_url('user/edit_profil/'.$user->id));
								}
								else{
									// Set pesan
									$this->session->set_flashdata('message', '
					        <div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
										<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Gagal
					        </div>');
					        redirect(base_url('user/edit_profil/'.$user->id));
								}
							}
					}
						// Jika tidak ada foto pada record, maka upload foto baru
						else
						{
							//load uploading file library
							$config['upload_path']      = 'assets/images/user/';
							$config['allowed_types']    = 'jpg|jpeg|png|gif';
							$config['max_size']         = '2048'; // 2 MB
							$config['max_width']        = '2000'; //pixels
							$config['max_height']       = '2000'; //pixels
							$config['file_name']        = $nmfile; //nama yang terupload nantinya

							$this->load->library('upload', $config);

							// Jika file gagal diupload -> kembali ke form update
							if (!$this->upload->do_upload())
							{
								$this->update();
							}
								// Jika file berhasil diupload -> lanjutkan ke query INSERT
								else
								{
									$userfile = $this->upload->data();
									// library yang disediakan codeigniter
									$thumbnail                = $config['file_name'];
									//nama yang terupload nantinya
									$config['image_library']  = 'gd2';
									// gambar yang akan dibuat thumbnail
									$config['source_image']   = 'assets/images/user/'.$userfile['file_name'].'';
									// membuat thumbnail
									$config['create_thumb']   = TRUE;
									// rasio resolusi
									$config['maintain_ratio'] = FALSE;
									// lebar
									$config['width']          = 250;
									// tinggi
									$config['height']         = 250;

									$this->load->library('image_lib', $config);
									$this->image_lib->resize();

									$data = array(
										'nama' 			=> $this->input->post('nama'),
										'username'  => $this->input->post('username'),
										'email'     => strtolower($this->input->post('email')),
										'alamat'  	=> $this->input->post('alamat'),
										'phone'     => $this->input->post('phone'),
										'userfile'        => $nmfile,
	                  'userfile_type'   => $userfile['file_ext'],
	                  'uploader'        => $this->session->userdata('identity')
									);

									// jika password terisi
									if ($this->input->post('password')){
										$data['password'] = $this->input->post('password');
									}

									// mengecek apakah sedang mengupdate data user
									if($this->ion_auth->update($user->id, $data))
									{
										$this->session->set_flashdata('message', '
						        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
											<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Berhasil
						        </div>');
						        redirect(base_url('user/edit_profil/'.$user->id));
									}
									else{
										$this->session->set_flashdata('message', '
						        <div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
											<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Gagal
						        </div>');
						        redirect(base_url('user/edit_profil/'.$user->id));
									}
								}
						}
				}
				  // Jika file upload kosong
					else
					{
						$data = array(
							'nama' 			=> $this->input->post('nama'),
							'username'  => $this->input->post('username'),
							'email'     => strtolower($this->input->post('email')),
							'alamat'  	=> $this->input->post('alamat'),
							'phone'     => $this->input->post('phone'),
							'uploader'        => $this->session->userdata('identity')
						);

						// jika password terisi
						if ($this->input->post('password')){
							$data['password'] = $this->input->post('password');
						}

						// mengecek apakah sedang mengupdate data user
						if($this->ion_auth->update($user->id, $data))
						{
							$this->session->set_flashdata('message', '
							<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
								<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Berhasil
							</div>');
							redirect(base_url('user/edit_profil/'.$user->id));
						}
						else{
							$this->session->set_flashdata('message', '
							<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
								<i class="ace-icon fa fa-bullhorn green"></i> Update Profil Gagal
							</div>');
							redirect(base_url('user/edit_profil/'.$user->id));
						}
					}
			}
		}

		// menampilkan form edit/ update data user
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// mengatur pesan/ flash data eror jika ada
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// melempar data user ke view
		$this->data['user'] = $user;

		$this->data['nama'] = array(
			'name'  => 'nama',
			'id'    => 'nama',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('nama', $user->nama),
		);
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'readonly'  => '',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('username', $user->username),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'readonly'  => '',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['alamat'] = array(
			'name'  => 'alamat',
			'id'    => 'alamat',
			'type'  => 'textarea',
			'class'  => 'form-control',
			'rows'  => '2',
			'cols'  => '2',
			'value' => $this->form_validation->set_value('alamat', $user->alamat),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class'  => 'form-control',
			'placeholder'  => 'diisi jika mengubah password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class'  => 'form-control',
			'placeholder'  => 'diisi jika mengubah password'
		);

		$this->data['get_all_users_group'] = $this->Ion_auth_model->get_all_users_group();

		$this->_render_page('front/user/edit_profil', $this->data);
	}

	public function username_check($str)
	{
		$this->load->model('ion_auth_model');
		if ($this->ion_auth_model->username_check_front($str))
		{
			return TRUE;
		}
			else
			{
				$this->form_validation->set_message('username_check','Username tidak ditemukan');
				return FALSE;
			}
	}

	// Lupa Password
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is identity or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_username_label'), 'required');
		}
			else
			{
				$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
			}

		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' )
			{
				$this->data['username_label'] = $this->lang->line('forgot_password_username_label');
			}
				else
				{
					$this->data['username_label'] = $this->lang->line('forgot_password_email_username_label');
				}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $this->data);
		}
			else
			{
				$identity_column = $this->config->item('identity','ion_auth');
				$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

				if(empty($identity))
				{
					if($this->config->item('identity', 'ion_auth') != 'email')
					{
						$this->ion_auth->set_error('forgot_password_username_not_found');
					}
						else
						{
							$this->ion_auth->set_error('forgot_password_email_not_found');
						}

					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect("auth/forgot_password", 'refresh');
				}

				// run the forgotten password method to email an activation code to the user
				$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
				if ($forgotten)
				{
					// if there were no errors
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
				}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect("auth/forgot_password", 'refresh');
					}
			}
	}

	// Tahap lanjutan dari lupa password -> reset password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			/* jika data benar */
			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				$this->_render_page('auth/reset_password', $this->data);
			}
				else
				{
					// cek keaslian request/ pemanggilan data
					if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
					{
						// something fishy might be up
						$this->ion_auth->clear_forgotten_password_code($code);
						show_error($this->lang->line('error_csrf'));
					}
						else
						{
							// finally change the password
							$username = $user->{$this->config->item('identity', 'ion_auth')};
							$change = $this->ion_auth->reset_password($username, $this->input->post('new'));

							if ($change)
							{
								// if the password was successfully changed
								$this->session->set_flashdata('message', $this->ion_auth->messages());
								redirect("auth/login", 'refresh');
							}
							else
							{
								$this->session->set_flashdata('message', $this->ion_auth->errors());
								redirect('auth/reset_password/' . $code, 'refresh');
							}
						}
				}
			}
				else
				{
					// jika kode invalid/ tidak terdaftar
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect("auth/forgot_password", 'refresh');
				}
	}

	// Aktivasi user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		elseif ($this->ion_auth->is_superadmin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>Selamat, Akun Anda telah aktif.</b></div>');
			redirect(base_url());
		}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-dismissible alert-danger">
	        <button type="button" class="close" data-dismiss="alert">&times;</button>Maaf, Akun Anda gagal aktif. Silahkan hubungi Admin.</b></div>');
				redirect(base_url());
			}
	}

	public function profile($id)
	{
		$this->data['profil_data'] 	= $this->Ion_auth_model->get_profil_seller($id)->row();
		$this->data['profil'] 			= $this->Ion_auth_model->get_ads_profil_seller($id)->result();

		$this->data['page'] 				= 'Toko '.$this->data['profil_data']->nama;

		$this->load->view('front/user/profile', $this->data);
	}

	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
		$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
			else
			{
				return FALSE;
			}
	}

	/* sama seperti $this->load->view */
	public function _render_page($view, $data=null, $returnhtml=false)
	{
		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;
	}
}
