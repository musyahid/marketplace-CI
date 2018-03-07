<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Slider_model');
    $this->load->model('Kategori_model');

    $this->data['module'] = 'Slider';

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
    $this->data['title'] = "Data Slider";

    $this->data['slider_data'] = $this->Slider_model->get_all();
    $this->load->view('back/slider/slider_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah Slider Baru';
    $this->data['action']         = site_url('admin/slider/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['no_urut'] = array(
      'name'  => 'no_urut',
      'id'    => 'no_urut',
      'class' => 'form-control',
      'type'    => 'number',
      'value' => $this->form_validation->set_value('no_urut'),
    );

    $this->data['link'] = array(
      'name'  => 'link',
      'id'    => 'link',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('link'),
    );

    $this->load->view('back/slider/slider_add', $this->data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->create();
    }
      else
      {
        /* 4 adalah menyatakan tidak ada file yang diupload*/
        if ($_FILES['userfile']['error'] <> 4)
        {
          $nmfile = strtolower(url_title($this->input->post('no_urut'))).date('YmdHis');

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/slider/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['max_width']        = '2000'; //pixels
          $config['max_height']       = '2000'; //pixels
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('userfile'))
          {
            //file gagal diupload -> kembali ke form tambah
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

            $this->create();
          }
            //file berhasil diupload -> lanjutkan ke query INSERT
            else
            {
              $userfile = $this->upload->data();

              $this->load->library('image_lib', $config);

              $data = array(
                'no_urut'       => $this->input->post('no_urut'),
                'link'          => $this->input->post('link'),
                'userfile'      => $nmfile,
                'userfile_type' => $userfile['file_ext'],
                'userfile_size' => $userfile['file_size'],
              );

              // eksekusi query INSERT
              $this->Slider_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
              redirect(site_url('admin/slider'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
            'no_urut'  => $this->input->post('no_urut'),
            'slug'     => judul_seo($this->input->post('no_urut')),
            'link'    => $this->input->post('link'),
          );

          // eksekusi query INSERT
          $this->Slider_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
          redirect(site_url('admin/slider'));
        }
      }
  }

  public function update($id)
  {
    $row = $this->Slider_model->get_by_id($id);
    $this->data['slider'] = $this->Slider_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Update Slider';
      $this->data['action']         = site_url('admin/slider/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_slider'] = array(
        'name'  => 'id_slider',
        'id'    => 'id_slider',
        'type'=> 'hidden',
      );

      $this->data['no_urut'] = array(
        'name'  => 'no_urut',
        'id'    => 'no_urut',
        'class' => 'form-control',
      );

      $this->data['link'] = array(
        'name'  => 'link',
        'id'    => 'link',
        'class' => 'form-control',
      );

      $this->load->view('back/slider/slider_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '<div class="alert alert-warning alert">Data tidak ditemukan</div>');
        redirect(site_url('admin/slider'));
      }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('id_slider'));
    }
      else
      {
        $nmfile = strtolower(url_title($this->input->post('no_urut')));

        /* Jika file upload diisi */
        if($_FILES['userfile']['error'] <> 4)
        {
          $delete = $this->Slider_model->del_by_id($this->input->post('id_slider'));

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/slider/".$delete->userfile.$delete->userfile_type;

          // Hapus userfile
          unlink($dir);

          $nmfile = strtolower(url_title($this->input->post('no_urut'))).date('YmdHis');

          //load uploading file library
          $config['upload_path']      = './assets/images/slider/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);

          // Jika file gagal diupload -> kembali ke form update
          if (!$this->upload->do_upload('userfile'))
          {
            //file gagal diupload -> kembali ke form tambah
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

            $this->update($this->input->post('id_slider'));
          }
            // Jika file berhasil diupload -> lanjutkan ke query INSERT
            else
            {
              $userfile = $this->upload->data();
              $this->load->library('image_lib', $config);

              $data = array(
                'no_urut'       => $this->input->post('no_urut'),
                'link'          => $this->input->post('link'),
                'userfile'      => $nmfile,
                'userfile_type' => $userfile['file_ext'],
                'userfile_size' => $userfile['file_size'],
              );

              $this->Slider_model->update($this->input->post('id_slider'), $data);
              $this->session->set_flashdata('message', '<div class="alert alert-success alert">Edit Data Berhasil</div>');
              redirect(site_url('admin/slider'));
            }
        }
          // Jika file upload kosong
          else
          {
            $data = array(
              'no_urut'  => $this->input->post('no_urut'),
              'link'    => $this->input->post('link'),
            );

            $this->Slider_model->update($this->input->post('id_slider'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert">Edit Data Berhasil</div>');
            redirect(site_url('admin/slider'));
          }
      }
  }

  public function delete($id)
  {
    $delete = $this->Slider_model->del_by_id($id);

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/slider/".$delete->userfile.$delete->userfile_type;

    // Hapus foto
    unlink($dir);

    // Jika data ditemukan, maka hapus foto dan record nya
    if($delete)
    {
      $this->Slider_model->delete($id);

      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/slider'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/slider'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('no_urut', 'No. urut', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_slider', 'id_slider', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}
