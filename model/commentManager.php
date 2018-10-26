<?php
class CommentManager {
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
   * Méthode permettant d'ajouter un comment.
   * @param $comment Comment Le comment à ajouter
   * @param $post Post nécessaire pour le comment à ajouter
   * @return void
   */
  protected function addComment(Comment $comment, Post $post) {
    $requete = $this->prepare('INSERT INTO comment(user_id, post_id, content) VALUES(:user, :post, :content)');
    
    $user = 1;
    $requete->bindValue(':user', $user);
    $requete->bindValue(':post', $post->getId());
    $requete->bindValue(':content', $comment->getContent());
    
    $requete->execute();
  }
  
  /**
   * Méthode renvoyant le nombre de comments total.
   * @return int
   */
  public function countComment() {
    return $this->query('SELECT COUNT(*) FROM comment')->fetchColumn();
  }
  
  /**
   * Méthode permettant de supprimer un comment.
   * @param $id int L'identifiant du comment à supprimer
   * @return void
   */
  public function deleteComment($id) {
    $this->exec('DELETE FROM comment WHERE id = '.(int) $id);
  }
  
  /**
   * Méthode retournant une liste de comments demandés.
   * @param $debut int Le premier comment à sélectionner
   * @param $limite int Le nombre de comment à sélectionner
   * @return array La liste des comments. Chaque entrée est une instance de Comment.
   */
  public function getListComments($post_id) {
    $sql = 'SELECT id, user_id, post_id = :post_id, content FROM comment ORDER BY id DESC';
    
    var_dump($post_id);
    $requete = $this->db->query($sql);
    $requete->bindValue(':post_id', $post_id);

    // If you want to fetch your result into a class (by using PDO::FETCH_CLASS) 
    // and want the constructor to be executed *before* PDO assings the object properties, 
    // you need to use the PDO::FETCH_PROPS_LATE constant:
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');
    
    $listeComment = $requete->fetchAll();

    // On parcourt notre liste de comment pour pouvoir placer des instances de DateTime en guise de dates.
    // On passe d'une date typé SQL à une date typé DateTime.
    foreach ($listeComment as $comment) {
      $comment->setDateCreation(new DateTime($comment->getDateCreation()));
      $comment->setDateModif(new DateTime($comment->getDateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeComment;
  }
  
  /**
   * Méthode retournant un comment précis.
   * @param $id int L'identifiant du comment à récupérer
   * @return comment Le comment demandé
   */
  public function getUniqueComment($id) {
    $requete = $this->prepare('SELECT id, user_id, post_id, content FROM comment WHERE id = :id');  
    $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

    $comment = $requete->fetch();

    $comment->setDateCreation(new DateTime($comment->getDateCreation()));
    $comment->setDateModif(new DateTime($comment->getDateModif()));
    
    return $comment;
  }
  
  /**
   * Méthode permettant d'enregistrer un comment.
   * @param $comment Comment le comment à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function saveComment(Comment $comment, Post $post) {
    if ($comment->isValid()) {
      $comment->isNew() ? $this->addComment($comment, $post) : $this->updateComment($comment);
    } else {
      throw new RuntimeException('Le commentaire doit être valide pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de modifier un comment.
   * @param $comment comment le comment à modifier
   * @return void
   */
  protected function updateComment(Comment $comment) {
    $requete = $this->prepare('UPDATE comment SET user_id = :user_id, post_id = :post_id, content = :content WHERE id = :id');
    
    $requete->bindValue(':id', $comment->getid(), PDO::PARAM_INT);
    $requete->bindValue(':user_id', $comment->getUserId());
    $requete->bindValue(':post_id', $comment->getPostId());
    $requete->bindValue(':content', $comment->getContent());
    
    $requete->execute();
  }

  /**
   * Méthode permettant d'envoyer un email à chaque nouveau comment.
   * email pour prévenir le super-administrateur
   * @return void
   */
  protected function emailPost(string $msg) {
  }
}
