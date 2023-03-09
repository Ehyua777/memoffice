<?php
if (isset($_POST['contact']))
{
	if (empty($_POST['teste']))
	{
		extract($_POST);
		$mail = new LLibrary\General\Mail(array(
		'addrressee'  => 'marcel.ehya@memo.net',
		'subject'     => $subject,
		'content'     => $content,
		'senderName'  => $pseudo,
		'senderEmail' => $email
		));
		if (!$mail->checkSubject())
		{
			$message = "Proposez svp un sujet à la conversation";
		}
		elseif (!$mail->checkContent())
		{
			$message ="Remplissez svp le champ message";
		}
		elseif (!$mail->checkSenderName())
		{
			$message ="Remplissez svp le cham pseudo";
		}
		else
		{
			$alert = $mail->checkContactEmail();
			if ($alert['alert'] < 1)
			{
				if ($mail->sendAnEMail())
				{
					$message = "Votre message nous est bien parvenu";
				}
				else
				{
					$message = "Oups, une erreur s'est produite lors de l'envoi du 
					message. Veuillez recommencer.";
				}
			}
			else
			{
				$message = $alert['error'];
			
			}
		}
	}
	else
	{
		$message="Merci, votre message a tres bien été posté";
	}
}
else
{
	//header('location:'.$config->rp().'/contacts');
}
include('details.php');
include('form0.php'); 
?>