<?php
/**
 * Stories Page - Children's Sindhi Stories
 * Interactive story reading platform with moral lessons
 */

// Include necessary files
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';
require_once __DIR__ . '/../components/splash.php';

// Load stories data
$storiesData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/stories/stories.json'), true);
$stories = $storiesData['stories'] ?? [];
$categories = $storiesData['categories'] ?? [];

// Page configuration
layout([
    'title' => getPageTitle('ٻاراڻيون آکاڻيُون - Sindhi Stories'),
    'meta' => [
        'title' => 'ٻاراڻيون آکاڻيُون | Children\'s Sindhi Stories',
        'description' => 'مزيدار، تعليمي ۽ سبق ڏيندڙ آکاڻيُون - Educational moral stories for children in Sindhi',
        'keywords' => 'sindhi stories, آکاڻيُون, moral stories, children stories, ڪهاڻيون, sindhi kahaniyan',
        'author' => 'Sindhi Stories Team',
        'type' => 'website',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($stories, $categories) {
    ?>
    
    <!-- Hero Section with Fun Character -->
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 dark:from-slate-800 dark:via-purple-900/20 dark:to-slate-800">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 text-6xl animate-bounce opacity-20">📚</div>
            <div class="absolute top-40 right-20 text-5xl animate-pulse opacity-20">🌟</div>
            <div class="absolute bottom-20 left-20 text-5xl animate-bounce opacity-20">✨</div>
            <div class="absolute bottom-40 right-40 text-6xl animate-pulse opacity-20">🎭</div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center space-y-6 sm:space-y-8">
                <!-- Fun Character -->
                <div class="inline-block animate-bounce">
                    <div class="text-8xl sm:text-9xl drop-shadow-2xl">📖</div>
                </div>
                
                <!-- Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 dark:from-purple-400 dark:via-pink-400 dark:to-blue-400 bg-clip-text text-transparent leading-tight">
                    ٻاراڻيون آکاڻيُون
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl sm:text-2xl lg:text-3xl text-slate-700 dark:text-slate-300 font-medium max-w-3xl mx-auto" dir="rtl">
                    مزيدار، تعليمي ۽ سبق ڏيندڙ آکاڻيُون
                </p>
                
                <!-- Fun Badges -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                    <span class="px-4 sm:px-6 py-2 sm:py-3 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-full text-base sm:text-lg font-semibold text-purple-600 dark:text-purple-400 border-2 border-purple-200 dark:border-purple-800">
                        <?php echo count($stories); ?> آکاڻيُون
                    </span>
                    <span class="px-4 sm:px-6 py-2 sm:py-3 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-full text-base sm:text-lg font-semibold text-pink-600 dark:text-pink-400 border-2 border-pink-200 dark:border-pink-800">
                        اخلاقي سبق
                    </span>
                    <span class="px-4 sm:px-6 py-2 sm:py-3 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-full text-base sm:text-lg font-semibold text-blue-600 dark:text-blue-400 border-2 border-blue-200 dark:border-blue-800">
                        تفريحي
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 sm:py-16 bg-gradient-to-b from-white to-slate-50 dark:from-slate-900 dark:to-slate-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-center mb-8 sm:mb-12 bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent" dir="rtl">
                📚 آکاڻين جا قسم
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 max-w-5xl mx-auto">
                <?php foreach ($categories as $category): ?>
                    <div class="group bg-white dark:bg-slate-800 rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-<?php echo $category['color']; ?>-200 dark:border-<?php echo $category['color']; ?>-800">
                        <div class="text-center space-y-2 sm:space-y-3">
                            <div class="text-4xl sm:text-5xl group-hover:scale-125 transition-transform duration-300">
                                <?php echo $category['emoji']; ?>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-<?php echo $category['color']; ?>-600 dark:text-<?php echo $category['color']; ?>-400" dir="rtl">
                                <?php echo $category['name']; ?>
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                                <?php echo $category['nameEnglish']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Stories Grid Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-slate-50 to-white dark:from-slate-800 dark:to-slate-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-center mb-8 sm:mb-12 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent" dir="rtl">
                ✨ آکاڻيُون پڙهو
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 max-w-7xl mx-auto">
                <?php foreach ($stories as $story): ?>
                    <div class="group bg-gradient-to-br from-white to-slate-50 dark:from-slate-800 dark:to-slate-900 rounded-3xl p-6 sm:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-slate-200 dark:border-slate-700 cursor-pointer" 
                         onclick="openStoryModal('<?php echo $story['id']; ?>')">
                        
                        <!-- Story Header -->
                        <div class="flex items-start gap-4 sm:gap-6 mb-6">
                            <div class="text-5xl sm:text-6xl group-hover:scale-125 transition-transform duration-300 flex-shrink-0">
                                <?php echo $story['emoji']; ?>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 dark:text-slate-100 mb-2" dir="rtl">
                                    <?php echo $story['title']; ?>
                                </h3>
                                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-400">
                                    <?php echo $story['titleEnglish']; ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Moral -->
                        <div class="bg-gradient-to-r <?php echo $story['gradient']; ?> bg-opacity-10 dark:bg-opacity-20 rounded-2xl p-4 sm:p-5 mb-6">
                            <p class="text-lg sm:text-xl font-semibold text-<?php echo $story['color']; ?>-800 dark:text-<?php echo $story['color']; ?>-300" dir="rtl">
                                💡 <?php echo $story['moral']; ?>
                            </p>
                        </div>
                        
                        <!-- Story Preview -->
                        <p class="text-base sm:text-lg text-slate-700 dark:text-slate-300 mb-6 line-clamp-2" dir="rtl">
                            <?php echo $story['content'][0]; ?>
                        </p>
                        
                        <!-- Story Meta -->
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <span class="px-4 py-2 bg-gradient-to-r <?php echo $story['gradient']; ?> text-white rounded-full text-sm font-semibold">
                                <?php echo $story['difficulty']; ?>
                            </span>
                            <span class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-full text-sm font-semibold flex items-center gap-2">
                                ⏱️ <?php echo $story['time']; ?>
                            </span>
                            <span class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-full text-sm font-semibold flex items-center gap-2">
                                👦 <?php echo $story['ageGroup']; ?>
                            </span>
                        </div>
                        
                        <!-- Read Button -->
                        <button class="w-full bg-gradient-to-r <?php echo $story['gradient']; ?> text-white font-bold py-4 px-6 rounded-2xl hover:shadow-xl transition-all duration-300 hover:scale-105 text-lg">
                            📖 پڙهو - Read Story
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Story Modal -->
    <div id="storyModal" class="hidden fixed inset-0 bg-black/60 dark:bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 animate-fade-in">
        <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-5xl w-full max-h-[90vh] overflow-hidden shadow-2xl animate-scale-in">
            <!-- Modal Header -->
            <div id="modalHeader" class="sticky top-0 z-10 bg-gradient-to-r from-purple-500 to-pink-500 p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-3">
                            <span id="modalEmoji" class="text-5xl sm:text-6xl"></span>
                            <div>
                                <h2 id="modalTitle" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white" dir="rtl"></h2>
                                <p id="modalTitleEnglish" class="text-lg sm:text-xl text-white/90"></p>
                            </div>
                        </div>
                        <div id="modalMoral" class="bg-white/20 backdrop-blur-sm rounded-2xl p-4">
                            <p class="text-lg sm:text-xl font-semibold text-white" dir="rtl"></p>
                        </div>
                    </div>
                    <button onclick="closeStoryModal()" class="text-white hover:bg-white/20 rounded-full p-2 transition-all duration-300 flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Modal Content -->
            <div id="modalContent" class="overflow-y-auto p-6 sm:p-8 space-y-6" style="max-height: calc(90vh - 250px);">
                <!-- Story paragraphs will be loaded here -->
            </div>
            
            <!-- Modal Footer -->
            <div class="sticky bottom-0 bg-gradient-to-t from-white to-transparent dark:from-slate-800 dark:to-transparent p-6 border-t border-slate-200 dark:border-slate-700">
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <button onclick="closeStoryModal()" class="px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-slate-500 to-slate-600 text-white font-bold rounded-2xl hover:shadow-xl transition-all duration-300 hover:scale-105 text-base sm:text-lg">
                        بند ڪريو - Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Stories data
        const storiesData = <?php echo json_encode($stories); ?>;
        
        // Open story modal
        function openStoryModal(storyId) {
            const story = storiesData.find(s => s.id === storyId);
            if (!story) return;
            
            // Set modal header
            document.getElementById('modalEmoji').textContent = story.emoji;
            document.getElementById('modalTitle').textContent = story.title;
            document.getElementById('modalTitleEnglish').textContent = story.titleEnglish;
            document.getElementById('modalMoral').innerHTML = `<p class="text-lg sm:text-xl font-semibold text-white" dir="rtl">💡 ${story.moral}</p>`;
            
            // Set gradient color for header
            const headerColors = {
                'emerald': 'from-emerald-500 to-green-500',
                'amber': 'from-amber-500 to-orange-500',
                'purple': 'from-purple-500 to-pink-500',
                'blue': 'from-blue-500 to-indigo-500'
            };
            document.getElementById('modalHeader').className = `sticky top-0 z-10 bg-gradient-to-r ${headerColors[story.color] || 'from-purple-500 to-pink-500'} p-6 sm:p-8`;
            
            // Create story content
            const contentDiv = document.getElementById('modalContent');
            contentDiv.innerHTML = '';
            
            story.content.forEach((paragraph, index) => {
                const p = document.createElement('div');
                p.className = 'bg-gradient-to-br from-slate-50 to-white dark:from-slate-700 dark:to-slate-800 rounded-2xl p-6 sm:p-8 border-2 border-slate-200 dark:border-slate-600 hover:shadow-lg transition-all duration-300';
                p.innerHTML = `<p class="text-lg sm:text-xl lg:text-2xl leading-relaxed text-slate-800 dark:text-slate-100" dir="rtl">${paragraph}</p>`;
                contentDiv.appendChild(p);
            });
            
            // Add final moral lesson card
            const moralCard = document.createElement('div');
            moralCard.className = `bg-gradient-to-r ${story.gradient} bg-opacity-20 rounded-2xl p-6 sm:p-8 border-2 border-${story.color}-300 dark:border-${story.color}-700`;
            moralCard.innerHTML = `
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-4xl">${story.emoji}</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-${story.color}-800 dark:text-${story.color}-300" dir="rtl">سبق</h3>
                </div>
                <p class="text-lg sm:text-xl lg:text-2xl font-semibold text-${story.color}-800 dark:text-${story.color}-300" dir="rtl">${story.moral}</p>
                <p class="text-base sm:text-lg text-${story.color}-700 dark:text-${story.color}-400 mt-2">${story.moralEnglish}</p>
            `;
            contentDiv.appendChild(moralCard);
            
            // Show modal
            document.getElementById('storyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close story modal
        function closeStoryModal() {
            document.getElementById('storyModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeStoryModal();
            }
        });
        
        // Close modal on outside click
        document.getElementById('storyModal').addEventListener('click', (e) => {
            if (e.target.id === 'storyModal') {
                closeStoryModal();
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes scale-in {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
        
        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <?php
    }
]);
?>
