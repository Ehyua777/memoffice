<?php
namespace Blog;
class BlogController extends \LLibrary\Models\DBFactory
{
	protected $blogCommentManager,
	$blogSubjectManager,
	$content;
	
	const CHAR_NOUMBER = 200;
	const LIMIT        = 5;
	
	public function setContent($content)
	{
		$this->content = new \LLibrary\General\Content($content);
	}
	
	public function __construct()
	{
		$this->blogSubjectManager = new \LLibrary\Models\BlogSubjectManager($this->db);
		$this->blogCommentManager = new \LLibrary\Models\BlogCommentManager($this->db);
	}
	
	public function executeList($offset)
	{
		$manager = $this->blogSubjectManager;
		$list    = $manager->getList($offset, self::LIMIT);
		foreach ($list as $subject)
		{
			if (strlen($subject->text()) <= self::CHAR_NOUMBER)
			{
				$content = $this->setContent($subject->text());
			}
			else
			{
				$text    = substr($subject->text(), 0, self::CHAR_NOUMBER);
				$text    = substr($text, 0, strrpos($text, ' ')) . '...';
				$content = $this->setContent($text);
				$this->content = $content;
			}
			include('../subjects.php');
		}
	}
	
	public function executeIndex(\EILibrary\General\HTTPRequest $request)
	{
		$nombreNews = $this->app->config()->get('nombre_news');
		$nombreCaracteres = $this->app->config()->get('nombre_caracteres');
		// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Liste des '.$nombreNews.'dernières news');
		// On récupère le manager des news.
		$manager = $this->managers->getManagerOf('News');
		$listeNews = $manager->getList(0, $nombreNews);
		foreach ($listeNews as $news)
		{
			if (strlen($news->content()) > $nombreCaracteres)
			{
				$debut = substr($news->content(), 0, $nombreCaracteres);
				$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
				$news->setContent($debut);
			}
		}
		// On ajoute la variable $listeNews à la vue.
		$this->page->addVar('listeNews', $listeNews);
	}
	
	public function blogSubjectManager(){ return $this->blogSubjectManager; }
	public function blogCommentManager(){ return $this->blogCommentManager; }
	public function content()           { return $this->content; }
}