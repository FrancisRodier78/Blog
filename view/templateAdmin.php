<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="Administration de mon Blog">
    	<meta name="author" content="Francis Rodier">

    	<title><?php echo $title; ?></title>

    	<!-- Bootstrap Core CSS -->
    	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    	<!-- Theme CSS -->
    	<link href="public/css/blog.css" rel="stylesheet">

    	<!-- Custom Fonts -->
    	<link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
        	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.js"></script>
	    <![endif]-->
    </head>
        
    <body class="administration" >
        <?php echo $content; ?>
    </body>
</html>