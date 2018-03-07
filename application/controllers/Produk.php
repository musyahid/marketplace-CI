<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->model('Produk_model');
      $this->load->model('Kategori_model');
      $this->load->model('Ion_auth_model');

      $this->data['title'] = "MarketPlace";
  }

  public function read($id)
	{
    /* mengambil data berdasarkan id */
    $row = $this->Produk_model->get_by_id_front($id);

    /* memanggil function buat_captcha */
    $cap = $this->buat_captcha();
    $this->data['cap_img'] = $cap['image'];
    $this->session->set_userdata('kode_captcha', $cap['word']);

    $this->data['segment'] = count($this->uri->segment_array());

    $segment = count($this->uri->segment_array());
    $segments = $this->uri->segment_array();

    if($segment==4)
    {
      /* memanggil function dari masing2 model yang akan digunakan */
      $this->data['seller']         = $this->Produk_model->get_by_id_iklan_seller($segments[4]);
      $this->data['produk']         = $this->Produk_model->get_by_id_front($segments[4]);
      $this->data['get_komentar']   = $this->Produk_model->get_komentar($segments[4]);

      $this->data['page']     = $this->data['produk']->judul_produk;

      /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
      $this->load->view('front/produk/body', $this->data);
    }
	}

  public function buat_captcha()
  {
    /* memanggil helper captcha dan string */
    $this->load->helper('captcha');

    /* menyiapkan data variabel vals melalui array untuk proses pembuatan captcha */
    $vals = array(
      /* lokasi gambar captcha, ex: captcha */
      'img_path'      => './captcha/',
      /* alamat gambar captcha, ex: www.abcd.com/captcha */
      'img_url'       => base_url().'captcha/',
      /* tinggi gambar */
      'img_height'    => 30,
      /* waktu berlaku captcha disimpan pada folder aplikasi (100 = dalam detik) */
      'expiration'    => 100,
      /* jumlah huruf/ karakter yang ditampilkan */
      'word_length'   => 5,
      // pengaturan warna dan background captcha
      'colors'        => array(
                          'background' => array(255, 255, 255),
                          'border' => array(0, 0, 0),
                          'text' => array(0, 0, 0),
                          'grid' => array(255, 240, 0)
                        )
    );

    $cap = create_captcha($vals);
    return $cap;
  }

  public function komen($id)
  {
    /* set aturan form validasi pada form */
    $this->form_validation->set_rules('kode_captcha', 'Kode Captcha', 'callback_cek_captcha');

    /* pengecekan form_validation */
    if ($this->form_validation->run() === FALSE)
    {
      /* buat captcha */
      $cap = $this->buat_captcha();
      $this->data['cap_img'] = $cap['image'];
      $this->session->set_userdata('kode_captcha', $cap['word']);

      $this->read($id);
    }
      else
      {
        /* menyiapkan/ menyimpan data ke dalam array */
        $data = array(
          'produk_id'     => $this->input->post('produk_id'),
          'user_id'       => $this->session->userdata('user_id'),
          'isi_komentar'  => $this->input->post('isi_komentar'),
        );

        /* proses insert ke database melalui function yang ada pada model */
        $this->Produk_model->insert_komentar($data);

        /* menghapus session captcha */
        $this->session->unset_userdata('kode_captcha');

        /* membuat notifikasi pada halaman yang dituju */
        $this->session->set_flashdata('message', '<div class="alert alert-success">Komentar berhasil terkirim</div>');

        $this->read($id);
      }
  }

  public function cek_captcha($input)
  {
    /* pengecekan hasil input captcha */
    if($input === $this->session->userdata('kode_captcha'))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
      return FALSE;
    }
  }

  public function cari_produk()
  {
      /* menyiapkan data yang akan disertakan/ ditampilkan pada view */
      $this->data['page'] = 'Hasil Pencarian Anda';

      /* memanggil function dari model yang akan digunakan */
      $this->data['hasil_pencarian'] = $this->Produk_model->get_cari_produk();

      /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
      $this->load->view('front/produk/hasil_pencarian', $this->data);
  }

  //public function kategori($kategori=null, $subkategori=null, $superskategori=null)
  public function kategori($id)
  {

      /*if($superskategori == null)
          $row = $this->Kategori_model->get_by_superskategori($superskategori);
      else if($subkategori == null)
          $row = $this->Kategori_model->get_by_subkategori($subkategori);
      else if($kategori == null)
          $row = $this->Kategori_model->get_by_kategori($kategori);*/

      $row = $this->Kategori_model->get_by_id_front($id)->result();

      if($row == FALSE)
      {
          echo "<script>alert('Data tidak ditemukan.');location.replace('".base_url()."')</script>";
      }
      else{
          /* mengambil uri segment ke-3 dan mengubah huruf awal menjadi kapital/ cetak */
          $kat = ucfirst($this->uri->segment(3));

          /* menyiapkan data yang akan disertakan/ ditampilkan pada view */
          $this->data['page']        = "Kategori: $kat";

          $this->data['title']        = "Portal Produk CI";

          /* memanggil function dari model yang akan digunakan */
          //$this->data['kategori_data']     = $this->Kategori_model->get_by_id_front($id);
          $this->data['kategori_data'] = $row;

          /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
          $this->load->view('front/kategori/body', $this->data);
      }
  }

  private $limit = 6;

  public function p()
  {
    $this->load->helper(array('clean'));
    $this->data['segment'] = count($this->uri->segment_array());

    $segment = count($this->uri->segment_array());
    $segments = $this->uri->segment_array();

    $offset = 0;

    if($segment==3 || ($segment==4 && is_numeric($segments[4])))
    {
      $this->data['page'] = strtoupper(clean2($this->uri->segment(3)));
      if($segment==4)
      $offset = $segments[4];

      $this->data['produk_row'] = $this->Kategori_model->get_list_by_kategori($segments[3], $this->limit, $offset)->row();

      $this->data['produk'] = $this->Kategori_model->get_list_by_kategori($segments[3], $this->limit, $offset);

      $this->data['pagination'] = $this->generate_paging($this->Kategori_model->get_by_kategori_nr($segments[3]), base_url() . 'produk/p/' . $segments[3],  4);

    }
    else if($segment==4 || ($segment==5 && is_numeric($segments[5])))
    {
      $this->data['page'] = strtoupper(clean2($this->uri->segment(4)));

      if($segment==5)
      $offset = $segments[5];

      $this->data['produk_row'] = $this->Kategori_model->get_list_by_subkategori($segments[4], $this->limit, $offset)->row();

      $this->data['produk'] = $this->Kategori_model->get_list_by_subkategori($segments[4], $this->limit, $offset);

      $this->data['pagination'] = $this->generate_paging($this->Kategori_model->get_by_subkategori_nr($segments[4]), base_url() . 'produk/p/' . $segments[3] . '/' . $segments[4],  5);

    }
    else if($segment==5 || ($segment==6 && is_numeric($segments[6])))
    {
      $this->data['page'] = strtoupper(clean2($this->uri->segment(5)));

      if($segment==6)
      $offset = $segments[6];

      $this->data['produk_row'] = $this->Kategori_model->get_list_by_superskategori($segments[5], $this->limit, $offset)->row();

      $this->data['produk'] = $this->Kategori_model->get_list_by_superskategori($segments[5], $this->limit, $offset);

      $this->data['pagination'] = $this->generate_paging($this->Kategori_model->get_by_superskategori_nr($segments[5]), base_url() . 'produk/p/' . $segments[3] . '/' . $segments[4] . '/' . $segments[5],  6);

    }

    $this->load->view('front/kategori/body', $this->data);
  }

  function generate_paging($numRows, $url, $uriSegment, $suffix='')
  {
  	$this->load->library('Pagination');

    $config['full_tag_open']    = "<ul class='pagination'>";
    $config['full_tag_close']   = "</ul>";
    $config['num_tag_open']     = "<li>";
    $config['num_tag_close']    = "</li>";
    $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
    $config['next_link']        = "Selanjutnya";
    $config['next_tag_open']    = "<li>";
    $config['next_tagl_close']  = "</li>";
    $config['prev_link']        = "Sebelumnya";
    $config['prev_tag_open']    = "<li>";
    $config['prev_tagl_close']  = "</li>";
    $config['first_link']       = "Awal";
    $config['first_tag_open']   = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_link']        = 'Terakhir';
    $config['last_tag_open']    = "<li>";
    $config['last_tagl_close']  = "</li>";

  	$config['base_url'] = $url;
  	$config['total_rows'] = $numRows;
  	$config['per_page'] = $this->limit;
  	$config['uri_segment'] = $uriSegment;
    $config['suffix'] = $suffix;
  	$config['first_url'] = $config['base_url'] . $config['suffix'];
  	$this->pagination->initialize($config);
  	return $this->pagination->create_links();
	}

  public function katalog()
  {
    /* menyiapkan data yang akan disertakan/ ditampilkan pada view */
    $this->data['page'] = "Katalog Produk";

    /* memanggil library pagination (membuat halaman) */
    $this->load->library('pagination');

    /* menghitung jumlah total data */
    $jumlah = $this->Produk_model->total_rows();

    // Mengatur base_url
    $config['base_url'] = base_url().'produk/katalog/halaman/';
    //menghitung total baris
    $config['total_rows'] = $jumlah;
    //mengatur total data yang tampil per halamannya
    $config['per_page'] = 12;
    // tag pagination bootstrap

    $config['full_tag_open']    = "<ul class='pagination'>";
    $config['full_tag_close']   = "</ul>";
    $config['num_tag_open']     = "<li>";
    $config['num_tag_close']    = "</li>";
    $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
    $config['next_link']        = "Selanjutnya";
    $config['next_tag_open']    = "<li>";
    $config['next_tagl_close']  = "</li>";
    $config['prev_link']        = "Sebelumnya";
    $config['prev_tag_open']    = "<li>";
    $config['prev_tagl_close']  = "</li>";
    $config['first_link']       = "Awal";
    $config['first_tag_open']   = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_link']        = 'Terakhir';
    $config['last_tag_open']    = "<li>";
    $config['last_tagl_close']  = "</li>";

    // mengambil uri segment ke-4
    $dari = $this->uri->segment('4');

    /* eksekusi library pagination ke model penampilan data */
    $this->data['katalog'] = $this->Produk_model->get_all_katalog($config['per_page'], $dari);
    $this->pagination->initialize($config);

    /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
    $this->load->view('front/produk/katalog', $this->data);
  }

}
