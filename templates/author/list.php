<main class="container-fluid d-flex justify-content-around">
    <?php

    foreach ($author as $author) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($author->getId().' - '.$author->getFirstname().' '.$author->getLastname()); ?></h5>
                <a href="<?php echo ('/index.php?controller=author&action=show&id='.$author->getId());?>" class="btn btn-primary">Voir le détail</a>
            </div>
        </div>

    <?php } ?>
</main>

