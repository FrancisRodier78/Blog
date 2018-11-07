<?php
require_once 'model/postManagerPDO.php';

abstract class PostManager {
  /**
   * Méthode permettant d'ajouter un post.
   * @param $post Post Le post à ajouter
   * @return void
   */
  abstract protected function addPost(Post $post);
  
  /**
   * Méthode renvoyant le nombre de posts total.
   * @return int
   */
  abstract public function countPost();
  
  /**
   * Méthode permettant de supprimer un post.
   * @param $id int L'identifiant du post à supprimer
   * @return void
   */
  abstract public function deletePost($id);
  
  /**
   * Méthode retournant une liste de posts demandés.
   * @param $debut int Le premier post à sélectionner
   * @param $limite int Le nombre de post à sélectionner
   * @return array La liste des posts. Chaque entrée est une instance de Post.
   */
  abstract public function getListPosts($debut = -1, $limite = -1);
  
  /**
   * Méthode retournant un post précis.
   * @param $id int L'identifiant du post à récupérer
   * @return Post Le post demandé
   */
  abstract public function getUniquePost($id);
  
  /**
   * Méthode permettant d'enregistrer un post.
   * @param $post Post le post à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function savePost(Post $post) {
    if ($post->isValid()) {
      $post->isNew() ? $this->addPost($post) : $this->updatePost($post);
    } else {
      throw new RuntimeException('Le post doit être valide pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de modifier un post.
   * @param $post post le post à modifier
   * @return void
   */
  abstract protected function updatePost(Post $post);

  /**
   * Méthode permettant d'envoyer un email à chaque nouveau post.
   * email pour prévenir le super-administrateur
   * @return void
   */
  abstract protected function emailPost(string $msg);
}