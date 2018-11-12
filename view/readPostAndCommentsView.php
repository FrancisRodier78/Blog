<?php

  echo '<p>Par <em>', $post->getUserId(), '</em>, créer le ', $post->getDateCreation()->format('d/m/Y à H\hi'), ', modifier le ', $post->getDateModif()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $post->getTitre(), '</h2>', "\n",
       '<p>', nl2br($post->getContent()), '</p>', "\n";

  echo '<form action="." method="post">';
    echo '<input type="hidden" name="idPost" value=', $post->getId(), ' />';
    echo '<input type="submit" value="Modifier le post" name="modifier"/>';
  echo '</form>';

  echo '<form action="." method="post">';
    echo '<input type="hidden" name="id" value=', $id, ' />';
    echo '<input type="submit" value="Supprimer le post" name="supprimer"/>';
  echo '</form>';

  echo '<form action="." method="post">';
    echo '<input type="submit" value="Retourner à la liste" name="retour"/>';
  echo '</form>';
