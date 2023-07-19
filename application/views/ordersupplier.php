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

            <a href="<?= base_url('admin/supplier') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <h2 class="h5 mb-0 text-gray-800">Supplier <?= $sup->kode_sup . " " . $sup->nama_sup ?></h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode PO</th>
                                    <th>Buyer</th>
                                    <th>Total Item</th>
                                    <th>aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $dt) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $dt->kode_buyer . '-' . $dt->kode_po ?></td>
                                        <td><?= $dt->nama_buyer ?></td>
                                        <td><?= $dt->produksi ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/produksi_supplier/' . $dt->kode_sup . '/' . $dt->kode_buyer . '/' . $dt->kode_po) ?>" class="btn btn-warning rounded-circle btn-sm"><i class="fas fa-arrow-right"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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