<?php
/**
 * 404 Error Page - Page Not Found
 * Custom error page for handling invalid URLs and folder access
 */

// Set proper HTTP status code
http_response_code(404);

// Load configuration and functions
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Load all components
require_once __DIR__ . '/components/layout.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/footer.php';
require_once __DIR__ . '/components/splash.php';
require_once __DIR__ . '/components/button.php';

// Start layout
layout([
    'title' => '404 - صفحو نه مليو',
    'meta' => [
        'title' => '404 - Page Not Found | ' . SITE_NAME,
        'description' => 'The page you are looking for could not be found.',
        'robots' => 'noindex, nofollow'
    ],
    'showHeader' => false,
    'showFooter' => false,
    'showSplash' => false,
    'bodyClass' => '',
    'content' => function() {
    ?>
    
    <div class="fixed inset-0 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 overflow-y-auto">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Error Code -->
            <div class="mb-8">
                <h1 class="text-9xl sm:text-[12rem] font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 animate-pulse">
                    404
                </h1>
            </div>
            
            <!-- Error Message -->
            <div class="mb-8">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-800 dark:text-slate-200 mb-4">
                    صفحو نه مليو
                </h2>
                <p class="text-xl sm:text-2xl text-slate-600 dark:text-slate-400 mb-6">
                    معاف ڪجو، توهان جيڪو صفحو ڳولي رهيا آهيو اهو موجود ناهي.
                </p>
                <p class="text-lg sm:text-xl text-slate-500 dark:text-slate-500">
                    Sorry, the page you are looking for does not exist or has been moved.
                </p>
            </div>

            <!-- Illustration -->
            <div class="mb-12 flex justify-center">
                <svg class="w-48 h-48 sm:w-64 sm:h-64 text-indigo-500/20 dark:text-indigo-400/20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <!-- Go Back Button -->
                <button 
                    onclick="window.history.back()" 
                    class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg sm:text-xl font-bold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>واپس وڃو</span>
                </button>

                <!-- Home Button -->
                <a 
                    href="<?php echo SITE_URL; ?>" 
                    class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-pink-600 to-rose-600 text-white text-lg sm:text-xl font-bold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-6 h-6 transform group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>گھر وڃو</span>
                </a>
            </div>

            <!-- Helpful Links -->
            <div class="mt-12 p-6 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm rounded-2xl border border-slate-200 dark:border-slate-700">
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">
                    مددگار لنڪس
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="<?php echo SITE_URL; ?>pages/learn-sindhi/" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        سنڌي سکو
                    </a>
                    <a href="<?php echo SITE_URL; ?>sindhi.php" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        سنڌي
                    </a>
                    <a href="<?php echo SITE_URL; ?>math.php" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        رياضي
                    </a>
                    <a href="<?php echo SITE_URL; ?>science.php" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        سائنس
                    </a>
                    <a href="<?php echo SITE_URL; ?>stories.php" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        ڪهاڻيون
                    </a>
                    <a href="<?php echo SITE_URL; ?>family-tree.php" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors">
                        خانداني وڻ
                    </a>
                    <a href="https://docs.sindh.ai" target="_blank" rel="noopener noreferrer" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-base sm:text-lg font-semibold transition-colors inline-flex items-center justify-center gap-1">
                        <span>دستاويز</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Security Note -->
            <div class="mt-8 text-sm text-slate-500 dark:text-slate-600">
                <p>اگر توهان سمجهو ٿا ته هي هڪ غلطي آهي، مهرباني ڪري سائيٽ منتظم سان رابطو ڪريو.</p>
                <p class="mt-1">If you believe this is an error, please contact the site administrator.</p>
            </div>
        </div>
    </div>
    
    <?php
    }
]);
