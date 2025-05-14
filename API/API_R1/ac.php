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
    'driver_registration' => $lang === 'vi' ? 'Đăng ký tài xế' : 'Driver Registration',
    'driver_registration_description' => $lang === 'vi' ? 'Vui lòng điền vào biểu mẫu bên dưới để đăng ký làm tài xế.' : 'Please fill out the form below to register as a driver.',
    'name_required' => 'Name is required.',
    'invalid_email' => 'Invalid email address.',
    'invalid_phone' => 'Invalid phone number.',
    'vehicle_type_required' => 'Vehicle type is required.',
    'license_plate_required' => 'License plate is required.',
    'address_required' => 'Address is required.',
    'dob_required' => 'Date of birth is required (format: mm/dd/yyyy).',
    'invalid_experience' => 'Experience must be a non-negative number.',
    'driver_registered' => 'Driver successfully registered!',
    'error' => 'An error occurred',
    'address' => $lang === 'vi' ? 'Địa chỉ' : 'Address',
    'dob' => $lang === 'vi' ? 'Ngày sinh' : 'Date of Birth',
    'experience' => $lang === 'vi' ? 'Kinh nghiệm' : 'Experience',
    'ride' => $lang === 'vi' ? 'Đi xe' : 'Ride',
    'drive' => $lang === 'vi' ? 'Lái xe' : 'Drive',
    'business' => $lang === 'vi' ? 'Kinh doanh' : 'Business',
    'help' => $lang === 'vi' ? 'Trợ giúp' : 'Help',
    'login' => $lang === 'vi' ? 'Đăng nhập' : 'Log In',
    'signup' => $lang === 'vi' ? 'Đăng ký' : 'Sign Up',
    'register' => $lang === 'vi' ? 'Đăng ký' : 'Register',
    'vehicle_type' => $lang === 'vi' ? 'Loại xe' : 'Vehicle Type',
    'license_plate' => $lang === 'vi' ? 'Biển số xe' : 'License Plate',
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $vehicle_type = trim($_POST['vehicle_type']);
    $license_plate = trim($_POST['license_plate']);
    $address = trim($_POST['address']);
    $dob = trim($_POST['dob']);
    $experience = trim($_POST['experience']);

    $errors = [];

    if (empty($name)) {
        $errors[] = $text['name_required'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = $text['invalid_email'];
    }
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = $text['invalid_phone'];
    }
    if (empty($vehicle_type)) {
        $errors[] = $text['vehicle_type_required'];
    }
    if (empty($license_plate)) {
        $errors[] = $text['license_plate_required'];
    }
    if (empty($address)) {
        $errors[] = $text['address_required'];
    }
    if (empty($dob) || !preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/', $dob)) {
        $errors[] = $text['dob_required'];
    }
    if (!is_numeric($experience) || $experience < 0) {
        $errors[] = $text['invalid_experience'];
    }

    if (empty($errors)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO drivers (name, email, phone, vehicle_type, license_plate, address, dob, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $name, $email, $phone, $vehicle_type, $license_plate, $address, $dob, $experience);

        if ($stmt->execute()) {
            echo "<script>alert('" . $text['driver_registered'] . "');</script>";
        } else {
            echo "<script>alert('" . $text['error'] . ": " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<script>alert('" . $error . "');</script>";
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
    <title><?php echo $text['driver_registration']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=UberMove:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'UberMove', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
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
                    <a href="../account/login.php" class="px-4 py-2 text-sm font-medium hover:bg-gray-800 rounded"><?php echo $text['login']; ?></a>
                    <a href="../account/signup.php" class="px-4 py-2 text-sm font-medium bg-white text-black rounded"><?php echo $text['signup']; ?></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <section class="container mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold mb-6 text-center"><?php echo $text['driver_registration']; ?></h1>
            <p class="text-gray-600 mb-6 text-center"><?php echo $text['driver_registration_description']; ?></p>
            <form method="POST" action="" class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="name"><?php echo $text['name']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="name" id="name" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="email"><?php echo $text['email']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="email" name="email" id="email" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="phone"><?php echo $text['phone']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="phone" id="phone" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="vehicle_type"><?php echo $text['vehicle_type']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="vehicle_type" id="vehicle_type" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="license_plate"><?php echo $text['license_plate']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="license_plate" id="license_plate" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="address"><?php echo $text['address']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="text" name="address" id="address" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="dob"><?php echo $text['dob']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="date" name="dob" id="dob" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="experience"><?php echo $text['experience']; ?></label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-black" type="number" name="experience" id="experience" min="0" required>
                </div>
                <button class="bg-black text-white px-4 py-2 rounded-lg w-full hover:bg-gray-800" type="submit"><?php echo $text['register']; ?></button>
            </form>
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
<!-- ...existing code... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="API/optimize.js"></script>
<!-- ...existing code... -->
</body>
</html>