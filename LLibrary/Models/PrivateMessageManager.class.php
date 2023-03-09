<?php
namespace LLibrary\Models;
class PrivateMessageManager extends DBFactory
{
	// RECUPERATION DE LA BOITE DE RECEPTION //
	public function getList($debut = -1, $limite = -1, $memberID, $stat)
	{
		$sql = '
		SELECT message_id messageID, message_talkNumber talkNumber, message_sender 
		senderID, message_title title, message_content content, 
		message_addressee addressee, message_previous previous, 
		DATE_FORMAT (message_postTime, \' %d/%m/%Y à %Hh%i\') AS postTime, 
		message_status status, user_pseudo senderPseudo, user_avator avator
		FROM l_private_messages
		INNER JOIN l_users ON l_private_messages.message_sender = l_users.user_id
		WHERE message_addressee = :member AND message_status <= :stat
		ORDER BY message_id DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query=$this->db->prepare($sql);
		$query->bindValue(':member', (int) $memberID, \PDO::PARAM_INT);
		$query->bindValue(':stat', (int) $stat, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\PrivateMessage');
		$messagesList = $query->fetchAll();
		return $messagesList;
	}
	// LECTURE D'UN MESSAGE //
	public function getUnique($id)
	{
		$sql='
		SELECT message_id messageID, message_talkNumber talkNumber, 
		message_sender senderID, message_title title, message_content content, 
		message_addressee addressee, message_previous previous,
		DATE_FORMAT (message_postTime, \' %d/%m/%Y à %Hh%i\') AS postTime, 
		message_status status, user_pseudo senderPseudo, user_signature signature, 
		user_avator avator, user_localisation localisation, user_iDate iDate, 
		user_posts posts  
		FROM l_private_messages
		INNER JOIN l_users ON l_private_messages.message_sender = l_users.user_id
		WHERE message_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\PrivateMessage');
		return $query->fetch();
	}
	// POSTER UN MESSAGE //
	public function add(\LLibrary\Entities\PrivateMessage $message)
	{
		try
		{
			$sql='
			INSERT INTO l_private_messages (message_talkNumber, message_sender, 
			message_title, message_content, message_addressee, message_previous)
			VALUES (:talkNumber, :sender, :title, :content, :addressee, :previous)
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':talkNumber', $message->talkNumber());
			$query->bindValue(':sender', $message->senderID());
			$query->bindValue(':title', $message->title());
			$query->bindValue(':content', $message->content());
			$query->bindValue(':addressee', $message->addressee());
			$query->bindValue(':previous', $message->previous());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	// RECUPERATION DES REPONSES //
	public function getAnswersList($debut = -1, $limite = -1, $memberID, $msg)
	{
		$sql = '
		SELECT message_id messageID, message_talkNumber talkNumber, 
		message_sender senderID, message_title title, message_content content, 
		message_addressee addressee, message_previous previous, 
		DATE_FORMAT (message_postTime, \' %d/%m/%Y à %Hh%i\') AS postTime, 
		message_status status, user_pseudo senderPseudo, user_avator avator
		FROM l_private_messages
		INNER JOIN l_users ON l_private_messages.message_sender = l_users.user_id
		WHERE message_addressee = :member AND message_id = :msg AND 
		message_status <= :stat
		ORDER BY message_id
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query=$this->db->prepare($sql);
		$query->bindValue(':member', (int) $memberID, \PDO::PARAM_INT);
		$query->bindValue(':msg', (int) $msg, \PDO::PARAM_INT);
		$query->bindValue(':stat', (int) $msg, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\PrivateMessage');
		$messagesList = $query->fetchAll();
		return $messagesList;
	}
	/**
	* @see NewsManager::count()
	*/
	public function count($stat)
	{
		$sql='
		SELECT COUNT(*)
		FROM l_private_messages
		WHERE message_status ='.$stat;
		return $this->db->query($sql)->fetchColumn();
	}
	/**
	* @see NewsManager::delete()
	*/
	public function delete($id)
	{
		try
		{
			$sql='DELETE FROM l_blog_subject WHERE bs_id = '.(int) $id;
			$this->db->exec($sql);
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function update(\LLibrary\Entities\PrivateMessage $message)
	{
		
		try
		{
			$sql='
			UPDATE l_private_messages
			SET message_status = :status
			WHERE message_id = :id
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':status', $message->status(), \PDO::PARAM_INT);
			$query->bindValue(':id', $message->messageID(), \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
}