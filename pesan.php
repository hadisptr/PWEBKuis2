<?php
include 'dbConnection.php';

$query = "SELECT p.ID_Pesan, p.ID_Sender, p.ID_Receiver, p.Isi_Pesan, p.Waktu_Kirim, p.Status_Pesan, g.Nama_Guru, s.Nama
          FROM Komunikasi_Pesan p
          LEFT JOIN Guru g ON p.ID_Sender = g.ID_Guru
          LEFT JOIN Siswa s ON p.ID_Receiver = s.ID_Siswa OR p.ID_Receiver IS NULL";
$result = mysqli_query($mysqli, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESAN</title>
</head>
<body>
    <h2>Pesan</h2>

    <a href="index.php"><button>Homepage</button></a>
    <a href="addPesan.php"><button>Tambah Pesan</button></a>

    <table border="1">
        <tr>
            <th>ID Message</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Message Content</th>
            <th>Send Time</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['ID_Pesan']}</td>";
                echo "<td>{$row['Nama_Guru']}</td>";
                echo "<td>{$row['Nama']}</td>";
                echo "<td>{$row['Isi_Pesan']}</td>";
                echo "<td>{$row['Waktu_Kirim']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No messages found</td></tr>";
        }
        ?>
    </table>

    <script>
        function deletePesan(pesanId) {
            var confirmation = confirm("Are you sure you want to delete this message?");
            
            if (confirmation) {
                window.location.href = "delete_pesan.php?id=" + pesanId;
            }
        }
    </script>
</body>
</html>
