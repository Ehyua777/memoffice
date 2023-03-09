<?php
namespace LLibrary\Models;
class NewsManager_MySQLi extends NewsManager
{
	/**
	* Attribut contenant l'instance représentant la BDD.
	* @type MySQLi
	*/
	protected $db;
	/**
	* Constructeur étant chargé d'enregistrer l'instance de MySQLi dans l'attribut $db.
	* @param $db MySQLi Le DAO
	* @return void
	*/
	public function __construct(MySQLi $db)
	{
		$this->db = $db;
	}
	/**
	* @see NewsManager::add()
	*/
	protected function add(News $news)
	{
		$title=stripslashes(htmlspecialchars($news->titre()));
		$author=stripslashes(htmlspecialchars($news->auteur()));
		$content=stripslashes(htmlspecialchars($news->contenu()));
		$query = $this->db->prepare('
		INSERT INTO ei_news
		SET auteur = ?, titre = ?, contenu = ?, dateAjout = NOW(), dateModif = NOW()
		');
		$query->bind_param('sss', $author, $title, $content);
		$query->execute() or die(print_r($db->errorInfo()));
	}
	/**
	* @see NewsManager::count()
	*/
	public function count()
	{
		return $this->db->query('SELECT id FROM ei_news')->num_rows;}
		/**
		* @see NewsManager::delete()
		*/
		public function delete($id)
		{
			$id = (int) $id;
			$query = $this->db->prepare('DELETE FROM ei_news WHERE id = ?');
			$query->bind_param('i', $id);
			$query->execute() or die(print_r($db->errorInfo()));
		}
		/**
		* @see NewsManager::getList()
		*/
		public function getList($debut = -1, $limite = -1)
		{
			$listeNews = array();
			$sql = '
			SELECT id, auteur, titre, contenu, 
			DATE_FORMAT (dateAjout, \'le %d/%m/%Y à %Hh%i\') AS dateAjout, 
			DATE_FORMAT (dateModif, \'le %d/%m/%Y à %Hh%i\') AS dateModif 
			FROM ei_news 
			ORDER BY id DESC
			';
			//On vérifie l'intégrité des paramètres fournis.
			if ($debut != -1 || $limite != -1)
			{
				$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
			}
			$query = $this->db->query($sql);
			while ($news = $query->fetch_object('News'))
			{
				$listeNews[] = $news;
			}
			return $listeNews;
		}
		/**
		* @see NewsManager::getUnique()
		*/
		public function getUnique($id)
		{
			$id = (int) $id;
			$query = $this->db->prepare('
			SELECT id, auteur, titre, contenu, 
			DATE_FORMAT (dateAjout, \'le %d/%m/%Y à %Hh%i\') AS dateAjout, 
			DATE_FORMAT (dateModif, \'le %d/%m/%Y à %Hh%i\') AS dateModif 
			FROM ei_news 
			WHERE id = ?
			');
			$query->bind_param('i', $id);
			$query->execute() or die(print_r($db->errorInfo()));
			$query->bind_result($id, $auteur, $titre, $contenu, $dateAjout, $dateModif);
			$query->fetch();
			return new \LLibrary\Entities\News(array(
			'id' => $id,
			'auteur' => $auteur,
			'titre' => $titre,
			'contenu' => $contenu,
			'dateAjout' => $dateAjout,
			'dateModif' => $dateModif
			));
		}
		/**
		* @see NewsManager::update()
		*/
		protected function update(\LLibrary\Entities\News $news)
		{
			$title=stripslashes(htmlspecialchars($news->titre()));
			$author=stripslashes(htmlspecialchars($news->auteur()));
			$content=stripslashes(htmlspecialchars($news->contenu()));
			$query = $this->db->prepare('
			UPDATE ei_news 
			SET auteur = ?, titre = ?, contenu = ?, dateModif = NOW() WHERE id = ?
			');
			$query->bind_param('sssi', $author, $title, $content, $news->id());
			$query->execute() or die(print_r($db->errorInfo()));
		}
	}