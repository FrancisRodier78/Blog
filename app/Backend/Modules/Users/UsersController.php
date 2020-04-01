<?php
// UsersController.php
// A supprimer

namespace App\Backend\Modules\Users;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Users;

class usersController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $usersId = $request->getData('id');
 
    $this->managers->getManagerOf('Users')->delete($usersId);

    $this->app->user()->setFlash('Le User a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeIndex(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Users');
 
    return $this->render('backend/BackendUsersIndex.html', ['title' => 'Gestion des Users', 'listeUsers' => $manager->getList(), 'nombreUsers' => $manager->count()]);
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $users = $this->processForm($request);

    return $this->render('backend/BackendUsersInsert.html', ['title' => 'Ajout d\'une User', 'Users' => $users]);
  }
 
  public function executeSave(HTTPRequest $request)
  {
    $users = new Users;
    $users->setRoleId($request->postData('roleId'));
    $users->setName($request->postData('name'));
    $users->setFirstname($request->postData('firstname'));
    $users->setLoggin($request->postData('loggin'));
    $users->setPassword($request->postData('password'));
    $users->setEmail($request->postData('email'));
    $users->setPicture($request->postData('picture'));
    $users->setGrip($request->postData('grip'));

    if ($request->postExists('id')) {
      $users->setId($request->postData('id'));
    }

    $this->managers->getManagerOf('Users')->save($users);

    $this->app->httpResponse()->redirect('.');
  }

  public function executeUpdate(HTTPRequest $request)
  {
    $users = $this->processForm($request);
 
    return $this->render('backend/BackendUsersUpdate.html', ['title' => 'Modification d\'un User', 'Users' => $users]);
  }
 
  public function processForm(HTTPRequest $request)
  {
    // L'identifiant du User est transmis si on veut le modifier
    if ($request->getExists('id')) {
    $users = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
    } else {
    $users = new Users;
    }

    return $users;
  }
}