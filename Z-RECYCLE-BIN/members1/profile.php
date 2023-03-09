<div id="post">
<h1 class="title">
Profile de <?php echo $member['pseudo'] ?>
</h1>
<table>
<tr>
    <td>
	<img src="<?php ROOTPATH;?>/web/images/avators/<?php echo $member['../../members/avator']; ?>" 
    title="<?php echo $member['pseudo'] ?>" />
	</td>
    <td>
	<?php if ($member['member_id']==$id)
	{?>
    <a href="<?php ROOTPATH; ?>/members/?mp=edit&amp;cat=avator">Modifier</a>
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
<h2 class="title">Informations générale sur&nbsp;<?php echo $member['pseudo']; ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Prenom</td>
    <td><?php echo $member['fname']; ?></td>
  </tr>
  <tr>
    <td>Nom</td>
    <td><?php echo $member['name']; ?></td>
  </tr>
  <tr>
    <td>Genre</td>
    <td><?php echo $member['genre']; ?></td>
  </tr>
  <tr>
    <td>Biographie</td>
    <td><?php echo $member['bio']; ?></td>
  </tr>
  <tr>
  <td>Signature</td>
  <td><?php echo $member['signature'] ?></td>
  </tr>
</table>
</div>
<br clear="all" />

<div i="post">
<h2 class="title">Coordonnées de <?php echo $member['pseudo'] ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>E-mail</td>
    <td><a href="<?php mailto:$member['../../members/email']; ?>">
	<?php echo $member['email'] ?></a>
    </td>
  </tr>
  <tr>
    <td>Site WEB</td>
    <td>
    <a href="http://<?php echo $member['website'] ?>" target="_blank">
	 <?php echo $member['website'] ?></a>
     </td>
  </tr>
  <tr>
  <td>Localisation</td>
  <td><?php echo $member['loc'] ?></td>
  </tr>
</table>
</div>
<br clear="all" />

<div id="post">
<h2 class="title">Informations supplémentaires</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td>Date d'inscription</td>
  <td><?php echo $member['idate'] ?></td>
  </tr>
  <tr>
  <td>Nombre de message postés</td>
  <td><?php echo $member['posts'] ?></td>
  </tr>
</table>
</div>