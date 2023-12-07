<?php
// Include database connection
include 'dbConnection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $namaGuru = $_POST['nama_guru'];
    $mataPelajaran = $_POST['mata_pelajaran'];
    $dataKontak = $_POST['data_kontak'];

    // Insert data into Guru table
    $query = "INSERT INTO Guru (Nama_Guru, Mata_Pelajaran, Data_Kontak) VALUES ('$namaGuru', '$mataPelajaran', '$dataKontak')";
    $result = mysqli_query($mysqli, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the guru.php page after adding a teacher
    header("Location: guru.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru</title>
</head>
<body>
    <h2>Tambah Guru</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Form to add a new teacher -->
    <form method="post" action="">
        <label>Nama Guru:</label>
        <input type="text" name="nama_guru" required><br>

        <label>Mata Pelajaran:</label>
        <input type="text" name="mata_pelajaran" required><br>

        <label>Data Kontak:</label>
        <input type="text" name="data_kontak" required><br>

        <input type="submit" value="Tambah Guru">
    </form>

</body>
</html>
