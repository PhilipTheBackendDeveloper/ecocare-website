<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $service_type = htmlspecialchars($_POST['service_type']);
    $state = htmlspecialchars($_POST['state']);
    $location = htmlspecialchars($_POST['location']);
    $appointment_time = htmlspecialchars($_POST['appointment_time']);
    $appointment_date = htmlspecialchars($_POST['appointment_date']);

    // Email configuration
    $to = "ecocaregh1on1@gmail.com";
    $subject = "New Appointment Booking";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    // Email body
    $message = "You have received a new appointment booking. Here are the details:\n\n";
    $message .= "Name: $name\n";
    $message .= "Phone: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Service Type: $service_type\n";
    $message .= "State: $state\n";
    $message .= "Location: $location\n";
    $message .= "Appointment Date: $appointment_date\n";
    $message .= "Appointment Time: $appointment_time\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you! Your appointment has been booked.";
    } else {
        echo "Sorry, there was an error processing your request. Please try again.";
    }
}
?>
