<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Supersubkategori extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kategori_model');
    $this->load->model('Supersubkategori_model');

    $this->data['module'] = 'Supersubkategori';

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
    $this->data['title'] = "Data Supersubkategori";

    $this->data['supersubkategori_data'] = $this->Supersubkategori_model->get_all();
    $this->load->view('back/supersubkategori/supersubkategori_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah Supersubkategori Baru';
    $this->data['action']         = site_url('admin/supersubkategori/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['kat_id'] = array(
      'name'  => 'kat_id',
      'id'    => 'kat_id',
      'class' => 'form-control',
      'required'    => '',
      'onChange' => 'tampilSubkat()',
    );

    $this->data['subkat_id'] = array(
      'name'  => 'subkat_id',
      'id'    => 'subkat_id',
      'class' => 'form-control',
      'required'    => '',
    );

    $this->data['judul_supersubkategori'] = array(
      'name'  => 'judul_supersubkategori',
      'id'    => 'judul_supersubkategori',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('judul_supersubkategori'),
    );

    $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

    $this->load->view('back/supersubkategori/supersubkategori_add', $this->data);
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
          'id_kat'                  => $this->input->post('kat_id'),
          'id_subkat'               => $this->input->post('subkat_id'),
          'judul_supersubkategori'  => $this->input->post('judul_supersubkategori'),
          'slug_supersubkat'        => judul_seo($this->input->post('judul_supersubkategori')),
        );

        // eksekusi query INSERT
        $this->Supersubkategori_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dibuat
        </div>');
        redirect(site_url('admin/supersubkategori'));
      }
  }

  public function update($id)
  {
    $row = $this->Supersubkategori_model->get_by_id($id);
    $this->data['supersubkategori'] = $this->Supersubkategori_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Update Supersubkategori';
      $this->data['action']         = site_url('admin/supersubkategori/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_supersubkat'] = array(
        'name'  => 'id_supersubkat',
        'id'    => 'id_supersubkat',
        'type'  => 'hidden',
      );

      $this->data['kat_id'] = array(
        'name'  => 'kat_id',
        'id'    => 'kat_id',
        'class' => 'form-control',
        'required'    => '',
        'onChange' => 'tampilSubkat()',
      );

      $this->data['subkat_id'] = array(
        'name'  => 'subkat_id',
        'id'    => 'subkat_id',
        'class' => 'form-control',
        'required'    => '',
      );

      $this->data['judul_supersubkategori'] = array(
        'name'  => 'judul_supersubkategori',
        'id'    => 'judul_supersubkategori',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $kat = $row->id_kat;
      $subkat = $row->id_subkat;

      $this->data['ambil_kategori']     = $this->Kategori_model->ambil_kategori();
      $this->data['ambil_subkat']       = $this->Kategori_model->ambil_subkat($kat);

      $this->load->view('back/supersubkategori/supersubkategori_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/supersubkategori'));
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
          'id_subkat'  => $this->input->post('subkat_id'),
          'judul_supersubkategori'  => $this->input->post('judul_supersubkategori'),
          'slug_supersubkat'  => judul_seo($this->input->post('judul_supersubkategori')),
        );

        $this->Supersubkategori_model->update($this->input->post('id_supersubkat'), $data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Edit Data Berhasil
        </div>');
        redirect(site_url('admin/supersubkategori'));
      }
  }

  public function delete($id)
  {
    $row = $this->Supersubkategori_model->get_by_id($id);

    if ($row)
    {
      $this->Supersubkategori_model->delete($id);
      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/supersubkategori'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/supersubkategori'));
      }
  }

  // dijalankan saat kategori di klik
	public function pilih_subkategori(){
		$this->data['subkategori']=$this->Kategori_model->ambil_subkategori($this->uri->segment(4));
		$this->load->view('back/produk/v_subkat',$this->data);
	}

  public function _rules()
  {
    $this->form_validation->set_rules('judul_supersubkategori', 'Judul Supersubkategori', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_subkat', 'id_subkat', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert" align="left">', '</div>');
  }

}
