<!DOCTYPE html>
<html>
  <head>
    <title>Administration</title>
    <meta charset="utf-8" />
    
    <style type="text/css">
      table, td {
        border: 1px solid black;
      }
      
      table {
        margin:auto;
        text-align: center;
        border-collapse: collapse;
      }
      
      td {
        padding: 3px;
      }
    </style>
  </head>
  
  <body>
    <p><a href=".">Accéder à l'accueil du site</a></p>
    
    <p style="text-align: center">Il y a actuellement <?= $managerPost->countPost() ?> posts. En voici la liste :</p>
    
    <table>
      <tr><th>Titre</th><th>Date de création</th><th>Date de modification</th><th>Action</th></tr>
<?php

foreach ($managerPost->getListPosts() as $posts) {
  echo '<tr><td>', $posts->getTitre(), '</td><td>', $posts->getDateCreation()->format('d/m/Y à H\hi'), '</td><td>', $posts->getDateModif()->format('d/m/Y à H\hi'), '</td><td><a href="?modifier=', $posts->getId(), '">Modifier</a> | <a href="?supprimer=', $posts->getId(), '">Supprimer</a></td></tr>', "\n";}
?>
    </table>
  </body>
</html>