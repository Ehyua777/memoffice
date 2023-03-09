<meta charset="utf-8" />
<marquee scrollamount="1" scrolldelay="0" onmouseover="this.stop()" onmouseout="this.start()" onmousemove="this.stop()" id="news">
<?php echo stripslashes($new['content']); ?>&nbsp;Le&nbsp;<?php echo $new['date']; ?>
</marquee>