<?php
class Newsletter extends CI_Controller 
{
	//est lancé chaque mois par un chron
	function index()
	{
		//on récupère la liste des consommateurs
		foreach ($this->getUtilisateurs() as $key => $user) 
		{
			//on génère le pdf
			$this->generatePdf($user);
			//on envoie le mail

		}
	}

	function getUtilisateurs()
	{
		$this->load->database();
		$users = [];
		$query = $this->db->query('SELECT Utilisateur.userId FROM Utilisateur;'); 
		foreach ($query->result_array() as $row)
		{
        	$users[] = $row["userId"];
		}
		return $users;
	}

	function generatePdf($idUser)
	{
		/*var_dump(function_usable("exec"));
		var_dump(file_exists("./pdf/catalogueNewWorld.exe"));*/
		/*$commande="catalogueNewWorld 1";
		var_dump(system($commande));*/
		var_dump(file_exists("./pdf/catalogueNewWorld"));
		exec("sudo -u mvanlerberghe ./pdf/catalogueNewWorld");
		exec("sudo -u mvanlerberghe whoami", $test);
		var_dump($test);
		//var_dump($test);
	}

	function sendMail($idUser)
	{

	}
}
?>
