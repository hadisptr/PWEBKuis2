<?php
// Include database connection
include 'dbConnection.php';

// Fetch data for dropdown (assuming you have a Siswa table)
$querySiswa = "SELECT ID_Siswa, Nama FROM Siswa";
$resultSiswa = mysqli_query($mysqli, $querySiswa);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idSiswa = $_POST['id_siswa'];
    $jenisLaporan = $_POST['jenis_laporan'];
    $isiLaporan = $_POST['isi_laporan'];

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO Laporan (ID_Siswa, Jenis_Laporan, Isi_Laporan, Waktu_Pelaporan) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "iss", $idSiswa, $jenisLaporan, $isiLaporan);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the laporan.php page after adding a report
    header("Location: laporan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan</title>
</head>
<body>
    <h2>Tambah Laporan</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Form to add a new report -->
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

        <label>Jenis Laporan:</label>
        <input type="text" name="jenis_laporan" required><br>

        <label>Isi Laporan:</label>
        <textarea name="isi_laporan" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Tambah Laporan">
    </form>
</body>
</html>
