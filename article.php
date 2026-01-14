<?php
include 'koneksi.php';
include "upload_foto.php";
?>

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Article
            </button>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari Artikel...">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th class="w-25">Judul</th>
                    <th class="w-50">Isi</th>
                    <th class="w-25">Gambar</th>
                    <th class="w-25">Aksi</th>
                </tr>
            </thead>
            <tbody id="result">
            <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);
                $no = 1;

                while ($row = $hasil->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <strong><?= $row["judul"] ?></strong><br>
                        pada : <?= $row["tanggal"] ?><br>
                        oleh : <?= $row["username"] ?>
                    </td>
                    <td><?= $row["isi"] ?></td>
                    <td>
                        <?php
                        if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) {
                            echo '<img src="img/' . $row["gambar"] . '" class="img-fluid">';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#" class="badge rounded-pill text-bg-success"
                           data-bs-toggle="modal"
                           data-bs-target="#modalEdit<?= $row['id'] ?>">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" class="badge rounded-pill text-bg-danger"
                           data-bs-toggle="modal"
                           data-bs-target="#modalHapus<?= $row['id'] ?>">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul"
                                               value="<?= $row['judul'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Isi</label>
                                        <textarea class="form-control" name="isi" required><?= $row['isi'] ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ganti Gambar</label>
                                        <input type="file" class="form-control" name="gambar">
                                    </div>

                                    <?php if ($row['gambar']) { ?>
                                        <img src="img/<?= $row['gambar'] ?>" class="img-fluid">
                                    <?php } ?>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL HAPUS -->
                <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="post">
                                <div class="modal-body">
                                    Yakin ingin menghapus artikel <b><?= $row['judul'] ?></b>?
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi</label>
                        <textarea class="form-control" name="isi" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';

    if (!empty($_FILES['gambar']['name'])) {
        $upload = upload_foto($_FILES['gambar']);
        $gambar = $upload['message'];
    }

    $stmt = $conn->prepare(
        "INSERT INTO article (judul, isi, gambar, tanggal, username)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
    $stmt->execute();

    echo "<script>location.href='admin.php?page=article'</script>";
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar = $_POST['gambar_lama'];

    if (!empty($_FILES['gambar']['name'])) {
        if ($gambar && file_exists("img/$gambar")) {
            unlink("img/$gambar");
        }
        $upload = upload_foto($_FILES['gambar']);
        $gambar = $upload['message'];
    }

    $conn->query("UPDATE article SET
        judul='$judul',
        isi='$isi',
        gambar='$gambar'
        WHERE id='$id'");

    echo "<script>location.href='admin.php?page=article'</script>";
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar && file_exists("img/$gambar")) {
        unlink("img/$gambar");
    }

    $conn->query("DELETE FROM article WHERE id='$id'");
    echo "<script>location.href='admin.php?page=article'</script>";
}
?>

<!-- ================= SCRIPT AJAX SESUAI TUTORIAL ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
function loadData(keyword = '') {
    $.ajax({
        url: 'article_search.php',
        type: 'POST',
        data: { keyword: keyword },
        success: function(data) {
            $('#result').html(data);
        }
    });
}

// load awal
loadData();

// ketika mengetik di input search
$('#search').keyup(function () {
    loadData($(this).val());
});
</script>

