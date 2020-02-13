<?php
// Relationship-RightFormBuilder.php

namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class Relationship-RightFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Right',
        'name' => 'rightId',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le right spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier le right de la relationship-right'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Role',
        'name' => 'roleId',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le role spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier le role de la relationship-right'),
        ],
       ]));
  }
}