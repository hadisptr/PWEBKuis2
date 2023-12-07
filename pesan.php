<?php
// Include database connection
include 'dbConnection.php';

// Fetch data from Komunikasi_Pesan table
$query = "SELECT ID_Pesan, ID_Sender, ID_Receiver, Isi_Pesan, Waktu_Kirim, Status_Pesan FROM Komunikasi_Pesan";
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
    <title>PESAN</title>
</head>
<body>
    <h2>Pesan</h2>

    <!-- Button to add a new message -->
    <a href="index.php"><button>Homepage</button></a>
    <a href="addPesan.php"><button>Tambah Pesan</button></a>

    <!-- Display the list of messages -->
    <table border="1">
        <tr>
            <th>ID Message</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Message Content</th>
            <th>Send Time</th>
        </tr>

        <?php
        // Check if there are rows in the result set
        if (mysqli_num_rows($result) > 0) {
            // Loop through the result set and display data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . (isset($row['ID_Pesan']) ? $row['ID_Pesan'] : '') . "</td>";

                // Display sender name
                $senderId = isset($row['ID_Sender']) ? $row['ID_Sender'] : '';
                $senderName = ($senderId != '') ? getUserName($mysqli, $senderId, 'Guru') : '';
                echo "<td>{$senderName}</td>";

                // Display receiver name
                $receiverId = isset($row['ID_Receiver']) ? $row['ID_Receiver'] : '';
                $receiverName = ($receiverId != '') ? getUserName($mysqli, $receiverId, 'Siswa') : '';
                echo "<td>{$receiverName}</td>";

                echo "<td>" . (isset($row['Isi_Pesan']) ? $row['Isi_Pesan'] : '') . "</td>";
                echo "<td>" . (isset($row['Waktu_Kirim']) ? $row['Waktu_Kirim'] : '') . "</td>";
                echo "</tr>";
            }
        } else {
            // Display a message when there are no rows
            echo "<tr><td colspan='6'>No messages found</td></tr>";
        }
        ?>
    </table>

    <script>
        // JavaScript function to delete a message
        function deletePesan(pesanId) {
            var confirmation = confirm("Are you sure you want to delete this message?");
            
            if (confirmation) {
                // Redirect to delete_pesan.php with the message ID to perform deletion
                window.location.href = "delete_pesan.php?id=" + pesanId;
            }
        }
    </script>

</body>
</html>

<?php
// Function to get user name by user ID and user type (Guru or Siswa)
function getUserName($mysqli, $userId, $userType) {
    $columnName = ($userType == 'Guru') ? 'Nama_Guru' : 'Nama';
    $query = "SELECT $columnName FROM $userType WHERE ID_$userType = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($mysqli));
    }

    $userName = mysqli_fetch_assoc($result)[$columnName];
    return $userName;
}
?>
