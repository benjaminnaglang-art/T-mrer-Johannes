<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- CONFIGURATION ---
    $to = "post@tomrer-johannes.dk"; // Your email address
    $subject = "New Inquiry from Tømrermester Johannes Website";
    
    // Clean and sanitize the input to prevent spam/hacking
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = strip_tags(trim($_POST["message"]));

    // Basic validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill out all required fields correctly.";
        exit;
    }

    // Create the email body
    $email_content = "You have received a new message from your website:\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

    // Set the email headers
    // Note: We use your own email as the 'From' to avoid Simply.com's spam filters
    $headers = "From: post@tomrer-johannes.dk\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect back to the home page with a success message in the URL
        header("Location: index.html?status=success");
        exit;
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // If someone tries to access contact.php directly, send them back home
    header("Location: index.html");
    exit;
}
?>
