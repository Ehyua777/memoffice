<?php if ($visitor->isAuthenticated()){?>
<?php
$logouAlert = $userManager->logout($visitor->id());
if ($logouAlert == LLibrary\Interfaces\ICommon::ACTION_SUCCESS)
header ('location:'.$config->rp().'/');
else echo "Vous n'estes pas connecté.";
?>
<?php } else header ('location:'.$config->rp().'/Error'); ?>