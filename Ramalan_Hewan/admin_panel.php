<?php
session_start();
include "config_koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* =========================
   TAMBAH DATA (HEWAN + RAMALAN)
========================= */
if (isset($_POST['tambah_data'])) {

    $nama_hewan = trim($_POST['nama_hewan']);
    $warna = trim($_POST['warna']);
    $isi_ramalan = trim($_POST['isi_ramalan']);

    if ($nama_hewan == "" || $warna == "" || $isi_ramalan == "") {
        echo "Semua field wajib diisi!";
        exit;
    }

    // Tambah hewan
    $q1 = "INSERT INTO hewan (nama_hewan, warna) VALUES (?, ?)";
    $stmt1 = mysqli_prepare($conn, $q1);
    mysqli_stmt_bind_param($stmt1, "ss", $nama_hewan, $warna);
    mysqli_stmt_execute($stmt1);

    $hewan_id = mysqli_insert_id($conn);

    // Tambah ramalan
    $q2 = "INSERT INTO ramalan (hewan_id, isi_ramalan) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($conn, $q2);
    mysqli_stmt_bind_param($stmt2, "is", $hewan_id, $isi_ramalan);
    mysqli_stmt_execute($stmt2);

    header("Location: admin_panel.php");
    exit;
}

/* =========================
   HAPUS RAMALAN
========================= */
if (isset($_GET['hapus_ramalan'])) {
    $id = intval($_GET['hapus_ramalan']);
    mysqli_query($conn, "DELETE FROM ramalan WHERE id_ramalan=$id");
    header("Location: admin_panel.php");
    exit;
}

/* =========================
   HAPUS HEWAN (RAMALAN IKUT HAPUS)
========================= */
if (isset($_GET['hapus_hewan'])) {
    $id = intval($_GET['hapus_hewan']);

    mysqli_query($conn, "DELETE FROM ramalan WHERE hewan_id=$id");
    mysqli_query($conn, "DELETE FROM hewan WHERE id_hewan=$id");

    header("Location: admin_panel.php");
    exit;
}

/* =========================
   EDIT RAMALAN
========================= */
if (isset($_POST['edit_ramalan'])) {
    $id_ramalan = intval($_POST['id_ramalan']);
    $isi_ramalan = trim($_POST['isi_ramalan']);

    if ($isi_ramalan == "") {
        echo "Isi ramalan tidak boleh kosong!";
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE ramalan SET isi_ramalan=? WHERE id_ramalan=?");
    mysqli_stmt_bind_param($stmt, "si", $isi_ramalan, $id_ramalan);
    mysqli_stmt_execute($stmt);

    header("Location: admin_panel.php");
    exit;
}

/* =========================
   EDIT HEWAN
========================= */
if (isset($_POST['edit_hewan'])) {
    $id_hewan = intval($_POST['id_hewan']);
    $nama_hewan = trim($_POST['nama_hewan']);
    $warna = trim($_POST['warna']);

    if ($nama_hewan == "" || $warna == "") {
        echo "Nama hewan dan warna tidak boleh kosong!";
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE hewan SET nama_hewan=?, warna=? WHERE id_hewan=?");
    mysqli_stmt_bind_param($stmt, "ssi", $nama_hewan, $warna, $id_hewan);
    mysqli_stmt_execute($stmt);

    header("Location: admin_panel.php");
    exit;
}

/* =========================
   AMBIL DATA
========================= */
$data_hewan = mysqli_query($conn, "SELECT * FROM hewan ORDER BY id_hewan DESC");

$data_ramalan = mysqli_query($conn, "
    SELECT ramalan.id_ramalan, ramalan.isi_ramalan, hewan.id_hewan, hewan.nama_hewan, hewan.warna
    FROM ramalan
    JOIN hewan ON ramalan.hewan_id = hewan.id_hewan
    ORDER BY ramalan.id_ramalan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ramalan Hewan</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f7f2e8;
            margin: 0;
            padding: 0;
        }

        .container{
            max-width: 1100px;
            margin: 40px auto;
            padding: 18px;
        }

        .header{
            text-align: center;
            margin-bottom: 26px;
        }

        .header h1{
            margin: 0;
            color: #7c3e12;
            font-size: 30px;
        }

        .header p{
            margin-top: 8px;
            color: #6b7280;
        }

        .section-title{
            margin-top: 34px;
            margin-bottom: 12px;
            color: #7c3e12;
            font-size: 22px;
        }

        .card{
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        label{
            display:block;
            margin-top: 14px;
            font-weight: bold;
            color: #333;
        }

        input, textarea{
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 15px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        textarea{
            resize: vertical;
        }

        .btn{
            padding: 12px 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-primary{
            background: #ff914d;
            color: white;
        }
        .btn-primary:hover{
            background: #ff7a2b;
        }

        .btn-danger{
            background: #dc2626;
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 12px;
            display: inline-block;
            text-align: center;
        }
        .btn-danger:hover{
            background: #b91c1c;
        }

        .btn-back{
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            padding: 14px;
            border-radius: 14px;
            background: #7c3e12;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-back:hover{
            background: #5f2d0b;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
        }

        th, td{
            border-bottom: 1px solid #eee;
            padding: 12px;
            text-align: left;
            vertical-align: top;
        }

        th{
            background: #fff4e6;
            color: #7c3e12;
        }

        .badge{
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: bold;
            color: white;
            display: inline-block;
            font-size: 13px;
        }

        .row-actions{
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .mini{
            width: auto;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 14px;
        }

        .grid-2{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 700px){
            .grid-2{
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>Admin Panel</h1>
        <p>Kelola hewan dan ramalan</p>
    </div>

    <!-- FORM TAMBAH -->
    <div class="section-title">1) Tambah Hewan & Ramalan</div>
    <div class="card">
        <form method="POST" action="admin_panel.php">

            <div class="grid-2">
                <div>
                    <label>Nama Hewan</label>
                    <input type="text" name="nama_hewan" placeholder="Contoh: Kucing" required>
                </div>

                <div>
                    <label>Warna Tema (bebas)</label>
                    <input type="color" name="warna" value="#ff914d" required>
                </div>
            </div>

            <label>Isi Ramalan</label>
            <textarea name="isi_ramalan" rows="4" placeholder="Contoh: Hari ini kamu akan dapat keberuntungan..." required></textarea>

            <br><br>
            <button type="submit" name="tambah_data" class="btn btn-primary">+ Tambah Data</button>
        </form>
    </div>

    <!-- TOMBOL KEMBALI DI PALING BAWAH -->
    <a href="index.php" class="btn-back"> Kembali ke Beranda</a>

</div>

</body>
</html>