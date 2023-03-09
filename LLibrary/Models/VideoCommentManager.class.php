<?php namespace LLibrary\Models;
class VideoCommentManager extends DBFactory
{
	//Récupérer la liste des commentaires d'un sujet
	public function getList($sID, $offset = -1, $limit = -1)
	{
		$valid = 1;
		$sql = '
		SELECT vc_id id, video_id videoID, vc_author author, vc_content content, 
		vc_postDate postDate, vc_editDate editDate, vc_validity validity, 
		user_pseudo pseudo, user_avator avator
		FROM l_videos_comments
		INNER JOIN l_users ON l_videos_comments.vc_author = l_users.user_id
		WHERE video_id = :videoID AND vc_validity = :valid
		ORDER BY vc_id
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($offset != -1 || $limit != -1)
		{
			$sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $offset;
		}
		try
		{
			$query=$this->db->prepare($sql);
			$query->bindValue(':videoID', (int) $sID, \PDO::PARAM_INT);
			$query->bindValue(':valid'  , (int) $valid, \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
			'\LLibrary\Entities\VideoComment');
			$commentsList = $query->fetchAll();
			return $commentsList;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	//Ajouter un commentaire à un sujet
	public function add(\LLibrary\Entities\VideoComment $comment)
	{
		$sql='
		INSERT INTO l_videos_comments (video_id, vc_author, vc_content, vc_postDate, 
		vc_editDate)
		VALUES(:video, :author, :content, NOW(), NOW())
		';
		try
		{
			$query = $this->db->prepare($sql);
			$query->bindValue(':video'  , $comment->videoID());
			$query->bindValue(':author' , $comment->author());
			$query->bindValue(':content', $comment->content());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	//Modifier un objet commentaire
	protected function update(\LLibrary\Entities\VideoComment $comment)
	{
		$sql='
		UPDATE l_video_comments
		SET vc_content = :content, vc_editDate = NOW(), vc_validity = :validity
		WHERE vc_id = :id
		';
		try
		{
			$query = $this->db->prepare($sql);
			$query->bindValue(':content' , $comment->content());
			$query->bindValue(':validity', $comment->validity());
			$query->bindValue(':id'      , $comment->id());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	//Compter le nombre de commentaire par sujet
	public function count($id)
	{
		$sql='
		SELECT COUNT(*) 
		FROM l_videos_comments 
		WHERE video_id = '.(int) $id;
		try
		{
			return $this->db->query($sql)->fetchColumn();
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	//Suprimer un commentaire d'un sujet de la BD
	public function delete($id, $videoID)
	{
		$sql='
		DELETE FROM l_videos_comments
		WHERE vc_id = '.(int) $id.' AND video_id = '.(int) $videoID;
		try
		{
			$this->db->exec($sql);
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
}