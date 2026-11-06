<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: carpet-booking.html");
    exit;
}

// Sanitize input
$name = htmlspecialchars(trim($_POST["name"]));
$email = htmlspecialchars(trim($_POST["email"]));
$phone = htmlspecialchars(trim($_POST["phone"]));
$serviceType = htmlspecialchars(trim($_POST["serviceType"]));
$state = htmlspecialchars(trim($_POST["state"]));
$location = htmlspecialchars(trim($_POST["location"]));
$appointmentDate = htmlspecialchars(trim($_POST["appointmentDate"]));
$appointmentTime = htmlspecialchars(trim($_POST["appointmentTime"]));

// Validate required fields
if (empty($name) || empty($email) || empty($phone) || empty($serviceType) || empty($state) || empty($location) || empty($appointmentDate) || empty($appointmentTime)) {
    header("Location: carpet-booking.html?status=validation_error");
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: carpet-booking.html?status=invalid_email");
    exit;
}

// Validate phone
if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
    header("Location: carpet-booking.html?status=invalid_phone");
    exit;
}

// Email setup
$to = "info@ecocaregh.com";
$subject = "EcoCare Booking Form Submission";
$email_message = "You have received a new booking:\n\n";
$email_message .= "Name: $name\nEmail: $email\nPhone: $phone\n";
$email_message .= "Service Type: $serviceType\nState: $state\nLocation: $location\n";
$email_message .= "Appointment Date: $appointmentDate\nAppointment Time: $appointmentTime\n";

$headers = "From: info@ecocaregh.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $email_message, $headers)) {
    header("Location: carpet-booking.html?status=success");
} else {
    error_log("Failed to send booking email for: $name ($email)");
    header("Location: carpet-booking.html?status=error");
}
exit;
?>
