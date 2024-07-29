<?php
$conn = new mysqli('localhost', 'dgscin_therigvr', 'Bd5D^6FRVe5Z', 'dgscin_therig');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT comments, name FROM waitlist ORDER BY id DESC LIMIT 3");
$comments = [];
while ($row = $result->fetch_assoc()) {
    // $comments[] = $row['name'];
    $comments[] = $row['comments'];
}

$conn->close();

echo json_encode(['comments' => $comments]);
?>
