<div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            foreach ($slider as $slide) {
                $actives = "";
                if ($i == 0) {
                    $actives = "active";
                }
            ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $actives ?>"></li>
            <?php
                $i++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($slider as $slide) {
                $actives = "";
                if ($i == 0) {
                    $actives = "active";
                }
            ?>
                <div class="carousel-item <?= $actives ?>">
                    <img class="d-block w-100 slider-image" src="assets/images/<?= $slide['image_name'] ?>" alt="First slide">
                    <div class="heading-wrapper">
                        <h2><?= $slide['slide_heaeding'] ?></h2>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>