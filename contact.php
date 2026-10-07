<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $phone = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $postcode = htmlspecialchars(trim($_POST["postcode"] ?? ""));
    $project_type = htmlspecialchars(trim($_POST["project_type"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    $to = "greenscapesuk@hotmail.com";
    $subject = "New Landscaping Enquiry from Greenscapes UK Website";

    $body = "
Name: $name
Phone: $phone
Email: $email
Postcode: $postcode
Project Type: $project_type

Message:
$message
";

    $headers = "From: Greenscapes UK <no-reply@greenscapesuk-essex.co.uk>\r\n";

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $headers .= "Reply-To: $email\r\n";
    }

    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your enquiry has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again.";
    }
}
?>