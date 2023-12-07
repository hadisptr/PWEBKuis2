<?php
// Include database connection
include 'dbConnection.php';

// Fetch data for statistics
$query = "SELECT Siswa.Nama AS Nama_Siswa, COUNT(Jadwal_Bimbingan.ID_Jadwal) AS Jumlah_Jadwal
          FROM Siswa
          LEFT JOIN Jadwal_Bimbingan ON Siswa.ID_Siswa = Jadwal_Bimbingan.ID_Siswa
          GROUP BY Siswa.ID_Siswa, Siswa.Nama";
$result = mysqli_query($mysqli, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($mysqli));
}

// Fetch data for chart
$chartQuery = "SELECT Nama, COUNT(ID_Jadwal) AS Jumlah_Jadwal FROM Siswa
               LEFT JOIN Jadwal_Bimbingan ON Siswa.ID_Siswa = Jadwal_Bimbingan.ID_Siswa
               GROUP BY Siswa.ID_Siswa, Nama";
$chartResult = mysqli_query($mysqli, $chartQuery);

// Check if there is data in the result
if (!$result || !$chartResult) {
    echo "No data available for statistics.";
} else {
    // Fetch data for statistics
    $statistikData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $statistikData[] = $row;
    }

    // Fetch data for chart
    $chartData = [];
    while ($chartRow = mysqli_fetch_assoc($chartResult)) {
        $chartData[] = $chartRow;
    }

    // Close connection
    mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistic Siswa</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Statistic Siswa</h2>

    <a href="index.php"><button>Homepage</button></a>

    <!-- Display statistics -->
    <table border="1">
        <tr>
            <th>Nama Siswa</th>
            <th>Jumlah Jadwal</th>
        </tr>
        <?php
        foreach ($statistikData as $data) {
            echo "<tr>";
            echo "<td>{$data['Nama_Siswa']}</td>";
            echo "<td>{$data['Jumlah_Jadwal']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Display chart -->
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // JavaScript to create a bar chart using Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($chartData, 'Nama')); ?>,
                datasets: [{
                    label: 'Jumlah Jadwal',
                    data: <?php echo json_encode(array_column($chartData, 'Jumlah_Jadwal')); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
<?php
} // Close the else block
?>
