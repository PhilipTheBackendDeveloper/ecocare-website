<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $serviceType = htmlspecialchars(trim($_POST["serviceType"]));
    $serviceMode = htmlspecialchars(trim($_POST["serviceMode"]));
    $location = htmlspecialchars(trim($_POST["location"]));
    $appointmentDate = htmlspecialchars(trim($_POST["appointmentDate"]));
    $appointmentTime = htmlspecialchars(trim($_POST["appointmentTime"]));

    // Validation
    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email address is required.";
    if (empty($phone) || !preg_match("/^\d{10}$/", $phone)) $errors[] = "A valid phone number (10 digits) is required.";
    if (empty($serviceType)) $errors[] = "Service type is required.";
    if (empty($serviceMode)) $errors[] = "Mode of service is required.";
    if (empty($location)) $errors[] = "Location is required.";
    if (empty($appointmentDate)) $errors[] = "Appointment date is required.";
    if (empty($appointmentTime)) $errors[] = "Appointment time is required.";

    // Display errors if validation fails
    if ($errors) {
        echo "<div style='color: red;'><strong>Oops! The following errors occurred:</strong><br>";
        foreach ($errors as $error) {
            echo "- " . htmlspecialchars($error) . "<br>";
        }
        echo "</div>";
        exit;
    }

    // Prepare email
    $to = "ecocaregh1on1@gmail.com";
    $subject = "Ecocare Fumigation Booking";
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Phone: $phone\n";
    $email_message .= "Service Type: $serviceType\n";
    $email_message .= "Mode of Service: $serviceMode\n";
    $email_message .= "Location: $location\n";
    $email_message .= "Appointment Date: $appointmentDate\n";
    $email_message .= "Appointment Time: $appointmentTime\n";
    $headers = "From: info@ecocaregh.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "<div style='color: green;'>Thank you for your booking! We will contact you soon.</div>";
    } else {
        echo "<div style='color: red;'>Oops! Something went wrong. Please try again later.</div>";
    }
} else {
    echo "<div style='color: red;'>Invalid request.</div>";
}
?>
