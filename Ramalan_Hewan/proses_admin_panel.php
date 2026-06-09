<?php
session_start();
include "config_koneksi.php";

// Proteksi admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['aksi'])) {
    header("Location: admin_panel.php?error=Aksi tidak valid");
    exit;
}

$aksi = $_POST['aksi'];


// =========================
// AKSI 1: TAMBAH HEWAN
// =========================
if ($aksi == "tambah_hewan") {

    $nama_hewan = trim($_POST['nama_hewan']);
    $warna = trim($_POST['warna']);

    if ($nama_hewan == "" || $warna == "") {
        header("Location: admin_panel.php?error=Nama hewan dan warna wajib diisi");
        exit;
    }

    // Cek biar tidak dobel nama hewan
    $cek = mysqli_prepare($conn, "SELECT id FROM hewan WHERE nama_hewan = ?");
    mysqli_stmt_bind_param($cek, "s", $nama_hewan);
    mysqli_stmt_execute($cek);
    mysqli_stmt_store_result($cek);

    if (mysqli_stmt_num_rows($cek) > 0) {
        header("Location: admin_panel.php?error=Hewan sudah ada, silakan tambah ramalan saja");
        exit;
    }

    // Insert hewan
    $query = "INSERT INTO hewan (nama_hewan, warna) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $nama_hewan, $warna);
    mysqli_stmt_execute($stmt);

    header("Location: admin_panel.php?sukses=1");
    exit;
}



// =========================
// AKSI 2: TAMBAH RAMALAN
// =========================
if ($aksi == "tambah_ramalan") {

    $hewan_id = trim($_POST['hewan_id']);
    $isi_ramalan = trim($_POST['isi_ramalan']);

    if ($hewan_id == "" || $isi_ramalan == "") {
        header("Location: admin_panel.php?error=Hewan dan isi ramalan wajib diisi");
        exit;
    }

    // Insert ramalan
    $query = "INSERT INTO ramalan (hewan_id, isi_ramalan) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "is", $hewan_id, $isi_ramalan);
    mysqli_stmt_execute($stmt);

    header("Location: admin_panel.php?sukses=1");
    exit;
}


// Kalau aksi tidak dikenali
header("Location: admin_panel.php?error=Aksi tidak dikenali");
exit;
?>
