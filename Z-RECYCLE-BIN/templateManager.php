<?php
$layoutManager = new LLibrary\Models\LayoutManager($db);
$layout = $layoutManager->setLayout();
?>
<?php
$title = new LLibrary\General\Title($pageTitle);
$visitorIP = ip2long($_SERVER['REMOTE_ADDR']);		
$ipManager = new LLibrary\Models\GeoLocalisation($db);
$visitor = new LLibrary\Entities\Whosonline(array(
'id'             => $id,
'ip'             => $visitorIP,
'page'           => $pageTitle,
'connectionTime' => time()
));
$ipManager->visitorRegister($visitor);
?>
<?php
$minute = date ('i');
$heure = date ('H');
$counter1 = $ipManager->whosOnline($id);
$counter2 = $ipManager->countVisitors();
$counter3 = $ipManager->countMembers();
$counter4 = $ipManager->countNoMembers();
$counter5 = $ipManager->nowPageVisitors($pageTitle);
?>