<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		echo link_tag(base_url().'css/bootstrap.min.css');
		echo link_tag(base_url().'css/mdb.min.css');
		echo link_tag(base_url().'css/caroussel.css');
		echo link_tag(base_url().'css/style.css');
		echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

		//modal login
		$loginData["questions"] = $this->getQuestions();
		$this->load->view('v_modal_login', $loginData);

		$this->load->view('v_navbar');
		$this->load->view('v_main');
		$this->load->view('v_footer');

	}

	public function login()
	{
		header("Location: base_url()");
	}

	function getQuestions()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM Question;");
		return $query->result_array();
	}
}
?>