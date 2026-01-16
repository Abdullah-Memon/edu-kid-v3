<?php
/**
 * Class Page - Display Class Poetry and Content
 * URL: class.php?id=1 (where id is 1-5)
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
require_once __DIR__ . '/../components/popup.php';

// Get class ID from URL parameter
$classId = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Validate class ID (must be between 1-5)
if ($classId < 1 || $classId > 5) {
    $classId = 1;
}

// Class configuration
$classConfig = [
    1 => [
        'name' => 'ڪلاس پھريون',
        'englishName' => 'Class 1',
        'color' => 'from-pink-400 via-rose-400 to-red-400',
        'bgColor' => 'bg-pink-50 dark:bg-pink-900/20',
        'textColor' => 'text-pink-600 dark:text-pink-400',
        'borderColor' => 'border-pink-300 dark:border-pink-600',
        'emoji' => '🌸',
        'description' => 'پهرين درجي جا شاعري ۽ نظمون'
    ],
    2 => [
        'name' => 'ڪلاس ٻيون',
        'englishName' => 'Class 2',
        'color' => 'from-blue-400 via-cyan-400 to-teal-400',
        'bgColor' => 'bg-blue-50 dark:bg-blue-900/20',
        'textColor' => 'text-blue-600 dark:text-blue-400',
        'borderColor' => 'border-blue-300 dark:border-blue-600',
        'emoji' => '🌊',
        'description' => 'ٻئي درجي جا شاعري ۽ نظمون'
    ],
    3 => [
        'name' => 'ڪلاس ٽيون',
        'englishName' => 'Class 3',
        'color' => 'from-purple-400 via-violet-400 to-indigo-400',
        'bgColor' => 'bg-purple-50 dark:bg-purple-900/20',
        'textColor' => 'text-purple-600 dark:text-purple-400',
        'borderColor' => 'border-purple-300 dark:border-purple-600',
        'emoji' => '🦋',
        'description' => 'ٽئين درجي جا شاعري ۽ نظمون'
    ],
    4 => [
        'name' => 'ڪلاس چوٿون',
        'englishName' => 'Class 4',
        'color' => 'from-green-400 via-emerald-400 to-lime-400',
        'bgColor' => 'bg-green-50 dark:bg-green-900/20',
        'textColor' => 'text-green-600 dark:text-green-400',
        'borderColor' => 'border-green-300 dark:border-green-600',
        'emoji' => '🌿',
        'description' => 'چوٿين درجي جا شاعري ۽ نظمون'
    ],
    5 => [
        'name' => 'ڪلاس پنجون',
        'englishName' => 'Class 5',
        'color' => 'from-orange-400 via-amber-400 to-yellow-400',
        'bgColor' => 'bg-orange-50 dark:bg-orange-900/20',
        'textColor' => 'text-orange-600 dark:text-orange-400',
        'borderColor' => 'border-orange-300 dark:border-orange-600',
        'emoji' => '⭐',
        'description' => 'پنجين درجي جا شاعري ۽ نظمون'
    ]
];

$currentClass = $classConfig[$classId];

// Load class data from JSON file
$jsonFile = __DIR__ . '/../assets/Data/classes/class' . $classId . '.json';
$classData = [];

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    // Remove BOM if present
    $jsonContent = preg_replace('/^\xEF\xBB\xBF/', '', $jsonContent);
    $decodedData = json_decode($jsonContent, true);
    
    // Check for JSON errors
    if (json_last_error() !== JSON_ERROR_NONE && ENVIRONMENT === 'local') {
        error_log("JSON Error for class $classId: " . json_last_error_msg());
        error_log("File path: " . $jsonFile);
    }
    
    $classData = is_array($decodedData) ? $decodedData : [];
}

// Page meta tags
$pageTitle = $currentClass['name'] . ' - ' . $currentClass['englishName'] . ' | ' . SITE_NAME;
$pageDescription = 'سنڌي ' . $currentClass['name'] . ' جا شاعري، نظمون ۽ بيت. Interactive learning content for ' . $currentClass['englishName'] . ' students.';

// Render page
layout([
    'title' => $pageTitle,
    'meta' => [
        'title' => $pageTitle,
        'description' => $pageDescription,
        'keywords' => 'sindhi class ' . $classId . ', سنڌي شاعري, sindhi poetry, class ' . $classId . ' sindhi, نظمون',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/class' . $classId . '-preview.jpg'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => true,
    'content' => function() use ($classId, $currentClass, $classData, $classConfig) {
        ?>
        
        <!-- Hero Section with Class Title -->
        <section class="relative overflow-hidden py-12 lg:py-20 bg-gradient-to-br <?php echo $currentClass['color']; ?>">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 text-9xl animate-bounce">📚</div>
                <div class="absolute top-20 right-20 text-7xl animate-pulse">✨</div>
                <div class="absolute bottom-10 left-1/4 text-6xl animate-bounce" style="animation-delay: 0.2s;">🎨</div>
                <div class="absolute bottom-20 right-1/3 text-8xl animate-pulse" style="animation-delay: 0.4s;">🌟</div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center text-white">
                    <!-- Class Number Badge -->
                    <div class="inline-block mb-6 px-8 py-3 bg-white/20 backdrop-blur-lg rounded-full border-2 border-white/40 shadow-xl animate-bounce">
                        <span class="text-6xl"><?php echo $currentClass['emoji']; ?></span>
                    </div>
                    
                    <!-- Class Title -->
                    <h1 class="text-5xl lg:text-7xl font-bold mb-4 drop-shadow-lg animate-fade-in">
                        <?php echo $currentClass['name']; ?>
                    </h1>
                    <h2 class="text-3xl lg:text-4xl font-semibold mb-6 opacity-90">
                        <?php echo $currentClass['englishName']; ?>
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-xl lg:text-2xl mb-8 max-w-2xl mx-auto opacity-90">
                        <?php echo $currentClass['description']; ?>
                    </p>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-4 mb-8">
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold"><?php echo count($classData); ?></div>
                            <div class="text-sm opacity-90">نظمون ۽ شاعري</div>
                        </div>
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">📖</div>
                            <div class="text-sm opacity-90">آن لائين سکيا</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Class Navigation -->
        <section class="container mx-auto px-4 -mt-8 relative z-20">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-4 border-4 <?php echo $currentClass['borderColor']; ?>">
                <div class="flex flex-wrap justify-center gap-3">
                    <?php foreach ($classConfig as $id => $class): ?>
                        <a href="class.php?id=<?php echo $id; ?>" 
                           class="group relative overflow-hidden px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-110 <?php echo $id == $classId ? 'bg-gradient-to-r ' . $class['color'] . ' text-white shadow-lg scale-105' : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:shadow-lg'; ?>">
                            <span class="text-2xl mr-2"><?php echo $class['emoji']; ?></span>
                            <span><?php echo $class['name']; ?></span>
                            <?php if ($id == $classId): ?>
                                <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        
        <!-- Poetry/Content Section -->
        <section class="container mx-auto px-4 py-12">
            <?php if (empty($classData)): ?>
                <!-- No Data Message -->
                <div class="max-w-2xl mx-auto text-center py-16">
                    <div class="text-8xl mb-6">📚</div>
                    <h3 class="text-3xl font-bold text-slate-700 dark:text-slate-300 mb-4">
                        معاف ڪجو!
                    </h3>
                    <p class="text-xl text-slate-600 dark:text-slate-400">
                        هن وقت هن ڪلاس لاءِ مواد موجود ناهي.
                    </p>
                </div>
            <?php else: ?>
                <!-- Poetry Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <?php foreach ($classData as $index => $bait): ?>
                        <div class="group relative">
                            <!-- Card -->
                            <div class="relative overflow-hidden rounded-3xl bg-white dark:bg-slate-800 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-4 <?php echo $currentClass['borderColor']; ?> <?php echo $currentClass['bgColor']; ?>">
                                
                                <!-- Card Header with Decorative Pattern -->
                                <div class="relative bg-gradient-to-br <?php echo $currentClass['color']; ?> p-6 overflow-hidden">
                                    <!-- Decorative Elements -->
                                    <div class="absolute top-0 right-0 text-6xl opacity-20 transform rotate-12"><?php echo $currentClass['emoji']; ?></div>
                                    <div class="absolute bottom-0 left-0 text-4xl opacity-10 transform -rotate-12">✨</div>
                                    
                                    <!-- Card Number Badge -->
                                    <div class="absolute top-4 left-4 w-12 h-12 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/50 shadow-lg">
                                        <span class="text-xl font-bold text-white"><?php echo $index + 1; ?></span>
                                    </div>
                                    
                                    <!-- Title -->
                                    <h3 class="relative text-2xl lg:text-3xl font-bold text-white text-right pr-16 leading-relaxed drop-shadow-md">
                                        <?php echo htmlspecialchars($bait['baitTitle']); ?>
                                    </h3>
                                    
                                    <!-- Author Badge -->
                                    <!-- <?php if (!empty($bait['author'])): ?>
                                        <div class="relative mt-4 inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                            <span class="text-white text-sm">
                                                ✍️ <?php echo htmlspecialchars($bait['author']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?> -->
                                </div>
                                
                                <!-- Card Content -->
                                <div class="p-8">
                                    <!-- Poetry Lines (First 3 lines only) -->
                                    <div class="space-y-4 text-center">
                                        <?php 
                                        $displayLines = array_slice($bait['baitContent'], 0, 3);
                                        foreach ($displayLines as $line): 
                                        ?>
                                            <div class="group/line relative">
                                                <p class="text-lg lg:text-xl text-slate-700 dark:text-slate-200 leading-loose font-medium transition-colors duration-300">
                                                    <?php echo htmlspecialchars($line); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                        
                                        <?php if (count($bait['baitContent']) > 3): ?>
                                            <div class="text-4xl text-slate-400 dark:text-slate-600">...</div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Read More Button -->
                                    <div class="mt-6 pt-6 border-t-2 <?php echo $currentClass['borderColor']; ?> space-y-3">
                                        <button onclick="openPoetryModal(<?php echo $index; ?>)" class="w-full px-6 py-4 bg-gradient-to-r <?php echo $currentClass['color']; ?> text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <span>مڪمل پڙهو</span>
                                        </button>
                                        
                                        <?php if (!empty($bait['exercise']) && is_array($bait['exercise'])): ?>
                                            <a href="exercise.php?class=<?php echo $classId; ?>&bait=<?php echo $index; ?>" class="w-full px-6 py-4 bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>مشق ڪريو</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <!-- Hover Effect Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-br <?php echo $currentClass['color']; ?> opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none"></div>
                            </div>
                            
                            <!-- Decorative Shadow -->
                            <div class="absolute inset-0 bg-gradient-to-br <?php echo $currentClass['color']; ?> opacity-20 blur-xl -z-10 scale-95 group-hover:scale-100 transition-transform duration-500"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- Poetry Modals -->
        <?php foreach ($classData as $index => $bait): ?>
            <div id="poetryModal<?php echo $index; ?>" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
                <!-- Background Overlay -->
                <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" onclick="closePoetryModal(<?php echo $index; ?>)"></div>
                
                <!-- Modal Content -->
                <div class="flex min-h-screen items-center justify-center p-4">
                    <div class="relative w-full max-w-4xl transform transition-all">
                        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border-4 <?php echo $currentClass['borderColor']; ?> overflow-hidden">
                            
                            <!-- Modal Header -->
                            <div class="relative bg-gradient-to-br <?php echo $currentClass['color']; ?> p-6 overflow-hidden">
                                <div class="absolute top-0 right-0 text-6xl opacity-20 transform rotate-12"><?php echo $currentClass['emoji']; ?></div>
                                
                                <!-- Close Button -->
                                <button onclick="closePoetryModal(<?php echo $index; ?>)" class="absolute top-4 left-4 w-10 h-10 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/50 hover:bg-white/40 transition-all">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                
                                <!-- Title -->
                                <h3 class="text-3xl lg:text-4xl font-bold text-white text-center leading-relaxed drop-shadow-md">
                                    <?php echo htmlspecialchars($bait['baitTitle']); ?>
                                </h3>
                                
                                <!-- Author Badge -->
                                <!-- <?php if (!empty($bait['author'])): ?>
                                    <div class="mt-4 text-center">
                                        <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30 text-white text-sm">
                                            ✍️ <?php echo htmlspecialchars($bait['author']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?> -->
                            </div>
                            
                            <!-- Modal Body -->
                            <div class="p-8 max-h-[60vh] overflow-y-auto">
                                <!-- Full Poetry Content - Centered -->
                                <div class="space-y-4 text-center">
                                    <?php foreach ($bait['baitContent'] as $line): ?>
                                        <p class="text-lg lg:text-2xl text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                                            <?php echo htmlspecialchars($line); ?>
                                        </p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Modal Footer with Audio Player -->
                            <?php if (!empty($bait['audioPath'])): ?>
                                <div class="p-6 border-t-2 <?php echo $currentClass['borderColor']; ?> bg-slate-50 dark:bg-slate-900">
                                    <audio id="audioPlayer<?php echo $index; ?>" class="hidden">
                                        <source src="<?php echo htmlspecialchars(ASSETS_URL . $bait['audioPath']); ?>" type="audio/mpeg">
                                    </audio>
                                    
                                    <!-- Play Button (Initial State) -->
                                    <button id="playBtn<?php echo $index; ?>" onclick="startAudio(<?php echo $index; ?>)" class="w-full px-6 py-4 bg-gradient-to-r <?php echo $currentClass['color']; ?> text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/>
                                        </svg>
                                        <span>آواز ٻڌو</span>
                                    </button>
                                    
                                    <!-- Control Buttons (Hidden Initially) -->
                                    <div id="controlBtns<?php echo $index; ?>" class="hidden grid grid-cols-2 gap-3">
                                        <!-- Pause/Resume Button -->
                                        <button id="pauseBtn<?php echo $index; ?>" onclick="togglePause(<?php echo $index; ?>)" class="px-6 py-4 bg-gradient-to-r from-amber-400 to-orange-400 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                            <svg id="pauseIcon<?php echo $index; ?>" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z"/>
                                            </svg>
                                            <svg id="resumeIcon<?php echo $index; ?>" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/>
                                            </svg>
                                            <span id="pauseText<?php echo $index; ?>">رڪايو</span>
                                        </button>
                                        
                                        <!-- Stop Button -->
                                        <button onclick="stopAudio(<?php echo $index; ?>)" class="px-6 py-4 bg-gradient-to-r from-red-400 to-rose-400 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>بند ڪريو</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <!-- Fun Learning Section -->
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto bg-gradient-to-br <?php echo $currentClass['color']; ?> rounded-3xl p-8 lg:p-12 text-white shadow-2xl">
                <div class="text-center">
                    <div class="text-6xl mb-6 animate-bounce">🎉</div>
                    <h3 class="text-3xl lg:text-4xl font-bold mb-4">
                        شاباس! توهان شاندار آهيو!
                    </h3>
                    <p class="text-xl mb-8 opacity-90">
                        سنڌي شاعري سکڻ ۾ مزو اچي رهيو آهي؟
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <?php if ($classId > 1): ?>
                            <a href="class.php?id=<?php echo $classId - 1; ?>" 
                               class="px-8 py-4 bg-white/20 backdrop-blur-lg hover:bg-white/30 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg border-2 border-white/40 flex items-center gap-2">
                                <span>←</span>
                                <span>پوئين ڪلاس</span>
                            </a>
                        <?php endif; ?>
                        <a href="index.php" 
                           class="px-8 py-4 bg-white text-<?php echo str_replace('text-', '', $currentClass['textColor']); ?> hover:shadow-xl rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center gap-2">
                            <span>🏠</span>
                            <span>گهر واپس</span>
                        </a>
                        <?php if ($classId < 5): ?>
                            <a href="class.php?id=<?php echo $classId + 1; ?>" 
                               class="px-8 py-4 bg-white/20 backdrop-blur-lg hover:bg-white/30 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg border-2 border-white/40 flex items-center gap-2">
                                <span>اڳتي وڌو</span>
                                <span>→</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Floating Animation Script -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fade-in 0.6s ease-out;
            }
        </style>
        
        <script>
            // Open Poetry Modal
            function openPoetryModal(index) {
                const modal = document.getElementById('poetryModal' + index);
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            // Close Poetry Modal
            function closePoetryModal(index) {
                const modal = document.getElementById('poetryModal' + index);
                const audio = document.getElementById('audioPlayer' + index);
                
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
                
                // Stop audio if playing
                if (audio && !audio.paused) {
                    stopAudio(index);
                }
            }
            
            // Start Audio - Play from beginning
            function startAudio(index) {
                const audio = document.getElementById('audioPlayer' + index);
                const playBtn = document.getElementById('playBtn' + index);
                const controlBtns = document.getElementById('controlBtns' + index);
                
                if (!audio) return;
                
                // Reset audio to beginning
                audio.currentTime = 0;
                audio.play();
                
                // Hide play button, show control buttons
                playBtn.classList.add('hidden');
                controlBtns.classList.remove('hidden');
                
                // Reset pause button state
                resetPauseButton(index);
                
                // Auto-reset when audio ends
                audio.onended = function() {
                    stopAudio(index);
                };
            }
            
            // Toggle Pause/Resume
            function togglePause(index) {
                const audio = document.getElementById('audioPlayer' + index);
                const pauseIcon = document.getElementById('pauseIcon' + index);
                const resumeIcon = document.getElementById('resumeIcon' + index);
                const pauseText = document.getElementById('pauseText' + index);
                
                if (!audio) return;
                
                if (audio.paused) {
                    // Resume
                    audio.play();
                    pauseIcon.classList.remove('hidden');
                    resumeIcon.classList.add('hidden');
                    pauseText.textContent = 'رڪايو';
                } else {
                    // Pause
                    audio.pause();
                    pauseIcon.classList.add('hidden');
                    resumeIcon.classList.remove('hidden');
                    pauseText.textContent = 'جاري رکو';
                }
            }
            
            // Stop Audio - Reset everything
            function stopAudio(index) {
                const audio = document.getElementById('audioPlayer' + index);
                const playBtn = document.getElementById('playBtn' + index);
                const controlBtns = document.getElementById('controlBtns' + index);
                
                if (!audio) return;
                
                // Stop and reset audio
                audio.pause();
                audio.currentTime = 0;
                
                // Show play button, hide control buttons
                playBtn.classList.remove('hidden');
                controlBtns.classList.add('hidden');
                
                // Reset pause button state
                resetPauseButton(index);
            }
            
            // Reset Pause Button to initial state
            function resetPauseButton(index) {
                const pauseIcon = document.getElementById('pauseIcon' + index);
                const resumeIcon = document.getElementById('resumeIcon' + index);
                const pauseText = document.getElementById('pauseText' + index);
                
                pauseIcon.classList.remove('hidden');
                resumeIcon.classList.add('hidden');
                pauseText.textContent = 'رڪايو';
            }
            
            // Close modal on Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const modals = document.querySelectorAll('[id^="poetryModal"]');
                    modals.forEach((modal, index) => {
                        if (!modal.classList.contains('hidden')) {
                            closePoetryModal(index);
                        }
                    });
                }
            });
        </script>
        
        <?php
    }
]);
?>
