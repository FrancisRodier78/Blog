<?php

    echo '<form action="." method="post">';
      echo '<p style="text-align: center">';
        echo 'Titre : <input type="text" name="titre" value="', $post->getTitre(),'" /><br />';
        echo 'Chapo : <input type="text" name="chapo" value="', $post->getChapo(),'" /><br />';
        echo 'Contenu : <input type="textarea rows="8" cols="60" name="content" value="', $post->getContent(),'" /><br />';
        echo '<input type="hidden" name="idPost" value=', $id, ' />';
        echo '<input type="submit" value="Envoyer le post" name="envoyer" />';
      echo '</p>';
    echo '</form>';
