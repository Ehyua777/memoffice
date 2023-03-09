<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/x-ico" href="<?php echo $config->rp() ?>/Templates/images/icons/mem.png" />
<meta name="keywords" content="fresh zone, portfolio, theme, free web design, free css templates" />
<meta name="description" content="Fresh Zone, Portfolio, free CSS template by templatemo.com" />
<?php
if ($refresh==true)
{
	if(isset($_GET['true']) && !empty($_GET['true']))
	{
		?>
        <meta http-equiv="refresh" content="1; url=<?php echo $config->rp() ?>" />
        <!-- Redirection vers la page d'accueil du site si on a entré son e-mail. -->
		<?php
    }
	else
	{
		?>
        <meta http-equiv="refresh" content="20; url=<?php echo $config->rp() ?>" />
        <!-- Redirection vers la page d'accueil si on tarde trop à entrer son e-mail. -->
		<?php
    }
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/Default/css/controller1.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/Default/css/containers.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/Default/css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/Default/css/permanently.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/Default/css/photo.css" media="screen" />
<script type="text/javascript" src="<?php echo $config->rp() ?>/Templates/Default/js/portfolio/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo $config->rp() ?>/Templates/Default/css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="<?php echo $config->rp() ?>/Templates/Default/js/portfolio/slimbox2.js"></script>
<script type="text/javascript" src="<?php echo $config->rp() ?>/Templates/js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $config->rp() ?>/Templates/css/text-style.css"/>
<script type="text/javascript" src="<?php echo $config->rp() ?>/Templates/js/l_bbcode.js"></script>
<script type="text/javascript">
    $(function(){
		$('#test').hide();
		$('#contact').click(function(){
			valid=true;
			if ($('#pseudo').val()==''){
				$('#pseudo').css('border-bottom-style', 'solid');
				$('#pseudo').css('border-color', '#F00');
				$('#pseudo').css('border-width', 'thin');
				$('#pseudo').next('.error-message').text("Entrez svp un pseudo");
				valid=false;
			}
			else{
				$('#pseudo').css('border-bottom-style', 'solid');
				$('#pseudo').css('border-color', 'rgba(0,255,0,1)');
				$('#pseudo').css('border-width', 'thin');
				$('#pseudo').next('.error-message').text("");
			}
			if ($('#email').val()==''){
				$('#email').css('border-bottom-style', 'solid');
				$('#email').css('border-color', '#F00');
				$('#email').css('border-width', 'thin');
				$('#email').next('.error-message').text("Entrez svp un email");
				valid=false;
			}
			else{
				if (!$('#email').val().match(/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,4}$/i)){
					$('#email').css('border-bottom-style', 'solid');
					$('#email').css('border-color', '#F00');
					$('#email').css('border-width', 'thin');
					$('#email').next('.error-message').text("Entrez un email valid");
					valid=false;
				}
				else {
					$('#email').css('border-bottom-style', 'solid');
					$('#email').css('border-color', 'rgba(0,255,0,1)');
					$('#email').css('border-width', 'thin');
					$('#email').next('.error-message').text("");
				}
			}
			if ($('#subject').val()==''){
				$('#subject').css('border-bottom-style', 'solid');
				$('#subject').css('border-color', '#F00');
				$('#subject').css('border-width', 'thin');
				$('#subject').next('.error-message').text("Entrez svp un sujet");
				valid=false;
			}
			else{
				$('#subject').css('border-bottom-style', 'solid');
				$('#subject').css('border-color', 'rgba(0,255,0,1)');
				$('#subject').css('border-width', 'thin');
				$('#subject').next('.error-message').text("");
			}
			if ($('#content').val()==''){
				$('#content').css('border-bottom-style', 'solid');
				$('#content').css('border-color', '#F00');
				$('#content').css('border-width', 'thin');
				$('#content').next('.error-message').text("Veillez entrer un message");
				valid=false;
			}
			else{
				$('#content').css('border-bottom-style', 'solid');
				$('#content').css('border-color', 'rgba(0,255,0,1)');
				$('#content').css('border-width', 'thin');
				$('#content').next('.error-message').text("");
			}	
			return valid;
			});
		});
</script>