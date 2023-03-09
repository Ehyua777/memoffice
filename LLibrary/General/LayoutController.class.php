<?php
namespace LLibrary\General;
class LayoutController extends \LLibrary\Models\DBFactory
{
	protected $title,
	$websiteName,
	$websiteDescription, 
	$signature,
	$lSignature,
	$topMenu = array(),
	$sideMenu = array(),
	$bottomMenu = array(),
	$visitorsNumber,
	$membersNumber,
	$noMembersNumber,
	$page;
	
	// LES SETTERS //
	public function setTitle($pT)
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app = $appTitle->setLayout();
		if(isset($pT) && !empty($pT))
		{
			$pT = $pT.' | '.$app->appTitle();
			$this->title = stripslashes(htmlspecialchars($pT));
		}
		else
		{
			$this->title = $app->appTitle();
		}
	}
	public function setWebsiteName()
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app = $appTitle->setLayout();
		$this->websiteName = $app->appTitle();
	}
	public function setWebsiteDescription()
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app = $appTitle->setLayout();
		$this->websiteDescription = $app->websiteDescription();
	}
	public function setSignature()
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app = $appTitle->setLayout();
		$this->signature = $app->signature();
	}
	public function setLSignature()
	{
		$appTitle = new \LLibrary\Models\LayoutManager($this->db);
		$app = $appTitle->setLayout();
		$this->lSignature = $app->lSignature();
	}
	public function setTopMenu($level=1)
	{
		$menuManager = new \LLibrary\Models\MenuManager($this->db);
		$this->topMenu = $menuManager->getMenu($level);
	}
	public function setSideMenu($level=3)
	{
		$menuManager = new \LLibrary\Models\MenuManager($this->db);
		$this->sideMenu = $menuManager->getMenu($level);
	}
	public function setBottomMenu($level=2)
	{
		$menuManager = new \LLibrary\Models\MenuManager($this->db);
		$this->bottomMenu = $menuManager->getMenu($level);
	}
	public function setVisitorsNumber()
	{
		$ipManager = new \LLibrary\Models\GeoLocalisation($this->db);
		$o = $ipManager->countVisitors();
		$this->visitorsNumber = $o->visitorsNumber(); 
	}
	public function setMembersNumber()
	{
		$ipManager = new \LLibrary\Models\GeoLocalisation($this->db);
		$o = $ipManager->countMembers();
		$this->membersNumber = $o->membersNumber(); 
	}
	public function setNoMembersNumber()
	{
		$ipManager = new \LLibrary\Models\GeoLocalisation($this->db);
		$o = $ipManager->countNoMembers();
		$this->noMembersNumber = $o->noMembersNumber(); 
	}
	public function setPage($page)
	{
		$ipManager = new \LLibrary\Models\GeoLocalisation($this->db);
		$o = $ipManager->nowPageVisitors($page);
		$this->page = $o->page(); 
	}
	
	public function __construct(\LLibrary\Entities\Visitor $visitor)
	{
		$this->executeVisitorRegister($visitor);
		$this->setTitle($visitor->page());
		$this->setWebsiteName();
		$this->setWebsiteDescription();
		$this->setSignature();
		$this->setLSignature();
		$this->setTopMenu();
		$this->setSideMenu();
		$this->setBottomMenu();
		$this->setVisitorsNumber();
		$this->setMembersNumber();
		$this->setNoMembersNumber();
		$this->setPage($visitor->page());
	}
	
	public function title()             { return $this->title;              }
	public function websiteName()       { return $this->websiteName;        }
	public function websiteDescription(){ return $this->websiteDescription; }
	public function signature()         { return $this->signature;          }
	public function lSignature()        { return $this->lSignature;         }
	public function topMenu()           { return $this->topMenu;            }
	public function sideMenu()          { return $this->sideMenu;           }
	public function bottomMenu()        { return $this->bottomMenu;         }
	public function visitorsNumber()    { return $this->visitorsNumber;     }
	public function membersNumber()     { return $this->membersNumber;      }
	public function noMembersNumber()   { return $this->noMembersNumber;    }
	public function page()              { return $this->page;               }
	
	public function executeVisitorRegister(\LLibrary\Entities\Visitor $visitor)
	{
		$ok = new \LLibrary\Models\GeoLocalisation($this->db);
		$ok->visitorRegister($visitor);
	}
	public function displayMiddleContainer($pageTitle)
	{
		if ($pageTitle == 'Bienvenu' || $pageTitle == 'Home')
		{
			include('home/middle.php');
		}
		else
		{
			include('middle.php');
		}
	}
}