<?php
require "config.php";
// $query = "SELECT * FROM kategori";
// susunan mysqli_query = variabel koneksinya. query
// dollar connect it udari file config.php 
$id = $_GET["id"];
$query1 = "SELECT * FROM kategori";
$kategori = mysqli_query($connect, $query1);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elen PeTIK</title>
    <script src="https://kit.fontawesome.com/03b0c5c9d8.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand mx-3 fw-bold text-light" href="index.php">Elen PeTIK</a>
            <div>
            </div>
            <a href="" class="m-2 text-secondary" style="text-decoration: none; color:white"><button type="button" class="btn btn-warning">Login</button></a>
        </div>
    </nav>
    <div class="container-fluid d-grid justify-content-center align-items-center" style="height: 75vh; background-color: #EDEFE4;">
        <div class="col-12 text-center">
            <h2 class="fw-bold">E-learning PeTIK</h4>
            <p>Platform pembelajaran online Pesantren PeTIK</p>
            <p><a href="#" type="submit" class="btn btn-sm btn-outline-success">Ready to get started ?</a></p>
        </div>
    </div>
    <?php
    foreach ($kategori as $datkat) {
        $id = $datkat["id"];
        $query = "SELECT kategori.kategori, pengajar.nama, mata_kuliah.* FROM mata_kuliah 
    INNER JOIN kategori ON mata_kuliah.kategori_id = kategori.id
    INNER JOIN pengajar ON mata_kuliah.pengajar_id = pengajar.id WHERE kategori_id = $id
    ORDER BY nama_matkul ASC LIMIT 3";
        $matkul = mysqli_query($connect, $query);
    ?>
        <div class="row mt-5 mx-5 mb-2">
            <div class="col-10">
                <h4>Mata Kuliah <?= $datkat['kategori'] ?></h4>
            </div>
            <div class="col-2">
                <a class="text-dark" style="text-decoration: none;" href="lihat.php?id=<?= $datkat['id'] ?>">
                    <p class="fw-bold"><i class="fa-solid fa-list"></i> Lihat semua</p>
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 mx-5 g-4">
        <?php
                foreach ($matkul as $datmat) {
                ?>
            <div class="col">
           
                    <div class="card">
                        <img src="foto.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Dosen : <span class="text-info"><?= $datmat['nama'] ?></span></p>
                            <a class="text-dark" style="text-decoration: none;" href="detail_matkul.php?id=<?= $datmat['id'] ?>">
                                <h5><?= $datmat['nama_matkul'] ?></h5>
                            </a>
                        </div>
                        <div class="card-footer text-secondary"><i class="fa-solid fa-user"></i> <?= $datmat['jumlah_peserta'] ?> Peserta</div>
                    </div>
               
            </div>
            <?php
                }

                ?>
        </div>
    <?php
    }
    ?>




    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>