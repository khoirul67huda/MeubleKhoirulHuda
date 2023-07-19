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

            <button data-toggle="collapse" data-target="#barang" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Invoice</button>

            <div id="barang" class="collapse">
                <div class="card shadow mb-1">
                    <div class="card-header alert-success">
                        Tambah Invoice
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>pilih buyer:</label>
                                <select name="kode_buyer" class="form-control">
                                    <?php foreach ($buyer as $byr) : ?>
                                        <option value="<?= $byr->kode_buyer; ?>"><?= $byr->kode_buyer . ' ' . $byr->nama_buyer; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat Export:</label>
                                <input type="text" class="form-control" name="alamat_export" placeholder="Tulis Alamat Tujuan Export">
                            </div>

                            <input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <h2 class="h5 mb-0 text-gray-800">List Invoice</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode</th>
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
                                        <td><?= $dt->total_item ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/invoice_po/') . $dt->kode_po ?>" class="btn btn-warning rounded-circle btn-sm"><i class="fas fa-arrow-right"></i></a>
                                            <a href="<?= base_url('admin/edit_invoice/') . $dt->kode_po ?>" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>


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