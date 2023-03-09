<div id="post">
<h1 class="title">
Profile de <?php echo $member->pseudo(); ?>
</h1>
<table>
<tr>
    <td>
	<img src="/Web/loads/img/avators/<?php echo $member->avator(); ?>" 
    title="<?php echo $member->pseudo(); ?>" />
	</td>
    <td>
	<?php if ($member->id()==$visitor->id())
	{?>
    <a href="<?php $config->rp() ?>/members/?mp=edit&amp;cat=avator">Modifier</a>
	<?php }
	else
	{
		echo '&nbsp;';
	}
	?>
    </td>
  </tr>
</table>
</div>
<br clear="all" />

<div id="post">
<h2 class="title">Informations générale sur&nbsp;<?php echo $member->pseudo(); ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php if (!empty($member->fName)) { ?>
  <tr>
    <td>Prenom</td>
    <td><?php echo $member->fName(); ?></td>
  </tr>
  <?php } ?>
  <?php if (!empty($member->name)) { ?>
  <tr>
    <td>Nom</td>
    <td><?php echo $member->name(); ?></td>
  </tr>
  <?php } ?>
  <?php if (!empty($member->genre)) { ?>
  <tr>
    <td>Genre</td>
    <td><?php echo $member->genre(); ?></td>
  </tr>
  <?php } ?>
  <?php if (($member->birthDay()*$member->birthMonth()*$member->birthYear())!=0 ){ ?>
  <tr>
    <td>Date de naissance</td>
    <td>
	<?php echo $member->birthDay() ?>/
	<?php echo $member->birthMonth() ?>/
    <?php echo $member->birthYear() ?>
    </td>
  </tr>
  <?php } ?>
  <tr>
  <td>Signature</td>
  <td><?php echo $member->signature() ?></td>
  </tr>
  <?php if ($member->bio()!='') { ?>
  <tr>
    <td>Biographie</td>
    <td><?php echo $content->content() ?></td>
  </tr>
  <?php } ?>
</table>
</div>
<br clear="all" />

<div i="post">
<h2 class="title">Coordonnées de <?php echo $member->pseudo() ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>E-mail</td>
    <td><a href="<?php mailto:$member->email(); ?>">
	<?php echo $member->email() ?></a>
    </td>
  </tr>
  <?php if ($member->website()!=''){ ?>
  <tr>
    <td>Site WEB</td>
    <td>
    <a href="http://<?php echo $member->website() ?>" target="_blank">
	 <?php echo $member->website() ?></a>
     </td>
  </tr>
  <?php } ?>
  <?php if (!empty($member->localisation)){ ?>
  <tr>
   <td>Localisation</td>
   <td><?php echo $member->localisation() ?></td>
  </tr>
  <?php } ?>
</table>
</div>
<br clear="all" />

<div id="post">
<h2 class="title">Informations supplémentaires</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td>Date d'inscription</td>
  <td><?php echo $member->iDate() ?></td>
  </tr>
  <tr>
  <td>Nombre de message postés</td>
  <td><?php echo $member->posts() ?></td>
  </tr>
</table>
</div>
<hr />
<div>
<marquee scrollamount="1" scrolldelay="1" onmouseover="this.stop()" 
onmouseout="this.start()">
<?php echo $wcmsg;?>
</marquee>
</div>