<?php
namespace LLibrary\Models;
class NewsManager_PDO extends NewsManager
{
	public function add(\LLibrary\Entities\News $news)
	{
		$sql='
		INSERT INTO l_news
		SET news_author = :author, news_title = :title, news_content = :content, 
		news_image = :image, news_postDate = NOW(), news_editDate = NOW()
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':title', $news->title());
		$query->bindValue(':author', $news->author());
		$query->bindValue(':content', $news->content());
		$query->bindValue(':image', $news->image());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	/**
	* @see NewsManager::count()
	*/
	public function count()
	{
		$sql='SELECT COUNT(*) FROM l_news WHERE news_status = 1';
		return $this->db->query($sql)->fetchColumn();
	}
	/**
	* @see NewsManager::delete()
	*/
	public function delete($id)
	{
		$sql='DELETE FROM l_news WHERE news_id = '.(int) $id;
		$this->db->exec($sql);
	}
	/**
	* @see NewsManager::getList()
	*/
	public function getList($debut = -1, $limite = -1)
	{
		$sql = '
		SELECT news_id id, news_author, news_title title, news_content content, 
		news_image image, 
		DATE_FORMAT (news_postDate, \' %d/%m/%Y à %Hh%i\') AS postDate, 
		DATE_FORMAT (news_editDate, \' %d/%m/%Y à %Hh%i\') AS editDate, 
		user_pseudo author 
		FROM l_news
		INNER JOIN l_users ON l_news.news_author = l_users.user_id
		ORDER BY news_id DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		$query = $this->db->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\News');
		$listeNews = $query->fetchAll();
		return $listeNews;
	}
	/**
	* @see NewsManager::getUnique()
	*/
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
	/**
	* @see NewsManager::update()
	*/
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
		$query->bindValue(':id', $news->id());
		$query->execute() or die(print_r($db->errorInfo()));
	}
	
	// Récupération de la dernièrre info
	public function getInfo()
	{
		$sql = '
		SELECT news_content content, 
		DATE_FORMAT(news_postDate, \'%d/%m/%Y à %Hh%imin%ss\') date
		FROM l_news
		WHERE news_status = ?
		ORDER BY news_id DESC
		LIMIT 0, 1';
		$valid=1;
		$query = $this->db->prepare($sql);
		$query->execute(array($valid)) or die(print_r($db->errorInfo()));
		$news = $query->fetchAll();
		return $news;
	}
}