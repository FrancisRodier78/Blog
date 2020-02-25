<!DOCTYPE html>
<html lang="en">

<head>
  <!-- a supprimer -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?= isset($title) ? $title : 'Mon super site' ?>
    </title>

  <!-- Custom fonts for this theme Blog\app\Frontend\Templates -->
  <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="css/freelancer.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- blog Section -->
  <section class="page-section bg-primary text-white mb-0" id="blog">
    <div class="container">
        <div class="container">
          <div id="wrap">
            <header>
              <h1><a class="blog-a" href="/">Mon super site</a></h1>
              <p>Comment ça, il n'y a presque rien ?</p>
            </header>
       
            <nav>
              <ul>
                <li><a class="blog-a" href="/">Accueil</a></li>
                <li><a class="blog-a" href="/admin/">Admin</a></li>
                <?php if ($user->isAuthenticated()) { ?>
                   <li><a class="blog-a" href="/admin/news-insert.html">Ajouter une news</a></li>
                   <li><a class="blog-a" href="/admin/logout">Deconnexion</a></li>
                <?php } ?>
              </ul>
            </nav>
       
            <div id="content-wrap">
              <section id="main">
                <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
       
                {% block content %}{%endblock %}
              </section>
            </div>
       
            <footer></footer>
          </div>
        </div>

    </div>
  </section>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.js"></script>
</body>
</html>