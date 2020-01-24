<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title)? $title : NULL ?> :: Busila Core</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">

    <header class="page-header">
        <h1 id="page-up"><a href="index.html">cyprien busila</a></h1>
        <p><i class="fas fa-home"></i>Développeur web indépendant, à l’écoute de vos projets</p>
        <nav>
            <div class="nav-ham">☰</div>
            <ul>
                <li class="nav-li-img"><a href="home.php"><img src="img/LOGO_BUSE_ROND.png" alt="Busila Core" title="Busila Core"></a></li>
                <li><a href="home.php#form-contact">Contact</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="cgu.php">C.G.U</a></li>
                <li class="nav-li-img"><a href="https://www.facebook.com/BusilaCore/" target="_blank"><img src="img/thumbs/facebook-logo.png" alt="Facebook" title="Facebook"></a></li>
            </ul>
        </nav>
    </header>

    <main class="page-body">
        <?= isset($content)? $content : 'error 404, le contenu est indispénible' ?>
    </main>

<div class="cursor-jump-up"><a href="#page-up">^^</a></div>
<footer class="page-footer">
    <p><a href="418" class="egg" rel="header('HTTP/1.1 418 I'm a teapot')">™</a></p>
</footer>

</div>
<script src="js/script.js"></script>
</body>
</html>