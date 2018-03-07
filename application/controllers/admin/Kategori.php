<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kategori_model');

    $this->data['module'] = 'Kategori';

    $this->load->helper('judul_seo');

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
    $this->data['title'] = "Data Kategori";

    $this->data['kategori_data'] = $this->Kategori_model->get_all();
    $this->load->view('back/kategori/kategori_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah Kategori Baru';
    $this->data['action']         = site_url('admin/kategori/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['judul_kategori'] = array(
      'name'  => 'judul_kategori',
      'id'    => 'judul_kategori',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('judul_kategori'),
    );

    $this->load->view('back/kategori/kategori_add', $this->data);
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
        $data = array(
          'judul_kategori'  => $this->input->post('judul_kategori'),
          'slug_kat'  => judul_seo($this->input->post('judul_kategori')),
        );

        // eksekusi query INSERT
        $this->Kategori_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dibuat
        </div>');
        redirect(site_url('admin/kategori'));
      }
  }

  public function update($id)
  {
    $row = $this->Kategori_model->get_by_id($id);
    $this->data['kategori'] = $this->Kategori_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Update Kategori';
      $this->data['action']         = site_url('admin/kategori/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_kategori'] = array(
        'name'  => 'id_kategori',
        'id'    => 'id_kategori',
        'type'  => 'hidden',
      );

      $this->data['judul_kategori'] = array(
        'name'  => 'judul_kategori',
        'id'    => 'judul_kategori',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->load->view('back/kategori/kategori_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/kategori'));
      }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('id_kategori'));
    }
      else
      {
        $data = array(
          'judul_kategori'  => $this->input->post('judul_kategori'),
          'slug_kat'  => judul_seo($this->input->post('judul_kategori')),
        );

        $this->Kategori_model->update($this->input->post('id_kategori'), $data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Edit Data Berhasil
        </div>');
        redirect(site_url('admin/kategori'));
      }
  }

  public function delete($id)
  {
    $row = $this->Kategori_model->get_by_id($id);

    if ($row)
    {
      $this->Kategori_model->delete($id);
      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/kategori'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/kategori'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('judul_kategori', 'Judul Kategori', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert" align="left">', '</div>');
  }

}
