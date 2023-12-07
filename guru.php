<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Guru table
$query = "SELECT * FROM Guru";
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
    <title>GURU</title>
</head>
<body>
    <h2>Guru</h2>

     <!-- Button to add a new teacher -->
     <a href="index.php"><button>Homepage</button></a>
     <a href="addGuru.php"><button>Tambah Guru</button></a>

    <!-- Display the list of teachers -->
    <table border="1">
        <tr>
            <th>ID Guru</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Data Kontak</th>

        </tr>

        <?php
        // Loop through the result set and display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['ID_Guru']}</td>";
            echo "<td>{$row['Nama_Guru']}</td>";
            echo "<td>{$row['Mata_Pelajaran']}</td>";
            echo "<td>{$row['Data_Kontak']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        // JavaScript function to delete a teacher
        function deleteGuru(guruId) {
            var confirmation = confirm("Are you sure you want to delete this teacher?");
            
            if (confirmation) {
                // Redirect to delete_guru.php with the teacher ID to perform deletion
                window.location.href = "delete_guru.php?id=" + guruId;
            }
        }
    </script>

</body>
</html>
