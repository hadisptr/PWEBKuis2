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

// Fetch data for statistics
$statisticsQuery = "SELECT Siswa.Nama AS Nama_Siswa, COUNT(Jadwal_Bimbingan.ID_Jadwal) AS Jumlah_Jadwal
                    FROM Siswa
                    LEFT JOIN Jadwal_Bimbingan ON Siswa.ID_Siswa = Jadwal_Bimbingan.ID_Siswa
                    GROUP BY Siswa.ID_Siswa, Siswa.Nama";
$statisticsResult = mysqli_query($mysqli, $statisticsQuery);

// Check if the query was successful
if (!$statisticsResult) {
    die("Statistics query failed: " . mysqli_error($mysqli));
}

// Fetch data for chart
$chartQuery = "SELECT Nama, COUNT(ID_Jadwal) AS Jumlah_Jadwal FROM Siswa
               LEFT JOIN Jadwal_Bimbingan ON Siswa.ID_Siswa = Jadwal_Bimbingan.ID_Siswa
               GROUP BY Siswa.ID_Siswa, Nama";
$chartResult = mysqli_query($mysqli, $chartQuery);

// Check if there is data in the result
if (!$result || !$statisticsResult || !$chartResult) {
    echo "No data available.";
} else {
    // Fetch data for statistics
    $statistikData = [];
    while ($row = mysqli_fetch_assoc($statisticsResult)) {
        $statistikData[] = $row;
    }

    // Fetch data for chart
    $chartData = [];
    while ($chartRow = mysqli_fetch_assoc($chartResult)) {
        $chartData[] = $chartRow;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Management System</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Sekolah Management System</h1>

<a href="guru.php"><button>Guru</button></a>
<a href="siswa.php"><button>Siswa</button></a>
<a href="jadwal.php"><button>Jadwal Bimbingan</button></a>
<a href="materi.php"><button>Materi Pelajaran</button></a>
<a href="pesan.php"><button>Komunikasi Pesan</button></a>
<a href="dashboard_statistik.php"><button>Dashboard Statistik</button></a>
<a href="laporan.php"><button>Laporan</button></a>

<h2>List Siswa</h2>

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
