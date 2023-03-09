<form method="post" action="<?php $config->rp() ?>" >
<fieldset>
<legend>Banissement</legend>
<input type="email" name="email" value="" placeholder="Email du membre à banir" />
</fieldset>
<fieldset>
<input type="submit" name="banish" value="Banir" />
<input type="reset" value="Reprendre" />
</fieldset>
</form>