<ul>
<li>
<?php
$abouDataName='biography_photographe';
$aboutInfo = $abouManager->getAboutData($abouDataName);
echo '<p><img src="/Web/loads/img/photos/'.$aboutInfo.'" width="239" height="300" title="'.$layout->websiteName().'" />';
?>
</li>
<li>
<h2>Biographie</h2>
<ul>
<li><a href="#">A l'état civi</a></li>
<li><a href="#">Parcour scolaire</a></li>
<li><a href="#">Parcour estudiantain</a></li>
<li><a href="#">Un hommme de lettre</a></li>
<li><a href="#">Proffession actuelle</a></li>
</ul>
</li>
</ul>