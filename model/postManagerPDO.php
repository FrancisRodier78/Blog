<?php

class PostManagerPDO extends PostManager {
  /**
   * Attribut contenant l'instance représentant la BDD.
   * @type PDO
   */
  protected $db;
  
  /**
   * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
   * @param $db PDO Le DAO
   * @return void
   */
  public function __construct(PDO $db) {
    $this->db = $db;
  }
  
  /**
   * @see PostManager::addPost()
   */
  protected function addPost(Post $post) {
    $requete = $this->db->prepare('INSERT INTO post(titre, dateModif, chapo, contenu) VALUES(:titre, NOW(), :chapo, :contenu)');
    
    $requete->bindValue(':titre', $post->getTitre());
    $requete->bindValue(':chapo', $post->getChapo());
    $requete->bindValue(':contenu', $post->getContenu());
    
    $requete->execute();
  }
  
  /**
   * @see PostManager::countPost()
   */
  public function countPost() {
    return $this->db->query('SELECT COUNT(*) FROM post')->fetchColumn();
  }
  
  /**
   * @see PostManager::deletePost()
   */
  public function deletePost($id) {
//    $this->db->exec('DELETE FROM post WHERE id = '.(int) $id);
  }
  
  /**
   * @see PostManager::getListPost()
   */
  public function getListPosts($debut = -1, $limite = -1) {
    $sql = 'SELECT id, titre, dateModif, chapo, contenu FROM post ORDER BY id DESC';
    
    // On vérifie l'intégrité des paramètres fournis.
    if ($debut != -1 || $limite != -1) {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->db->query($sql);
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
    
    $listePost = $requete->fetchAll();

    // On parcourt notre liste de post pour pouvoir placer des instances de DateTime en guise de dates de modification.
    foreach ($listePost as $post) {
      $post->setDateModif(new DateTime($post->getDateModif()));
    }
    
    $requete->closeCursor();
    
    return $listePost;
  }
  
  /**
   * @see PostManager::getUniquePost()
   */
  public function getUniquePost($id) {
    $requete = $this->db->prepare('SELECT id, titre, dateModif, chapo, contenu FROM post WHERE id = :id');
    $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');

    $post = $requete->fetch();

    $post->setDateModif(new DateTime($post->getDateModif()));
    
    return $post;
  }
  
  /**
   * @see PostManager::updatePost()
   */
  protected function updatePost(Post $post) {
    $requete = $this->db->prepare('UPDATE post SET titre = :titre, dateModif= NOW(), chapo = :chapo, contenu = :contenu WHERE id = :id');
    
    $requete->bindValue(':titre', $post->titre());
    $requete->bindValue(':chapo', $post->auteur());
    $requete->bindValue(':contenu', $post->contenu());
    $requete->bindValue(':id', $post->id(), PDO::PARAM_INT);
    
    $requete->execute();
  }
}