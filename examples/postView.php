<?php $title = $post['title']; ?>

<?php ob_start(); ?>
    <p><a href="index.php">Retour à la liste des billets</a></p>
    
<div class="container-fluid">
    <div class="card col-lg-8">
      <div class="card-body">
        <h5 class="card-title"><?= $post['title'] ?>
                <em>le <?= $post['creation_date_fr'] ?></em></h5>
        <p class="card-text"><?= nl2br($post['content']) ?></p>
      </div>
    </div>
    <br/>
</div>

<div class="col-lg-8 blockAddComm">
    <h2>Commentaires</h2>
    <form action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" method="post">
        <h4>Ajouter un commentaire :</h4>
        <p><label name="author">Pseudo : <input type="text" name="author"/></label></p>
        <p><label name="comment">Commentaire : <input type="textarea" class="textTiny" name="comment"/></label></p>
        <input type="submit" text="Valider"/>
    </form>
</div>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <div class="commentDisplay">
            <p><strong><?= $comment['author'] ?></strong> le <?= $comment['creation_date_fr'] ?></p>
            <p><?= nl2br($comment['content']) ?></p>
            <p><a href="index.php?action=reportComment&amp;id=<?= $_GET['id'] ?>&amp;commentId=<?= $comment['id'] ?>">Signaler</a></p>
        </div>
    <?php
    }
    ?>

<?php $content = ob_get_clean(); ?>

<?php require('templateFront.php'); ?>