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
            <a href="<?= base_url('admin/invoice') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button data-toggle="collapse" data-target="#barang" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Invoice</button>

            <div id="barang" class="collapse">
                <div class="card shadow mb-1">
                    <div class="card-header alert-success">
                        Tambah Barang
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="kode_po" value="<?= $kode->kode_po ?>">
                            <input type="hidden" name="kode_buyer" value="<?= $kode->kode_buyer ?>">
                            <input type="hidden" name="alamat_export" value="<?= $kode->alamat_export ?>">
                            <input type="hidden" name="total_item" value="<?= $kode->total_item ?>">

                            <div class="form-group">
                                <label>pilih barang:</label>
                                <select name="barang" class="form-control">
                                    <?php foreach ($barang as $ktg) : ?>
                                        <option value="<?= $ktg->id; ?>"><?= $ktg->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah barang:</label>
                                <input type="number" class="form-control" name="jumlah" placeholder="pilih jumlah barang">
                            </div>

                            <input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <h2 class="h5 mb-0 text-gray-800"><?= $kode->kode_buyer . '-' . $kode->kode_po ?></h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode Barang</th>
                                    <th>Buyer</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $dt) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $dt->kode_barang ?></td>
                                        <td><?= $dt->nama_buyer ?></td>
                                        <td><?= $dt->nama ?></td>
                                        <td><?= $dt->jumlah ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/detail_invoice/') . $dt->id_invoice ?>" class="btn btn-warning rounded-circle btn-sm"><i class="fas fa-search"></i></a>
                                            <a href="<?= base_url('admin/edit_invoice_barang/') . $dt->id_invoice ?>" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>
                                            <a onclick="deleteConfirm('<?php echo site_url('admin/delete_invoice/' . $dt->id_invoice . '/' . $kode->kode_po . '/' . $kode->total_item . '/' . $dt->id_barang) ?>')" href="#!" class="btn btn-danger rounded-circle btn-sm"><i class="fas fa-trash"></i></a>

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