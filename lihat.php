<?php
require "config.php";

$id = $_GET["id"];

// Fetch category information based on the provided ID
$kategori_query = "SELECT * FROM kategori WHERE id=$id";
$kategori_result = mysqli_query($connect, $kategori_query);
$kategori = mysqli_fetch_assoc($kategori_result);

// Fetch mata_kuliah data based on the category ID
$mata_kuliah_query = "SELECT * FROM mata_kuliah WHERE kategori_id=$id";
$mata_kuliah_result = mysqli_query($connect, $mata_kuliah_query);
$rowmatkul = mysqli_num_rows($mata_kuliah_result);
$mata_kuliah = "SELECT * FROM mata_kuliah WHERE id";
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
    <div class="card m-5" style="background-color: #ECEFF6; border-color:#ECEFF6;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-2 px-4 float-end">
                <li class="breadcrumb-item"><a style="text-decoration: none;" class="text-dark" href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration: none;" class="text-dark" href="#">My Course</a></li>
                <li class="breadcrumb-item active text-danger" aria-current=""><?= $kategori['kategori'] ?></li>
            </ol>
        </nav>
    </div>

    <?php
    if ($kategori) { ?>
        <h5 class="mt-5 mx-5 mb-4"> Total <?= $rowmatkul ?> mata kuliah</h5>
        <div class="row row-cols-1 row-cols-md-3 mx-5 g-4">
            <?php while ($matkul = mysqli_fetch_assoc($mata_kuliah_result)) {
            ?>
                <div class="col">
                    <div class="card">
                        <img src="foto.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <?php
                            $pengajar_query = "SELECT * FROM pengajar WHERE id={$matkul['pengajar_id']}";
                            $pengajar_result = mysqli_query($connect, $pengajar_query);
                            $pengajar = mysqli_fetch_assoc($pengajar_result);
                            ?>
                            <p class="card-text">Dosen : <span class="text-info"><?= $pengajar['nama'] ?></span></p>
                            <a class="text-dark" style="text-decoration: none;" href="detail_matkul.php?id=<?= $matkul['id'] ?>">
                                <h5><?= $matkul['nama_matkul'] ?></h5>
                            </a>
                        </div>
                        <div class="card-footer text-secondary"><i class="fa-solid fa-user"></i> <?= $matkul['jumlah_peserta'] ?> Peserta</div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No kategori found for the provided ID.</p>
    <?php } ?>

    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>