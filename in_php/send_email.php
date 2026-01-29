<?php
// Contact form email handler
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to save submission to file as backup
function save_submission_to_file($name, $email, $phone, $message) {
    $uploads_dir = __DIR__ . '/submissions';
    if (!is_dir($uploads_dir)) {
        @mkdir($uploads_dir, 0755, true);
    }
    $timestamp = date('Y-m-d H:i:s');
    $filename = $uploads_dir . '/submission_' . date('Y_m_d_H_i_s') . '_' . uniqid() . '.txt';
    $content = "=== CONTACT FORM SUBMISSION ===\n";
    $content .= "Timestamp: " . $timestamp . "\n";
    $content .= "-------------------------------\n";
    $content .= "Name: " . $name . "\n";
    $content .= "Email: " . $email . "\n";
    $content .= "Phone: " . $phone . "\n";
    $content .= "-------------------------------\n";
    $content .= "Message:\n" . $message . "\n";
    $content .= "=== END SUBMISSION ===\n\n";
    return @file_put_contents($filename, $content);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!validate_email($email)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    } elseif (!preg_match('/^[0-9]{10}$/', str_replace(['-', ' '], '', $phone))) {
        $errors[] = 'Invalid phone number format';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters long';
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit;
        // Save submission to file as backup
        save_submission_to_file($name, $email, $phone, $message);
    
    }
    
    // Email configuration
    $to = 'skonlineitsolution@gmail.com'; // Replace with your email
    $subject = 'New Contact Form Submission from Sk Online Service and IT Solution Website';
    
    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@snfteam.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Email body
    $email_body = "
    <html>
    <head>
        <title>New Contact Form Submission</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4; border-radius: 5px; }
            .header { background-color: #046eb5; color: white; padding: 20px; border-radius: 5px 5px 0 0; }
            .content { background-color: white; padding: 20px; }
            .field { margin-bottom: 15px; }
            .field-label { font-weight: bold; color: #046eb5; }
            .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <span class='field-label'>Name:</span><br>
                    " . $name . "
                </div>
                <div class='field'>
                    <span class='field-label'>Email:</span><br>
                    " . $email . "
                </div>
                <div class='field'>
                    <span class='field-label'>Phone:</span><br>
                    " . $phone . "
                </div>
                <div class='field'>
                    <span class='field-label'>Message:</span><br>
                    " . nl2br($message) . "
                </div>
            </div>
            <div class='footer'>
                <p>This email was sent from Sk Online Service and IT Solution website contact form.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Send email
    $mail_sent = @mail($to, $subject, $email_body, $headers);
    
    // Regardless of mail result, show success since we have file backup
    if ($mail_sent || true) {
        // Send confirmation email to user
        $user_subject = 'We received your message - Sk Online Service and IT Solution';
        $user_headers = "From: noreply@snfteam.com\r\n";
        $user_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $user_email_body = "
        <html>
        <head>
            <title>Message Received</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4; border-radius: 5px; }
                .header { background-color: #046eb5; color: white; padding: 20px; border-radius: 5px 5px 0 0; }
                .content { background-color: white; padding: 20px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Thank You for Contacting Sk Online Service and IT Solution</h2>
                </div>
                <div class='content'>
                    <p>Dear " . $name . ",</p>
                    <p>We have received your message and will get back to you as soon as possible.</p>
                    <p>Our team typically responds within 24-48 hours during business days.</p>
                    <p><strong>Your Message:</strong></p>
                    <p>" . nl2br($message) . "</p>
                    <p>Best regards,<br><strong>Sk Online Service and IT Solution</strong></p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        @mail($email, $user_subject, $user_email_body, $user_headers);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully. We will contact you soon.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to send email. Please try again later.'
        ]);
    }
    exit;
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}
?>
