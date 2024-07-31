<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

    // connect to database
    $conn = new mysqli('localhost', 'dgscin_therigvr', 'Bd5D^6FRVe5Z', 'dgscin_therig');
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
    }

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT COUNT(*) FROM waitlist WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => 'This email is already registered.']);
        $conn->close();
        exit();
    }

    // Send email
    $to = $email;
    $subject = "Thank you for joining the waitlist!";
    $message = "Hi $name, thank you for joining our waitlist. We will keep you updated.";
    $headers = "From: no-reply@therigvrarcade.com";

    mail($to, $subject, $message, $headers);

    // Save to database
    $stmt = $conn->prepare("INSERT INTO waitlist (name, email, phone, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $comments);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true]);
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
  
}

?>
