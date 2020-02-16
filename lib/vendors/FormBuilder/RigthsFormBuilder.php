<?php
// RigthsFormBuilder.php

namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class RightsFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Description',
        'name' => 'description',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('La description spécifiée est trop longue (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier la description de la Rights'),
        ],
       ]));
  }
}