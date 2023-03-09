<?php
namespace LLibrary\Models;
class PhotoManager extends DBFactory
{
	public function getList($debut = -1, $limite = -1)
	{
		$valid = 1;
		$sql = '
		SELECT photo_id id,	photo_title title, photo_fileName fileName, photo_comment 
		comment, DATE_FORMAT(photo_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		photo_validity validity
		FROM l_photos
		WHERE photo_validity = :valid
		ORDER BY photo_id DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query = $this->db->prepare($sql);
		$query->bindValue(':valid', $valid, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\Photo');
		$photosList = $query->fetchAll();
		return $photosList;
	}
	public function count()
	{
		$sql = 'SELECT COUNT(*) FROM l_photos WHERE photo_validity = 1';
		return $this->db->query($sql)->fetchColumn();
	}
	public function add(\LLibrary\Entities\Photo $photo)
	{
		$sql='
		INSERT INTO l_photos (photo_title, photo_fileName, photo_comment)
		VALUES (:title, :fileName, :comment)
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':title'   , $photo->title());
		$query->bindValue(':fileName', $photo->filename());
		$query->bindValue(':comment' , $photo->comment());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	public function delete($id)
	{
		$sql='DELETE FROM l_news WHERE news_id = '.(int) $id;
		$this->db->exec($sql);
	}
	protected function update(\LLibrary\Entities\News $news)
	{
		$sql='
		UPDATE l_news
		SET news_author = :author, news_title = :title, news_content = :content, 
		news_image = image, news_editDate = NOW()
		WHERE news_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':title', $news->title());
		$query->bindValue(':author', $news->author());
		$query->bindValue(':content', $news->content());
		$query->bindValue(':image', $news->image());
		$query->bindValue(':id', $news->id(), \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
	}
	public function getUnique($id)
	{
		$sql='
		SELECT news_id id, news_author, news_title title, news_content content, 
		news_image image, 
		DATE_FORMAT (news_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (news_editDate, \' %d/%m/%Y à %Hh%i\') AS editDate, 
		user_pseudo author 
		FROM l_news
		INNER JOIN l_users ON l_news.news_author = l_users.user_id
		WHERE news_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\News');
		return $query->fetch();
	}
}