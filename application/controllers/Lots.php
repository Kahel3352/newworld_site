<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lots extends CI_Controller 
{
	function getLots()
	{
		$this->load->database();
		$query = $this->db->query(
			'SELECT Variete.varieteNom, Variete.varieteDescr, Variete.varieteImg, Lot.lotPrix, Unite.uniteLibelle FROM Lot
			INNER JOIN Variete ON Lot.varieteId = Variete.varieteId
			INNER JOIN Produit ON Variete.produitId = Produit.produitId
			INNER JOIN Unite ON Produit.uniteId = Unite.uniteId;');
		if($query->num_rows()>0)
		{
			echo json_encode($query->result_array());
		}
	}
}

?>