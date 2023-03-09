<?php namespace LLibrary\General;
/*
//Vérification du droit d'accès
if (!$visitor->isModerator()) header('location:'.$config->rp().'/Error');
$photoManager = new LLibrary\Models\PhotoManager($db);
if (isset($_FILES['avator']))
{
	$member = new LLibrary\Entities\Member();
	if (isset($member))
	{
		$alert = $member->checkAvator($_FILES['avator']);
		switch ($alert)
		{
			case LLibrary\Entities\Member::LOARDING_ERROR :
			$message ="Désolé, une erreur est survenu lors du chargement";
			break;
			case LLibrary\Entities\Member::AVATOR_TOO_HEAVY :
			$message ="Wowo, l'image est trop lourde!";
			break;
			case LLibrary\Entities\Member::SIZE_ERROR :
			$message = "L'image est soit trop, soit trop longue";
			break;
			case LLibrary\Entities\Member::INVALID_EXTENSION :
			$message = "Extension invalide";
			break;
			default: 
			$member->moveAvator($_FILES['avator'], $config->avatorDir());
			$member->setId($id);
			$userManager->updateAvator($member);
		}
	}
}
*/
?>
<script type="text/javascript" src="/Templates/js/jquery-dualslider/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<link rel="stylesheet" href="/Templates/Default/css/slimbox2.css" type="text/css" media="screen" /> 

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<script type="text/javascript">
    
    $(document).ready(function() {
        
        $("#carousel").dualSlider({
            auto:true,
            autoDelay: 6000,
            easingCarousel: "swing",
            easingDetails: "easeOutBack",
            durationCarousel: 1000,
            durationDetails: 600
        });
        
    });   
    
</script>
<script src="/Templates/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="/Templates/js/jquery-dualslider/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="/Templates/js/jquery-dualslider/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="/Templates/js/jquery-dualslider/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>


<link rel="stylesheet" type="text/css" href="/Templates/Default/css/containers.css" />
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/layout.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/permanently.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/photo.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/slimbox2.css"/>
<script type="text/javascript" src="/Templates/Default/js/portfolio/slimbox2.js"></script>
<script type="text/javascript" src="/Templates/Default/js/portfolio/jquery.min.js"></script>
<script src="/Templates/js/jquery-dualslider/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/Templates/js/l_bbcode.js"></script>





<script type="text/javascript">
    
    $(document).ready(function() {
        
        $("#carousel").dualSlider({
            auto:true,
            autoDelay: 6000,
            easingCarousel: "swing",
            easingDetails: "easeOutBack",
            durationCarousel: 1000,
            durationDetails: 600
        });
        
    });   
    
</script>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/photo.css"/>
<link rel="stylesheet" type="text/css" href="/Templates/Default/css/slimbox2.css"/>
<script type="text/javascript" src="/Templates/Default/js/portfolio/slimbox2.js"></script>
<script type="text/javascript" src="/Templates/Default/js/portfolio/jquery.min.js"></script>
<script src="/Templates/js/jquery-dualslider/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/Templates/js/l_bbcode.js"></script>
<?php
class Configuration
{
	protected $vars = array();
	protected $rp;
	
	public function setRp()
	{
		$this->rp = 'http://'.$_SERVER['HTTP_HOST'];
	}
	public function setVars($var)
	{
		if (!$this->vars)
		{
			$xml = new \DOMDocument;
			$xml->load(__DIR__.'/Configuration/app.xml');
			$elements = $xml->getElementsByTagName('define');
			foreach ($elements as $element)
			{
				$this->vars[$element->getAttribute('var')] 
				=
				$element->getAttribute('value');
			}
		}
	}
	public function __construct($vars)
	{
		$this->setRp();
		$this->setVars($vars);
	}
	public function rp(){ return $this->rp; }
	public function vars()
	{
		if (isset($this->vars[$var]))
		{
			return $this->vars[$var];
		}
		return null;
	}
}
?>
<p>Achever l'espace membre.</p>
<p>Réduire le nombre de controleeur dans l''espace membres</p>
<p>Achever la pagination des commentaires du blog.</p>
<p>Achever la page de la messagerie privée</p>
<p>Dynamiser la page A PROPOS à l'instar de celles des cours de la OPEN CLASSROOM</p>
<p>metre à jours tout les formulaires concernant le teste des eurreurs avec JS</p>
<p>Gerrrer les messages d'alert  avec JS</p>
<p>Créer une page TAF dans le groupe de travail.</p>
<p>Ajouter le champ option à l'administration du blog</p>
<p>Tester la validité des images avec JS.</p>
<p>Metre à jour les formulaire afin de las adapté au nouveau css.</p>
<p>Prévénir les failles XSS et sécuriser toute les données transitant par les array $_POST et $_GET.(Très important).</p>
<p></p>
<?php
/*class MaClasse
{
	private $unAttributPrive;
	public function __set($nom, $valeur)
	{
		echo 'Ah, on a tenté d\'assigner à l\'attribut <strong>', $nom, '</strong> la 
		valeur <strong>', $valeur, '</strong> mais c\'est pas possible !<br />';
	}
}
$obj = new MaClasse;
$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';
*/
?>
<?php
/*
class MaClasse
{
	private $attributs = array();
	private $unAttributPrive;
	public function __set($nom, $valeur)
	{
		$this->attributs[$nom] = $valeur;
	}
	public function afficherAttributs()
	{
		echo '<pre>', print_r($this->attributs, true), '</pre>';
	}
}
$obj = new MaClasse;
$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';
$obj->afficherAttributs();
*/
echo sha1('testeur8');
?>
<?php
$coordonnees = array (
'prenom' => 'François',
'nom' => 'Dupont',
'adresse' => '3 Rue du Paradis',
'ville' => 'Marseille');
echo '<pre>';
print_r($coordonnees);
echo '</pre>';
?>