<section>
<h2 class="title"><?php echo $subject->title(); ?></h2>
<p class="byline"><small>Posté le <?php echo $subject->postDate() ?> par
<a href="<?php $config->rp() ?>/members/<?php echo $subject->sender().'/'.$subject->alias() ?>">
<?php echo $subject->pseudo() ?></a> 
<?php if ($visitor->id()==$subject->sender()) echo '| <a href="#">Edit</a>'; ?></small>
</p>
<article>
<p><?php $subject->displayImage() ?></p>
<p><?php echo $content->content() ?></p>
<p class="meta">
<?php if ($visitor->isAuthenticated()){ ?>
<a href="<?php $config->rp() ?>/blog/?bp=comm&amp;s=<?php echo $subject->id() ?>" class="comments">Commentaires</a>
<?php } ?>
<a href="<?php $config->rp() ?>/blog/?bp=comm&amp;s=<?php echo $subject->id() ?>" 
class="more">Lire la suite</a>
</p>
</article>
</section>