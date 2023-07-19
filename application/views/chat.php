<!DOCTYPE html>
<html lang="en">

<?php include 'part/head.php' ?>

<body id="page-top">


    <?php include 'part/sidebar.php' ?>

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include 'part/navbar.php' ?>
        <div class="container-fluid">
            <!-- ------------( batas Awal Isi Halaman )------------ -->
            <div class="card shadow mb-1">
                <div class="card-header py-3">

                    <h2 class="h5 mb-0 text-gray-800"><?= $barang->kode . ' - ' . $barang->nama ?></h2>
                </div>
                <div class="card-body alert-secondary">
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="isi_chat" placeholder="Ketik Komentar">
                            <input type="hidden" name="id_user" value="<?= $this->session->userdata('mkh_logged')->id ?>">
                            <input type="hidden" name="id_prod" value="<?= $barang->id_prod ?>">
                            <div class="input-group-append">
                                <input class="btn btn-success" type="submit" name="komentar" value="Kirim">
                            </div>
                        </div>
                    </form>
                    <?php foreach ($data as $dt) : ?>
                        <div class="card">
                            <div class="card-header">
                                <?= $dt->time_chat . ' - ' . $dt->nama_user ?>
                            </div>
                            <div class="card-body"><?= $dt->isi_chat ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <!-- ------------( Batas Akhir Isi Halaman )------------ -->
        </div>
        <!-- /.container-fluid -->

    </div>

    <?php include 'part/footer.php' ?>
    <?php include 'part/modal.php' ?>
    <script>
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
    </script>
    <?php include 'part/js.php' ?>
</body>

</html>