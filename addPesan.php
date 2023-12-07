<?php
include 'dbConnection.php';

// Fetch data for dropdowns
$querySender = "SELECT ID_Guru, Nama_Guru FROM Guru";
$resultSender = mysqli_query($mysqli, $querySender);

$queryReceiver = "SELECT ID_Siswa, Nama FROM Siswa";
$resultReceiver = mysqli_query($mysqli, $queryReceiver);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSender = $_POST['id_Guru'];
    $idReceiver = $_POST['id_Siswa'];
    $isiPesan = $_POST['isi_pesan'];

    $query = "INSERT INTO Komunikasi_Pesan (ID_Sender, ID_Receiver, Isi_Pesan, Waktu_Kirim, Status_Pesan) VALUES (?, ?, ?, NOW(), 'Unread')";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "iis", $idSender, $idReceiver, $isiPesan);

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    header("Location: pesan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pesan</title>
</head>
<body>
    <h2>Kirim Pesan</h2>

    <a href="index.php"><button>Homepage</button></a>

    <form method="post" action="">
        <label>ID Sender (Guru):</label>
        <select name="id_Guru" required>
            <?php
            while ($rowSender = mysqli_fetch_assoc($resultSender)) {
                echo "<option value='{$rowSender['ID_Guru']}'>{$rowSender['Nama_Guru']}</option>";
            }
            ?>
        </select><br>

        <label>ID Receiver (Siswa):</label>
        <select name="id_Siswa" required>
            <?php
            while ($rowReceiver = mysqli_fetch_assoc($resultReceiver)) {
                echo "<option value='{$rowReceiver['ID_Siswa']}'>{$rowReceiver['Nama']}</option>";
            }
            ?>
        </select><br>

        <label>Message Content:</label>
        <textarea name="isi_pesan" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Kirim Pesan">
    </form>
</body>
</html>
