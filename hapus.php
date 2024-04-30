<?php

require "config.php";

$id = $_GET["id"];
$query = mysqli_query($connect, "SELECT * FROM soal WHERE id=$id");
$soal = mysqli_fetch_assoc($query);
$so = $soal['matkul_id'];
$query2 = "DELETE FROM soal WHERE id=$id";
$hps = mysqli_query($connect, $query2);

header("Location: detail_matkul.php?id=$so");
session_start();
$_SESSION['status'] = "Successfull";
