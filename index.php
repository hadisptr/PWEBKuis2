<?php
include 'dbConnection.php';

$result = mysqli_query($mysqli, "SELECT * FROM Siswa");
$siswaList = mysqli_fetch_all($result, MYSQLI_ASSOC);

function deleteSiswa($siswaID, $mysqli) {
    $deleteQuery = "DELETE FROM Siswa WHERE ID_Siswa = $siswaID";
    mysqli_query($mysqli, $deleteQuery);
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Management System</title>
</head>
<body>

<h1>Sekolah Management System</h1>

<a href="guru.php"><button>Guru</button></a>
<a href="siswa.php"><button>Siswa</button></a>
<a href="jadwal.php"><button>Jadwal Bimbingan</button></a>
<a href="materi.php"><button>Materi Pelajaran</button></a>
<a href="pesan.php"><button>Komunikasi Pesan</button></a>
<a href="dashboard_statistik.php"><button>Dashboard Statistik</button></a>
<a href="laporan.php"><button>Laporan</button></a>

</body>
</html>
