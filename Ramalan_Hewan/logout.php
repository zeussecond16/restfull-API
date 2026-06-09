<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Balik ke halaman login
header("Location: login.php");
exit;
