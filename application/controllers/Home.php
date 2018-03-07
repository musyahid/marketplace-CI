<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		/* memanggil model untuk ditampilkan pada masing2 modul*/
		$this->load->model('Produk_model');
		$this->load->model('Slider_model');

    /* menyiapkan data yang akan disertakan/ ditampilkan pada view */
		$this->data['page'] 		= 'Home';
		$this->data['title'] 		= 'MarketPlace';

		/* memanggil function dari masing2 model yang akan digunakan */
		$this->data['slider_data'] 				= $this->Slider_model->get_all();
		$this->data['produk_new_data'] 				= $this->Produk_model->get_all_new_home();

		/* memanggil view yang telah disiapkan dan passing data dari model ke view*/
		$this->load->view('front/home/body', $this->data);
	}

}
