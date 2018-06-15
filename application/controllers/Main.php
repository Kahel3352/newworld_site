<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');

		echo link_tag(base_url().'css/bootstrap.min.css');
		echo link_tag(base_url().'css/mdb.min.css');
		echo link_tag(base_url().'css/caroussel.css');
		echo link_tag(base_url().'css/style.css');
		echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

		//modal login
		$loginData["questions"] = $this->getQuestions();
		$this->load->view('v_modal_login', $loginData);
		$this->load->view('v_navbar');
	}

	public function index()
	{
		$this->load->view('v_main');

	}

	public function acheter()
	{
		$this->load->view('v_acheter');
	}

	public function profil()
	{
		$this->load->view('v_profil');
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