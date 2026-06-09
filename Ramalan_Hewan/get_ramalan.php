<?php
header("Content-Type: application/json");
include "config_koneksi.php";

// Ambil 1 ramalan random + join ke tabel hewan untuk ambil nama & warna
$sql = "
SELECT 
    ramalan.id,
    ramalan.isi_ramalan,
    hewan.nama_hewan,
    hewan.warna
FROM ramalan
JOIN hewan ON ramalan.hewan_id = hewan.id
ORDER BY RAND()
LIMIT 1
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query error: " . mysqli_error($conn)
    ]);
    exit;
}

if (mysqli_num_rows($result) == 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Belum ada data ramalan di database"
    ]);
    exit;
}

$data = mysqli_fetch_assoc($result);

echo json_encode([
    "status" => "success",
    "hewan" => $data["nama_hewan"],
    "warna" => $data["warna"],
    "judul" => "Ramalan " . $data["nama_hewan"],
    "isi"   => $data["isi_ramalan"]
]);
