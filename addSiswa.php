<?php
// Include database connection
include 'dbConnection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $alamat = $_POST['alamat'];
    $dataKontak = $_POST['data_kontak'];

    // Insert data into Siswa table
    $query = "INSERT INTO Siswa (Nama, Usia, Alamat, Data_Kontak) VALUES ('$nama', $usia, '$alamat', '$dataKontak')";
    $result = mysqli_query($mysqli, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the siswa.php page after adding a student
    header("Location: siswa.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
</head>
<body>
    <h2>Tambah Siswa</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Form to add a new student -->
    <form method="post" action="">
        <label>Nama:</label>
        <input type="text" name="nama" required><br>

        <label>Usia:</label>
        <input type="number" name="usia" required><br>

        <label>Alamat:</label>
        <input type="text" name="alamat" required><br>

        <label>Data Kontak:</label>
        <input type="text" name="data_kontak" required><br>

        <input type="submit" value="Tambah Siswa">
    </form>

</body>
</html>
