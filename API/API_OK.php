<?php 
// Ensure session is started only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the language handler file
$language_handler_path = realpath(__DIR__ . '/language_handler.php');
if ($language_handler_path && file_exists($language_handler_path)) {
    include $language_handler_path;
} else {
    die("Error: language_handler.php not found.");
}

// Handle language selection
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
if ($lang === 'vi') {
    $text = [
        'title' => 'Chào mừng đến với LHC - ',
        'Ride' => 'Đi xe',
        'Drive' => 'Lái xe',
        'Business' => 'Kinh doanh',
        'Help' => 'Trợ giúp',
        'signup' => 'Đăng ký',
        'login' => 'Đăng nhập',
        'hero_title' => 'Hành trình của bạn bắt đầu từ đây',
        'hero_subtitle' => 'Đi xe hoặc lái xe để kiếm tiền với LHC.',
        'footer_note' => 'Tất cả các quyền được bảo lưu.',
    ];
} else {
    $text = [
        'title' => 'Welcome to LHC - ',
        'Ride' => 'Ride',
        'Drive' => 'Drive',
        'Business' => 'Business',
        'Help' => 'Help',
        'signup' => 'Sign Up',
        'login' => 'Log In',
        'hero_title' => 'Your Journey Starts Here',
        'hero_subtitle' => 'Get a ride or drive to earn money with LHC.',
        'footer_note' => 'All rights reserved.',
    ];
}

// Simulate user login status (replace this with actual session or authentication logic)
$is_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $text['title']; ?>Earn Money by Driving or Get a Ride Now | LHC</title>
    <link rel="icon" href="../../../opt/vscodium/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=UberMove:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <a href="#" class="hover:opacity-80"><?php echo $text['Ride']; ?></a>
                    <a href="API_R1/ac.php" class="hover:opacity-80"><?php echo $text['Drive']; ?></a>
                    <a href="API_R1/business.php" class="hover:opacity-80"><?php echo $text['Business']; ?></a>
                    <a href="API_R1/help.php" class="hover:opacity-80"><?php echo $text['Help']; ?></a>
                </nav>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=en">EN</a>
                    <a class="text-gray-600 hover:text-gray-800" href="?lang=vi">VI</a>
                    <?php if ($is_logged_in): ?>
                        <a href="account/logout.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded">
                            <?php echo $lang === 'vi' ? 'Đăng xuất' : 'Log Out'; ?>
                        </a>
                    <?php else: ?>
                        <a href="account/signup.php" class="px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded">
                            <?php echo $text['signup']; ?>
                        </a>
                        <a href="account/login.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded">
                            <?php echo $text['login']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <section class="container mx-auto px-4 py-16">
            <div class="max-w-2xl mx-auto text-center">
                <?php if ($is_logged_in): ?>
                    <h1 class="text-5xl font-bold mb-6"><?php echo $lang === 'vi' ? 'Chào mừng bạn đã đến với dịch vụ LHC' : 'Welcome to LHC Services'; ?></h1>
                <?php else: ?>
                    <h1 class="text-5xl font-bold mb-6"><?php echo $text['hero_title']; ?></h1>
                    <p class="text-xl mb-12"><?php echo $text['hero_subtitle']; ?></p>
                    
                    <!-- Search Form -->
                    <form action="API_MONEY/money.php" method="GET" class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <div class="relative">
                                    <i class="fas fa-circle text-gray-400 absolute left-3 top-3"></i>
                                    <input type="text" name="pickup" placeholder="Pickup location" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black" required>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="relative">
                                    <i class="fas fa-square text-gray-400 absolute left-3 top-3"></i>
                                    <input type="text" name="dropoff" placeholder="Dropoff location" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black" required>
                                </div>
                            </div>
                            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg hover:bg-gray-800">
                                See prices
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </section>
        <!-- Suggestions Section -->
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-8"><?php echo $lang === 'vi' ? 'Gợi ý' : 'Suggestions'; ?></h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Ride Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-2"><?php echo $lang === 'vi' ? 'Đi xe' : 'Ride'; ?></h3>
                                <p class="text-gray-600 mb-4">
                                    <?php echo $lang === 'vi' ? 'Đi bất cứ đâu với LHC. Yêu cầu một chuyến đi, lên xe và đi.' : 'Go anywhere with LHC. Request a ride, hop in, and go.'; ?>
                                </p>
                                <a href="#" class="text-black font-medium hover:opacity-80">
                                    <?php echo $lang === 'vi' ? 'Chi tiết' : 'Details'; ?> <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                            <img src="https://mobile-content.uber.com/launch-experience/ride.png" alt="Ride" class="w-24 h-24 object-contain">
                        </div>
                    </div>

                    <!-- Reserve Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-2"><?php echo $lang === 'vi' ? 'Đặt trước' : 'Reserve'; ?></h3>
                                <p class="text-gray-600 mb-4">
                                    <?php echo $lang === 'vi' ? 'Đặt trước chuyến đi của bạn để bạn có thể thư giãn vào ngày đi.' : 'Reserve your ride in advance so you can relax on the day of your trip.'; ?>
                                </p>
                                <a href="#" class="text-black font-medium hover:opacity-80">
                                    <?php echo $lang === 'vi' ? 'Chi tiết' : 'Details'; ?> <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                            <img src="https://mobile-content.uber.com/uber_reserve/reserve_clock.png" alt="Reserve" class="w-24 h-24 object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Drive Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold mb-4"><?php echo $lang === 'vi' ? 'Lái xe khi bạn muốn, kiếm tiền khi bạn cần' : 'Drive when you want, make what you need'; ?></h2>
                    <p class="text-gray-600 mb-6">
                        <?php echo $lang === 'vi' ? 'Kiếm tiền theo lịch trình của bạn với giao hàng hoặc chuyến đi — hoặc cả hai. Bạn có thể sử dụng xe của riêng mình hoặc chọn thuê xe qua LHC.' : 'Make money on your schedule with deliveries or rides—or both. You can use your own car or choose a rental through LHC.'; ?>
                    </p>
                    <button class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800">
                        <?php echo $lang === 'vi' ? 'Bắt đầu' : 'Get started'; ?>
                    </button>
                </div>
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
    <!-- filepath: c:\xampp\htdocs\API\index.html -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="API/optimize.js"></script>
</body>
</html>
x