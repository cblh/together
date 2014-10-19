<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codemirror extends CI_Controller {

	public function index()
	{
		$this->load->view('editor');
	}
}

/* End of file codemirror.php */
/* Location: ./application/controllers/codemirror.php */