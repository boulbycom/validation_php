<?php
namespace App;

class Response{
	public $from;
	public $errors;
	public $request;
	public $session;
	public $validators = array(
		'Nom' =>  array(
			'rule' => 'noEmpty',
			'message' => 'le champ name ne peut pas etre vide'
			 ), 
		'Email' =>  array(
			'rule' => '([a-z]+[a-z1-9.\-]+@[a-z]+[a-z1-9\-]+\.[a-z]{2,3})',
			'message' => 'cet email n\'est pas valide'
			 ),
		'Objet' =>  array(
			'rule' => 'noEmpty',
			'message' => 'le champ subject ne peut pas etre vide'
			 ),
		'Message' =>  array(
			'rule' => 'noEmpty',
			'message' => 'le champ message ne peut pas etre vide'
			 ), 
		);


	public function __construct($request){
		$this->request = $request;
	}

	/*********************
	*Effectue les validations*
	*************************/
	private function validation(){
		//Verifions si les donnes sont postes

			//Itialise le valideur
			$is_valide = true;

			foreach ($this->validators as $field => $v) {
				//si la regle est non vide
				if($v['rule'] == 'noEmpty'){
					//Si c'est valide, alors il faut declencher erreurs
					if (empty($this->request->data->$field)) {
    					$this->errors[$field] = $v['message'];
    					$is_valide = false;
	                }
				}elseif (!preg_match('/^'.$v['rule'].'$/', $this->request->data->$field)) {
					$this->errors[$field] = $v['message'];
    					$is_valide = false;
				}

			}

		return $is_valide;

	}

	/********************
	*Permet d'envoyer le message *
	*******************************/
	public function sendMail()	{
		//Verifie si les informati
		if(isset($this->request->data) AND !empty($this->request->data)){

			if ($this->validation()) {
				//
					$to = 'bourama.traore12@yahoo.fr';

					$subject = $this->request->data->Objet;

					$headers = "From: " .strip_tags($this->request->data->Nom).'<'. strip_tags($this->request->data->Email) . ">\r\n";
					$headers .= "Reply-To: ". strip_tags($this->request->data->Email) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				//

				if(mail($to, $subject, $this->request->data->Message, $headers)){
					$sessionFlash = "Le mail a ete envoyer avec succes !";
					$sessionOption = "success";
					//On vide data
					unset($this->request->data);
				}else{
					$sessionFlash = "Envoie echoué, le serveur a racontré un probleme !";
					$sessionOption = "danger";
				}
			}else{
				$sessionFlash = "Les champs ne sont pas correctement renseignés";
				$sessionOption = "danger";
			}

			//var_dump($this->form->errors);
			if(isset($sessionFlash) AND !empty($sessionFlash)){
				//Construire la session
				$this->session = new \Session();
				$this->session->setFlash($sessionFlash, $sessionOption);
			}
		}

		$this->form->errors = $this->errors;
		//rendre à la vue, les infos
		$this->output();

	}

	/********************************************
	*  permet de rendre les informations à la vue*
	*********************************************/
	private function output(){
		require WEBROOT.DS.'view.php';
	}

}