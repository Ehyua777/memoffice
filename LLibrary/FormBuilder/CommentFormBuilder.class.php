<?php
namespace EILibrary\FormBuilder;
class CommentFormBuilder extends \EILibrary\General\FormBuilder
{
	public function build()
	{
		$this->form->add(new \EILibrary\General\StringField(array(
		'label' => 'Auteur',
		'name' => 'auteur',
		'maxLength' => 50,
		'validators' => array(new \EILibrary\General\MaxLengthValidator('
		L\'auteur spécifié est trop long (50 caractères maximum)', 50), 
		new \EILibrary\General\NotNullValidator('Merci de spécifier l\'auteur du 
		commentaire'),),)))->add(new \EILibrary\General\TextField(array(
		'label' => 'Contenu',
		'name' => 'contenu',
		'rows' => 7,
		'cols' => 50,
		'validators' => array(new \EILibrary\General\NotNullValidator('
		Merci de spécifier votre commentaire'),),)));
	}
}