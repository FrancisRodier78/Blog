<?php
// ConnexionController.php

namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
      //var_dump('Index');die();
    if ($request->postExists('login')) {
      $loggin = $request->postData('login');
      $password = $request->postData('password');
 
//    if ($loggin == $this->app->config()->get('login') && $password == $this->app->config()->get('pass')) {
      if ($users = $this->managers->getManagerOf('Users')->exist($loggin, $password))  {
          $this->app->user()->setAuthenticated(true);

          $_SESSION['role_id'] = $users->role_id;
          if (($_SESSION['role_id'] == 'Administrateur') OR ($_SESSION['role_id'] == 'Super-Administrateur')) {
            $this->app->httpResponse()->redirect('.');
          } else {
              //var_dump($_SESSION['role_id']);die();
            $this->app->httpResponse()->redirect('/');
          }
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }

    return $this->render('ConnexionIndex.html', ['title' => 'Connexion']);
  }

  public function executeLogout(HTTPRequest $request)
  {
    $this->app->user()->setAuthenticated(false);
    $this->app->httpResponse()->redirect('/');
  }
}