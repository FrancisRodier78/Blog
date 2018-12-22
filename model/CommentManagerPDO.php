<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Blog\model;
use \PDO;
use \Blog\model\CommentManager;
use \Blog\model\Comment;

class CommentManagerPDO extends CommentManager
{
    /**
     * Attribut contenant l'instance représentant la BDD.
     *
     * @var PDO
     */
    protected $db;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     *
     * @param $db PDO Le DAO
     *
     * @return void
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @see CommentManager::countComment()
     */
    /**
    public function countComment()
    {
        return $this->db->query('SELECT COUNT(*) FROM comment')->fetchColumn();
    }
    */

    /**
     * @see CommentManager::deleteComment()
     *
     * @param mixed $idComment
     */
    public function deleteComment($idComment)
    {
        $this->db->exec('DELETE FROM comment WHERE id = '.(int) $idComment);
    }

    /**
     * @see CommentManager::getListComments()
     *
     * @param mixed $idComment
     */
    public function getListComments($idComment)
    {
        $requete = $this->db->prepare('SELECT C.id, U.loggin AS auteur, C.content, C.dateComment FROM comment AS C INNER JOIN post AS P ON P.id = C.post_id INNER JOIN user AS U ON U.id = C.user_id WHERE C.post_id = :id AND C.etat = "Valider" ORDER BY C.id DESC');
        $requete->bindValue(':id', (int) $idComment, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Blog\model\Comment');

        return $requete->fetchAll();
    }
    
    /**
     * @see CommentManager::getUniqueComment()
     *
     * @param mixed $idComment
     */
    public function getUniqueComment($idComment)
    {
        $requete = $this->db->prepare('SELECT C.id, C.user_id, C.content, C.dateComment FROM comment AS C WHERE C.id = :id');
        $requete->bindValue(':id', (int) $idComment, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Blog\model\Comment');

        return $requete->fetch();
    }

    /**
     * @see CommentManager::getListNewComments()
     */
    public function getListNewComments()
    {
        $requete = $this->db->prepare('SELECT C.id, U.loggin AS auteur, C.content, C.etat, C.dateComment FROM comment AS C INNER JOIN user AS U ON U.id = C.user_id WHERE C.etat <> "Valider" ORDER BY C.id DESC');

        $requete->execute();

        // Par FETCH_CLASS on récupère un tableau d'objet et non un tableau de table.
        // Par FETCH_PROPS_LATE on force l'exécution du constructeur avant celui du contrôleur.
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Blog\model\Comment');

        $listComments = $requete->fetchAll();

        $requete->closeCursor();

        return $listComments;
    }

    /**
     * @see CommentManager::addComment()
     */
    protected function addComment(Comment $comment)
    {
        $requete = $this->db->prepare('INSERT INTO comment(user_id, post_id, content, etat, dateComment) VALUES(:user, :postId, :content, :etat, NOW())');

        $user = 1;
        $requete->bindValue(':user', $user);
        $requete->bindValue(':postId', $comment->getPostId());
        $requete->bindValue(':content', $comment->getContent());
        $etat = 'En attente';
        $requete->bindValue(':etat', $etat);

        if (!$requete) {
            echo "\nPDO::errorInfo():\n";
            print_r($requete->errorInfo());
        } else {
            print_r($requete->errorInfo());
        }

        $requete->execute();
    }

    /**
     * @see CommentManager::updateComment()
     */
    protected function updateComment(Comment $comment)
    {
        $requete = $this->db->prepare('UPDATE comment SET content = :content, etat = :etat, dateComment = NOW() WHERE id = :id');

        $requete->bindValue(':id', $comment->getid(), PDO::PARAM_INT);
        $requete->bindValue(':content', $comment->getContent());
        $requete->bindValue(':etat', $comment->getEtat());

        $requete->execute();
    }
}
