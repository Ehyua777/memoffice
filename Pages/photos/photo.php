<div id="gallery_box">
<a href="<?php $config->rp() ?>/Web/loads/img/photos/<?php echo $photo->fileName() ?>" 
rel="lightbox[portfolio]"><?php $photo->displayPhoto() ?></a>
<h5><?php echo $photo->title() ?></h5>
<h5><?php echo $content->content() ?></h5>
<p><?php echo $photo->postDate() ?></p>
</div>