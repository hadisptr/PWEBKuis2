<?php
// Include database connection
include 'dbConnection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $mataPelajaran = $_POST['mata_pelajaran'];
    $tingkatKelas = $_POST['tingkat_kelas'];
    $sumberBelajar = $_POST['sumber_belajar'];

    // Insert data into Materi_Pelajaran table
    $query = "INSERT INTO Materi_Pelajaran (Mata_Pelajaran, Tingkat_Kelas, Sumber_Belajar) VALUES ('$mataPelajaran', '$tingkatKelas', '$sumberBelajar')";
    $result = mysqli_query($mysqli, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the materi_pelajaran.php page after adding a study material
    header("Location: materi.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi</title>
</head>
<body>
    <h2>Tambah Materi</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Form to add a new study material -->
    <form method="post" action="">
        <label>Mata Pelajaran:</label>
        <input type="text" name="mata_pelajaran" required><br>

        <label>Tingkat Kelas:</label>
        <input type="text" name="tingkat_kelas" required><br>

        <label>Sumber Belajar:</label>
        <input type="text" name="sumber_belajar" required><br>

        <input type="submit" value="Tambah Materi">
    </form>

</body>
</html>
