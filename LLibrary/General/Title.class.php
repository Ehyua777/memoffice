<?php
namespace LLibrary\General;
class Title extends \LLibrary\Models\DBFactory
{
	protected $title;
	public function setTitle($pageTitle)
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app=$appTitle->setLayout();
		if(isset($pageTitle) && trim($pageTitle) != '')
		{
			$pageTitle = $pageTitle.' | '.$app->appTitle();
			$this->title = stripslashes(htmlspecialchars($pageTitle));
		}
		else
		{
			$pageTitle = $app->appTitle();
			$this->title=$pageTitle;
		}
	}
	public function __construct($title)
	{
		$this->setTitle($title);
	}
	public function title(){ return $this->title; }
}
