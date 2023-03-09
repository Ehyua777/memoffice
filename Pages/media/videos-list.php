<div class="video-item">
<a href="videos/<?php echo $video->url() ?>-<?php echo $video->id() ?>">
<?php $video->displayPoster() ?>
</a>
<p>
<a href="videos/<?php echo $video->url() ?>-<?php echo $video->id() ?>">
<?php echo $video->title() ?>
</a>
</p>
<p>&nbsp;&nbsp;<small>Depuis le <?php echo $video->postDate() ?></small></p>
</div>