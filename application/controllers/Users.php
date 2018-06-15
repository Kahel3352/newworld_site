<?php
class Users extends CI_Controller 
{
	function login()
	{
		$this->load->database();
		$query = $this->db->query('SELECT Utilisateur.userId, Utilisateur.userNom, Utilisateur.userPrenom FROM Utilisateur WHERE Utilisateur.userMail = ? AND Utilisateur.userMdp = md5(?);', [$this->input->post('mail'), $this->input->post('password')]);
		if($query->num_rows()>0)
		{
			$this->load->library('session');
			$_SESSION['userId'] = $query->row()->userId;
			$_SESSION['userNom'] = $query->row()->userNom;
			$_SESSION['userPrenom'] = $query->row()->userPrenom; 
		}
		else
		{
			echo "Mot de passe et/adresse mail inccorect";
		}
	}

	function logout()
	{
		$this->load->library('session');
		$this->load->helper('url');
		var_dump($this->session);
		echo "<br><br>";
		unset($_SESSION["userId"]);
		var_dump($this->session);
		header("Location: ".base_url());
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
			$query = $this->db->query('SELECT Utilisateur.* FROM Utilisateur WHERE userMail = ?;', [$this->input->post('mail')]);
			if($query->num_rows()>0)
				echo "L'adresse mail est déjà associée à un compte";
			else
			{
				$idAdresse = $this->createAdresse($this->input->post('adresse'));
				$codeConfirmation = md5(time());
				$values = [
					$this->input->post('nom'),
					$this->input->post('prenom'),
					$this->input->post('mail'),
					$this->input->post('password'),
					$this->input->post('reponse'),
					$codeConfirmation,
					$this->input->post('question'),
					$idAdresse
				];
				$this->db->query("INSERT INTO Utilisateur (userId, userNom, userPrenom, userMail, userEtat, userDateInscription, userMdp, userReponseSecurite, userCodeConfirmation, phraseId, adresseId) VALUES ((select ifnull(max(userId), 0)+1 from Utilisateur as id), ?, ?, ?, 2, curdate(), md5(?), ?, ?, ?, ?);", $values);
				$this->sendMail($this->input->post('nom'), $this->input->post('prenom'), $this->input->post('mail'), $codeConfirmation);
				echo "Un mail de confirmation a été envoyé";
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

	function sendMail($nom, $prenom, $mail, $code)
	{
		$subject = "Inscription sur New World";
		$message = '<!doctype html>
						<html lang="fr">
						<head>
						  <meta charset="utf-8">
						  <title>Titre de la page</title>
						  <link rel="stylesheet" href="style.css">
						  <script src="script.js"></script>
						</head>
						<body>
							Cher(e) '.$prenom.' '.$nom.' <br> Bienvenu sur New World, veuillez confirmer votre inscription en cliquant sur le lien ci-dessous: <br> <a href="http://172.29.56.11/~mvanlerberghe/3.0/index.php/Users/confirm/'.$mail.'/'.$code.'">Confirmer</a>
						</body>
						</html>';
     	$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		mail($mail, $subject , $message, implode("\r\n", $headers));
	}

	function confirm($mail, $code)
	{
		$this->load->database();
		$this->db->query("UPDATE Utilisateur SET userEtat = 1 WHERE userMail = ? AND userCodeConfirmation = ?", [$mail, $code]);
	}
}
?>