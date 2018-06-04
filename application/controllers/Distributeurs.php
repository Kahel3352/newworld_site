<?php
class Distributeurs extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	function login($mail, $password)
	{
		$query = $this->db->query('SELECT Utilisateur.*, Relai.* FROM Distributeur INNER JOIN Utilisateur ON Distributeur.userId = Utilisateur.userId INNER JOIN Relai ON Distributeur.relaiId = Relai.relaiId WHERE userMail = ? AND userMdp = ?;', [$mail, $password]); 
		if($query->num_rows() < 1)
			echo "Mauvais mail ou mot de passe";
		else
		{
			echo json_encode($query->row());
			$_SESSION['idRelai'] = $query->row()->relaiId;
		}

	}

	function logout()
	{
		session_destroy();
	}

	function test()
	{
		$test = [$message = "hello world"];
		echo json_encode($_SESSION['idRelai']);
	}

	function getProducteurs($idRelais)
	{
		$this->load->database();
		$query = $this->db->query('SELECT Producteur.* FROM Commande INNER JOIN Relai ON Commande.relaiId = Relai.relaiId INNER JOIN Lot ON Commande.lotId = Lot.lotId INNER JOIN Parcelle ON Lot.parcelleId = Parcelle.parcelleId INNER JOIN Producteur ON Producteur.producteurId = Parcelle.producteurId INNER JOIN Distributeur ON Distributeur.relaiId = Relai.relaiId INNER JOIN Utilisateur ON Distributeur.userId = Utilisateur.userId WHERE Distributeur.relaiId = ? AND DATE(cmdDate) = DATE(NOW());', [$idRelais]);
			echo json_encode($query->result_array());
	}

	function getLignesDeCommandes($idProducteur)
	{
		$this->load->database();
		$query = $this->db->query(';', [$idProducteur]);
			echo json_encode($query->result_array());
	}
}
?>
