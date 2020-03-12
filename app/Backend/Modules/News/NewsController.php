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
 
    $this->app->httpResponse()->redirect('/news-' . $request->postData('new_id') . '.html');

  }
 
  public function executeIndex(HTTPRequest $request)
  {
    //var_dump('Index');die();
    $manager = $this->managers->getManagerOf('News');
 
    return $this->render('backend/BackendNewsIndex.html', ['title' => 'Gestion des news', 'listeNews' => $manager->getList(), 'nombreNews' => $manager->count()]);
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $news = $this->processForm($request); 

    return $this->render('backend/BackendNewsInsert.html', ['title' => 'Ajout d\'une news', 'News' => $news]);
  }
 
 public function executeSave(HTTPRequest $request)
  {
    $news = new News; 
    $news->setUser_id($request->postData('user_id'));
    $news->setTitre($request->postData('titre'));
    $news->setChapo($request->postData('chapo'));
    $news->setContent($request->postData('content'));

    if ($request->postExists('id')) {
      $news->setId($request->postData('id'));
    }

    $this->managers->getManagerOf('News')->save($news);

    $this->app->httpResponse()->redirect('.');
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
 
    return $this->render('backend/BackendNewsUpdateComment.html', ['title' => 'Modification d\'un commentaire', 'Comment' => $comment, 'Id' => $request->getData('id')]);
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

    $this->app->httpResponse()->redirect('/news-' . $request->postData('new_id') . '.html');
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