<?php
namespace LLibrary\Models;
class BlogSubjectManager extends DBFactory
{
	//Ajouter un sujet de blog
	public function add(\LLibrary\Entities\BlogSubject $subject)
	{
		try
		{
			$sql='
			INSERT INTO l_blog_subjects (bs_title, bs_text, bs_image, bs_sender, 
			bs_postDate, bs_editDate)
			VALUES (:title, :text, :url, :image, :sender, NOW(), NOW())
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':title', $subject->title());
			$query->bindValue(':text', $subject->text());
			$query->bindValue(':url', $subject->url());
			$query->bindValue(':image', $subject->image());
			$query->bindValue(':sender', $subject->sender());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function count()
	{
		$sql='
		SELECT COUNT(*)
		FROM l_blog_subjects
		WHERE bs_status = 1
		';
		return $this->db->query($sql)->fetchColumn();
	}
	public function delete($id)
	{
		try
		{
			$sql='DELETE FROM l_blog_subjects WHERE bs_id = '.(int) $id;
			$this->db->exec($sql);
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function getList($debut = -1, $limite = -1)
	{
		$sql = '
		SELECT bs_id id, bs_title title, bs_text text, bs_url url, bs_image image, 
		bs_sender sender,  
		DATE_FORMAT (bs_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (bs_editDate, \' %d/%m/%Y à %Hh%i\') AS editDate, bs_status status,
		user_pseudo pseudo, user_alias alias
		FROM l_blog_subjects
		INNER JOIN l_users ON l_blog_subjects.bs_sender = l_users.user_id
		WHERE bs_status = 1
		ORDER BY bs_editDate DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query=$this->db->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\BlogSubject');
		$subjectsList = $query->fetchAll();
		$query->closeCursor();
		return $subjectsList;
	}
	public function getUnique($id)
	{
		$sql='
		SELECT bs_id id, bs_title title, bs_text text, bs_url url, bs_image image, 
		bs_sender sender,   
		DATE_FORMAT (bs_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (bs_editDate, \' %d/%m/%Y à %Hh%i\') AS editDate, bs_status status, 
		user_pseudo pseudo, user_alias alias
		FROM l_blog_subjects
		INNER JOIN l_users ON l_blog_subjects.bs_sender = l_users.user_id
		WHERE bs_id = :id AND bs_status = 1
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\BlogSubject');
		return $query->fetch();
	}
	public function update(\LLibrary\Entities\BlogSubject $subject)
	{
		
		try
		{
			$sql='
			UPDATE l_blog_subjects
			SET bs_title = :title, bs_text = :text, bs_url = :url, bs_image = :image, 
			bs_editDate = NOW(), bs_status = :status
			WHERE bs_id = :id
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':title', $subject->title());
			$query->bindValue(':text', $subject->text());
			$query->bindValue(':url', $subject->url());
			$query->bindValue(':image', $subject->image());
			$query->bindValue(':status', $subject->status());
			$query->bindValue(':id', $subject->id());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function save(\LLibrary\Entities\BlogSubject $subject)
	{
		if ($subject->isValid())
		{
			$subject->isNew() ? $this->add($subject) : $this->update($subject);
		}
		else
		{
			throw new \RuntimeException('La news doit être valide pour être enregistrée');
		}
	}
}