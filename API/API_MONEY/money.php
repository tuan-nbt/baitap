<?php
// Include the language handler from API.php
include '../language_handler.php';

// Handle language selection
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$text = $lang === 'vi' ? [
    'Ride' => 'Đi xe',
    'Drive' => 'Lái xe',
    'Business' => 'Kinh doanh',
    'Help' => 'Trợ giúp',
    'signup' => 'Đăng ký',
    'login' => 'Đăng nhập',
    'price_details' => 'Chi tiết giá',
    'pickup' => 'Địa điểm đón',
    'dropoff' => 'Địa điểm trả',
    'distance' => 'Khoảng cách',
    'total_price' => 'Tổng giá',
    'route_map' => 'Bản đồ tuyến đường',
] : [
    'Ride' => 'Ride',
    'Drive' => 'Drive',
    'Business' => 'Business',
    'Help' => 'Help',
    'signup' => 'Sign Up',
    'login' => 'Log In',
    'price_details' => 'Price Details',
    'pickup' => 'Pickup Location',
    'dropoff' => 'Dropoff Location',
    'distance' => 'Distance',
    'total_price' => 'Total Price',
    'route_map' => 'Route Map',
];

// Get pickup and dropoff locations
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';

// Simulate distance calculation (in km) and pricing
$distance = rand(5, 50); // Random distance for demonstration
$price_per_km = 2; // Example price per km
$total_price = $distance * $price_per_km;
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $text['price_details']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=UberMove:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_ACTUAL_API_KEY&callback=loadMap" async defer></script>
    <script src="../API_MAP/map.js"></script>
    <style>
        body {
            font-family: 'UberMove', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        #map {
            height: 400px;
            width: 100%;
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
                    <a href="../API.php" class="hover:opacity-80"><?php echo $text['Ride']; ?></a>
                    <a href="../API_R1/ac.php" class="hover:opacity-80"><?php echo $text['Drive']; ?></a>
                    <a href="../API_R1/business.php" class="hover:opacity-80"><?php echo $text['Business']; ?></a>
                    <a href="../API_R1/help.php" class="hover:opacity-80"><?php echo $text['Help']; ?></a>
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
        <div class="container mx-auto px-4 py-16">
            <h1 class="text-5xl font-bold mb-6 text-center text-gray-800"><?php echo $text['price_details']; ?></h1>
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-2xl font-semibold mb-4"><?php echo $text['pickup']; ?></h2>
                        <p class="text-lg bg-white text-gray-800 rounded-lg p-4 shadow-md">
                            <strong><?php echo $pickup; ?></strong>
                        </p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold mb-4"><?php echo $text['dropoff']; ?></h2>
                        <p class="text-lg bg-white text-gray-800 rounded-lg p-4 shadow-md">
                            <strong><?php echo $dropoff; ?></strong>
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4"><?php echo $text['distance']; ?></h2>
                        <p class="text-3xl font-bold bg-white text-gray-800 rounded-lg p-4 shadow-md">
                            <?php echo $distance; ?> km
                        </p>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4"><?php echo $text['total_price']; ?></h2>
                        <p class="text-3xl font-bold bg-white text-gray-800 rounded-lg p-4 shadow-md">
                            $<?php echo $total_price; ?>
                        </p>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4">Estimated Time</h2>
                        <p class="text-3xl font-bold bg-white text-gray-800 rounded-lg p-4 shadow-md">
                            <?php echo rand(10, 60); ?> mins
                        </p>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-bold mt-12 mb-4 text-center text-gray-800"><?php echo $text['route_map']; ?></h2>
            <div id="map" class="rounded-lg shadow-lg border border-gray-300"></div>
        </div>
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

    <script src="../API_MAP/applications.html"></script>
    <script>
        function loadMap() {
            const pickup = "<?php echo $pickup; ?>";
            const dropoff = "<?php echo $dropoff; ?>";
            if (pickup && dropoff) {
                initMap(pickup, dropoff);
            } else {
                alert("Invalid pickup or dropoff location.");
            }
        }

        window.onload = loadMap;
    </script>
</body>
</html>
