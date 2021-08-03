<?php
   $servername = "localhost";
   $database = "percobaan";
   $username = "root";
   $password = "";
   $conn = mysqli_connect($servername, $username, $password, $database);
   if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
    }

    $pelajar = mysqli_query($conn,'SELECT * FROM siswa');
    if(isset($_POST['cek'])){
        $nama = $_POST['nama'];
        $nilai = $_POST['nilai'];

        if($nilai >= 0 && $nilai <= 39){
            $hasil = 'D';
        }elseif($nilai >= 40 && $nilai <= 59){
            $hasil = 'C';
        }elseif($nilai >= 60 && $nilai <= 79){
            $hasil = 'B';
        }elseif($nilai >= 80  && $nilai <= 100){
            $hasil = 'A';
        }

        mysqli_query($conn,"INSERT INTO `siswa` (`id`, `nama`, `nilai`,`hasil`) VALUES (NULL, '$nama', '$nilai','$hasil')");

        echo "<script>alert('Data pelajar Telah Berhasil DiSimpan');document.location.href='test.php'</script>";
        
    }
    
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Latihan</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class=" m-4 p-4">
                <h1>Pengecekan Nilai Siswa</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="number" name="nilai" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded-pill" name="cek" value="cek">Cek Nilai</button>
                    </div>
                </form>
            </div>

            <div class="table">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Hasil Huruf</th> 
                        </tr>
                     
                    </thead>
                    <tbody>
                        <?php foreach($pelajar as $p){ ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td><?= $p['nama'] ?></td>
                                <td><?= $p['nilai'] ?></td>
                                <td><?= $p['hasil'] ?></td>
                            </tr>    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>


