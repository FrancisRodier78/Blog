<?php
// InscriptionController.php

namespace App\Frontend\Modules\Inscription;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Users;


class InscriptionController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        if ($request->postExists('name')) {
            $name = $request->postData('name');
            $firstname = $request->postData('firstname');
            $loggin = $request->postData('loggin');
            $password = $request->postData('password');
            $password2 = $request->postData('password2');
            $email = $request->postData('email');

            if (!$users = $this->managers->getManagerOf('Users')->existloggin($loggin)) {
                if ($password == $password2) {
                    $this->app->user()->setAuthenticated(true);

                    $_SESSION['role_id'] = 'Visiteur';

                    $user = new users;
                    $user->setName($name);
                    $user->setFirstname($firstname);
                    $user->setLoggin($loggin);

                    $password = $password.'Je suis une brute';
                    $password = sha1($password);
                    $user->setPassWord($password);

                    $user->setEmail($email);

                    $this->managers->getManagerOf('Users')->save($user);
                } else {
                    $this->app->user()->setFlash('Le mot de passe n\'est pas confirmé.');
                }
            } else {
                $this->app->user()->setFlash('Veuillez choisir un autre pseudo.');
            }
        }

        $this->app->httpResponse()->redirect('.');
    }

}

