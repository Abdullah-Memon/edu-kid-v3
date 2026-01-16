<?php
/**
 * Configuration File
 * Contains site-wide settings and constants
 */

// ============================================
// ENVIRONMENT CONFIGURATION
// ============================================
// Options: 'prod', 'dev', 'local'
define('ENVIRONMENT', 'local'); // Change to 'prod' for production

// Base URL Configuration based on environment
if (ENVIRONMENT === 'prod') {
    define('BASE_URL', 'https://edukid.sindh.ai/');
    define('ASSETS_URL', 'https://edukid.sindh.ai/assets/');
    // Production error reporting
    error_reporting(0);
    ini_set('display_errors', 0);
} else if (ENVIRONMENT === 'dev') {
    define('BASE_URL', 'https://edukid-v3.sindh.ai/');
    define('ASSETS_URL', 'https://edukid-v3.sindh.ai/assets/');
    // Development error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

else if (ENVIRONMENT === 'local') {
    // dev or local environment
    define('BASE_URL', 'http://localhost/edukid/');
    define('ASSETS_URL', 'http://localhost/edukid/assets/');
    // Development error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// ============================================
// SITE CONFIGURATION
// ============================================
define('SITE_NAME', 'سنڌي ٻارن جي تعليم');
define('SITE_TITLE', 'ٻارن لاءِ سنڌي سکيا جي ڪورس ۾ ڀليڪار');
define('SITE_URL', BASE_URL);
define('BASE_PATH', dirname(dirname(__FILE__)));

// Asset Paths
define('ASSETS_PATH', './assets/');
define('DATA_PATH', ASSETS_PATH . 'Data/');
define('IMAGES_PATH', ASSETS_PATH . 'images/');
define('FONTS_PATH', ASSETS_PATH . 'fonts/');

// Tailwind CDN
define('TAILWIND_CDN', 'https://cdn.tailwindcss.com');

// Default Language
define('DEFAULT_LANG', 'sd');
define('DEFAULT_DIR', 'rtl');

// Classes Configuration
$classes = [
    1 => ['name' => 'ڪلاس پھريون', 'slug' => 'class1'],
    2 => ['name' => 'ڪلاس ٻيون', 'slug' => 'class2'],
    3 => ['name' => 'ڪلاس ٽيون', 'slug' => 'class3'],
    4 => ['name' => 'ڪلاس چوٿون', 'slug' => 'class4'],
    5 => ['name' => 'ڪلاس پنجون', 'slug' => 'class5']
];

// Meta Tags Configuration
$meta_config = [
    'description' => 'Best free platform to learn Sindhi language for children. Interactive games, stories, alphabet learning, and cultural education.',
    'keywords' => 'learn sindhi online free, best sindhi learning app kids, sindhi alphabet for children, how to teach sindhi to kids, sindhi education platform',
    'author' => 'Sindhi Educational Platform',
    'theme_color' => '#6366f1'
];

// Tailwind Configuration
$tailwind_config = [
    'darkMode' => 'class',
    'primary' => [
        '50' => '#f0f9ff',
        '500' => '#3b82f6',
        '600' => '#2563eb',
        '700' => '#1d4ed8'
    ]
];
