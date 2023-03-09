<form method="post" action="<?php ROOTPATH; ?>" name="form">
<fieldset>
<legend>Mise en forme</legend>
<input type="button" id="gras" name="gras" value="Gras"
onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="Italic"
onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" id="souligné" name="souligné" value="Souligné"
onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="Lien"
onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
</fieldset>

<fieldset>
<legend>Smilies</legend>
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="heureux"
alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="lol" alt="lol"
onClick="javascript:smilies(' :lol: ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="triste" alt="triste"onClick="javascript:smilies(' :triste: ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="cool" alt="cool"
onClick="javascript:smilies(' :frime: ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="rire" alt="rire"
onClick="javascript:smilies(' XD ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="confus" alt="confus"
onClick="javascript:smilies(' :s ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="choc" alt="choc"
onClick="javascript:smilies(' :o ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="?" alt="?"
onClick="javascript:smilies(' :interrogation: ');return(false)" />
<img src="<?php ROOTPATH; ?>/web/images/smilies/cool.png" title="!" alt="!"
onClick="javascript:smilies(' :exclamation: ');return(false)" />
</fieldset>
<fieldset>
<legend>Commenter</legend>
<textarea name="comment" placeholder="Laissez ici votre commentaire"></textarea>
<input type="hidden" name="subject" value="<?php echo $subject['bs_id'] ?>" />
</fieldset>
<fieldset>
<input type="submit" value="Poster" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>