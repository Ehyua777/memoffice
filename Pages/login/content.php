<div class="post">
<h1 class="title">Connexion</h1>
<p>&nbsp;</p>
<div class="entry">
<?php
if (isset($loginMessage)) echo $loginMessage;
include ('form.php');
?>
<p class="byline"><small>Vous n'estes pas inscri ?&nbsp;
<a href="<?php ROOTPATH; ?>/inscription" id="inscription">Inscription</a></small></p>   
</div>
</div>