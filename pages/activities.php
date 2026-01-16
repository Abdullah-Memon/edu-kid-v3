<?php
/**
 * Activities Page - Interactive Learning Activities for Kids
 * URL: activities.php?id=letterRecognition
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load required components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';

// Get activity ID from URL
$activityId = isset($_GET['id']) ? $_GET['id'] : '';

// Load activities data
$activitiesFile = __DIR__ . '/../assets/Data/sindhi/activities.json';
$activitiesData = json_decode(file_get_contents($activitiesFile), true);

// Find the selected activity
$selectedActivity = null;
foreach ($activitiesData['activities'] as $activity) {
    if ($activity['id'] === $activityId) {
        $selectedActivity = $activity;
        break;
    }
}

// Redirect if activity not found
if (!$selectedActivity) {
    header('Location: sindhi.php');
    exit;
}

// Load activity-specific data based on ID
$activityDataFile = __DIR__ . '/../assets/Data/' . $activityId . '.json';
$activityContent = [];
if (file_exists($activityDataFile)) {
    $jsonContent = file_get_contents($activityDataFile);
    $jsonContent = preg_replace('/^\xEF\xBB\xBF/', '', $jsonContent);
    $decodedData = json_decode($jsonContent, true);
    
    // Check if the JSON has a key matching the activity ID
    if (isset($decodedData[$activityId])) {
        $activityContent = $decodedData[$activityId];
    } else {
        // Otherwise use the decoded data directly
        $activityContent = $decodedData;
    }
}

// Page meta tags
$pageTitle = $selectedActivity['title'] . ' | ' . SITE_NAME;

// Render page
layout([
    'title' => $pageTitle,
    'meta' => [
        'title' => $pageTitle,
        'description' => 'Interactive Sindhi learning activity - ' . $selectedActivity['subtitle'],
        'keywords' => 'sindhi learning, ' . $selectedActivity['id'] . ', sindhi for kids',
        'type' => 'website'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($selectedActivity, $activityContent, $activityId) {
        ?>
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-8 lg:py-12 bg-gradient-to-br <?php echo $selectedActivity['color']; ?>">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 text-8xl animate-bounce">✨</div>
                <div class="absolute top-20 right-20 text-6xl animate-pulse">🎮</div>
                <div class="absolute bottom-10 left-1/4 text-5xl animate-bounce" style="animation-delay: 0.2s;">⭐</div>
                <div class="absolute bottom-20 right-1/3 text-7xl animate-pulse" style="animation-delay: 0.4s;">🌟</div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center text-white">
                    <!-- Icon Badge -->
                    <div class="inline-block mb-4 px-6 py-3 bg-white/20 backdrop-blur-lg rounded-full border-2 border-white/40 shadow-xl animate-bounce">
                        <span class="text-6xl"><?php echo $selectedActivity['emoji']; ?></span>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-4xl lg:text-6xl font-bold mb-3 drop-shadow-lg" dir="rtl">
                        <?php echo htmlspecialchars($selectedActivity['title']); ?>
                    </h1>
                    <h2 class="text-2xl lg:text-3xl font-semibold mb-4 opacity-90" dir="rtl">
                        <?php echo htmlspecialchars($selectedActivity['subtitle']); ?>
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-xl lg:text-2xl mb-6 max-w-2xl mx-auto" dir="rtl">
                        <?php echo htmlspecialchars($selectedActivity['description']); ?>
                    </p>
                    
                    <!-- Back Button -->
                    <a href="<?php echo BASE_URL; ?>pages/sindhi.php" class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30 hover:bg-white/30 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span dir="rtl">واپس وڃو</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Activity Content -->
        <section class="container mx-auto px-4 py-8">
            <div class="max-w-6xl mx-auto">
                
                <?php if ($activityId === 'letterRecognition'): ?>
                    <!-- Letter Recognition Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-purple-800 dark:text-purple-100" dir="rtl">
                            اکر سڃاڻڻ جي راند
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach ($activityContent as $item): ?>
                                    <button class="activity-card p-6 bg-gradient-to-br <?php echo $selectedActivity['color']; ?> rounded-2xl shadow-lg hover:scale-110 transition-all duration-300 transform">
                                        <div class="text-center">
                                            <div class="text-5xl font-bold text-white mb-2"><?php echo htmlspecialchars($item['displayLetter'] ?? $item['letter'] ?? $item['character'] ?? ''); ?></div>
                                            <div class="text-sm text-white/80"><?php echo htmlspecialchars($item['exampleWord'] ?? $item['name'] ?? ''); ?></div>
                                        </div>
                                    </button>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-span-full text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php elseif ($activityId === 'wordBuilding'): ?>
                    <!-- Word Building Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-blue-800 dark:text-blue-100" dir="rtl">
                            لفظ ٺاهڻ جي راند
                        </h3>
                        <div class="space-y-6">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach (array_slice($activityContent, 0, 10) as $item): ?>
                                    <div class="bg-gradient-to-r <?php echo $selectedActivity['color']; ?> bg-opacity-10 rounded-2xl p-6">
                                        <div class="flex items-center justify-between gap-4">
                                            <div class="text-4xl"><?php echo htmlspecialchars($item['image'] ?? '🎯'); ?></div>
                                            <div class="flex-1 text-right">
                                                <div class="text-2xl font-bold text-slate-800 dark:text-slate-100" dir="rtl">
                                                    <?php echo htmlspecialchars($item['word'] ?? ''); ?>
                                                </div>
                                                <div class="text-base text-slate-600 dark:text-slate-300" dir="rtl">
                                                    <?php echo htmlspecialchars($item['meaning'] ?? ''); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php elseif ($activityId === 'vocabularyBuilding'): ?>
                    <!-- Vocabulary Building Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-green-800 dark:text-green-100" dir="rtl">
                            لفظن جو خزانو
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach (array_slice($activityContent, 0, 12) as $item): ?>
                                    <div class="bg-gradient-to-br <?php echo $selectedActivity['color']; ?> bg-opacity-10 rounded-2xl p-6 hover:scale-105 transition-all duration-300">
                                        <div class="text-center">
                                            <div class="text-5xl mb-3"><?php echo htmlspecialchars($item['emoji'] ?? $item['icon'] ?? '📚'); ?></div>
                                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2" dir="rtl">
                                                <?php echo htmlspecialchars($item['sindhi'] ?? $item['word'] ?? ''); ?>
                                            </div>
                                            <div class="text-sm text-slate-600 dark:text-slate-300" dir="rtl">
                                                <?php echo htmlspecialchars($item['english'] ?? $item['meaning'] ?? ''); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-span-full text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php elseif ($activityId === 'writingPractice'): ?>
                    <!-- Writing Practice Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-orange-800 dark:text-orange-100" dir="rtl">
                            لکڻ جي مشق
                        </h3>
                        <div class="space-y-8">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach (array_slice($activityContent, 0, 8) as $item): ?>
                                    <div class="bg-gradient-to-r <?php echo $selectedActivity['color']; ?> bg-opacity-10 rounded-2xl p-8">
                                        <div class="text-center mb-6">
                                            <div class="text-6xl font-bold text-slate-800 dark:text-slate-100 mb-4">
                                                <?php echo htmlspecialchars($item['letter'] ?? $item['character'] ?? ''); ?>
                                            </div>
                                            <div class="text-lg text-slate-600 dark:text-slate-300" dir="rtl">
                                                <?php echo htmlspecialchars($item['name'] ?? ''); ?>
                                            </div>
                                        </div>
                                        <div class="border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl p-4 min-h-32 bg-white/50 dark:bg-slate-700/50">
                                            <p class="text-center text-slate-500 dark:text-slate-400" dir="rtl">هتي مشق ڪريو...</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php elseif ($activityId === 'readingPractice'): ?>
                    <!-- Reading Practice Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-red-800 dark:text-red-100" dir="rtl">
                            پڙهڻ جي مشق
                        </h3>
                        <div class="space-y-6">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach (array_slice($activityContent, 0, 10) as $index => $item): ?>
                                    <div class="bg-gradient-to-r <?php echo $selectedActivity['color']; ?> bg-opacity-10 rounded-2xl p-6">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0 w-12 h-12 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center font-bold text-slate-800 dark:text-slate-100">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <div class="flex-1 text-right">
                                                <div class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-2 leading-loose" dir="rtl">
                                                    <?php echo htmlspecialchars($item['sentence'] ?? $item['text'] ?? ''); ?>
                                                </div>
                                                <?php if (isset($item['translation'])): ?>
                                                    <div class="text-base text-slate-600 dark:text-slate-300 italic">
                                                        <?php echo htmlspecialchars($item['translation']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php elseif ($activityId === 'grammarPractice'): ?>
                    <!-- Grammar Practice Activity -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-4 border-slate-200 dark:border-slate-700">
                        <h3 class="text-3xl font-bold text-center mb-8 text-pink-800 dark:text-pink-100" dir="rtl">
                            گرامر جي سکيا
                        </h3>
                        <div class="space-y-6">
                            <?php if (!empty($activityContent) && is_array($activityContent)): ?>
                                <?php foreach (array_slice($activityContent, 0, 10) as $item): ?>
                                    <div class="bg-gradient-to-r <?php echo $selectedActivity['color']; ?> bg-opacity-10 rounded-2xl p-6">
                                        <h4 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-3" dir="rtl">
                                            <?php echo htmlspecialchars($item['title'] ?? $item['rule'] ?? ''); ?>
                                        </h4>
                                        <p class="text-base text-slate-700 dark:text-slate-300 mb-4 leading-loose" dir="rtl">
                                            <?php echo htmlspecialchars($item['description'] ?? $item['explanation'] ?? ''); ?>
                                        </p>
                                        <?php if (isset($item['example'])): ?>
                                            <div class="bg-white/60 dark:bg-slate-700/60 rounded-xl p-4">
                                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-2" dir="rtl">مثال:</p>
                                                <p class="text-lg text-slate-800 dark:text-slate-100" dir="rtl">
                                                    <?php echo htmlspecialchars($item['example']); ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-12">
                                    <p class="text-2xl text-slate-600 dark:text-slate-300" dir="rtl">
                                        جلد ئي اچي رهيو آهي! 🚀
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Default Coming Soon -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border-4 border-slate-200 dark:border-slate-700 text-center">
                        <div class="text-8xl mb-6">🚀</div>
                        <h3 class="text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4" dir="rtl">
                            جلد ئي اچي رهيو آهي!
                        </h3>
                        <p class="text-xl text-slate-600 dark:text-slate-300" dir="rtl">
                            هي راند تيار ڪئي پئي وڃي
                        </p>
                    </div>
                <?php endif; ?>

            </div>
        </section>

        <style>
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
            .activity-card:hover {
                animation: bounce 0.5s ease infinite;
            }
        </style>

        <?php
    }
]);
?>
