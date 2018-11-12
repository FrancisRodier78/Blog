<?php

    echo '<form action="." method="post">';
      echo '<p style="text-align: center">';
        echo 'Titre : <input type="text" name="titre" value="" /><br />';
        echo 'Chapo : <input type="text" name="chapo" value="" /><br />';
        echo 'Contenu : <input type="textarea rows="8" cols="60" name="content" value="" /><br />';
        echo '<input type="submit" value="Ajouter un nouveau post" name="ajouter" />';
      echo '</p>';
    echo '</form>';