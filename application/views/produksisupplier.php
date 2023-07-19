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
            <a href="<?= base_url('admin/order_supplier/' . $sup->kode_sup) ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h5 mb-0 text-gray-800">Supplier <?= $sup->kode_sup . " " . $sup->nama_sup ?></h2>
                        <h2 class="h5 mb-0 text-gray-800"><?= $kobuyer . "-" . $kopo . " " . $buyer->nama_buyer ?></h2>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>QTY</th>
                                    <th>Proses</th>
                                    <th>Selesai</th>
                                    <th>Start Date</th>
                                    <th>Deadline</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $dt) : ?>
                                    <?php $proses = $dt->jumlah - $dt->prd_selesai ?>
                                    <?php
                                    $warna = '';
                                    if ($proses == 0) {
                                        $warna = 'alert-success';
                                    } else if ($proses != 0 && time() >= strtotime($dt->prd_deadline)) {
                                        $warna = 'alert-danger';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $dt->kode_buyer . "-" . $dt->kode_po . "-" . $dt->kode_tambahan  ?></td>
                                        <td><?= $dt->kode_barang . "-" . $dt->nama ?></td>
                                        <td class="<?= $warna ?>"><?= $dt->jumlah ?></td>
                                        <td class="<?= $warna ?>"><?= $proses ?></td>
                                        <td class="<?= $warna ?>">
                                            <form action="<?= base_url('admin/produksi_selesai') ?>" method="POST">
                                                <input type="number" name="selesai" max="<?= $dt->jumlah ?>" min="0" value="<?= $dt->prd_selesai ?>">
                                                <input type="hidden" name="idprod" value="<?= $dt->id_prod ?>">
                                                <input type="hidden" name="sup" value="<?= $sup->kode_sup ?>">
                                                <input type="hidden" name="buyer" value="<?= $kobuyer ?>">
                                                <input type="hidden" name="po" value="<?= $kopo ?>">
                                                <input type="submit" class="btn btn-success btn-sm" name="" value="save">
                                            </form>
                                        </td>
                                        <td><?= $dt->prd_start ?></td>
                                        <td><?= $dt->prd_deadline ?></td>

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
    <?php include 'part/js.php' ?>
</body>

</html>