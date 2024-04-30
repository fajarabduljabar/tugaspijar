<?php
require "config.php";
$id = $_GET["id"];

$matkul = mysqli_query($connect, "SELECT * FROM mata_kuliah WHERE id=$id");
$nama = htmlspecialchars($_POST["soal"]);
$mulai = htmlspecialchars($_POST["mulai"]);
$selesai = htmlspecialchars($_POST["selesai"]);
$j_soal = htmlspecialchars($_POST["j_soal"]);
$query = "INSERT INTO soal(nama_soal,tgl_mulai,tgl_selesai,jenis_soal,matkul_id) VALUES ('$nama','$mulai','$selesai','$j_soal','$id')";
$query2 = "SELECT * FROM soal WHERE id='$id'";
$cek_kode = mysqli_query($connect, $query2);

if (isset($_POST["tambah"])) {

    if ($connect->query($query) === TRUE) {
        header("Location: detail_matkul.php?id=$id");

        session_start();
        $_SESSION['tambah'] = "Horeeeee....!!";
    } else {
        echo "Error: " . $query . "<br>" . $connect->error;
    }

    $connect->close();
}

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
    <div class="card m-5" style="background-color: #ECEFF6; border-color:#ECEFF6;">
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb pt-2 px-4 float-end">

                <li class="breadcrumb-item"><a class="text-dark" style="text-decoration: none;" href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a class="text-dark" style="text-decoration: none;" href="#">My Course</a></li>
                <?php
                foreach ($matkul as $kul) {
                    if ($id == $kul['id']) {
                ?>
                        <li class="breadcrumb-item active text-dark" aria-current="">
                        <a style="text-decoration: none;" class="text-dark" href="detail_matkul.php?id=<?= $kul['id'] ?>">
                            <?= $kul['kode'] ?>
                            </a>
                        </li>

                        <li class="breadcrumb-item">Adding a new</li>
            </ol>

            <h5 class="pt-2 px-5"><?= $kul['nama_matkul'] ?></h5>
        </nav>
    </div>
    <div class="card mx-5 mb-5">
        <div class="row m-4">
            <div class="col-12">
                <h4>Adding a new topic</h4>
            </div>
        </div>
        <form action="" method="POST">
            <div class="row mx-3">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mata kuliah</label>
                        <input type="text" class="form-control" value="<?= $kul['nama_matkul'] ?>" id="exampleFormControlInput1" required>
                    </div>

                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama soal</label>
                        <input type="text" class="form-control" name="soal" id="exampleFormControlInput1" required>
                    </div>
                </div>
            </div>
            <div class="row mx-3">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="mulai" id="exampleFormControlInput1" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="selesai" id="exampleFormControlInput1" required>
                    </div>
                </div>
            </div>
            <div class="row mx-3">
                <div class="col-12">
                    <p>Jenis Soal</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="t" name="j_soal" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Tugas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="k" name="j_soal" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Kuis
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="u" name="j_soal" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Ujian
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mx-2">
                <div class="col-10 p-4">
                    <button type="submit" name="tambah" class="btn btn-sm btn-success">Save and return to course</button>
                    
                </div>
                <div class="col-2">
                <a href="detail_matkul.php?id=<?= $kul['id'] ?>" type="submit" class="btn btn-sm btn-outline-success float-end mx-2 mt-4">
                    Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
<?php
                    }
                }
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

