<?php
// UsersFormBuilder.php

namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class UsersFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Nom',
        'name' => 'name',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le nom spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le nom du l\'utilisateur'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Prénom',
        'name' => 'firstName',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le prénom spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le prénom du l\'utilisateur'),
        ],
       ]));
       ->add(new StringField([
        'label' => 'Loggin',
        'name' => 'loggin',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le loggin spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le loggin du l\'utilisateur'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Mot de passe',
        'name' => 'passWord',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le MDP spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le MDP du l\'utilisateur'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Email',
        'name' => 'email',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'émail spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'émail du l\'utilisateur'),
        ],
       ]));
  }
}
