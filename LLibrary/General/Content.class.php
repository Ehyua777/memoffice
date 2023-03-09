<?php namespace LLibrary\General;
class Content
{
	const PATH = 'Templates/images/smilies';
	protected $content;
	
	private static function textStyle($text)
	{
		//gras
		$text=preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $text);
		//italique
		$text=preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $text);
		//souligné
		$text=preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $text);
		//Paragraphes
		$text=preg_replace('`\[p\](.+)\[/p\]`isU', '<p>$1</p>', $text);
		//lien
		$text=preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $text);
		//La quote
		$text=preg_replace('`\[quote\](.+)\[/quote\]`isU', '<span id="quote">$1</span>', 
		$text);
		//On retourne la variable texte
		return $text;
	}
	private function generateSmilies()
	{
		$filesAndNotes = array(
		'happy.gif'            => 'heureux',
		'laugh.gif'         => 'lol',
		'sad.gif'      => 'triste',
		'cool.gif'       => 'cool',
		'heureux.png'        => 'rire',
		'mellow.gif'            => 'confus',
		'ohmy.gif'            => 'choc',
		'huh.gif'    => '?',
		'blink.gif' => '!'
		);
		foreach($filesAndNotes as $file => $note)
		{
			$img = '<img src="/'.self::PATH.'/'.$file.'" title="'.$note.'" alt="
			'.$note.'" />';
		}
		return $img;
	}
	private function smilies($text)
	{
		$symbols=array(
		':D'            => 'happy.gif',
		':lol:'         => 'laugh.gif',
		':triste:'      => 'sad.gif',
		':frime:'       => 'cool.gif',
		':rire:'        => 'heureux.png',
		':s'            => 'mellow.gif',
		':O'            => 'ohmy.gif',
		':question:'    => 'huh.gif',
		':exclamation:' => 'blink.gif'
		);
		foreach($symbols as $symbol)
		{
			$content = str_replace($symbol, $this->generateSmilies(), $text);
		}
		return $content;
	}
	private function smilies2($text)
	{
		$symbols=array(
		':D'            => 'happy.gif',
		':lol:'         => 'laugh.gif',
		':triste:'      => 'sad.gif',
		':frime:'       => 'cool.gif',
		':rire:'        => 'heureux.png',
		':s'            => 'mellow.gif',
		':O'            => 'ohmy.gif',
		':question:'    => 'huh.gif',
		':exclamation:' => 'blink.gif'
		);
		$notes = array(
			':D'            => 'heureux',
			':lol:'         => 'lol',
			':triste:'      => 'triste',
			':frime:'       => 'cool',
			':rire:'        => 'rire',
			':s'            => 'confus',
			':O'            => 'choc',
			':question:'    => '?',
			':exclamation:' => '!'
			);
			foreach($notes as $symbol => $note)
			{
				$img = '<img src="/'.self::PATH.'/'.$file.'" title="'.$note.'" alt="
				'.$note.'" />';
			}
	}
	private static function smilies1($text)
	{
		$text = str_replace(':D', 
		'<img src="/'.self::PATH.'/happy.gif" title="heureux" alt="heureux" />', 
		$text);
		$text = str_replace(':lol:', 
		'<img src="/'.self::PATH.'/laugh.gif" title="lol" alt="lol" />', 
		$text);
		$text = str_replace(':triste:', 
		'<img src="/'.self::PATH.'/sad.gif" title="triste" alt="triste" />', 
		$text);
		$text = str_replace(':frime:', 
		'<img src="/'.self::PATH.'/cool.gif" title="cool" alt="cool" />', 
		$text);
		$text = str_replace(':rire:', 
		'<img src="/'.self::PATH.'/heureux.png" title="rire" alt="rire" />', 
		$text);
		$text=str_replace(':s', 
		'<img src="/'.self::PATH.'/mellow.gif" title="confus" alt="confus" />', 
		$text);
		$text = str_replace(':O', 
		'<img src="/'.self::PATH.'/ohmy.gif" title="choc" alt="choc" />', 
		$text);
		$text = str_replace(':question:', 
		'<img src="/'.self::PATH.'/huh.gif" title="?" alt="?" />', 
		$text);
		$text = str_replace(':exclamation:', 
		'<img src="/'.self::PATH.'/blink.gif" title="!" alt="!" />', 
		$text);
		return $text;
	}
	public function setContent($content1)
	{
		$content1 = stripslashes(htmlspecialchars($content1));
		$content1 = self::textStyle($content1);
		$content1 = self::smilies1($content1);
		$this->content = nl2br($content1);
	}
	public function __construct($content)
	{
		$this->setContent($content);
	}
	public function content(){ return $this->content; }
}