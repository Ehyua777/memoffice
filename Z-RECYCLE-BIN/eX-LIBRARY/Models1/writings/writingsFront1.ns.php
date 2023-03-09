<?php
namespace writingsFront1;
//Sélectionne la dernièrre exclusivité posté sur le site
function exclusivity($offset, $limit)
{
	$offset= (int) $offset;
	$limit = (int) $limit;
	global $db;
	$query = $db->query('
	SELECT exclusivity_id, exclusivity_title title, exclusivity_type type, 
	exclusivity_breffing bref, exclusivity_text text,
	DATE_FORMAT(exclusivity_date, \'%d/%m/%Y à %Hh%imin%ss\') date
	FROM mem_exclusivities
	ORDER BY exclusivity_date DESC
	LIMIT '.$offset.','.$limit.'
	');
	/*$query->bindParam(':offset', $offset, PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, PDO::PARAM_INT);*/
	$query->execute() or die(print_r($db->errorInfo()));
	$exclusivities = $query->fetchAll();
	return $exclusivities;
}

//Sélectionner une exclusivité à partir de son id
function selectedExclusivity($ex)
{
	global $db;
	$query = $db->query('
	SELECT exclusivity_title title, exclusivity_text text, 
	DATE_FORMAT(exclusivity_date, \'%d/%m/%Y à %Hh%imin%ss\') date
	FROM mem_exclusivities
	WHERE exclusivity_id ='.$ex.'
	');
	//$query->bindValue(':ex', $ex, PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$exclusivity = $query->fetchAll();
	return $exclusivity;
}

//Récupération des éventuelles poèmes correspondants à l'exclusivité
function selectedExclusivityTexts($type, $ex)
{
	global $db;
	if ($type=='poem')
	{
		$query = $db->query('
		SELECT poem_title title, poem_introduction intro, poem_text text
		FROM mem_poems
		WHERE exclusivity_id ='.$ex.'
		');
		//$query->bindValue(':ex', $ex, PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$poems = $query->fetchAll();
		return $poems;
	}
	elseif ($type='book')
	{
		$query = $db->query('
		SELECT poem_title title, poem_introduction introduction, poem_text text, 
		exclusivity_id
		FROM mem_books
		WHERE exclusivity_id ='.$ex.'
		');
		//$query->bindValue(':ex', $ex, PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$books = $query->fetchAll();
		return $books;
	}
	else
	{
		return 'Ce genre litéraire n\'est pas pratiquer par l\auteur';
	}
}

//Sélection du dernier poème posté s'il n'y a pas d'info dans l'url
function selectedLastPoems($type, $offset, $limit)
{
	$offset= (int) $offset;
	$limit = (int) $limit;
	global $db;
	if ($type=='poem')
	{
		$query = $db->query('
		SELECT poem_title title, poem_introduction intro, poem_text text, 
		DATE_FORMAT(poem_date, \'%d/%m/%Y à %Hh%imin%ss\') date 
		FROM mem_poems
		ORDER BY poem_date DESC
		LIMIT '.$offset.','.$limit.'');
		/*$query->bindParam(':offset', $offset, PDO::PARAM_INT);
		$query->bindParam(':limit', $limit, PDO::PARAM_INT);*/
		$query->execute() or die(print_r($db->errorInfo()));
		$poems = $query->fetchAll();
		return $poems;
	}
}