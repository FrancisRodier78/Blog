<?php
// index.php

foreach ($listeNews as $news)
{
?>
  <h2><a class="blog-a" href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  <p><?= nl2br($news['chapo']) ?></p>  
<?php
}
?>

{% for new in listeNews %}
  <h2><a class="blog-a" href="news-<?= $news['id'] ?>.html">{{ news.titre }}</a></h2>
  <p>{{ news.chapo }}</p>  
{% endfor %}
