<?php
// Kiểm tra và bao gồm file language_handler.php
$language_handler_path = realpath(__DIR__ . '/../language_handler.php');
if ($language_handler_path && file_exists($language_handler_path)) {
    include $language_handler_path;
} else {
    die("Error: language_handler.php not found.");
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Tên người dùng mặc định cho XAMPP
$password = ""; // Mật khẩu mặc định cho XAMPP
$dbname = "uber_clone"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đảm bảo biến $lang được khởi tạo đúng
$lang = $_GET['lang'] ?? 'en'; // Mặc định là 'en' nếu không có tham số 'lang'

// Khởi tạo mảng $text dựa trên ngôn ngữ
if ($lang === 'vi') {
    $text = [
        'login_title' => 'Đăng nhập vào tài khoản của bạn',
        'login_subtitle' => 'Chào mừng trở lại! Vui lòng đăng nhập để tiếp tục.',
        'login_button' => 'Đăng nhập',
        'forgot_password' => 'Quên mật khẩu?',
        'ride' => 'Đi xe',
        'drive' => 'Lái xe',
        'business' => 'Kinh doanh',
        'help' => 'Trợ giúp',
        'signup_prompt' => 'Chưa có tài khoản? Đăng ký ngay!',
        'signup_button' => 'Đăng ký',
        'error_message' => 'Đã xảy ra lỗi. Vui lòng thử lại.',
        'success_message' => 'Đăng nhập thành công!',
        'footer_note' => 'Bản quyền thuộc về.',
        'username' => 'Tên đăng nhập',
        'password' => 'Mật khẩu',
        'company' => 'Công ty',
        'about_us' => 'Về chúng tôi',
        'offerings' => 'Dịch vụ',
        'newsroom' => 'Tin tức',
        'careers' => 'Tuyển dụng',
    ];
} else {
    $text = [
        'login_title' => 'Login to Your Account',
        'login_subtitle' => 'Welcome back! Please login to continue.',
        'login_button' => 'Login',
        'forgot_password' => 'Forgot Password?',
        'ride' => 'Ride',
        'drive' => 'Drive',
        'business' => 'Business',
        'help' => 'Help',
        'signup_prompt' => 'Don\'t have an account? Sign up!',
        'signup_button' => 'Sign Up',
        'error_message' => 'An error occurred. Please try again.',
        'success_message' => 'Login successful!',
        'footer_note' => 'All rights reserved.',
        'username' => 'Username',
        'password' => 'Password',
        'company' => 'Company',
        'about_us' => 'About Us',
        'offerings' => 'Our Offerings',
        'newsroom' => 'Newsroom',
        'careers' => 'Careers',
    ];
}

// Xử lý đăng nhập
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_logged_in'] = true; // Set login status
            header("Location: ../API_OK.php"); // Redirect to API_OK.php
            exit();
        } else {
            $error = $text['error_message'];
        }
    } else {
        $error = $text['error_message'];
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $text['login_title']; ?></title>
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
                    <a href="../API.php" class="hover:opacity-80"><?php echo $text['ride']; ?></a>
                    <a href="../API_R1/ac.php" class="hover:opacity-80"><?php echo $text['drive']; ?></a>
                    <a href="#" class="hover:opacity-80"><?php echo $text['business']; ?></a>
                    <a href="#" class="hover:opacity-80"><?php echo $text['help']; ?></a>
                </nav>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=en">EN</a>
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=vi">VI</a>
                    <a href="signup.php" class="px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"><?php echo $text['signup_button']; ?></a>
                    <a href="login.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded"><?php echo $text['login_button']; ?></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <section class="container mx-auto px-4 py-16">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-center"><?php echo $text['login_button']; ?></h1>
                <?php if ($error): ?>
                    <p class="text-red-500 text-center mb-4"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="username"><?php echo $text['username']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="username" id="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="password"><?php echo $text['password']; ?></label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="password" name="password" id="password" required>
                    </div>
                    <button class="bg-black text-white px-4 py-2 rounded-lg w-full hover:bg-gray-800" type="submit"><?php echo $text['login_button']; ?></button>
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