<div id="page">
<div class="post">
<h1 class="title">404 not found !</h1>
<p>
Ok, on sait pas trop la page que vous cherchez mais semble-t-il qu'elle n'existe pas sur ce serveur.
</p>
<p>Alors vous avez deux choix:

<ul>
<li>
<?php
$page='';
if (isset($_POST['page']))
{
	$page = htmlspecialchars($_POST['page']);
}
?>
Soit vous cliquez <a href="<?php echo $page ?>">ici</a> pour revenir à la page précédente
</li>
<li>Soit vous allez directement à la <a href="<?php echo $config->rp() ?>">page d'accueil du site</a>
</li>
</ul>
</p>
</div>
</div>