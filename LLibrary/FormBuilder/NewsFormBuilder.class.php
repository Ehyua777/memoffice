<?php
namespace EILibrary\FormBuilder;
class NewsFormBuilder extends \EILibrary\General\FormBuilder
{
	public function build()
	{
		$this->form->add(new \EILibrary\General\StringField(array(
		'label' => 'Auteur',
		'name' => 'auteur',
		'maxLength' => 20,
		'validators' => array(
		new \EILibrary\General\MaxLengthValidator('L\'auteur spécifié est trop long 
		(20 caractères maximum)', 20), 
		new \EILibrary\General\NotNullValidator('
		Merci de spécifier l\'auteur de la news'),),
		)))->add(new \EILibrary\General\StringField(array(
		'label' => 'Titre',
		'name' => 'titre',
		'maxLength' => 100,
		'validators' => array(new \EILibrary\General\MaxLengthValidator('
		Le titre spécifié est trop long (100 caractères maximum)', 100), 
		new \EILibrary\General\NotNullValidator('
		Merci de spécifier le titre de la news'),),
		)))->add(new \EILibrary\General\TextField(array(
		'label' => 'Contenu',
		'name' => 'contenu',
		'rows' => 8,
		'cols' => 60,
		'validators' => array(new \EILibrary\General\NotNullValidator('
		Merci de spécifier le contenu de la news'),),)));
	}
}