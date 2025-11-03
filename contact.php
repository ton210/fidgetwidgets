<?php
require_once 'config.php';
$pageTitle = 'Contact Us';

$messageSent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // In production, send email here
        // For now, just set success message
        $messageSent = true;
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you</p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                <p>Have questions about our products? Want to share feedback? We're here to help!</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <h3>Email</h3>
                        <p><a href="mailto:info@fidget-widgets.com">info@fidget-widgets.com</a></p>
                    </div>
                    <div class="contact-item">
                        <h3>Phone</h3>
                        <p><a href="tel:+15551234567">+1 (555) 123-4567</a></p>
                    </div>
                    <div class="contact-item">
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9am - 6pm EST<br>
                        Saturday: 10am - 4pm EST<br>
                        Sunday: Closed</p>
                    </div>
                </div>
            </div>

            <div class="contact-form-container">
                <?php if ($messageSent): ?>
                    <div class="success-message">
                        <h3>Thank you for contacting us!</h3>
                        <p>We've received your message and will get back to you within 24 hours.</p>
                    </div>
                <?php else: ?>
                    <?php if ($error): ?>
                        <div class="error-message">
                            <p><?php echo $error; ?></p>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="POST" action="">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required
                                   value="<?php echo $_POST['name'] ?? ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required
                                   value="<?php echo $_POST['email'] ?? ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject"
                                   value="<?php echo $_POST['subject'] ?? ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="5" required><?php echo $_POST['message'] ?? ''; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
