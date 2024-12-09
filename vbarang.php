<?php
require_once 'barang.php';
require_once 'barangManager.php';

$barangManager = new barangManager();

//Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: vbarang.php');// Redirect untuk mencegah resubmission
}

//Menangani penghapusan barang
if (isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: vbarang.php'); // Redirect setelah menghapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
</head>
<body>
        <nav class="home-nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="vbarang.php" class="nav-link">Manajemen Barang</a>
            <a href="vcustomer.php" class="nav-link">Manajemen Pelanggan</a>
        </nav>

<div class="container">
    <h1>Pencatatan Barang</h1>
    <form method="POST" action="">
        <div>
            <label for="nama">Nama Barang:</label><br>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <label for="harga">Harga Barang:</label><br>
            <input type="number" id="harga" name="harga" required>
        </div>
        <div>
            <label for="stok">Stok Barang</label><br>
            <input type="number" id="stok" name="stok" required>
        </div>
        <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangManager->getBarang() as $barang): ?>
                <tr>
                    <td><?= $barang['id'] ?></td>
                    <td><?= $barang['nama'] ?></td>
                    <td><?= $barang['harga'] ?></td>
                    <td><?= $barang['stok'] ?></td>
                    <td>
                        <a href="?hapus=<?= $barang['id'] ?>" class="btn btn-delete">Hapus</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</body>
</html>