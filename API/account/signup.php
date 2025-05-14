<?php
// Include the language handler file
$language_handler_path = realpath(__DIR__ . '/../language_handler.php');
if ($language_handler_path && file_exists($language_handler_path)) {
    include $language_handler_path;
} else {
    die("Error: language_handler.php not found.");
}

// Ensure the $lang variable is initialized correctly
$lang = $_GET['lang'] ?? 'en'; // Default to 'en' if 'lang' parameter is not provided

// Get translations based on the selected language
$text = getTranslations($lang);

// Initialize variables to avoid warnings
$error = '';
$success = '';

// Start session and check login status
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user']); // Kiểm tra trạng thái đăng nhập

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "uber_clone"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate form inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = $text['error_message'];
    } elseif ($password !== $confirm_password) {
        $error = $text['error_message'];
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt) { // Check if the statement was prepared successfully
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = $text['success_message'];
            } else {
                $error = $text['error_message'] . ": " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Error preparing the statement: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $text['signup_title']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=UberMove:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'UberMove', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="fixed w-full bg-black text-white z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">LHC</div>
                <nav class="hidden md:flex space-x-6">
                    <?php if ($is_logged_in): ?>
                        <a href="logout.php" class="hover:opacity-80"><?php echo $text['logout']; ?></a>
                    <?php else: ?>
                        <a href="login.php" class="hover:opacity-80"><?php echo $text['login']; ?></a>
                        <a href="signup.php" class="hover:opacity-80"><?php echo $text['signup']; ?></a>
                    <?php endif; ?>
                </nav>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=en">EN</a>
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=vi">VI</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <section class="container mx-auto px-4 py-16">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-center"><?php echo $text['signup_title']; ?></h1>
                <p class="text-center mb-4"><?php echo $text['signup_subtitle']; ?></p>
                <?php if (!empty($error)): ?>
                    <p class="text-red-500 text-center mb-4"><?php echo $error; ?></p>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <p class="text-green-500 text-center mb-4"><?php echo $success; ?></p>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="username"><?php echo $text['username']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="username" id="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="email"><?php echo $text['email']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="email" name="email" id="email" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="password"><?php echo $text['password']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="password" name="password" id="password" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="confirm_password"><?php echo $text['confirm_password']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="password" name="confirm_password" id="confirm_password" required>
                    </div>
                    <button class="bg-black text-white px-4 py-2 rounded-lg w-full hover:bg-gray-800" type="submit"><?php echo $text['signup']; ?></button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold mb-4"><?php echo $text['company']; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $text['about_us']; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $text['offerings']; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $text['newsroom']; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $text['careers']; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-400">
                        © 2025 LHC Technologies Inc. <?php echo $text['footer_note']; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>