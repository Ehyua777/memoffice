<p>
Aujourd'hui à <?php echo date('H').' h '.date('i').'min'; ?> sur 
<?php echo $layout->websiteName(); ?> :
</p>
<p>
En ligne:<strong><?php echo $layout->visitorsNumber() ?></strong><img src="/Templates/images/icons/b_usrlist.png"> | membres: 
<strong><?php echo $layout->membersNumber() ?></strong>
<img src="/Templates/images/icons/s_success.png" /> | 
Visiteur(s): <strong><?php echo $layout->noMembersNumber() ?></strong>
<img src="/Templates/images/icons/mem.png" /> | Sur cette page : 
<strong><?php echo $layout->page() ?></strong>
<img src="/Templates/images/icons/dopplr.png" />
</p>