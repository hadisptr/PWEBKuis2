<?php
// Include database connection
include 'dbConnection.php';

// Fetch data for dropdowns
$querySiswa = "SELECT ID_Siswa, Nama FROM Siswa";
$resultSiswa = mysqli_query($mysqli, $querySiswa);

$queryGuru = "SELECT ID_Guru, Nama_Guru FROM Guru";
$resultGuru = mysqli_query($mysqli, $queryGuru);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idSiswa = $_POST['id_siswa'];
    $idGuru = $_POST['id_guru'];
    $mataPelajaran = $_POST['mata_pelajaran'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $status = $_POST['status'];

    // Insert data into Jadwal table
    $query = "INSERT INTO Jadwal_Bimbingan (ID_Siswa, ID_Guru, Mata_Pelajaran, Tanggal, Waktu, Status) VALUES ($idSiswa, $idGuru, '$mataPelajaran', '$tanggal', '$waktu', '$status')";
    $result = mysqli_query($mysqli, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the jadwal.php page after adding a guidance session
    header("Location: jadwal.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal</title>
</head>
<body>
    <h2>Tambah Jadwal</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Form to add a new guidance session -->
    <form method="post" action="">
        <label>ID Siswa:</label>
        <select name="id_siswa" required>
            <?php
            // Display options for Siswa dropdown
            while ($rowSiswa = mysqli_fetch_assoc($resultSiswa)) {
                echo "<option value='{$rowSiswa['ID_Siswa']}'>{$rowSiswa['Nama']}</option>";
            }
            ?>
        </select><br>

        <label>ID Guru:</label>
        <select name="id_guru" required>
            <?php
            // Display options for Guru dropdown
            while ($rowGuru = mysqli_fetch_assoc($resultGuru)) {
                echo "<option value='{$rowGuru['ID_Guru']}'>{$rowGuru['Nama_Guru']}</option>";
            }
            ?>
        </select><br>

        <label>Mata Pelajaran:</label>
        <input type="text" name="mata_pelajaran" required><br>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required><br>

        <label>Waktu:</label>
        <input type="time" name="waktu" required><br>

        <label>Status:</label>
        <input type="text" name="status" required><br>

        <input type="submit" value="Tambah Jadwal">
    </form>

</body>
</html>
