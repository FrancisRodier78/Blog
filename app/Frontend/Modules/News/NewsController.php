<?php
// NewsController.php

namespace App\Frontend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
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
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
 
    if (empty($news)) {
      $this->app->httpResponse()->redirect404();
    }
 
    return $this->render('frontend/FrontendNewsShow.html', ['title' => $news->titre(), 'new' => $news, 'comments' => $this->managers->getManagerOf('Comments')->getListOf($news->id())]);
  }
 
  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST') {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'userId' => $request->postData('userId'),
        'content' => $request->postData('content')
      ]);
    } else {
      $comment = new Comment;
    }
 
    return $this->render('frontend/FrontendCommentInsert.html', ['title' => 'Ajout d\'un commentaire', 'comment' => $comment]);
  }
}