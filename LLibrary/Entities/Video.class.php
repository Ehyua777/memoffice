<?php namespace LLibrary\Entities;
class Video
{
	// CONSTANTES DE LA CLASS //
	const INVALID_TITLE     = 1;
	const INVALID_TEXT      = 2;
	const INVALID_SENDER    = 3;
	const INVALID_EXTENSION = 4;
	const IMAGE_TOO_HEAVY   = 5;
	const IMAGE_MAX_SIZE    = 24576;
	const IMAGE_MAX_WIDTH   = 320;
	const IMAGE_MAX_HEIGHT  = 180;
	const LOARDING_ERROR    = 6;
	// PROPRIETES DE LA CLASS //
	protected $errors = array(),
	$id,
	$title,
	$poster,
	$comment,
	$url,
	$src,
	$postDate,
	$type,
	$valid;
	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setTitle($titre)
	{
		if (!is_string($titre) || empty($titre))
		{
			$this->errors[] = self::INVALID_TITLE;
		}
		else
		{
			$this->title = stripslashes(htmlspecialchars($titre));
		}
	}
	public function setComment($contenu)
	{
		if (!is_string($contenu) || empty($contenu))
		{
			$this->errors[] = self::INVALID_TEXT;
		}
		else
		{
			$this->comment = stripslashes(htmlspecialchars($contenu));
		}
	}
	public function setUrl($url)
	{
		if (empty($url))
		{
			$url = $this->url;
		}
		$url = str_replace("'", "-", $url);
		$url = str_replace(" ", "-", $url);
		$url = strtolower($url);
		$this->url = stripslashes(htmlspecialchars($url));
	}
	public function setSrc($link)
	{
		$this->src = $link;
	}
	public function setPoster($fileName)
	{
		$this->poster = $fileName;
	}
	public function setPostDate($dateAjout)
	{
		if (is_string($dateAjout) && preg_match('`le [0-9]{2}/[0-9]{2}/[0-9]{4} à 
		[0-9]{2}h[0-9]{2}`', $dateAjout))
		{
			$this->postDate = $dateAjout;
		}
	}
	public function setType($type)
	{
		$this->type = htmlspecialchars($type);
	}
	public function setValid($status)
	{
		$this->valid = (int) $status;
	}
	//Hydratation de l'objet
	public function hydrate($data)
	{
		foreach ($data as $attribute => $value)
		{
			$method = 'set'.ucfirst($attribute);
			if (is_callable(array($this, $method)))
			{
				$this->$method($value);
			}
		}
	}
	//Constructeur d'un objet de cette classe
	public function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}
	// GETTERS //
	public function errors()  { return $this->errors;   }
	public function id()      { return $this->id;       }
	public function title()   { return $this->title;    }
	public function comment() { return $this->comment;  }
	public function url()     { return $this->url;      }
	public function postDate(){ return $this->postDate; }
	public function poster()  { return $this->poster;   }
	public function type()    { return $this->type;     }
	public function src()     { return $this->src;      }
	public function valid()   { return $this->valid;    }
	// AUTRES FONCTIONS //
	public function generateVideoIframe($class='video')
	{
		$iframe='
		<iframe src="'.$this->src.'" marginwidth="0" marginheight="0" scrolling="auto" 
		align="middle" allowfullscreen class="'.$class.'"></iframe>';
		return $iframe;
	}
	public function displayVideo()
	{
		$video = $this->generateVideoIframe('video');
		echo $video;
	}
	public function generatePoster($class='poster')
	{
		$poster='
		<img src="/Web/loads/img/posters/'.$this->poster.'" alt="poster" 
		class="'.$class.'" />';
		return $poster;
	}
	public function displayPoster()
	{
		$poster=$this->generatePoster('poster');
		echo $poster;
	}
	public function checkLink()
	{
		return !(empty($this->link));
	}
	public function checkImage(array $image)
	{
		if ($image['error'] > 0 && empty($image['size']))
		{
			$this->errors[]=array(1 => "Une erreur s'est produite lors du transfère...");
		}
		elseif ($image['size'] > self::IMAGE_MAX_SIZE)
		{
			$this->errors[]=array(2 => "Image trop lourde...");
		}
		else
		{
			$fileSizes=getimagesize($image['tmp_name']);
			if ($fileSizes[0] > self::IMAGE_MAX_WIDTH || $fileSizes[1] > self::
			IMAGE_MAX_HEIGHT)
			{
				$imageErr='Image trop large ou trop longue :(<strong>'.$imageSizes[0].
				'x'.$imageSizes[1].'</strong> contre <strong>'.$maxwidth.'x'.$maxheight.'
				</strong>)';
				$this->errors[]=array(3 => $imageErr);
			}
			else
			{
				$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
				$extensionUpload=strtolower(substr(strrchr($image['name'],'.') 
				,1));
				if (!in_array($extensionUpload, $validExtensions))
				{
					$this->errors[]=array(3 => "L'extention de l'image est invalide");
				}
				else return true;
			}
		}
	}
	//Rengement d'image dans le local
	public function moveImage(array $image, $dir)
	{
		$dir =__DIR__.'/../../'.$dir.'/';
		$extensionUpload=strtolower(substr(strrchr($image['name'], '.'), 1));
		$name = time();
		$fileName = str_replace(' ', '', $name).'.'.$extensionUpload;
		$name=$dir.str_replace('', '', $name).'.'.$extensionUpload;
		move_uploaded_file($image['tmp_name'], $name);
		$this->setPoster($fileName);
	}
	public function processPoster(array $image, $dir)
	{
		$message = "";
		if (!$this->checkImage($image))
		{
			if (in_array(1, $this->errors))
			{
				$message = $alert[1];
			}
			elseif (in_array(2, $this->errors))
			{
				$message = $alert[2];
			}
			elseif (in_array(3, $this->errors))
			{
				$message = $alert[3];
			}
		}
		else
		{
			$this->moveImage($image, $dir);
		}	
		return $message;
	}
}