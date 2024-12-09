<?php
require_once 'customer.php';
require_once 'customerManager.php';

$customerManager = new customerManager();

// Menangani form tambah pelanggan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $customerManager->tambahCustomer($nama, $email, $telepon);
    header('Location: vcustomer.php'); // Redirect untuk mencegah resubmission
}

// Menangani penghapusan pelanggan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $customerManager->hapusCustomer($id);
    header('Location: vcustomer.php'); // Redirect setelah menghapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Customer</title>
</head>
<body>
        <nav class="home-nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="vbarang.php" class="nav-link">Manajemen Barang</a>
            <a href="vcustomer.php" class="nav-link">Manajemen Pelanggan</a>
        </nav>
<div class="container">
    <h1>Manajemen Customer</h1>
    <form method="POST" action="">
        <div>
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="telepon">Telepon:</label><br>
            <input type="text" id="telepon" name="telepon" required>
        </div>
        <button type="submit" name="tambah" class="btn btn-add">Tambah Customer</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customerManager->getCustomers() as $customer): ?>
                <tr>
                    <td><?= $customer['id'] ?></td>
                    <td><?= $customer['nama'] ?></td>
                    <td><?= $customer['email'] ?></td>
                    <td><?= $customer['telepon'] ?></td>
                    <td>
                        <a href="?hapus=<?= $customer['id'] ?>" class="btn btn-delete">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
