<?php
// Display status messages
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<div class="alert alert-success">Message sent successfully! Thank you for contacting us.</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert alert-danger">Failed to send message. Please try again later.</div>';
    } elseif ($_GET['status'] === 'validation_error') {
        echo '<div class="alert alert-warning">Please fill out all required fields correctly!</div>';
    }
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Validate fields
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?status=validation_error");
        exit;
    }

    // Email setup
    $to = "info@ecocaregh.com"; // Recipient email
    $subject = "New Contact Form Submission from $name";
    $body = "You have received a new message from your contact form:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n\n" .
            "Message:\n$message\n";

    $headers = "From: info@ecocaregh.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Attempt to send email
    if (mail($to, $subject, $body, $headers)) {
        header("Location: contact.php?status=success");
    } else {
        header("Location: contact.php?status=error");
    }
}
?>
