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
            <h2 class="h5 mb-0 text-gray-800">Deadline</h2>
            <?php foreach ($data as $dt) : ?>
                <?php
                $kode_sup = $dt->kode_sup;
                $carideadline = $this->MoProduksi->filterproduksisupplier($kode_sup);
                $itemproses = 0;
                foreach ($carideadline as $cd) {
                    if (time() >= strtotime($cd->prd_deadline)) {

                        $itemproses += 1;
                    }
                }
                ?>
                <?php if ($itemproses > 0) : ?>
                    <div class="card shadow mb-1">
                        <div class="card-header py-3">

                            <h2 class="h5 mb-0 text-gray-800"><?= $dt->nama_sup  ?></h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" width="100%" cellspacing="0">
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
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1;
                                    foreach ($carideadline as $cd) : ?>
                                        <?php if (time() >= strtotime($cd->prd_deadline)) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $cd->kode_buyer . "-" . $cd->kode_po . "-" . $cd->kode_tambahan  ?></td>
                                                <td><?= $cd->kode_barang . "-" . $cd->nama ?></td>
                                                <td><?= $cd->jumlah ?></td>
                                                <td><?= $cd->proses ?></td>
                                                <td><?= $cd->prd_selesai ?></td>
                                                <td><?= $cd->prd_start ?></td>
                                                <td><?= $cd->prd_deadline ?></td>
                                                <td><a href="<?= base_url('admin/chat/' . $cd->id_prod) ?>" class="btn btn-primary rounded-circle btn-sm"><i class="fas fa-comment"></i></a></td>

                                            </tr>
                                    <?php endif;
                                    endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

            <?php endif;
            endforeach; ?>

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