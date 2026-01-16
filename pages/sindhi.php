<?php
/**
 * Sindhi Learning Hub - Main page for Sindhi students
 * Interactive classes, activities, and stories for kids
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load all components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';
require_once __DIR__ . '/../components/card.php';

// Load JSON data
$classesData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/sindhi/classes.json'), true);
// $storiesData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/sindhi/stories.json'), true);
$activitiesData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/sindhi/activities.json'), true);

// Start layout
layout([
    'title' => getPageTitle('سنڌي سکيا - Sindhi Learning Hub'),
    'meta' => [
        'title' => 'سنڌي سکيا جي جادوگر دنيا | Interactive Sindhi Learning for Kids',
        'description' => 'Learn Sindhi language through interactive games, alphabet recognition, word building, and stories. Perfect for kids - classes 1-5.',
        'keywords' => 'sindhi learning, سنڌي سکيا, sindhi alphabet, sindhi for kids, sindhi education, sindhi classes',
        'author' => 'Sindhi Educational Platform Team',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/sindhi-learning-preview.jpg',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($classesData, $activitiesData) {
        ?>
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-12 lg:py-20 bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 text-9xl animate-pulse">📚</div>
                <div class="absolute top-20 right-20 text-7xl animate-pulse">✨</div>
                <div class="absolute bottom-10 left-1/4 text-6xl animate-pulse" style="animation-delay: 0.2s;">🎨</div>
                <div class="absolute bottom-20 right-1/3 text-8xl animate-pulse" style="animation-delay: 0.4s;">🌟</div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center text-white">
                    <!-- Wizard Badge -->
                    <div class="inline-block mb-6 px-8 py-3 bg-white/20 backdrop-blur-lg rounded-full border-2 border-white/40 shadow-xl">
                        <span class="text-6xl" role="img" aria-label="Friendly wizard character">🧙‍♂️</span>
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="text-5xl lg:text-7xl font-bold mb-4 drop-shadow-lg animate-fade-in">
                        سنڌي سکيا جو جادوگر دنيا
                    </h1>
                    <h2 class="text-3xl lg:text-4xl font-semibold mb-6 opacity-90 ltr">
                        Magical World of Sindhi Learning
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-xl lg:text-2xl mb-8 max-w-2xl mx-auto opacity-90">
                        🚀 راند رُوند ۾ سنڌي سِکو! 🚀
                    </p>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-4 mb-8">
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">5</div>
                            <div class="text-sm opacity-90">درجا</div>
                        </div>
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">🎮</div>
                            <div class="text-sm opacity-90">مذيدار راندون</div>
                        </div>
                        <div class="px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-3xl font-bold">📖</div>
                            <div class="text-sm opacity-90">آکاڻيون</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Class Navigation Section -->
        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-center text-indigo-800 dark:text-indigo-200 mb-8">
                📚 سکڻ جا درجا
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <?php foreach ($classesData['classes'] as $class): ?>
                <div class="transform transition-all duration-300 hover:scale-105 cursor-pointer" onclick="openClassModal('<?php echo $class['id']; ?>')">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-indigo-400 dark:hover:border-indigo-500 h-full">
                        <div class="text-center">
                            <div class="text-6xl mb-4 animate-bounce"><?php echo $class['emoji']; ?></div>
                            <h3 class="text-2xl font-bold text-indigo-800 dark:text-indigo-100 mb-2" dir="rtl">
                                <?php echo $class['title']; ?>
                            </h3>
                            <p class="text-base text-slate-600 dark:text-slate-300 mb-3" dir="rtl">
                                <?php echo $class['subtitle']; ?>
                            </p>
                            <div class="bg-gradient-to-r <?php echo $class['color']; ?> bg-opacity-20 rounded-xl p-3 mb-4">
                                <div class="text-sm text-slate-700 dark:text-slate-200" dir="rtl">
                                    <?php echo $class['description']; ?>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="bg-white/60 dark:bg-slate-700/60 px-3 py-1 rounded-full text-indigo-600 dark:text-indigo-400 font-semibold" dir="rtl">
                                    <?php echo $class['difficulty']; ?>
                                </span>
                                <div class="flex gap-1">
                                    <div class="w-2 h-2 bg-indigo-400 rounded-full"></div>
                                    <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                                    <div class="w-2 h-2 bg-slate-300 dark:bg-slate-600 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Learning Activities Section -->
        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-center text-indigo-800 dark:text-indigo-200 mb-8">
                🎯 مذيدار قسم جي سکيا
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($activitiesData['activities'] as $activity): ?>
                <div class="transform transition-all duration-300 hover:scale-105 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>pages/activities.php?id=<?php echo $activity['id']; ?>'">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-purple-400 dark:hover:border-purple-500 h-full">
                        <div class="text-center">
                            <div class="text-7xl mb-4"><?php echo $activity['emoji']; ?></div>
                            <h3 class="text-2xl font-bold text-purple-800 dark:text-purple-100 mb-2" dir="rtl">
                                <?php echo $activity['title']; ?>
                            </h3>
                            <p class="text-base text-slate-600 dark:text-slate-300 mb-3" dir="rtl">
                                <?php echo $activity['subtitle']; ?>
                            </p>
                            <div class="bg-gradient-to-r <?php echo $activity['color']; ?> bg-opacity-20 rounded-xl p-4 mb-4">
                                <p class="text-sm text-slate-700 dark:text-slate-200" dir="rtl">
                                    <?php echo $activity['description']; ?>
                                </p>
                            </div>
                            <button class="w-full px-6 py-3 bg-gradient-to-r <?php echo $activity['color']; ?> text-white rounded-xl font-bold shadow-lg transition-all duration-300 hover:scale-105" dir="rtl">
                                شروع ڪريو 🚀
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Stories Section -->
        <section class="container mx-auto px-4 py-8 pb-16">
            <div class="max-w-7xl mx-auto">
                <div class="relative overflow-hidden rounded-3xl shadow-2xl bg-gradient-to-br from-green-400 via-emerald-400 to-teal-400 aspect-[16/5]">
                    <!-- Background Decorations -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-10 left-10 text-9xl animate-pulse">📚</div>
                        <div class="absolute top-20 right-20 text-7xl animate-pulse" style="animation-delay: 0.2s;">✨</div>
                        <div class="absolute bottom-10 left-1/4 text-8xl animate-pulse" style="animation-delay: 0.4s;">📖</div>
                        <div class="absolute bottom-20 right-1/3 text-6xl animate-pulse" style="animation-delay: 0.6s;">🌟</div>
                    </div>
                    
                    <!-- Content -->
                    <div class="absolute inset-0 z-10 flex items-center justify-between p-6 lg:p-12 gap-6 lg:gap-12">
                        <!-- Left Side: Icon -->
                        <div class="flex-shrink-0">
                            <div class="bg-white/20 backdrop-blur-lg rounded-3xl border-2 border-white/40 shadow-xl p-6 lg:p-8">
                                <span class="text-6xl lg:text-8xl">📚</span>
                            </div>
                        </div>
                        
                        <!-- Middle: Content -->
                        <div class="flex-1 text-white">
                            <h2 class="text-3xl lg:text-5xl font-bold mb-2 lg:mb-3 drop-shadow-lg" dir="rtl">
                                آکاڻين جي دنيا
                            </h2>
                            <p class="text-base lg:text-xl opacity-90 mb-3 lg:mb-4" dir="rtl">
                                دلچسپ ۽ سبق آموز ڪهاڻيون پڙهو - هر ڪهاڻي هڪ نئون سبق!
                            </p>
                            
                            <!-- Stats inline -->
                            <div class="flex flex-wrap gap-3">
                                <div class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30 inline-flex items-center gap-2">
                                    <span class="text-xl">🎯</span>
                                    <span class="text-sm font-semibold">سبق آموز</span>
                                </div>
                                <div class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30 inline-flex items-center gap-2">
                                    <span class="text-xl">⭐</span>
                                    <span class="text-sm font-semibold">دلچسپ</span>
                                </div>
                                <div class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30 inline-flex items-center gap-2">
                                    <span class="text-xl">📖</span>
                                    <span class="text-sm font-semibold">آسان</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side: Button -->
                        <div class="flex-shrink-0">
                            <button onclick="window.location.href='<?php echo BASE_URL; ?>pages/stories.php'" class="inline-flex flex-col items-center gap-2 px-8 py-6 bg-white text-green-600 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 hover:bg-gradient-to-br hover:from-white hover:to-green-50 whitespace-nowrap" dir="rtl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                                <span class="text-base lg:text-lg">ڪهاڻيون پڙهو</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Class Detail Modal -->
        <div id="classModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-lg flex items-center justify-center z-50 p-4">
            <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-indigo-500/20 to-purple-500/20 dark:from-indigo-500/30 dark:to-purple-500/30 p-6 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 id="modalClassTitle" class="text-3xl font-bold text-indigo-800 dark:text-indigo-100 mb-2" dir="rtl"></h2>
                            <p id="modalClassDesc" class="text-lg text-slate-600 dark:text-slate-300" dir="rtl"></p>
                        </div>
                        <button onclick="closeClassModal()" class="text-slate-500 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-400 text-4xl font-bold transition-all duration-300">×</button>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="p-6" id="modalContent">
                    <!-- Content will be dynamically loaded -->
                </div>
            </div>
        </div>

        <script>
            // Classes data for modal
            const classesData = <?php echo json_encode($classesData['classes']); ?>;
            
            // Open class modal
            function openClassModal(classId) {
                const classData = classesData.find(c => c.id === classId);
                if (!classData) return;
                
                document.getElementById('modalClassTitle').textContent = classData.title + ' - ' + classData.subtitle;
                document.getElementById('modalClassDesc').textContent = classData.description;
                
                // Build lessons content
                let lessonsHTML = '<div class="space-y-6">';
                
                // Topics
                lessonsHTML += '<div class="mb-6"><h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-4" dir="rtl">موضوع:</h3><div class="flex flex-wrap gap-3">';
                classData.topics.forEach(topic => {
                    lessonsHTML += `<span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 px-4 py-2 rounded-full font-semibold" dir="rtl">${topic}</span>`;
                });
                lessonsHTML += '</div></div>';
                
                // Lessons
                lessonsHTML += '<h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-4" dir="rtl">سبق:</h3>';
                classData.lessons.forEach((lesson, index) => {
                    lessonsHTML += `
                        <div class="bg-gradient-to-r ${classData.color} bg-opacity-10 rounded-2xl p-6 mb-4">
                            <h4 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-3" dir="rtl">
                                ${index + 1}. ${lesson.title}
                            </h4>
                            <p class="text-base text-slate-700 dark:text-slate-300 mb-4" dir="rtl">
                                ${lesson.content}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                ${lesson.exercises.map(ex => `<span class="bg-white/60 dark:bg-slate-700/60 px-3 py-1 rounded-full text-sm font-medium" dir="rtl">${ex}</span>`).join('')}
                            </div>
                        </div>
                    `;
                });
                
                // Achievements
                lessonsHTML += '<h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-4 mt-6" dir="rtl">حاصلات:</h3><div class="flex flex-wrap gap-3">';
                classData.achievements.forEach(achievement => {
                    lessonsHTML += `<span class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 px-4 py-2 rounded-full font-semibold flex items-center gap-2" dir="rtl">🏆 ${achievement}</span>`;
                });
                lessonsHTML += '</div>';
                
                // Add Visit Class Button
                lessonsHTML += `
                    <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <button onclick="window.location.href='class.php?id=${classData.id.replace('class', '')}'" class="w-full px-8 py-4 bg-gradient-to-r ${classData.color} text-white rounded-2xl font-bold text-xl shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl flex items-center justify-center gap-3">
                            ڪلاس شروع ڪريو
                        </button>
                    </div>
                `;
                
                lessonsHTML += '</div>';
                
                document.getElementById('modalContent').innerHTML = lessonsHTML;
                document.getElementById('classModal').classList.remove('hidden');
            }
            
            // Close class modal
            function closeClassModal() {
                document.getElementById('classModal').classList.add('hidden');
            }
            
            // Close modal when clicking outside
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('classModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeClassModal();
                    }
                });
                
                // Close modal on escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeClassModal();
                    }
                });
            });
        </script>

        <?php
    }
]);
?>
