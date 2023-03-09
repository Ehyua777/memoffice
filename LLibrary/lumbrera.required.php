<?php
// ATTENTION A LA MODIFICATION DE L'ORDRE D'ARRIVE //
$refresh=NULL;
require('autoload.php');
LLibrary\Entities\User::refreshSession();
$db = LLibrary\Models\DBFactory::getMysqlConnexionWithPDO();
$config = new LLibrary\General\Configuration();
$visitor = new LLibrary\Entities\Visitor(array(
'id'             => (isset($_SESSION['id']))?(int) $_SESSION['id']:0,
'ip'             => ip2long($_SERVER['REMOTE_ADDR']),
'page'           => $pageTitle,
'pseudo'         => (isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'',
'connectionTime' => time()
));
$layout = new LLibrary\General\LayoutController($visitor);
/*$owner = new LLibrary\Entities\Owner("L' &Eacute;légant Né");
echo $owner->hisPseudo();*/