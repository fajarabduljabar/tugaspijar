<?php

// syarat untuk konek ke dalam database menggunakan PHP 
// nama hostnya, user db, password db, nama database
// bisa menggunakan fungsi mysqli_connect


$host = "localhost";
$user = "phpmyadmin";

$connect = mysqli_connect("$host", "$user", "bismillah", "pijar");

//  cek koneksi
// if ($connect) {
// echo "Berhasil Konek";
// } else {
// echo "Gagal Konek";
// }

