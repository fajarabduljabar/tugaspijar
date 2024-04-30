<?php
session_start();
require "config.php";

$id = $_GET["id"];


// $query = "SELECT * FROM kategori ";
// $edit = mysqli_query($connect, $query);

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
            <a class="navbar-brand mx-3 fw-bold text-light" href="index.php">Elen Pesantren PeTIK</a>
            <div>
            </div>
            <a href="" class="m-2 text-secondary" style="text-decoration: none; color:white"><button type="button" class="btn btn-warning">Login</button></a>
        </div>
    </nav>
    <?php
    if (isset($_SESSION['status'])) {
        echo "<div class='alert alert-warning alert-dismissible fade show mx-5 mt-3 mb-0' role='alert'>
                            <strong>" . $_SESSION['status'] . "</strong> Data has been deleted
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
        session_destroy();
    } elseif (isset($_SESSION['tambah'])) {
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Successfull", "Data has been added", "success");
        </script>
    <?php
    }
    session_destroy();
    ?>
    <div class="card mx-5 mt-3" style="background-color: #ECEFF6; border-color:#ECEFF6;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-2 px-4 float-end">
                <li class="breadcrumb-item"><a style="text-decoration: none;" class="text-dark" href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration: none;" class="text-dark" href="#">My Course</a></li>
                <?php
                $query = "SELECT * FROM mata_kuliah WHERE mata_kuliah.id='$id'";
                $mata_kuliah = mysqli_query($connect, $query);
                foreach ($mata_kuliah as $matkul) {
                    # code...

                ?>
                    <li class="breadcrumb-item active text-danger" aria-current="">
                        <?= $matkul['kode'] ?>
                    </li>
                <?php
                }
                ?>
            </ol>
        </nav>
    </div>
    <div class="card mt-5 mb-2 mx-5">
        <div class="row mb-2 mt-3">
            <div class="col-6">
                <h5 class="mx-3">Course Content</h5>
            </div>
            <div class="col-6">
                <?php
                $query1 = "SELECT kategori.kategori FROM kategori INNER JOIN mata_kuliah ON kategori.id = mata_kuliah.kategori_id WHERE mata_kuliah.id = '$id'";
                $kategori = mysqli_query($connect, $query1);
                foreach ($kategori as $kat) {
                    # code...

                ?>
                    <p class="mx-4 float-end">Category : Mata Kuliah <?= $kat['kategori'] ?> </p>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        $query2 = "SELECT soal.* FROM soal INNER JOIN mata_kuliah ON mata_kuliah.id = soal.matkul_id WHERE matkul_id = '$id'";
        $soal = mysqli_query($connect, $query2);
        foreach ($soal as $so) {

        ?>
            <div class="accordion mx-2 mb-3" id="<?= $so['id'] ?>">
                <div class="accordion mx-5" id="accordion-<?= $so['id'] ?>">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $so['id'] ?>" aria-expanded="true" aria-controls="collapse-<?= $so['id'] ?>">
                                <?= $so['nama_soal'] ?>
                            </button>
                        </h2>
                        <div id="collapse-<?= $so['id'] ?>" class="accordion-collapse collapse py-3" data-bs-parent="#accordion-<?= $so['id'] ?>">
                            <a href="hapus.php?id=<?= $so['id'] ?>" onclick="return confirm('Apakah anda yakin data ini akan dihapus ?')" style="text-decoration: none;">
                                <div class="card-body text-center float-end mx-3"><i class="fa-solid fa-trash text-danger rounded-2 p-2 border border-danger"></i></div>
                            </a>
                            <small class="px-5">Kategori
                                <?php if ($so["jenis_soal"] == 't') {
                                    echo "<small class='badge bg-success'>Tugas</small>";
                                } elseif ($so["jenis_soal"] == 'k') {
                                    echo "<small class='badge bg-warning'>Kuis</small>";
                                } else {
                                    echo "<small class='badge bg-danger'>Ujian</small>";
                                };
                                ?>
                            </small>
                            <?php
                            $detline = (new DateTime($so['tgl_selesai']))->diff(new DateTime($so['tgl_mulai']))->days;
                            ?>
                            <p class="px-5">-Detline <span class="text-danger fw-bold"><?= $detline ?> hari lagi</span> </p>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
    </div>
    <a href="add_topic.php?id=<?= $matkul['id'] ?>">
        <button type="submit" class="btn btn-sm btn-primary mx-5"><i class="fas fa-plus-circle"></i>Add Topic</button>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>