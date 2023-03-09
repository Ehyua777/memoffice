<?php namespace LLibrary\General;
class LayoutController extends \LLibrary\Models\LayoutManager
{
	protected $pageTitle,
	$title,
	$visitorIP,
	$visitorID,
	$visitor;

	// LES SETTERS //
	public function setPageTitle($pT)
	{
		$this->pageTitle = $pT;
	}
	public function setTitle($pT)
	{
		$aT = 'MEM OFFICE';
		//$app = $appTitle->setLayout();
		if(isset($pT) && !empty($pT))
		{
			$pT = $pT.' | '.$aT;
			$this->title = stripslashes(htmlspecialchars($pT));
		}
		else
		{
			$this->title = $appTitle;
		}
	}
	public function setVisitorID($id)
	{
		$this->visitorID = (int) $id;
	}
	public function setVisitorIP()
	{
		$this->visitorIP = ip2long($_SERVER['REMOTE_ADDR']);
	}
	public function executeVisitorRegister()
	{
		$ok = new \LLibrary\Models\GeoLocalisation($this->db);
		$ok->visitorRegister($this->visitor);
	}
	public function setVisitor()
	{
		$this->visitor = new \LLibrary\Entities\Whosonline(array(
		'id'             => $this->visitorID,
		'ip'             => $this->visitorIP,
		'page'           => $this->pageTitle,
		'connectionTime' => time()
		));
	}
	
	public function __construct($pT, $id)
	{
		$this->setPageTitle($pT);
		$this->setVisitorID($id);
		$this->setVisitorIP();
		$this->setTitle($pT);
		$this->setVisitor();
		$this->executeVisitorRegister();
	}
	
	public function title(){ return $this->title; }
}