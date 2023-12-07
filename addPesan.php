<?php
// Include database connection
include 'dbConnection.php';

// Fetch data for dropdowns (assuming you have a Siswa table)
$querySender = "SELECT ID_Guru, Nama_Guru FROM Guru";
$resultSender = mysqli_query($mysqli, $querySender);

$queryReceiver = "SELECT ID_Siswa, Nama FROM Siswa";
$resultReceiver = mysqli_query($mysqli, $queryReceiver);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idSender = $_POST['id_Guru'];
    $idReceiver = $_POST['id_Siswa'];
    $isiPesan = $_POST['isi_pesan'];

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO Komunikasi_Pesan (ID_Sender, ID_Receiver, Isi_Pesan, Waktu_Kirim, Status_Pesan) VALUES (?, ?, ?, NOW(), 'Unread')";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "iis", $idSender, $idReceiver, $isiPesan);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    // Redirect to the pesan.php page after sending a message
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

    <!-- Form to send a new message -->
    <form method="post" action="">
        <label>ID Sender (Guru):</label>
        <select name="id_Guru" required>
            <?php
            // Display options for Sender (Guru) dropdown
            while ($rowSender = mysqli_fetch_assoc($resultSender)) {
                echo "<option value='{$rowSender['ID_Guru']}'>{$rowSender['Nama_Guru']}</option>";
            }
            ?>
        </select><br>

        <label>ID Receiver (Siswa):</label>
        <select name="id_receiver" required>
            <?php
            // Display options for Receiver (Siswa) dropdown
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
