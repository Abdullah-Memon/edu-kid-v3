<?php
/**
 * Learn Sindhi - Main Index
 * Interactive language learning platform
 */

// Load configuration and functions
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

// Load required components
require_once __DIR__ . '/../../components/layout.php';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../components/footer.php';
require_once __DIR__ . '/../../components/splash.php';
require_once __DIR__ . '/../../components/card.php';

// Get current tab from URL parameter
$currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'alphabets';

// Validate tab
$validTabs = ['alphabets', 'phrases', 'vocabulary', 'grammar', 'culture', 'facts'];
if (!in_array($currentTab, $validTabs)) {
    $currentTab = 'alphabets';
}

// Page meta tags
$pageTitle = 'Learn Sindhi - Interactive Language Learning | ' . SITE_NAME;
$pageDescription = 'Learn Sindhi language online for free! Interactive lessons, vocabulary, grammar, culture, and fun activities for English speakers.';

// Render page
layout([
    'title' => $pageTitle,
    'meta' => [
        'title' => $pageTitle,
        'description' => $pageDescription,
        'keywords' => 'learn sindhi, sindhi language course, sindhi for english speakers, online sindhi lessons, sindhi vocabulary, sindhi grammar',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/learn-sindhi-preview.jpg'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => true,
    'content' => function() use ($currentTab) {
        ?>
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-16 lg:py-24 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 text-9xl animate-bounce">🗣️</div>
                <div class="absolute top-20 right-20 text-7xl animate-pulse">📚</div>
                <div class="absolute bottom-10 left-1/4 text-8xl animate-bounce" style="animation-delay: 0.2s;">✨</div>
                <div class="absolute bottom-20 right-1/3 text-6xl animate-pulse" style="animation-delay: 0.4s;">🌟</div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center text-white">
                    <div class="inline-block mb-6 px-8 py-3 bg-white/20 backdrop-blur-lg rounded-full border-2 border-white/40 shadow-xl animate-bounce">
                        <span class="text-6xl">🌍</span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                        Learn Sindhi Language
                    </h1>
                    <h2 class="text-3xl lg:text-4xl font-semibold mb-6 opacity-90">
                        سنڌي ٻولي سکو - Interactive & Fun!
                    </h2>
                    
                    <p class="text-xl lg:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
                        Start your journey to learn one of the oldest languages in the world!
                        <br>دنيا جي قديم ترين ٻولين مان هڪ سکو!
                    </p>
                    
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">52</div>
                            <div class="text-sm opacity-90">Letters</div>
                        </div>
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">5000+</div>
                            <div class="text-sm opacity-90">Years Old</div>
                        </div>
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">RTL</div>
                            <div class="text-sm opacity-90">Right to Left</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Navigation Tabs -->
        <section class="container mx-auto px-4 -mt-8 relative z-20">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-4 border-4 border-indigo-300 dark:border-indigo-600">
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="?tab=alphabets" 
                       class="learn-tab-btn <?php echo $currentTab === 'alphabets' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">🔤</span>
                        <span>Alphabets</span>
                    </a>
                    <a href="?tab=phrases" 
                       class="learn-tab-btn <?php echo $currentTab === 'phrases' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">💬</span>
                        <span>Phrases</span>
                    </a>
                    <a href="?tab=vocabulary" 
                       class="learn-tab-btn <?php echo $currentTab === 'vocabulary' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">📖</span>
                        <span>Vocabulary</span>
                    </a>
                    <a href="?tab=grammar" 
                       class="learn-tab-btn <?php echo $currentTab === 'grammar' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">📝</span>
                        <span>Grammar</span>
                    </a>
                    <a href="?tab=culture" 
                       class="learn-tab-btn <?php echo $currentTab === 'culture' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">🏛️</span>
                        <span>Culture</span>
                    </a>
                    <a href="?tab=facts" 
                       class="learn-tab-btn <?php echo $currentTab === 'facts' ? 'active' : ''; ?> px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mr-2">💡</span>
                        <span>Fun Facts</span>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Tab Content -->
        <div class="container mx-auto px-4 py-8">
            <?php
            // Include the appropriate tab content
            $tabFile = __DIR__ . '/' . $currentTab . '.php';
            if (file_exists($tabFile)) {
                include $tabFile;
            } else {
                echo '<div class="text-center py-12">';
                echo '<p class="text-2xl text-red-600">Tab content not found!</p>';
                echo '</div>';
            }
            ?>
        </div>
        
        <style>
            .learn-tab-btn {
                background: linear-gradient(135deg, #e0e7ff 0%, #ddd6fe 100%);
                color: #4338ca;
                border: 2px solid transparent;
            }
            
            .learn-tab-btn:hover {
                background: linear-gradient(135deg, #c7d2fe 0%, #ddd6fe 100%);
                border-color: #818cf8;
            }
            
            .learn-tab-btn.active {
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                color: white;
                box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
            }
            
            .dark .learn-tab-btn {
                background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
                color: #a5b4fc;
            }
            
            .dark .learn-tab-btn:hover {
                background: linear-gradient(135deg, #334155 0%, #475569 100%);
                border-color: #6366f1;
            }
            
            .dark .learn-tab-btn.active {
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                color: white;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>
        
        <?php
    }
]);
?>
