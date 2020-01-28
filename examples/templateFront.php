<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title> 
        
        <script src="https://cdn.tiny.cloud/1/c2w6x9i4uqtslwokaddhay6toclhnganymuwyl68kgxbte4m/tinymce/5/tinymce.min.js"></script>
        <script> tinymce.init({
            selector: '.textTiny'
            });
        </script>
        
        
        <link rel="stylesheet" href="css/bootstrap.css"> 
	    <link rel="stylesheet" href="css/bootstrap-grid.css">
        <link href="css/styleFront.css" rel="stylesheet" />
        
    </head>
    
    <header class="container-fluid">
        <a href="index.php" id="logo">
            <img src="pictures/logo.png" alt="logo jean forteroche" />
        </a>
        <nav id="main-menu" class="col-sm-12">
            <a href="index.php">Accueil</a>
            <?php 
                if (isset($_SESSION['authorised']) && $_SESSION['authorised'] == 1)
                {
                    echo "<a href='index.php?action=getAdminViews'>Administration du site</a>";
                } else
                {
                   echo "<a href='index.php?action=getLogin'>Connexion</a>";
                }
            ?>
        </nav>
    </header>
        
    <body>
        <?= $content ?>
    </body>
</html>