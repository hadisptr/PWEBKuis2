<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Laporan table
$query = "SELECT ID_Laporan, ID_Siswa, Jenis_Laporan, Isi_Laporan, Waktu_Pelaporan FROM Laporan";
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
    <title>Laporan</title>
</head>
<body>
    <h2>Laporan Siswa</h2>

    <!-- Button to add a new study material -->
    <a href="index.php"><button>Homepage</button></a>
    <a href="addLaporan.php"><button>Tambah laporan</button></a>

    <!-- Display the list of reports -->
    <table border="1">
        <tr>
            <th>ID Laporan</th>
            <th>ID Siswa</th>
            <th>Jenis Laporan</th>
            <th>Isi Laporan</th>
            <th>Waktu Pelaporan</th>
        </tr>

        <?php
        // Loop through the result set and display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . (isset($row['ID_Laporan']) ? $row['ID_Laporan'] : '') . "</td>";
            echo "<td>" . (isset($row['ID_Siswa']) ? $row['ID_Siswa'] : '') . "</td>";
            echo "<td>" . (isset($row['Jenis_Laporan']) ? $row['Jenis_Laporan'] : '') . "</td>";
            echo "<td>" . (isset($row['Isi_Laporan']) ? $row['Isi_Laporan'] : '') . "</td>";
            echo "<td>" . (isset($row['Waktu_Pelaporan']) ? $row['Waktu_Pelaporan'] : '') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
