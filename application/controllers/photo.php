<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {

	public function index()
	{
		$this->load->view('photo');
	}
}

/* End of file photo.php */
/* Location: ./application/controllers/photo.php */