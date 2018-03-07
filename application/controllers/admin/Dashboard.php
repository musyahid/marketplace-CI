<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
    $this->load->model('Kategori_model');
    $this->load->model('Ion_auth_model');

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
		else{
			$this->data = array(
	      'title' 							=> 'Dashboard',
	      'button' 							=> 'Tambah',
		    'total_user' 					=> $this->Ion_auth_model->total_rows(),
		    'total_kategori' 			=> $this->Kategori_model->total_rows()
			);

			$this->load->view('back/dashboard',$this->data);
		}
	}

}
