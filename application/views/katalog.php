<!DOCTYPE html>
<html lang="en">

<?php include 'partk/head.php' ?>

<body>

    <!-- Navigation -->
    <?php include 'partk/nav.php' ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?= base_url() ?>assets/img/head1.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1 class="">Putra Meuble Recycle</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mb-4">
        New Product:
        <hr>
        <div class="row">
            <?php $i = 0;
            foreach ($gambar as $dt) : ?>
                <?php $i++;
                if ($i <= 4) : ?>
                    <a class="col-lg-3 p-2" href="<?= base_url('katalog/detail_produk/') . $dt->id; ?>">
                        <img class="img-fluid" src="<?= base_url('assets/img/' . $dt->foto) ?>" alt="Chania">
                        <?= $dt->kode ?> - <?= $dt->nama ?>
                    </a>
            <?php endif;
            endforeach; ?>

        </div>
        <center><a href="<?= base_url("katalog/produk") ?>" class="btn btn-success">View All</a></center>
    </div>
    <?php include 'partk/footer.php' ?>
    <?php include 'partk/js.php' ?>
</body>

</html>