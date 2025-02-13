<main class="container-fluid d-flex justify-content-around">
    <?php

    foreach ($category as $category) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($category->getId().' - '.$category->getName()); ?></h5>
                <a href="<?php echo ('/index.php?controller=book&action=show&id='.$category->getId());?>" class="btn btn-primary">Voir le détail</a>
            </div>
        </div>

    <?php } ?>
</main>

