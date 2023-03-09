<?php namespace LLibrary\General;
class Mail
{
	protected $addrressee,
	$subject,
	$content,
	$senderName,
	$senderEmail;
	
	public function checkSubject()
	{
		return !empty($this->subject);
	}
	public function checkContent()
	{
		return !empty($this->content);
	}
	public function checkSenderName()
	{
		return !empty($this->senderName);
	}
	
	// SETTERS //
	public function setAddrressee($addrressee)
	{
		$this->addrressee=$addrressee;
	}
	public function setSubject($subject)
	{
		$this->subject=stripslashes(htmlspecialchars($subject));
	}
	public function setContent($content)
	{
		$this->content=stripslashes(htmlspecialchars($content));
	}
	public function setSenderName($senderName)
	{
		$this->senderName=stripslashes(htmlspecialchars($senderName));
	}
	public function setSenderEmail($sender)
	{
		$this->senderEmail=$sender;
	}
	// HYDRATATION //
	public function hydrate($data)
	{
		foreach ($data as $attribute => $value)
		{
			$method = 'set'.ucfirst($attribute);
			if (is_callable(array($this, $method)))
			{
				$this->$method($value);
			}
		}
	}	
	// CONSTRUCTEUR //
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	
	// FONCTION CLE D'EXPEDITION D'UN COURIER ELECTRONIQUE //
	public function sendAnEMail()
    {
		$mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
		$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$mailHeaders .= 'From: $this->senderName <$this->senderEmail>' . "\r\n";
		$mailHeaders .= 'Reply-To: $this->senderEmail';
		mail($this->addrressee, $this->subject, $this->content, $mailHeaders);
	}
	// FONCTIONS DE VERIFICATION //
	public function checkContactEmail()
	{
		$alert=0;
		$emailErr=NULL;
		$contactEmailAlert=array();
		if (empty($this->senderEmail))
		{
			$alert++;
			$emailErr="Vous n'avez pas remplis le champ e-mail.";			
		}
		if (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', 
		$this->senderEmail))
		{
			$alert++;
			$emailErr="E-mail pas valid!";
		}
		$contactEmailAlert=array('alert' => $alert, 'error' => $emailErr);
		return $contactEmailAlert;
	}
	
	public function checkContactPosts($pseudo, $subject, $message)
	{
		$alert=0;
		$contactErr=NULL;
		$pseudoErr=NULL;
		$subjectErr=NULL;
		$messageErr=NULL;
		$contactAlert=array();
		if (empty($pseudo))
		{
			$alert++;
			$pseudoErr='Vous n\'avez pas remplis le champ du pseudo.';
		}
		if (empty($subject))
		{
			$alert++;
			$subjectErr='Vous n\'avez pas remplis le champ du sujet.';
		}
		if (empty($message))
		{
			$alert++;
			$messageErr='Vous n\'avez pas remplis le champ du message.';
		}
		$contactAlert=array(
		'alert' => $alert,
		'perro' => $pseudoErr,
		'serro' => $subjectErr,
		'merro' => $messageErr
		);
		return $contactAlert;
	}
	// GETTERS //
	public function addrressee(){ return $this->addrressee; }
	public function subject(){ return $this->subject; }
	public function content(){ return $this->content; }
	public function sender(){ return $this->sender; }
	public function senderName(){ return $this->senderName; }
}