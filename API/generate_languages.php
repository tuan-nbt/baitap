<?php
$languages = [
    'en' => 'English',
    'fr' => 'French',
    'es' => 'Spanish',
    'de' => 'German',
    'it' => 'Italian',
    'pt' => 'Portuguese',
    'zh' => 'Chinese',
    'ja' => 'Japanese',
    'ko' => 'Korean',
    'ar' => 'Arabic',
    'ru' => 'Russian',
    'hi' => 'Hindi',
    'bn' => 'Bengali',
    'pa' => 'Punjabi',
    'ur' => 'Urdu',
    'vi' => 'Vietnamese',
    'th' => 'Thai',
    'ms' => 'Malay',
    'id' => 'Indonesian',
    'tr' => 'Turkish',
    'fa' => 'Persian',
    'sw' => 'Swahili',
    'ha' => 'Hausa',
    'am' => 'Amharic',
    'yo' => 'Yoruba',
    'ig' => 'Igbo',
    'zu' => 'Zulu',
    'xh' => 'Xhosa',
    'st' => 'Sesotho',
    'sn' => 'Shona',
    'rw' => 'Kinyarwanda',
    'so' => 'Somali',
    'ne' => 'Nepali',
    'ta' => 'Tamil',
    'te' => 'Telugu',
    'ml' => 'Malayalam',
    'kn' => 'Kannada',
    'mr' => 'Marathi',
    'gu' => 'Gujarati',
    'si' => 'Sinhala',
    'my' => 'Burmese',
    'km' => 'Khmer',
    'lo' => 'Lao',
    'mn' => 'Mongolian',
    'ka' => 'Georgian',
    'hy' => 'Armenian',
    'az' => 'Azerbaijani',
    'kk' => 'Kazakh',
    'uz' => 'Uzbek',
    'tg' => 'Tajik',
    'ky' => 'Kyrgyz',
    'ps' => 'Pashto',
    'sd' => 'Sindhi',
    'ckb' => 'Kurdish',
    'ku' => 'Kurdish (Kurmanji)',
    'he' => 'Hebrew',
    'el' => 'Greek',
    'bg' => 'Bulgarian',
    'uk' => 'Ukrainian',
    'pl' => 'Polish',
    'cs' => 'Czech',
    'sk' => 'Slovak',
    'hu' => 'Hungarian',
    'ro' => 'Romanian',
    'sr' => 'Serbian',
    'hr' => 'Croatian',
    'bs' => 'Bosnian',
    'sl' => 'Slovenian',
    'mk' => 'Macedonian',
    'al' => 'Albanian',
    'lv' => 'Latvian',
    'lt' => 'Lithuanian',
    'et' => 'Estonian',
    'fi' => 'Finnish',
    'sv' => 'Swedish',
    'no' => 'Norwegian',
    'da' => 'Danish',
    'is' => 'Icelandic',
    'mt' => 'Maltese',
    'cy' => 'Welsh',
    'ga' => 'Irish',
    'gd' => 'Scottish Gaelic',
    'eu' => 'Basque',
    'ca' => 'Catalan',
    'gl' => 'Galician',
    'af' => 'Afrikaans',
    'sq' => 'Albanian',
    'tl' => 'Tagalog',
    'ceb' => 'Cebuano',
    'haw' => 'Hawaiian',
    'sm' => 'Samoan',
    'to' => 'Tongan',
    'fj' => 'Fijian',
    'mi' => 'Maori'
];

$template = [
    "driver_registration" => "Driver Registration",
    "driver_registration_description" => "Please fill out the form below to register as a driver.",
    "name_required" => "Name is required.",
    "invalid_email" => "Invalid email address.",
    "invalid_phone" => "Invalid phone number.",
    "vehicle_type_required" => "Vehicle type is required.",
    "license_plate_required" => "License plate is required.",
    "address_required" => "Address is required.",
    "dob_required" => "Date of birth is required (format: mm/dd/yyyy).",
    "invalid_experience" => "Experience must be a non-negative number.",
    "driver_registered" => "Driver successfully registered!",
    "error" => "An error occurred",
    "address" => "Address",
    "dob" => "Date of Birth",
    "experience" => "Experience",
    "ride" => "Ride",
    "drive" => "Drive",
    "business" => "Business",
    "help" => "Help",
    "login" => "Log in",
    "signup" => "Sign up",
    "name" => "Name",
    "email" => "Email",
    "phone" => "Phone",
    "vehicle_type" => "Vehicle Type",
    "license_plate" => "License Plate",
    "register" => "Register"
];

$language_dir = __DIR__ . "/languages";

if (!is_dir($language_dir)) {
    mkdir($language_dir, 0777, true);
}

foreach ($languages as $code => $language) {
    $file_path = "{$language_dir}/{$code}.json";
    file_put_contents($file_path, json_encode($template, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

echo "Language files generated successfully!";
?>
