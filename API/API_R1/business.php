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
    'business_title' => $lang === 'vi' ? 'Kinh doanh với LHC' : 'Business with LHC',
    'business_hero_title' => $lang === 'vi' ? 'Giải pháp kinh doanh của bạn' : 'Your Business Solution',
    'business_hero_subtitle' => $lang === 'vi' ? 'Khám phá các giải pháp của chúng tôi để phát triển doanh nghiệp của bạn.' : 'Explore our solutions to grow your business.',
    'learn_more' => $lang === 'vi' ? 'Tìm hiểu thêm' : 'Learn More',
    'business_solutions_title' => $lang === 'vi' ? 'Các giải pháp kinh doanh' : 'Business Solutions',
    'solution_1_title' => $lang === 'vi' ? 'Giải pháp 1' : 'Solution 1',
    'solution_1_description' => $lang === 'vi' ? 'Mô tả giải pháp 1.' : 'Description of Solution 1.',
    'solution_2_title' => $lang === 'vi' ? 'Giải pháp 2' : 'Solution 2',
    'solution_2_description' => $lang === 'vi' ? 'Mô tả giải pháp 2.' : 'Description of Solution 2.',
    'solution_3_title' => $lang === 'vi' ? 'Giải pháp 3' : 'Solution 3',
    'solution_3_description' => $lang === 'vi' ? 'Mô tả giải pháp 3.' : 'Description of Solution 3.',
    'cta_title' => $lang === 'vi' ? 'Bắt đầu ngay hôm nay' : 'Get Started Today',
    'cta_description' => $lang === 'vi' ? 'Tham gia cùng chúng tôi để phát triển doanh nghiệp của bạn.' : 'Join us to grow your business.',
    'get_started' => $lang === 'vi' ? 'Bắt đầu' : 'Get Started',
    'ride' => $lang === 'vi' ? 'Đi xe' : 'Ride',
    'drive' => $lang === 'vi' ? 'Lái xe' : 'Drive',
    'business' => $lang === 'vi' ? 'Kinh doanh' : 'Business',
    'help' => $lang === 'vi' ? 'Trợ giúp' : 'Help',
    'signup' => $lang === 'vi' ? 'Đăng ký' : 'Sign Up',
    'login' => $lang === 'vi' ? 'Đăng nhập' : 'Log In',
], $text) : die("Error: Language translations not initialized.");

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "uber_clone"; // Replace with your database name

// Create connection
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
    <title><?php echo $text['business_title']; ?></title>
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
                    <a href="ac.php" class="hover:opacity-80"><?php echo $text['drive']; ?></a>
                    <a href="business.php" class="hover:opacity-80"><?php echo $text['business']; ?></a>
                    <a href="help.php" class="hover:opacity-80"><?php echo $text['help']; ?></a>
                </nav>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=en">EN</a>
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=vi">VI</a>
                    <a href="../account/signup.php" class="px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"><?php echo $text['signup']; ?></a>
                    <a href="../account/login.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded"><?php echo $text['login']; ?></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-5xl font-bold mb-6"><?php echo $text['business_hero_title']; ?></h1>
            <p class="text-xl mb-12"><?php echo $text['business_hero_subtitle']; ?></p>
            <a href="#solutions" class="bg-black text-white px-8 py-3 rounded-lg hover:bg-gray-800"><?php echo $text['learn_more']; ?></a>
        </section>

        <!-- Solutions Section -->
        <section id="solutions" class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center"><?php echo $text['business_solutions_title']; ?></h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Solution Card 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-bold mb-4"><?php echo $text['solution_1_title']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo $text['solution_1_description']; ?></p>
                        <a href="#" class="text-black font-medium hover:opacity-80">
                            <?php echo $text['learn_more']; ?> <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <!-- Solution Card 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-bold mb-4"><?php echo $text['solution_2_title']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo $text['solution_2_description']; ?></p>
                        <a href="#" class="text-black font-medium hover:opacity-80">
                            <?php echo $text['learn_more']; ?> <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <!-- Solution Card 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-bold mb-4"><?php echo $text['solution_3_title']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo $text['solution_3_description']; ?></p>
                        <a href="#" class="text-black font-medium hover:opacity-80">
                            <?php echo $text['learn_more']; ?> <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4"><?php echo $text['cta_title']; ?></h2>
                <p class="text-gray-600 mb-6"><?php echo $text['cta_description']; ?></p>
                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800"><?php echo $text['get_started']; ?></a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold mb-4"><?php echo $lang === 'vi' ? 'Công ty' : 'Company'; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Về chúng tôi' : 'About us'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Dịch vụ của chúng tôi' : 'Our offerings'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Phòng tin tức' : 'Newsroom'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Nhà đầu tư' : 'Investors'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Blog' : 'Blog'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Nghề nghiệp' : 'Careers'; ?></a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4"><?php echo $lang === 'vi' ? 'Sản phẩm' : 'Products'; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Đi xe' : 'Ride'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Lái xe' : 'Drive'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Giao hàng' : 'Deliver'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'LHC cho doanh nghiệp' : 'LHC for Business'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'LHC vận tải' : 'LHC Freight'; ?></a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4"><?php echo $lang === 'vi' ? 'Công dân toàn cầu' : 'Global citizenship'; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'An toàn' : 'Safety'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Đa dạng và hòa nhập' : 'Diversity and Inclusion'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Bền vững' : 'Sustainability'; ?></a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4"><?php echo $lang === 'vi' ? 'Du lịch' : 'Travel'; ?></h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Sân bay' : 'Airports'; ?></a></li>
                        <li><a href="#" class="hover:opacity-80"><?php echo $lang === 'vi' ? 'Thành phố' : 'Cities'; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex space-x-6 mb-4 md:mb-0">
                        <a href="#" class="hover:opacity-80"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:opacity-80"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-sm text-gray-400">
                        <?php echo $lang === 'vi' ? '© 2025 Công nghệ LHC Inc. Mọi quyền được bảo lưu.' : '© 2025 LHC Technologies Inc. All rights reserved.'; ?>
                    </div>
                </div>
            </div>  
        </div>
    </footer>
</body>
</html>
