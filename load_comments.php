<?php

$servername = "localhost"; 
$username = "dgscin_therigvr"; 
$password = "Bd5D^6FRVe5Z"; 
$dbname = "dgscin_therig";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT comments FROM waitlist ORDER BY id DESC LIMIT 3");
$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row['comments'];
}

$conn->close();

echo json_encode(['comments' => $comments]);
?>
