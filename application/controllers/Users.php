<?php
class Users extends CI_Controller 
{
	function login()
	{
		$this->load->database();
		$query = $this->db->query('select Utilisateur.Nom, Utilisateur.Prenom from Utilisateur inner join Securite on Utilisateur.idSecurite = Securite.idSecurite where mail = ? and mdp = ?;', [$this->input->post('login'), md5($this->input->post('password'))]);
			echo $query->num_rows();
	}

	function register()
	{
		$this->load->database();
		if(null==$this->input->post('nom') || null==$this->input->post('prenom') ||  null==$this->input->post('mail') || null==$this->input->post('password') || null==$this->input->post('passwordConfirmation') || null==$this->input->post('adresse'))
			echo "Veuillez remplir tout les champs";
		/*else if(!(ctype_alpha($this->input->post('nom')&&ctype_alpha($this->input->post('prenom')))))
			echo "Le nom et le prénom ne doivent contenir que des lettres";*/
		else if(!filter_var($this->input->post('mail'),FILTER_VALIDATE_EMAIL))
			echo "L'adresse mail n'es pas valide: ".$this->input->post('mail');
		else if($this->input->post('mail') != $this->input->post('mailConfirmation'))
			echo "La vérification du mail est incorrecte";
		else if($this->input->post('password') != $this->input->post('passwordConfirmation'))
			echo "La vérification du mot de passe est incorrecte";

		else
		{
			$query = $this->db->query('select Utilisateur.* from Utilisateur where userMail = ?;', [$this->input->post('mail')]);
			if($query->num_rows()>0)
				echo "L'adresse mail est déjà associée à un compte";
			else
			{
				$this->createAdresse($this->input->post('adresse'));
				$VALUES = [
					$this->input->post('nom'),
					$this->input->post('prenom'),
				];
				$query = "INSERT INTO Utilisateur (userId, userNom, userPrenom, userMail, userEtat, userDateInscription, userMdp, userReponseSecurite, phraseId, adresseId) VALUES ((select ifnull(max(userId), 0)+1 from Utilisateur), ?, ?, ?, 0, now(), ?, ?, ?, ?, ?);"
			}
		}

		//(0, "Lebeau", "Mélanie", "melanie33130@live.fr", 0, "2017-10-02", "0492684532", "ab4f63f9ac65152575886860dde480a1", "black rock shooter", 2, 4)
	}

	function createAdresse($adresse)
	{
		//si l'adresse n'existe pas dans la bdd
		$queryAdresse = $this->db->query("SELECT adresseId FROM Adresse INNER JOIN Ville ON Adresse.adresseId = Ville.villeId WHERE adresseRue = ? AND villeNom = ? AND villeCP = ?", [$adresse['rue'], $adresse['ville'], $adresse['cp']]);
		if($queryAdresse->num_rows()==0)
		{
			//si la ville n'existe pas dans la bdd
			$queryVille = $this->db->query("SELECT villeId FROM Ville WHERE villeNom = ? AND villeCP = ?;",[$adresse['ville'], $adresse['cp']]);
			if($queryVille->num_rows()==0)
			{
				//on l'a créer
				$this->db->query("INSERT INTO Ville (villeId, villeNom, villeCp) VALUES ((select ifnull(max(villeId), 0)+1 from Ville as id), ?, ?);", [$adresse["ville"], $adresse["cp"]]);
			}

			//on récupère l'id de la ville
			$queryVille = $this->db->query("SELECT villeId FROM Ville WHERE villeNom = ? AND villeCP = ?;",[$adresse['ville'], $adresse['cp']]);
			$idVille = $queryVille->row()->villeId;

			//on créer l'adresse
			$this->db->query("INSERT INTO Adresse (adresseId, adresseRue, villeId) VALUES ((select ifnull(max(adresseId), 0)+1 from Adresse as id), ?, ?);", [$adresse["rue"], $idVille]);
		}

		//on retourne l'id de l'adresse
		$queryAdresse = $this->db->query("SELECT adresseId FROM Adresse INNER JOIN Ville ON Adresse.villeId = Ville.villeId WHERE adresseRue = ? AND villeNom = ? AND villeCP = ?", [$adresse['rue'], $adresse['ville'], $adresse['cp']]);
		return $queryAdresse->row()->adresseId;
	}
}
?>