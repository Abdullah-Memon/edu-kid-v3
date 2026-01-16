<?php
/**
 * Example Page Template
 * Demonstrates how to use the layout system with splash screen
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load required components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';
require_once __DIR__ . '/../components/splash.php';
require_once __DIR__ . '/../components/card.php';
require_once __DIR__ . '/../components/button.php';

/**
 * USAGE EXAMPLES:
 * 
 * 1. Basic page with custom meta tags:
 * layout([
 *     'title' => 'Page Title',
 *     'meta' => [
 *         'description' => 'This is a description for SEO',
 *         'keywords' => 'sindhi, education, kids, learning',
 *         'image' => 'https://example.com/page-image.jpg'
 *     ],
 *     'content' => function() {
 *         echo '<div>Your content here</div>';
 *     }
 * ]);
 * 
 * 2. Article page with full SEO meta:
 * layout([
 *     'title' => 'Article Title',
 *     'meta' => [
 *         'title' => 'Complete Article Title - Site Name',
 *         'description' => 'Article description for search engines',
 *         'keywords' => 'article, topic, sindhi',
 *         'type' => 'article',
 *         'author' => 'Author Name',
 *         'image' => 'https://example.com/article-image.jpg',
 *         'canonical' => 'https://example.com/article',
 *         'robots' => 'index, follow'
 *     ],
 *     'content' => function() {
 *         echo '<article>Your article content</article>';
 *     }
 * ]);
 * 
 * 3. Page without splash screen:
 * layout([
 *     'title' => 'Page Title',
 *     'showSplash' => false,
 *     'content' => function() {
 *         echo '<div>Your content here</div>';
 *     }
 * ]);
 * 
 * 4. Page without header or footer:
 * layout([
 *     'title' => 'Page Title',
 *     'showHeader' => false,
 *     'showFooter' => false,
 *     'content' => function() {
 *         echo '<div>Your content here</div>';
 *     }
 * ]);
 * 
 * 5. Custom header/footer configuration:
 * layout([
 *     'title' => 'Page Title',
 *     'headerConfig' => ['transparent' => true, 'sticky' => false],
 *     'footerConfig' => ['year' => 2026],
 *     'content' => function() {
 *         echo '<div>Your content here</div>';
 *     }
 * ]);
 */

// Render the page using layout
layout([
    'title' => 'Example Page - ' . SITE_NAME,
    'meta' => [
        'title' => 'Layout System Example - ' . SITE_NAME,
        'description' => 'Example page demonstrating the layout system with custom meta tags for SEO optimization',
        'keywords' => 'sindhi education, kids learning, layout example, meta tags, seo',
        'author' => 'EduKid Development Team',
        'type' => 'website',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => true,
    'bodyClass' => 'example-page',
    'content' => function() {
        ?>
        
        <!-- Page Header -->
        <section class="container mx-auto px-4 py-12">
            <div class="text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-indigo-800 dark:text-indigo-200 mb-4">
                    Example Page Template
                </h1>
                <p class="text-xl text-slate-600 dark:text-slate-300">
                    This demonstrates how to use the layout system
                </p>
            </div>
        </section>
        
        <!-- Content Section -->
        <section class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <?php 
                // Using the card component
                renderGlassCard([
                    'icon' => '📝',
                    'title' => 'Layout Features',
                    'content' => '
                        <ul class="text-slate-600 dark:text-slate-300 space-y-2 text-right">
                            <li>✅ Automatic splash screen on page load</li>
                            <li>✅ Integrated header and footer</li>
                            <li>✅ Dark mode support</li>
                            <li>✅ Responsive design</li>
                            <li>✅ RTL support for Sindhi text</li>
                            <li>✅ Loading states for navigation</li>
                            <li>✅ Custom meta tags per page</li>
                            <li>✅ SEO optimization with Open Graph</li>
                            <li>✅ Twitter Card support</li>
                            <li>✅ Canonical URLs</li>
                        </ul>
                    '
                ]); 
                ?>
            </div>
        </section>
        
        <!-- Demo Section -->
        <section class="container mx-auto px-4 py-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-indigo-800 dark:text-indigo-200 mb-6">
                    Component Demo
                </h2>
                
                <div class="max-w-md mx-auto space-y-4">
                    <?php
                    renderButton([
                        'text' => 'Primary Button',
                        'href' => '#',
                        'variant' => 'primary',
                        'icon' => '🎯'
                    ]);
                    
                    renderButton([
                        'text' => 'Go Back Home - واپس وڃو',
                        'href' => '../index.php',
                        'variant' => 'secondary',
                        'icon' => '🏠'
                    ]);
                    ?>
                </div>
            </div>
        </section>
        
        <?php
    }
]);
?>
