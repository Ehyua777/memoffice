<?php namespace LLibrary\Models;
class VideoManager extends DBFactory
{
	public function add(\LLibrary\Entities\Video $video)
	{
		$sql='
		INSERT INTO l_videos (video_title, video_src, video_comment, video_poster, 
		video_type, video_url)
		VALUES (:title, :src, :comment, :poster, :type, :url)
		';
		try
		{
			$query = $this->db->prepare($sql);
			$query->bindValue(':title'  , $video->title());
			$query->bindValue(':src'    , $video->src());
			$query->bindValue(':comment', $video->comment());
			$query->bindValue(':type'   , $video->type());
			$query->bindValue(':url'    , $video->url());
			$query->bindValue(':poster' , $video->poster());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	protected function update(\LLibrary\Entities\Video $video)
	{
		$sql='
		UPDATE l_news
		SET news_author = :author, news_title = :title, news_content = :content, 
		news_image = image, news_editDate = NOW()
		WHERE news_id = :id
		';
		try
		{
			$query = $this->db->prepare($sql);
			$query->bindValue(':title', $news->title());
			$query->bindValue(':author', $news->author());
			$query->bindValue(':content', $news->content());
			$query->bindValue(':image', $news->image());
			$query->bindValue(':id', $news->id());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function getList($debut = -1, $limite = -1)
	{
		$sql = '
		SELECT video_id id, video_title title, video_src src, video_comment comment, 
		video_poster poster, 
		DATE_FORMAT (video_postDate, \' %d/%m/%Y à %Hh%i\') postDate, video_url url, 
		video_validity valid
		FROM l_videos
		ORDER BY video_id DESC
		';
		//On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		try
		{
			$query = $this->db->query($sql);
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
			'\LLibrary\Entities\Video');
			$videoList = $query->fetchAll();
			return $videoList;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function getUnique($id)
	{
		$sql='
		SELECT video_id id, video_title title, video_src src, video_comment comment, 
		video_poster poster, 
		DATE_FORMAT (video_postDate, \' %d/%m/%Y à %Hh%i\') postDate, video_url url, 
		video_validity valid
		FROM l_videos
		WHERE video_id = :id
		ORDER BY video_id DESC
		';
		try
		{
			$query = $this->db->prepare($sql);
			$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
			$query->execute() or die(print_r($db->errorInfo()));
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
			'\LLibrary\Entities\Video');
			return $query->fetch();
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function count()
	{
		$sql='SELECT COUNT(*) FROM l_videos WHERE video_validity = 1';
		try
		{
			return $this->db->query($sql)->fetchColumn();
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function delete($id)
	{
		$sql='DELETE FROM l_videos WHERE video_id = '.(int) $id;
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