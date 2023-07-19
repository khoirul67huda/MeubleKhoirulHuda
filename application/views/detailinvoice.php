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

            <a href="<?= base_url('admin/invoice_po/' . $dt->kode_po) ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card shadow mb-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4><?= $dt->kode_buyer . '-' . $dt->kode_po ?></h4>
                        <a href="<?= base_url('admin/detail_invoice/' . $idnya . '/' . $dt->barang) ?>" class="btn btn-primary mb-1 ml-1"><i class="fas fa-search"></i> Detail Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="container">
                        <tr>
                            <td>Kode Buyer</td>
                            <td><?= $dt->kode_buyer ?></td>
                        </tr>
                        <tr>
                            <td>Buyer</td>
                            <td><?= $dt->nama_buyer ?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><?= $dt->nama ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Barang</td>
                            <td><?= $dt->jumlah ?></td>
                        </tr>
                        <?php $total_proses = 0;
                        $total_selesai = 0;
                        foreach ($list_sup as $ls) {
                            $proses = $ls->jumlah - $ls->prd_selesai;
                            $total_proses = $total_proses + $proses;
                            $total_selesai = $total_selesai + $ls->prd_selesai;
                        } ?>
                        <tr>
                            <td>Jumlah Diproses</td>
                            <td><?= $total_proses ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Selesai Diproses</td>
                            <td><?= $total_selesai ?></td>
                        </tr>
                        <?php $belum_diproses = $dt->jumlah - $dt->proses - $dt->selesai ?>
                        <tr>
                            <td>Sisa Belum Proses</td>
                            <td><?= $belum_diproses ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Export</td>
                            <td><?= $dt->alamat_export ?></td>
                        </tr>
                    </table>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            <b>Catatan Produksi Item Deadline</b>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jumlah Produk</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $hitungan = 0; ?>
                                    <?php foreach ($list_sup as $ls) : ?>

                                        <?php $idproduksi = $ls->id_prod;

                                        $catatan = $this->MoProduksi->catatanProduksi($idproduksi);
                                        $deadlinenya = 0;
                                        foreach ($catatan as $cd) {
                                            if (time() >= strtotime($cd->prd_deadline)) {

                                                $catetan = $this->MoProduksi->isiChat($idproduksi);
                                                $deadlinenya = 1;
                                                if ($deadlinenya == 1) {
                                                    $hitungan++;
                                                    $proses = $ls->jumlah - $ls->prd_selesai;
                                                    echo "
                                            <tr>
                                            <td>" . $proses . "</td>";

                                                    foreach ($catetan as $ctt) {
                                                        if (isset($ctt->isi_chat)) {
                                                            echo " <td>" . $ctt->isi_chat . "</td>";
                                                        } else {
                                                            echo " <td></td>";
                                                        }
                                                    }

                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                        ?>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <?php if ($hitungan == 0) : ?>
                                <center><b>Proses Produksi Sesuai Jadwal</b></center>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->userdata('mkh_logged')->role != '4') : ?>
                <div class="card shadow my-3 ">
                    <div class="card-header alert-primary">
                        <h5>List Supplier</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="kode_po" value="<?= $dt->kode_po ?>">
                            <input type="hidden" name="kode_barang" value="<?= $dt->kode_barang ?>">
                            <input type="hidden" name="id_invoice" value="<?= $dt->id_invoice ?>">
                            <input type="hidden" name="proses_sebelumnya" value="<?= $dt->proses ?>">
                            <label>Pembagian Supplier</label>
                            <div class="input-group mb-3">
                                <select name="kode_sup" class="form-control">
                                    <?php foreach ($supplier as $sup) : ?>
                                        <option value="<?= $sup->kode_sup; ?>"><?= $sup->kode_sup . ' ' . $sup->nama_sup; ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <input type="number" class="form-control col-lg-2" name="jumlah" max="<?= $belum_diproses ?>" min="0" placeholder="jumlah barang">

                                <div class="input-group-append">
                                    <input type="submit" name="pembagian" class="btn btn-success btn-rounded" value="simpan">
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Supplier</th>
                                    <th>Proses</th>
                                    <th>Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_sup as $ls) : ?>
                                    <tr>
                                        <td><?= $ls->kode_sup . ' ' . $ls->nama_sup ?></td>
                                        <?php $proses = $ls->jumlah - $ls->prd_selesai; ?>
                                        <td><?= $proses; ?></td>
                                        <td><?= $ls->prd_selesai ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
            <!-- ------------( Batas Akhir Isi Halaman )------------ -->
        </div>
        <!-- /.container-fluid -->

    </div>

    <?php include 'part/footer.php' ?>
    <?php include 'part/modal.php' ?>

    <?php include 'part/js.php' ?>
</body>

</html>