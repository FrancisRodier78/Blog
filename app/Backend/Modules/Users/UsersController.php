<?php
// UsersController.php
// A supprimer

namespace App\Backend\Modules\Users;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
//use \Entity\News;
//use \Entity\Comment;
use \OCFram\FormHandler;
 
class UsersController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $UsersId = $request->getData('id');
 
    $this->managers->getManagerOf('Users')->delete($UsersId);
    $this->managers->getManagerOf('Comments')->deleteFromUsers($UsersId);
 
    $this->app->user()->setFlash('La Users a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('/Users-' . $request->postData('new_id') . '.html');

  }
 
  public function executeIndex(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Users');
 
    return $this->render('backend/BackendUsersIndex.html', ['title' => 'Gestion des Users', 'listeUsers' => $manager->getList(), 'nombreUsers' => $manager->count()]);
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $Users = $this->processForm($request); 

    return $this->render('backend/BackendUsersInsert.html', ['title' => 'Ajout d\'une Users', 'Users' => $Users]);
  }
 
  public function executeConnexion(HTTPRequest $request)
  {
    var_dump('Connexion'); die();
    if ($request->postExists('login') and $request->postExists('password')) {
      if ($this->app->user()->exist($request->postData('login'), $request->postData('password'))) {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }

    return $this->render('ConnexionUtilisateurIndex.html', ['title' => 'Connexion utilisateur']);
  }

  public function executeInscription(HTTPRequest $request)
  {
    var_dump('Inscription');die();

    if ($request->postExists('login') and $request->postExists('password') and $request->postExists('password2') and $request->postExists('email')) {
      if ($request->postData('password') == $request->postData('password2')) {
        $Users = new Users; 

        $Users->setRole_id($request->postData('role_id'));
        $Users->setName($request->postData('name'));
        $Users->setFirstname($request->postData('firstname'));
        $Users->setLoggin($request->postData('loggin'));
        $Users->setPassword($request->postData('password'));
        $Users->setEmail($request->postData('email'));
        $Users->setPicture($request->postData('picture'));
        $Users->setGrip($request->postData('grip'));

        $this->managers->getManagerOf('Users')->save($Users);

        $this->app->httpResponse()->redirect('.');
      } else {
        $this->app->user()->setFlash('Les mots de passe ne sont pas égaux.');
      }
    } else {
      $this->app->user()->setFlash('Un renseignement est faux.');
    }

    return $this->render('InscriptionUtilisateurIndex.html', ['title' => 'Inscription utilisateur']);
  }

  public function executeSave(HTTPRequest $request)
  {
    $Users = new Users; 
    $Users->setUser_id($request->postData('user_id'));
    $Users->setTitre($request->postData('titre'));
    $Users->setChapo($request->postData('chapo'));
    $Users->setContent($request->postData('content'));

    if ($request->postExists('id')) {
      $Users->setId($request->postData('id'));
    }

    $this->managers->getManagerOf('Users')->save($Users);

    $this->app->httpResponse()->redirect('.');
  }

  public function executeUpdate(HTTPRequest $request)
  {
    $Users = $this->processForm($request); 
 
    return $this->render('backend/BackendUsersUpdate.html', ['title' => 'Modification d\'une Users', 'Users' => $Users]);
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    if ($request->method() == 'POST') {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    } else {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    return $this->render('backend/BackendUsersUpdateComment.html', ['title' => 'Modification d\'un commentaire', 'Comment' => $comment, 'Id' => $request->getData('id')]);
  }
 
  public function executeCommentSave(HTTPRequest $request)
  {
    $comment = new Comment; 
    $comment->setId($request->postData('comment_id'));
    $comment->setNew_id($request->postData('new_id'));
    $comment->setUser_id($request->postData('user_id'));
    $comment->setContent($request->postData('content'));
    $comment->setEtat($request->postData('etat'));
    //$comment->setDateCreation($request->postData('dateCreation'));

    $this->managers->getManagerOf('Comments')->save($comment);

    $this->app->httpResponse()->redirect('/Users-' . $request->postData('new_id') . '.html');
  }

  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST') {
      $Users = new Users([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id')) {
        $Users->setId($request->getData('id'));
      }
    } else {
      // L'identifiant de la Users est transmis si on veut la modifier
      if ($request->getExists('id')) {
        $Users = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
      } else {
        $Users = new Users;
      }
    }

    return $Users;
  }
}