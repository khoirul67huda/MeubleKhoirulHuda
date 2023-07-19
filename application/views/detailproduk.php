<!DOCTYPE html>
<html lang="en">

<?php include 'partk/head.php' ?>

<body>

    <!-- Navigation -->
    <?php include 'partk/nav.php' ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?= base_url() ?>assets/img/head2.jpeg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>PMR</h1>
                        <span class="subheading">Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mb-4">
        <a href="<?= base_url('katalog/produk') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="row">
            <div class="col-lg-4 p-1"><img src="<?= base_url() ?>assets/img/<?= $dt->foto ?>" class="rounded img-fluid"></div>
            <div class="col-lg-8 p-3 pl-4">
                <h4><?= $dt->nama ?></h4>
                kode : <?= $dt->kode ?>
                <br>
                Kategori : <?= $kategori ?>
                <br>
                harga : <?= $dt->harga ?>
                <hr>
                <h5>Deskripsi Produk</h5>

                <p><?= $dt->deskripsi ?></p>
            </div>
        </div>
    </div>
    <?php include 'partk/footer.php' ?>
    <?php include 'partk/js.php' ?>
</body>

</html>