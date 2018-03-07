<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Produk_model');
    $this->load->model('Kategori_model');

    $this->data['module'] = 'Produk';

    /* cek status login */
		if (!$this->ion_auth->logged_in()){
			// apabila belum login maka diarahkan ke halaman login
			redirect('admin/auth/login', 'refresh');
		}
		// cek usertype
		elseif($this->ion_auth->is_seller()){
			// apabila belum login maka diarahkan ke halaman login
			redirect('admin/auth/login', 'refresh');
		}
  }

  public function index()
  {
    $this->data['title'] = "Data Produk";

    $this->data['produk_data'] = $this->Produk_model->get_all();
    $this->load->view('back/produk/produk_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah Produk Baru';
    $this->data['action']         = site_url('admin/produk/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['judul_produk'] = array(
      'name'  => 'judul_produk',
      'id'    => 'judul_produk',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('judul_produk'),
    );

    $this->data['deskripsi'] = array(
      'name'  => 'deskripsi',
      'id'    => 'deskripsi',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('deskripsi'),
    );

    $this->data['harga'] = array(
      'name'  => 'harga',
      'id'    => 'harga',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('harga'),
    );

    $this->data['kat_id'] = array(
      'name'  => 'kat_id',
      'id'    => 'kat_id',
      'class' => 'form-control',
      'onChange' => 'tampilSubkat()',
      'required'    => '',
    );

    $this->data['subkat_id'] = array(
      'name'  => 'subkat_id',
      'id'    => 'subkat_id',
      'class' => 'form-control',
      'onChange' => 'tampilSuperSubkat()',
      'required'    => '',
    );

    $this->data['supersubkat_id'] = array(
      'name'  => 'supersubkat_id',
      'id'    => 'supersubkat_id',
      'class' => 'form-control',
      'required'    => '',
    );

    $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

    $this->load->view('back/produk/produk_add', $this->data);
  }

  public function create_action()
  {
    $this->load->helper('clean');
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->create();
    }
      else
      {
        /* 4 adalah menyatakan tidak ada file yang diupload*/
        if ($_FILES['foto']['error'] <> 4)
        {
          $nmfile = strtolower(url_title($this->input->post('judul_produk'))).date('YmdHis');

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/produk/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('foto'))
          {
            //file gagal diupload -> kembali ke form tambah
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

            $this->create();
          }
            //file berhasil diupload -> lanjutkan ke query INSERT
            else
            {
              $foto = $this->upload->data();
              $thumbnail                = $config['file_name'];
              // library yang disediakan codeigniter
              $config['image_library']  = 'gd2';
              // gambar yang akan dibuat thumbnail
              $config['source_image']   = './assets/images/produk/'.$foto['file_name'].'';
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
                'judul_produk'     => $this->input->post('judul_produk'),
                'slug_produk'     => strtolower(url_title($this->input->post('judul_produk'))),
                'deskripsi'       => $this->input->post('deskripsi', FALSE),
                'kat_id'          => $this->input->post('kat_id'),
                'subkat_id'       => $this->input->post('subkat_id'),
                'supersubkat_id'  => $this->input->post('supersubkat_id'),
                'harga'           => clean($this->input->post('harga')),
                'foto'            => $nmfile,
                'foto_type'       => $foto['file_ext'],
                'uploader'        => $this->session->userdata('user_id')
              );

              // eksekusi query INSERT
              $this->Produk_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
              redirect(site_url('admin/produk'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
            'judul_produk'    => $this->input->post('judul_produk'),
            'slug_produk'     => strtolower(url_title($this->input->post('judul_produk'))),
            'deskripsi'       => $this->input->post('deskripsi', FALSE),
            'kat_id'          => $this->input->post('kat_id'),
            'subkat_id'       => $this->input->post('subkat_id'),
            'supersubkat_id'  => $this->input->post('supersubkat_id'),
            'harga'           => clean($this->input->post('harga')),
            'uploader'        => $this->session->userdata('user_id')
          );

          // eksekusi query INSERT
          $this->Produk_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
          redirect(site_url('admin/produk'));
        }
      }
  }

  public function update($id)
  {
    $row = $this->Produk_model->get_by_id($id);
    $this->data['produk'] = $this->Produk_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Update Produk';
      $this->data['action']         = site_url('admin/produk/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_produk'] = array(
        'name'  => 'id_produk',
        'id'    => 'id_produk',
        'type'=> 'hidden',
      );

      $this->data['judul_produk'] = array(
        'name'  => 'judul_produk',
        'id'    => 'judul_produk',
        'class' => 'form-control',
      );

      $this->data['deskripsi'] = array(
        'name'  => 'deskripsi',
        'id'    => 'deskripsi',
        'class' => 'form-control',
      );

      $this->data['harga'] = array(
        'name'  => 'harga',
        'id'    => 'harga',
        'class' => 'form-control',
      );

      $this->data['kat_id'] = array(
        'name'  => 'kat_id',
        'id'    => 'kat_id',
        'class' => 'form-control',
        'onChange' => 'tampilSubkat()',
        'required'    => '',
      );

      $this->data['subkat_id'] = array(
        'name'  => 'subkat_id',
        'id'    => 'subkat_id',
        'class' => 'form-control',
        'onChange' => 'tampilSuperSubkat()',
        'required'    => '',
      );

      $this->data['supersubkat_id'] = array(
        'name'  => 'supersubkat_id',
        'id'    => 'supersubkat_id',
        'class' => 'form-control',
        'required'    => '',
      );

      $this->data['keywords'] = array(
        'name'  => 'keywords',
        'id'    => 'keywords',
        'class' => 'form-control',
      );

      $kat = $row->kat_id;
      $subkat = $row->subkat_id;

      $this->data['ambil_kategori']     = $this->Kategori_model->ambil_kategori();
      $this->data['ambil_subkat']       = $this->Kategori_model->ambil_subkat($kat);
      $this->data['ambil_supersubkat']  = $this->Kategori_model->ambil_supersubkat($subkat);

      $this->load->view('back/produk/produk_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '<div class="alert alert-warning alert">Data tidak ditemukan</div>');
        redirect(site_url('admin/produk'));
      }
  }

  public function update_action()
  {
    $this->load->helper('clean');
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('id_produk'));
    }
      else
      {
        /* Jika file upload diisi */
        if($_FILES['foto']['error'] <> 4)
        {
          $delete = $this->Produk_model->del_by_id($this->input->post('id_produk'));

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/produk/".$delete->foto.$delete->foto_type;
          $dir_thumb = "assets/images/produk/".$delete->foto.'_thumb'.$delete->foto_type;

          // Hapus foto dan thumbnail
          unlink($dir);
          unlink($dir_thumb);
        
          $nmfile = strtolower(url_title($this->input->post('judul_produk'))).date('YmdHis');

          //load uploading file library
          $config['upload_path']      = './assets/images/produk/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);

          // Jika file gagal diupload -> kembali ke form update
          if (!$this->upload->do_upload('foto'))
          {
            //file gagal diupload -> kembali ke form tambah
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

            $this->update($this->input->post('id_produk'));
          }
            // Jika file berhasil diupload -> lanjutkan ke query INSERT
            else
            {
              $foto = $this->upload->data();
              // library yang disediakan codeigniter
              $thumbnail                = $config['file_name'];
              //nama yang terupload nantinya
              $config['image_library']  = 'gd2';
              // gambar yang akan dibuat thumbnail
              $config['source_image']   = './assets/images/produk/'.$foto['file_name'].'';
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
                'judul_produk'    => $this->input->post('judul_produk'),
                'slug_produk'     => strtolower(url_title($this->input->post('judul_produk'))),
                'deskripsi'       => $this->input->post('deskripsi', FALSE),
                'kat_id'          => $this->input->post('kat_id'),
                'subkat_id'          => $this->input->post('subkat_id'),
                'supersubkat_id'  => $this->input->post('supersubkat_id'),
                'harga'           => clean($this->input->post('harga')),
                'foto'        => $nmfile,
                'foto_type'   => $foto['file_ext'],
                'updater'        => $this->session->userdata('user_id')
              );

              $this->Produk_model->update($this->input->post('id_produk'), $data);
              $this->session->set_flashdata('message', '<div class="alert alert-success alert">Edit Data Berhasil</div>');
              redirect(site_url('admin/produk'));
            }
        }
          // Jika file upload kosong
          else
          {
            $data = array(
              'judul_produk'    => $this->input->post('judul_produk'),
              'slug_produk'     => strtolower(url_title($this->input->post('judul_produk'))),
              'deskripsi'       => $this->input->post('deskripsi'),
              'kat_id'          => $this->input->post('kat_id'),
              'subkat_id'       => $this->input->post('subkat_id'),
              'supersubkat_id'  => $this->input->post('supersubkat_id'),
              'harga'           => clean($this->input->post('harga')),
              'updater'        => $this->session->userdata('user_id')
            );

            $this->Produk_model->update($this->input->post('id_produk'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert">Edit Data Berhasil</div>');
            redirect(site_url('admin/produk'));
          }
      }
  }

  public function delete($id)
  {
    $delete = $this->Produk_model->del_by_id($id);

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/produk/".$delete->foto.$delete->foto_type;
    $dir_thumb = "assets/images/produk/".$delete->foto.'_thumb'.$delete->foto_type;

    // Hapus foto
    unlink($dir);
    unlink($dir_thumb);

    // Jika data ditemukan, maka hapus foto dan record nya
    if($delete)
    {
      $this->Produk_model->delete($id);

      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/produk'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/produk'));
      }
  }

  // dijalankan saat kategori di klik
	public function pilih_subkategori(){
		$this->data['subkategori']=$this->Kategori_model->ambil_subkategori($this->uri->segment(4));
		$this->load->view('back/produk/v_subkat',$this->data);
	}

  // dijalankan saat kategori di klik
	public function pilih_supersubkategori(){
		$this->data['supersubkategori']=$this->Kategori_model->ambil_supersubkategori($this->uri->segment(4));
		$this->load->view('back/produk/v_supersubkat',$this->data);
	}

  public function _rules()
  {
    $this->form_validation->set_rules('judul_produk', 'Judul Produk', 'trim|required');
    $this->form_validation->set_rules('deskripsi', 'Isi Produk', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert" align="left">', '</div>');
  }

}
