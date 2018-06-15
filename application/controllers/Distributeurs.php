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
		$query = $this->db->query('SELECT Relai.relaiId FROM Distributeur INNER JOIN Utilisateur ON Distributeur.userId = Utilisateur.userId INNER JOIN Relai ON Distributeur.relaiId = Relai.relaiId WHERE userMail = ? AND userMdp = ?;', [$mail, $password]); 
		if($query->num_rows() < 1)
			echo "-1";
		else
		{
			echo $query->row(0)->relaiId;
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
		$query = $this->db->query(
			'SELECT DISTINCT Producteur.producteurId, Utilisateur.userNom, Utilisateur.userPrenom
			FROM LigneDeCmd 
			INNER JOIN Commande ON LigneDeCmd.cmdId = Commande.cmdId 
			INNER JOIN Lot ON LigneDeCmd.lotId = Lot.lotId 
			INNER JOIN Parcelle ON Lot.parcelleId = Parcelle.parcelleId 
			INNER JOIN Producteur ON Parcelle.producteurId = Producteur.producteurId 
			INNER JOIN Utilisateur ON Producteur.userId = Utilisateur.userId 
			WHERE Commande.relaiId = ?
			AND LigneDeCmd.ldcEtat = 1 
			AND Commande.cmdDate = DATE(CURDATE());', [$idRelais]);
		echo json_encode($query->result_array());
	}

	function getConsommateurs($idRelais)
	{
		$query = $this->db->query(
			"SELECT DISTINCT Utilisateur.userId, Utilisateur.userNom, Utilisateur.userPrenom 
			FROM LigneDeCmd 
			INNER JOIN Commande ON Commande.cmdId = LigneDeCmd.cmdId 
			INNER JOIN Utilisateur ON Commande.userId = Utilisateur.userId 
			WHERE Commande.relaiId = ?
			AND LigneDeCmd.ldcEtat != 3
			AND Commande.cmdDate = DATE(CURDATE());", [$idRelais]);
		echo json_encode($query->result_array());

	}

	function getLignesDeCommandeProducteur($idRelais, $idProducteur)
	{
		$this->load->database();
		$query = $this->db->query(
			'SELECT DISTINCT LigneDeCmd.lotId, LigneDeCmd.cmdId, LigneDeCmd.ldcQte, Produit.produitLibelle, Unite.uniteLibelle, Variete.varieteNom, Rayon.rayonLibelle 
			FROM LigneDeCmd 
			INNER JOIN Commande ON LigneDeCmd.cmdId = Commande.cmdId 
			INNER JOIN Lot ON LigneDeCmd.lotId = Lot.lotId 
			INNER JOIN Parcelle ON Lot.parcelleId = Parcelle.parcelleId 
			INNER JOIN Variete ON Lot.varieteId = Variete.varieteId 
			INNER JOIN Produit ON Variete.produitId = Produit.produitId 
			INNER JOIN Unite ON Produit.uniteId = Unite.uniteId 
			INNER JOIN Rayon ON Produit.rayonId = Rayon.rayonId 
			WHERE Commande.relaiId = ? 
			AND Parcelle.producteurId = ? 
			AND Commande.cmdDate = CURDATE();', [$idRelais, $idProducteur]);
		echo json_encode($query->result_array());
	}

	function getLignesDeCommandeConsommateur($idRelais, $idConsommateur)
	{
		$this->load->database();
		$query = $this->db->query('SELECT DISTINCT LigneDeCmd.lotId, LigneDeCmd.cmdId, LigneDeCmd.ldcQte, Produit.produitLibelle, Unite.uniteLibelle, Variete.varieteNom, Rayon.rayonLibelle FROM LigneDeCmd INNER JOIN Commande ON LigneDeCmd.cmdId = Commande.cmdId INNER JOIN Utilisateur ON Commande.userId = Utilisateur.userId INNER JOIN Lot ON LigneDeCmd.lotId = Lot.lotId INNER JOIN Variete ON Lot.varieteId = Variete.varieteId INNER JOIN Produit ON Variete.produitId = Produit.produitId INNER JOIN Unite ON Produit.uniteId = Unite.uniteId INNER JOIN Rayon ON Produit.rayonId = Rayon.rayonId WHERE Commande.relaiId = ? AND Utilisateur.userId = ? AND Commande.cmdDate = CURDATE();', [$idRelais, $idConsommateur]);
			echo json_encode($query->result_array());
	}

	function changerEtatLigneDeCommande($idLot, $idCommande, $etat)
	{
		$this->load->database();
		//on vérifie que $etat et un état valide (1 = en cours, 2 = livré au point de distribution, 3 = récupéré par le consommateur, 4 = annulé)
		if($etat < 5 AND $etat > 0)
		{
			$query = $this->db->query('UPDATE LigneDeCmd SET ldcEtat = ? WHERE LigneDeCmd.lotId = ? AND LigneDeCmd.cmdId = ?;', [$etat, $idLot, $idCommande]);
		}
	}
}
?>
