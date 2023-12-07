<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Materi_Pelajaran table
$query = "SELECT id_materi, mata_pelajaran, tingkat_kelas, sumber_belajar FROM Materi_Pelajaran";
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
    <title>MATERI</title>
</head>
<body>
    <h2>Materi Pembelajaran</h2>

    <!-- Button to add a new study material -->
    <a href="index.php"><button>Homepage</button></a>
    <a href="addMateri.php"><button>Tambah Materi</button></a>

    <!-- Display the list of study materials -->
    <table border="1">
        <tr>
            <th>ID Materi</th>
            <th>Mata Pelajaran</th>
            <th>Tingkat Kelas</th>
            <th>Sumber Belajar</th>
        </tr>

        <?php
        // Loop through the result set and display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id_materi']}</td>";
            echo "<td>{$row['mata_pelajaran']}</td>";
            echo "<td>{$row['tingkat_kelas']}</td>";
            echo "<td>{$row['sumber_belajar']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        // JavaScript function to delete a study material
        function deleteMateri(materiId) {
            var confirmation = confirm("Are you sure you want to delete this study material?");
            
            if (confirmation) {
                // Redirect to delete_materi_pelajaran.php with the material ID to perform deletion
                window.location.href = "delete_materi_pelajaran.php?id=" + materiId;
            }
        }
    </script>

</body>
</html>
