<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Jadwal_Bimbingan table
$query = "SELECT id_jadwal, id_siswa, id_guru, mata_pelajaran, tanggal, waktu  FROM Jadwal_Bimbingan";
$result = mysqli_query($mysqli, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($mysqli));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JADWAL</title>
</head>
<body>
    <h2>Jadwal</h2>

    <!-- Button to add a new guidance session -->
    <a href="index.php"><button>Homepage</button></a>
    <a href="addJadwal.php"><button>Tambah Jadwal</button></a>

    <!-- Display the list of guidance sessions -->
    <table border="1">
        <tr>
            <th>ID Jadwal</th>
            <th>ID Siswa</th>
            <th>ID Guru</th>
            <th>Mata Pelajaran</th>
            <th>Tanggal</th>
            <th>Waktu</th>
        </tr>

        <?php
        // Loop through the result set and display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id_jadwal']}</td>";
            echo "<td>{$row['id_siswa']}</td>";
            echo "<td>{$row['id_guru']}</td>";
            echo "<td>{$row['mata_pelajaran']}</td>";
            echo "<td>{$row['tanggal']}</td>";
            echo "<td>{$row['waktu']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        // JavaScript function to delete a guidance session
        function deleteJadwalBimbingan(jadwalId) {
            var confirmation = confirm("Are you sure you want to delete this guidance session?");
            
            if (confirmation) {
                // Redirect to delete_jadwal_bimbingan.php with the session ID to perform deletion
                window.location.href = "delete_jadwal_bimbingan.php?id=" + jadwalId;
            }
        }
    </script>

</body>
</html>
