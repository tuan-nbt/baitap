<?php
// Ensure session is started only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define language translations
$translations = [
    'en' => [
        'signup_title' => 'Sign Up for an Account',
        'signup_subtitle' => 'Please fill out the form below to sign up.',
        'signup_button' => 'Sign Up',
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'address' => 'Address',
        'error_message' => 'An error occurred. Please try again.',
        'success_message' => 'Sign up successful!',
        'footer_note' => 'All rights reserved.',
        'login' => 'Login',
        'signup' => 'Sign Up',
        'company' => 'Company',
        'about_us' => 'About Us',
        'offerings' => 'Offerings',
        'newsroom' => 'Newsroom',
        'careers' => 'Careers',
        'username' => 'Username',
        'logout' => 'Logout',
    ],
    'vi' => [
        'signup_title' => 'Đăng ký tài khoản',
        'signup_subtitle' => 'Vui lòng điền thông tin bên dưới để đăng ký.',
        'signup_button' => 'Đăng ký',
        'name' => 'Tên',
        'email' => 'Email',
        'phone' => 'Số điện thoại',
        'password' => 'Mật khẩu',
        'confirm_password' => 'Xác nhận mật khẩu',
        'address' => 'Địa chỉ',
        'error_message' => 'Đã xảy ra lỗi. Vui lòng thử lại.',
        'success_message' => 'Đăng ký thành công!',
        'footer_note' => 'Bản quyền thuộc về.',
        'login' => 'Đăng nhập',
        'signup' => 'Đăng ký',
        'company' => 'Công ty',
        'about_us' => 'Về chúng tôi',
        'offerings' => 'Dịch vụ',
        'newsroom' => 'Tin tức',
        'careers' => 'Nghề nghiệp',
        'username' => 'Tên đăng nhập',
        'logout' => 'Đăng xuất',
    ],
];

// Function to get translations based on language
function getTranslations($lang) {
    global $translations;
    return $translations[$lang] ?? $translations['en'];
}

// Determine the language
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'en'; // Default language
}

// Debugging: Check if $lang is valid
if (!isset($translations[$lang])) {
    $lang = 'en'; // Fallback to default language
}

// Get translations
$text = getTranslations($lang);
?>