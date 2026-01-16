<?php
/**
 * Layout Component
 * Main page template that renders all pages with header, footer, and splash screen
 * 
 * Usage: 
 * layout([
 *     'title' => 'Page Title',
 *     'meta' => [
 *         'title' => 'Custom SEO Title',
 *         'description' => 'Page description for SEO',
 *         'keywords' => 'keyword1, keyword2, keyword3',
 *         'image' => 'https://example.com/image.jpg',
 *         'url' => 'https://example.com/page',
 *         'type' => 'article',
 *         'author' => 'Author Name'
 *     ],
 *     'showHeader' => true,
 *     'showFooter' => true,
 *     'showSplash' => true,
 *     'content' => function() { // page content }
 * ]);
 */

function layout($config = []) {
    // Configuration
    $title = $config['title'] ?? SITE_TITLE;
    $bodyClass = $config['bodyClass'] ?? '';
    $additionalHead = $config['additionalHead'] ?? '';
    $showHeader = $config['showHeader'] ?? true;
    $showFooter = $config['showFooter'] ?? true;
    $showSplash = $config['showSplash'] ?? true;
    $headerConfig = $config['headerConfig'] ?? [];
    $footerConfig = $config['footerConfig'] ?? [];
    
    // Meta Tags Configuration - can be overridden per page
    $meta = $config['meta'] ?? [];
    $pageTitle = $meta['title'] ?? $title;
    $pageDescription = $meta['description'] ?? $GLOBALS['meta_config']['description'] ?? '';
    $pageKeywords = $meta['keywords'] ?? $GLOBALS['meta_config']['keywords'] ?? '';
    $pageAuthor = $meta['author'] ?? $GLOBALS['meta_config']['author'] ?? '';
    $pageImage = $meta['image'] ?? SITE_URL . 'assets/images/og-image.jpg';
    $pageUrl = $meta['url'] ?? (SITE_URL . $_SERVER['REQUEST_URI']);
    $themeColor = $meta['theme_color'] ?? $GLOBALS['meta_config']['theme_color'] ?? '#6366f1';
    $pageType = $meta['type'] ?? 'website';
    $twitterCard = $meta['twitter_card'] ?? 'summary_large_image';
    $twitterSite = $meta['twitter_site'] ?? '@SindhiEdu';
    $canonical = $meta['canonical'] ?? $pageUrl;
    
    // Robots meta - Block indexing in development environment
    if (ENVIRONMENT === 'dev') {
        $robots = 'noindex, nofollow, noarchive';
    } else {
        $robots = $meta['robots'] ?? 'index, follow';
    }
    
    // Start output buffering for content
    if (isset($config['content']) && is_callable($config['content'])) {
        ob_start();
        $config['content']();
        $content = ob_get_clean();
    } else {
        $content = $config['content'] ?? '';
    }
    ?>
<!DOCTYPE html>
<html lang="<?php echo DEFAULT_LANG; ?>" dir="<?php echo DEFAULT_DIR; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Primary Meta Tags -->
    <title><?php echo sanitize($pageTitle); ?></title>
    <meta name="title" content="<?php echo sanitize($pageTitle); ?>">
    <meta name="description" content="<?php echo sanitize($pageDescription); ?>">
    <meta name="keywords" content="<?php echo sanitize($pageKeywords); ?>">
    <meta name="author" content="<?php echo sanitize($pageAuthor); ?>">
    <meta name="robots" content="<?php echo sanitize($robots); ?>">
    <link rel="canonical" href="<?php echo sanitize($canonical); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo sanitize($pageType); ?>">
    <meta property="og:url" content="<?php echo sanitize($pageUrl); ?>">
    <meta property="og:title" content="<?php echo sanitize($pageTitle); ?>">
    <meta property="og:description" content="<?php echo sanitize($pageDescription); ?>">
    <meta property="og:image" content="<?php echo sanitize($pageImage); ?>">
    <meta property="og:site_name" content="<?php echo sanitize(SITE_NAME); ?>">
    <meta property="og:locale" content="sd_PK">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="<?php echo sanitize($twitterCard); ?>">
    <meta property="twitter:url" content="<?php echo sanitize($pageUrl); ?>">
    <meta property="twitter:title" content="<?php echo sanitize($pageTitle); ?>">
    <meta property="twitter:description" content="<?php echo sanitize($pageDescription); ?>">
    <meta property="twitter:image" content="<?php echo sanitize($pageImage); ?>">
    <?php if (!empty($twitterSite)): ?>
    <meta property="twitter:site" content="<?php echo sanitize($twitterSite); ?>">
    <?php endif; ?>
    
    <!-- Mobile and App Optimization -->
    <meta name="theme-color" content="<?php echo sanitize($themeColor); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="<?php echo sanitize(SITE_NAME); ?>">
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="<?php echo TAILWIND_CDN; ?>">
    
    <!-- Tailwind CSS -->
    <script src="<?php echo TAILWIND_CDN; ?>"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    fontFamily: {
                        'ambile': ['ambile', 'Noto Nastaliq Urdu', 'serif'],
                        'ambile-heading': ['ambile-heading', 'Noto Nastaliq Urdu', 'serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/style.css">
    
    <!-- Custom Inline Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap');
    </style>
    
    <?php echo $additionalHead; ?>
</head>
<body class="<?php echo $bodyClass; ?> min-h-screen bg-gradient-to-br from-slate-50 via-slate-200 to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 transition-colors duration-300">
    
    <?php if ($showSplash): ?>
        <!-- Splash Screen -->
        <?php renderSplash(); ?>
    <?php endif; ?>
    
    <!-- Main Content Wrapper -->
    <div id="mainContent" class="<?php echo $showSplash ? 'opacity-0' : 'opacity-100'; ?> transition-opacity duration-500">
        
        <?php if ($showHeader): ?>
            <!-- Header -->
            <?php renderHeader($headerConfig); ?>
        <?php endif; ?>
        
        <!-- Page Content -->
        <main class="min-h-[60vh]">
            <?php echo $content; ?>
        </main>
        
        <?php if ($showFooter): ?>
            <!-- Footer -->
            <?php renderFooter($footerConfig); ?>
        <?php endif; ?>
        
    </div>
    
    <!-- Dark Mode Toggle Script -->
    <script>
        // Dark mode functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const htmlElement = document.documentElement;
        const bodyElement = document.body;
        
        // Check for saved preference or system preference
        const savedTheme = localStorage.getItem('darkMode');
        if (savedTheme === 'true' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            bodyElement.classList.add('dark');
            htmlElement.classList.add('dark');
        }
        
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                bodyElement.classList.toggle('dark');
                htmlElement.classList.toggle('dark');
                localStorage.setItem('darkMode', bodyElement.classList.contains('dark'));
            });
        }
        
        <?php if ($showSplash): ?>
        // Splash screen handling with multiple fallbacks
        (function() {
            let splashHidden = false;
            const minDisplayTime = 1500;
            const maxDisplayTime = 5000; // Maximum 5 seconds fallback
            const startTime = performance.now();
            
            function hideSplash() {
                if (splashHidden) return;
                splashHidden = true;
                
                const splash = document.getElementById('splashScreen');
                const mainContent = document.getElementById('mainContent');
                
                if (splash) {
                    splash.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => {
                        splash.style.display = 'none';
                    }, 500);
                }
                
                if (mainContent) {
                    mainContent.classList.remove('opacity-0');
                    mainContent.classList.add('opacity-100');
                }
            }
            
            // Handle browser back/forward button navigation (bfcache)
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Page was restored from bfcache (back/forward cache)
                    // Force splash to hide immediately
                    splashHidden = false;
                    hideSplash();
                }
            });
            
            // Method 1: DOMContentLoaded (fastest, when DOM is ready)
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(hideSplash, minDisplayTime);
                });
            } else {
                // DOM is already ready
                setTimeout(hideSplash, minDisplayTime);
            }
            
            // Method 2: Window load event (backup)
            window.addEventListener('load', function() {
                const elapsed = performance.now() - startTime;
                setTimeout(hideSplash, Math.max(minDisplayTime - elapsed, 0));
            });
            
            // Method 3: Fallback timer (safety net - force hide after max time)
            setTimeout(function() {
                if (!splashHidden) {
                    console.warn('Splash screen forced to hide after timeout');
                    hideSplash();
                }
            }, maxDisplayTime);
        })();
        <?php endif; ?>
    </script>
</body>
</html>
<?php
}
