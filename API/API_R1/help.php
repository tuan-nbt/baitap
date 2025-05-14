<?php
// Correct the path to the language handler file
$language_handler_path = realpath(__DIR__ . '/../language_handler.php');
if ($language_handler_path && file_exists($language_handler_path)) {
    include $language_handler_path;
} else {
    die("Error: language_handler.php not found.");
}

// Ensure the $lang variable is initialized correctly
$lang = isset($lang) ? $lang : 'en'; // Default to 'en' if $lang is not set

// Ensure required keys exist in the $text array
$text = isset($text) ? array_merge([
    'help_title' => $lang === 'vi' ? 'Trợ giúp' : 'Help',
    'ride' => $lang === 'vi' ? 'Đi xe' : 'Ride',
    'drive' => $lang === 'vi' ? 'Lái xe' : 'Drive',
    'business' => $lang === 'vi' ? 'Kinh doanh' : 'Business',
    'help' => $lang === 'vi' ? 'Trợ giúp' : 'Help',
    'signup' => $lang === 'vi' ? 'Đăng ký' : 'Sign Up',
    'login' => $lang === 'vi' ? 'Đăng nhập' : 'Log In',
    'help_hero_title' => $lang === 'vi' ? 'Chào mừng đến với trang trợ giúp' : 'Welcome to the Help Page',
    'help_hero_subtitle' => $lang === 'vi' ? 'Chúng tôi ở đây để giúp bạn.' : 'We are here to assist you.',
    'faq_title' => $lang === 'vi' ? 'Câu hỏi thường gặp' : 'Frequently Asked Questions',
    'no_faqs' => $lang === 'vi' ? 'Không có câu hỏi nào.' : 'No FAQs available.',
    'contact_title' => $lang === 'vi' ? 'Liên hệ với chúng tôi' : 'Contact Us',
    'contact_description' => $lang === 'vi' ? 'Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.' : 'If you have any questions, feel free to contact us.',
    'contact_us' => $lang === 'vi' ? 'Liên hệ' : 'Contact Us',
    'company' => $lang === 'vi' ? 'Công ty' : 'Company',
    'about_us' => $lang === 'vi' ? 'Về chúng tôi' : 'About Us',
    'offerings' => $lang === 'vi' ? 'Dịch vụ của chúng tôi' : 'Our Offerings',
    'newsroom' => $lang === 'vi' ? 'Phòng tin tức' : 'Newsroom',
    'careers' => $lang === 'vi' ? 'Nghề nghiệp' : 'Careers',
    'footer_note' => $lang === 'vi' ? 'Tất cả các quyền được bảo lưu.' : 'All rights reserved.',
], $text) : die("Error: Language translations not initialized.");

// Assign values from $text to individual variables
$ride = $text['ride'];
$drive = $text['drive'];
$business = $text['business'];
$help = $text['help'];
$signup = $text['signup'];
$login = $text['login'];
$help_hero_title = $text['help_hero_title'];
$help_hero_subtitle = $text['help_hero_subtitle'];
$faq_title = $text['faq_title'];
$no_faqs = $text['no_faqs'];
$contact_title = $text['contact_title'];
$contact_description = $text['contact_description'];
$contact_us = $text['contact_us'];
$company = $text['company'];
$about_us = $text['about_us'];
$offerings = $text['offerings'];
$newsroom = $text['newsroom'];
$careers = $text['careers'];
$footer_note = $text['footer_note'];

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
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $text['help_title']; ?></title>
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
                    <a href="../API.php" class="hover:opacity-80"><?php echo $ride; ?></a>
                    <a href="ac.php" class="hover:opacity-80"><?php echo $drive; ?></a>
                    <a href="business.php" class="hover:opacity-80"><?php echo $business; ?></a>
                    <a href="help.php" class="hover:opacity-80"><?php echo $help; ?></a>
                </nav>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=en">EN</a>
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=vi">VI</a>
                    <a href="../account/signup.php" class="px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"><?php echo $signup; ?></a>
                    <a href="../account/login.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded"><?php echo $login; ?></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-5xl font-bold mb-6"><?php echo $help_hero_title; ?></h1>
            <p class="text-xl mb-12"><?php echo $help_hero_subtitle; ?></p>
        </section>

        <!-- FAQ Section -->
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center"><?php echo $faq_title; ?></h2>
                <div class="space-y-6">
                    <?php
                    // Fetch FAQs from the database
                    $sql = "SELECT question, answer FROM faqs";
                    $result = $conn->query($sql);

                    // Kiểm tra trước khi sử dụng thuộc tính num_rows
                    if (isset($result) && $result !== false && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="bg-white p-6 rounded-lg shadow-sm">';
                            echo '<h3 class="text-xl font-bold mb-2">' . $row['question'] . '</h3>';
                            echo '<p class="text-gray-600">' . $row['answer'] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center text-gray-600">' . $no_faqs . '</p>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4"><?php echo $contact_title; ?></h2>
                <p class="text-gray-600 mb-6"><?php echo $contact_description; ?></p>
                <a href="mailto:support@lhc.com" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800"><?php echo $contact_us; ?></a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold mb-4"><?php echo $company; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $about_us; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $offerings; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $newsroom; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $careers; ?></a></li>
                    </ul>
                </div>
                <!-- Add other footer sections as needed -->
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-400">
                        © 2025 LHC Technologies Inc. <?php echo $footer_note; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- filepath: c:\xampp\htdocs\API\index.html -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="API/optimize.js"></script>
</body>
</html>
