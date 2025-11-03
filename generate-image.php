<?php
require_once 'config.php';
require_once 'api/FreepikAPI.php';

$pageTitle = 'AI Image Generator';

$generatedImage = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prompt = $_POST['prompt'] ?? '';
    $accessoryType = $_POST['accessory_type'] ?? '';

    $freepik = new FreepikAPI(FREEPIK_API_KEY, FREEPIK_API_URL);

    if (!empty($accessoryType)) {
        $result = $freepik->generateAccessoryImage($accessoryType);
    } elseif (!empty($prompt)) {
        $result = $freepik->generateImage($prompt);
    } else {
        $error = 'Please provide a prompt or select an accessory type.';
    }

    if (isset($result['error'])) {
        $error = 'Error: ' . ($result['message'] ?? 'Unknown error') .
                 ' (HTTP ' . ($result['http_code'] ?? 'N/A') . ')';
    } else {
        $generatedImage = $result;
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>AI Image Generator</h1>
        <p>Powered by Freepik AI</p>
    </div>
</section>

<section class="generator-section">
    <div class="container">
        <div class="generator-content">
            <div class="generator-form">
                <h2>Generate Product Images</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="accessory_type">Quick Generate (Accessory Type)</label>
                        <select id="accessory_type" name="accessory_type">
                            <option value="">-- Select Type --</option>
                            <option value="grinder">Grinder</option>
                            <option value="tray">Rolling Tray</option>
                            <option value="storage">Storage Container</option>
                            <option value="rolling_papers">Rolling Papers</option>
                            <option value="lighter">Lighter</option>
                            <option value="pipe">Pipe</option>
                        </select>
                    </div>

                    <div class="form-divider">OR</div>

                    <div class="form-group">
                        <label for="prompt">Custom Prompt</label>
                        <textarea id="prompt" name="prompt" rows="4"
                                  placeholder="Describe the image you want to generate..."><?php echo htmlspecialchars($_POST['prompt'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Generate Image</button>
                </form>
            </div>

            <div class="generator-result">
                <h2>Result</h2>
                <?php if ($error): ?>
                    <div class="error-message">
                        <p><?php echo htmlspecialchars($error); ?></p>
                    </div>
                <?php elseif ($generatedImage): ?>
                    <div class="generated-image">
                        <h3>Generated Image Data:</h3>
                        <pre><?php echo json_encode($generatedImage, JSON_PRETTY_PRINT); ?></pre>
                        <p class="note">Note: The actual image URL will be in the response data above.</p>
                    </div>
                <?php else: ?>
                    <p class="placeholder-text">Your generated image will appear here</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
