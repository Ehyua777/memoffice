<section>
<h1 class="title">Marcel Ehyua Dit Trésor M'BIA</h1>
<article>
<p><h2>Soyez les bienvenu</h2></p>
<img src="/Web/loads/img/photos/<?php echo $home->welcomePhoto() ?>" />
<p>
<?php
$content = new LLibrary\General\Content($home->welcomeMessage());
echo nl2br($content->content());
?>
</p>
</article>
</section>