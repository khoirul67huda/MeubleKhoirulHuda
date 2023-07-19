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
                        <h1>Putra Meuble Recycle</h1>
                        <span class="subheading">PRODUCTS</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mb-4" id="produk">
        Kategori: <?= $kategorine == '' ? 'Semua' : ucfirst($kategorine); ?>
        <DIV class="row">
            <form action="" method="POST">
                <a href="<?= base_url('katalog/produk/semua/#produk') ?>" class="btn btn-secondary btn-sm <?= $idk == 'semua' ? 'active' : '' ?>">Semua</a>
            </form>
            <?php foreach ($kategori as $ktg) : ?>

                <a href="<?= base_url('katalog/produk/' . $ktg->id . '/#produk') ?>" class="btn btn-secondary btn-sm <?= $idk == $ktg->id ? 'active' : '' ?>"><?= $ktg->kategori ?></a>
            <?php endforeach; ?>
        </DIV>
        <hr>
        <div class="row">
            <?php $i = 0;
            foreach ($gambar as $dt) : ?>

                <a class="col-lg-3 p-2" href="<?= base_url('katalog/detail_produk/') . $dt->id; ?>">
                    <img class="img-fluid" src="<?= base_url('assets/img/' . $dt->foto) ?>" alt="Chania">
                    <?= $dt->kode ?> - <?= $dt->nama ?>
                </a>

                <?php $i++; ?>
            <?php endforeach; ?>
            <?php if ($i == 0) {
                echo '<h5>Barang Tidak Tersedia</h5>';
            } ?>
        </div>
    </div>
    <?php include 'partk/footer.php' ?>
    <?php include 'partk/js.php' ?>
</body>

</html>