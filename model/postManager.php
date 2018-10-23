<?php
abstract class PostManager {
  /**
   * Méthode permettant d'ajouter un post.
   * @param $post Post Le post à ajouter
   * @return void
   */
  abstract protected function addPost(string $titre, string $chapo, string $content);
  
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
  public function savePost(string $titre, string $chapo, string $content) {
    if ($post->isValid()) {
      $post->isNew() ? $this->addPost($titre, $chapo, $content) : $this->updatePost($titre, $chapo, $content);
    } else {
      throw new RuntimeException('Le post doit être valide pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de modifier un post.
   * @param $post post le post à modifier
   * @return void
   */
  abstract protected function updatePost(string $titre, string $chapo, string $content);

  /**
   * Méthode permettant d'envoyer un email à chaque nouveau post.
   * @return void
   */
  abstract protected function emailPost() {
    // email pour prévenir
  }
}