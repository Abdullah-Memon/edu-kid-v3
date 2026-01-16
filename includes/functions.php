<?php
/**
 * Helper Functions
 * Reusable utility functions for the application
 */

/**
 * Load JSON data from file
 * @param string $filename - Path to JSON file
 * @return array - Decoded JSON data
 */
function loadJsonData($filename) {
    $filepath = DATA_PATH . $filename;
    if (!file_exists($filepath)) {
        return [];
    }
    $json = file_get_contents($filepath);
    return json_decode($json, true) ?? [];
}

/**
 * Load class data
 * @param int $classNumber - Class number (1-5)
 * @return array - Class data
 */
function loadClassData($classNumber) {
    return loadJsonData("classes/class{$classNumber}.json");
}

/**
 * Load exercise data
 * @param string $type - Exercise type (letterRecognition, wordBuilding, etc.)
 * @return array - Exercise data
 */
function loadExerciseData($type) {
    return loadJsonData("{$type}.json");
}

/**
 * Sanitize output
 * @param string $text - Text to sanitize
 * @return string - Sanitized text
 */
function sanitize($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Get current page name
 * @return string - Current page name
 */
function getCurrentPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

/**
 * Check if dark mode is active
 * @return bool
 */
function isDarkMode() {
    return isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true';
}

/**
 * Generate page title
 * @param string $pageTitle
 * @return string
 */
function getPageTitle($pageTitle = '') {
    if (empty($pageTitle)) {
        return SITE_TITLE;
    }
    return $pageTitle . ' - ' . SITE_NAME;
}

/**
 * Include component
 * @param string $component - Component name
 * @param array $data - Data to pass to component
 */
function component($component, $data = []) {
    extract($data);
    include dirname(__DIR__) . "/components/{$component}.php";
}

/**
 * Get audio path for class
 * @param int $classNumber
 * @param int $lessonNumber
 * @return string
 */
function getAudioPath($classNumber, $lessonNumber) {
    return ASSETS_PATH . "Data/Audio Baits/{$classNumber}/{$lessonNumber}/";
}

/**
 * Format number to Sindhi/Urdu numerals (optional)
 * @param int $number
 * @return string
 */
function toSindhiNumber($number) {
    $urduNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($englishNumbers, $urduNumbers, $number);
}

/**
 * Get class link
 * @param int $classNumber
 * @return string
 */
function getClassLink($classNumber) {
    global $classes;
    if (isset($classes[$classNumber])) {
        return 'class' . $classNumber . '.php';
    }
    return '#';
}

/**
 * Generate random ID
 * @return string
 */
function generateId() {
    return 'id_' . bin2hex(random_bytes(8));
}
