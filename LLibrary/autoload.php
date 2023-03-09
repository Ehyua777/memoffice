<?php
function autoload($className)
{
	if ((isset($_SERVER['REQUEST_URI'])) && $_SERVER['REQUEST_URI']=='/')
	{
		if (file_exists($file=(str_replace('\\', '/', $className).'.class.php')))
		{
			require $file;
		}
	}
	if (file_exists($file=('../'.str_replace('\\', '/', $className).'.class.php')))
	{
		require $file;
	}
}
spl_autoload_register('autoload');