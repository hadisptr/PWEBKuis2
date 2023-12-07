<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Siswa table
$query = "SELECT ID_Siswa, Nama, Usia, Alamat, Data_Kontak FROM Siswa";
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
    <title>SISWA</title>
</head>
<body>
    <h2>Siswa</h2>

    <!-- Button to add a new student -->
    <a href="index.php"><button>Homepage</button></a>
    <a href="addSiswa.php"><button>Tambah Siswa</button></a>

    <!-- Display the list of students -->
    <table border="1">
        <tr>
            <th>ID Siswa</th>
            <th>Nama</th>
            <th>Usia</th>
            <th>Alamat</th>
            <th>Data Kontak</th>
        </tr>

        <?php
        // Loop through the result set and display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['ID_Siswa']}</td>";
            echo "<td>{$row['Nama']}</td>";
            echo "<td>{$row['Usia']}</td>";
            echo "<td>{$row['Alamat']}</td>";
            echo "<td>{$row['Data_Kontak']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        // JavaScript function to delete a student
        function deleteSiswa(siswaId) {
            var confirmation = confirm("Are you sure you want to delete this student?");
            
            if (confirmation) {
                // Redirect to delete_siswa.php with the student ID to perform deletion
                window.location.href = "delete_siswa.php?id=" + siswaId;
            }
        }
    </script>

</body>
</html>
