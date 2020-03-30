<?php
// NewsController.php

namespace App\Frontend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;

class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On récupère le manager des news.
    $manager = $this->managers->getManagerOf('News');
 
    $listeNews = $manager->getList(0, $nombreNews);
 
    foreach ($listeNews as $news) {
      if (strlen($news->content()) > $nombreCaracteres) {
        $debut = substr($news->content(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $news->setContent($debut);
      }
    }
 
    return $this->render('frontend/FrontendNewsIndex.html', ['title' => 'Liste des '.$nombreNews.' dernières news///', 'listeNews' => $listeNews]);
  }
 
  public function executeShow(HTTPRequest $request)
  {
      $_SESSION['precedent'] = 'show';
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    if (empty($news)) {
      $this->app->httpResponse()->redirect404();
    }

      // Recherche du loggin ayant écrit la new
      $logginNew = $this->managers->getManagerOf('News')->getLoggin($news->user_id());

      // Recherche des loggins ayant écrit les commentaires se rapportant à la new
      $comments = $this->managers->getManagerOf('Comments')->getListOf($news->id());
      foreach ($comments as $comment) {
        $logginTab[] = $this->managers->getManagerOf('News')->getLoggin($comment->user_id());
      }

    return $this->render('frontend/FrontendNewsShow.html', ['title' => $news->titre(), 'new' => $news, 'logginNew' => $logginNew, 'comments' => $this->managers->getManagerOf('Comments')->getListOf($news->id()), 'logginTab' => $logginTab]);
  }
 
  public function executeInsertComment(HTTPRequest $request)
  {
    $comment = new Comment;
    $user_id = $_SESSION['utilisateur-id'];
    return $this->render('frontend/FrontendCommentInsert.html', ['title' => 'Ajout d\'un commentaire', 'comment' => $comment, 'newId' => $request->getData('news'), 'User_id' => $user_id]);
}
 
  public function executeSave(HTTPRequest $request)
  {
    $comment = new Comment;
    $comment->setnew_id($request->postData('new_id'));
    $comment->setUser_id($request->postData('user_id'));
    $comment->setContent($request->postData('content'));

    $this->managers->getManagerOf('Comments')->save($comment);

    $this->app->user()->setFlash('Le commentaire est mis en attente, il ne sera visible qu\'une fois validé.');

    $news = $this->managers->getManagerOf('News')->getUnique($request->postData('new_id'));

    if (empty($news)) {
      $this->app->httpResponse()->redirect404();
    }

    // Recherche du loggin ayant écrit la new
    $logginNew = $this->managers->getManagerOf('News')->getLoggin($news->user_id());

    // Recherche des loggins ayant écrit les commentaires se rapportant à la new
    $comments = $this->managers->getManagerOf('Comments')->getListOf($news->id());
    foreach ($comments as $comment) {
      $logginTab[] = $this->managers->getManagerOf('News')->getLoggin($comment->user_id());
    }

    return $this->render('frontend/FrontendNewsShow.html', ['title' => $news->titre(), 'new' => $news, 'logginNew' => $logginNew, 'comments' => $this->managers->getManagerOf('Comments')->getListOf($news->id()), 'logginTab' => $logginTab]);
  }
}