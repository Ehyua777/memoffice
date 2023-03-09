<?php
namespace LLibrary\Models;
class BlogCommentManager extends DBFactory
{
	//Récupérer la liste des commentaires d'un sujet
	public function getList($sID, $debut = -1, $limite = -1)
	{
		$valid = 1;
		$sql = '
		SELECT bc_id id, bs_id bsID, bc_author author, bc_content content, 
		DATE_FORMAT (bc_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (bc_editDate, \' %d/%m/%Y à %Hh%i\') AS editDate, 
		bc_validity validity, user_pseudo pseudo, user_avator avator
		FROM l_blog_comments
		INNER JOIN l_users ON l_blog_comments.bc_author = l_users.user_id
		WHERE bs_id = :sID AND bc_validity = :valid
		ORDER BY bc_id
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		try
		{
			$query=$this->db->prepare($sql);
			$query->bindValue(':sID', (int) $sID, \PDO::PARAM_INT);
			$query->bindValue(':valid', (int) $valid, \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
			'\LLibrary\Entities\BlogComment');
			$commentsList = $query->fetchAll();
			return $commentsList;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	//Ajouter un commentaire à un sujet
	public function add(\LLibrary\Entities\BlogComment $comment)
	{
		$sql='
		INSERT INTO l_blog_comments (bs_id, bc_author, bc_content, bc_postDate, 
		bc_editDate)
		VALUES(:subjectid, :author, :content, NOW(), NOW())
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':subjectid', $comment->bsID());
		$query->bindValue(':author', $comment->author());
		$query->bindValue(':content', $comment->content());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	//Compter le nombre de commentaire par sujet
	public function count($id)
	{
		$sql='
		SELECT COUNT(*) 
		FROM l_blog_comments 
		WHERE bs_id = '.(int) $id;
		return $this->db->query($sql)->fetchColumn();
	}
	//Suprimer un commentaire d'un sujet de la BD
	public function delete($id, $bsid)
	{
		$sql='
		DELETE FROM l_blog_comments
		WHERE bc_id = '.(int) $id.' AND bs_id = '.(int) $bsid;
		$this->db->exec($sql);
	}
	//Sélectionner un sujet à partir de son id
	/*public function getUnique($id)
	{
		$sql='
		SELECT bs_id id, bs_title title, bs_text text, bs_image image, bs_sender,   
		DATE_FORMAT (bs_postDate, \'le %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (bs_editDate, \'le %d/%m/%Y à %Hh%i\') AS editDate, bs_status status, 
		user_pseudo sender
		FROM ei_blog_subjects
		INNER JOIN ei_users ON ei_blog_subjects.bs_sender = ei_users.user_id
		WHERE bs_id = :id AND bs_status = 1
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'BlogSubject');
		return $query->fetch();
	}*/
	//Modifier un objet commentaire
	protected function update(\LLibrary\Entities\BlogComment $comment)
	{
		$sql='
		UPDATE l_blog_comments
		SET bc_content = :content, bc_editDate = NOW(), bc_validity = :validity
		WHERE bc_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':content' , $comment->content());
		$query->bindValue(':validity', $comment->validity());
		$query->bindValue(':id'      , $comment->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
}