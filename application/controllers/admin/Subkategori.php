<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subkategori extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kategori_model');
    $this->load->model('Subkategori_model');

    $this->data['module'] = 'Subkategori';

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
    $this->data['title'] = "Data Subkategori";

    $this->data['subkategori_data'] = $this->Subkategori_model->get_all();
    $this->load->view('back/subkategori/subkategori_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah Subkategori Baru';
    $this->data['action']         = site_url('admin/subkategori/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['kat_id'] = array(
      'name'  => 'kat_id',
      'id'    => 'kat_id',
      'class' => 'form-control',
      'required'    => '',
    );

    $this->data['judul_subkategori'] = array(
      'name'  => 'judul_subkategori',
      'id'    => 'judul_subkategori',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('judul_subkategori'),
    );

    $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

    $this->load->view('back/subkategori/subkategori_add', $this->data);
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
          'id_kat'  => $this->input->post('kat_id'),
          'judul_subkategori'  => $this->input->post('judul_subkategori'),
          'slug_subkat'  => judul_seo($this->input->post('judul_subkategori')),
        );

        // eksekusi query INSERT
        $this->Subkategori_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dibuat
        </div>');
        redirect(site_url('admin/subkategori'));
      }
  }

  public function update($id)
  {
    $row = $this->Subkategori_model->get_by_id($id);
    $this->data['subkategori'] = $this->Subkategori_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Update Subkategori';
      $this->data['action']         = site_url('admin/subkategori/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_subkat'] = array(
        'name'  => 'id_subkat',
        'id'    => 'id_subkat',
        'type'  => 'hidden',
      );

      $this->data['kat_id'] = array(
        'name'  => 'kat_id',
        'id'    => 'kat_id',
        'class' => 'form-control',
        'required'    => '',
      );

      $this->data['judul_subkategori'] = array(
        'name'  => 'judul_subkategori',
        'id'    => 'judul_subkategori',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

      $this->load->view('back/subkategori/subkategori_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/subkategori'));
      }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('id_subkat'));
    }
      else
      {
        $data = array(
          'id_kat'  => $this->input->post('kat_id'),
          'judul_subkategori'  => $this->input->post('judul_subkategori'),
          'slug_subkat'  => judul_seo($this->input->post('judul_subkategori')),
        );

        $this->Subkategori_model->update($this->input->post('id_subkat'), $data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Edit Data Berhasil
        </div>');
        redirect(site_url('admin/subkategori'));
      }
  }

  public function delete($id)
  {
    $row = $this->Subkategori_model->get_by_id($id);

    if ($row)
    {
      $this->Subkategori_model->delete($id);
      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/subkategori'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/subkategori'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('judul_subkategori', 'Judul Subkategori', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_subkat', 'id_subkat', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert" align="left">', '</div>');
  }

}
