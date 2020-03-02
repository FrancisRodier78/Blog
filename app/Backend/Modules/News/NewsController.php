<?php
// NewsController.php

namespace App\Backend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
 
    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
 
    $this->app->user()->setFlash('La news a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeIndex(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('News');
 
    return $this->render('backend/BackendNewsIndex.html', ['title' => 'Gestion des news', 'listeNews' => $manager->getList(), 'nombreNews' => $manager->count()]);
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $news = $this->processForm($request); 

    return $this->render('backend/BackendNewsInsert.html', ['title' => 'Ajout d\'une news', 'News' => $news]);
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    $news = $this->processForm($request); 
 
    return $this->render('backend/BackendNewsUpdate.html', ['title' => 'Modification d\'une news', 'News' => $news]);
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
 
    return $this->render('backend/BackendNewsUpdateComment.html', ['title' => 'Modification d\'un commentaire', 'Comment' => $comment]);
  }
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST') {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id')) {
        $news->setId($request->getData('id'));
      }
    } else {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id')) {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      } else {
        $news = new News;
      }
    }

    return $news;
  }
}