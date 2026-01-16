<?php
/**
 * Science Learning Platform - سائنس سکيا
 * Interactive science learning for kids with experiments
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load all components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';

// Load JSON data
$topicsData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/science/topics.json'), true);
$lessonsData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/science/lessons.json'), true);

// Start layout
layout([
    'title' => getPageTitle('سائنس سکيا - Science Learning Platform'),
    'meta' => [
        'title' => 'سائنس سکيا | Interactive Science Learning for Kids',
        'description' => 'Learn science through fun experiments! Biology, plants, human body, weather, space, chemistry, physics, and environment - perfect for kids.',
        'keywords' => 'science learning, سائنس, biology, plants, human body, weather, space, chemistry, physics, environment',
        'author' => 'Science Learning Platform Team',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/science-preview.jpg',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($topicsData, $lessonsData) {
        ?>
        
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-8 lg:py-12">
            <div class="text-center">
                <h1 class="text-4xl lg:text-6xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent dark:from-green-400 dark:to-blue-400 mb-4 animate-fade-in">
                    🔬 سائنس جي حیرت انگیز دنیا! 🔬
                </h1>
                <p class="text-xl lg:text-2xl text-slate-700 dark:text-slate-300 mb-8">
                    🌟 تجربا ڪريو، دريافت ڪريو، سکو! 🌟<br>
                    Explore Science Through Fun Experiments & Discovery
                </p>
                
                <!-- Animated Character -->
                <div class="mb-8 animate-bounce">
                    <div class="text-8xl mb-4" role="img" aria-label="Science explorer character">🧑‍🔬</div>
                    <p class="text-green-700 dark:text-green-300 text-lg font-medium">توهان جو سائنس جو ساٿي!</p>
                </div>
            </div>
        </section>

        <!-- Science Topics Grid -->
        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-center text-green-800 dark:text-green-200 mb-8">
                🌈 سائنس جا موضوع
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <?php foreach ($topicsData as $topic): ?>
                <div class="transform transition-all duration-300 hover:scale-105 cursor-pointer group" onclick="openTopicModal('<?php echo $topic['id']; ?>')">
                    <div class="bg-gradient-to-br <?php echo $topic['gradient']; ?> rounded-3xl p-6 shadow-xl hover:shadow-2xl border-2 border-white/20 dark:border-white/10 h-full backdrop-blur-sm">
                        <div class="text-center">
                            <div class="text-7xl mb-4 transform group-hover:scale-110 transition-transform duration-300">
                                <?php echo $topic['emoji']; ?>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2 drop-shadow-lg" dir="rtl">
                                <?php echo $topic['title']; ?>
                            </h3>
                            <p class="text-base text-white/90 mb-3" dir="rtl">
                                <?php echo $topic['subtitle']; ?>
                            </p>
                            <div class="bg-white/30 backdrop-blur-md rounded-xl p-3 mb-3">
                                <p class="text-sm text-white font-medium" dir="rtl">
                                    <?php echo $topic['description']; ?>
                                </p>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <span class="bg-white/40 backdrop-blur-sm px-3 py-1 rounded-full text-white text-xs font-semibold border border-white/30">
                                    📚 <?php echo $topic['lessons']; ?> سبق
                                </span>
                                <span class="bg-white/40 backdrop-blur-sm px-3 py-1 rounded-full text-white text-xs font-semibold border border-white/30">
                                    📈 <?php echo $topic['difficulty']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Quick Facts Section -->
        <section class="container mx-auto px-4 py-8 mb-12">
            <div class="bg-gradient-to-r from-cyan-400 to-blue-400 dark:from-cyan-600 dark:to-blue-600 rounded-3xl p-8 shadow-2xl">
                <h2 class="text-3xl lg:text-4xl font-bold text-center text-white mb-6">
                    💡 سائنسي حقيقتون
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-4 text-center">
                        <div class="text-4xl mb-2">🌍</div>
                        <p class="text-white text-base font-medium" dir="rtl">ڌرتي 4.5 ارب سال پراڻي</p>
                    </div>
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-4 text-center">
                        <div class="text-4xl mb-2">💧</div>
                        <p class="text-white text-base font-medium" dir="rtl">70% جسم پاڻي آهي</p>
                    </div>
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-4 text-center">
                        <div class="text-4xl mb-2">🌳</div>
                        <p class="text-white text-base font-medium" dir="rtl">ٻوٽا آڪسيجن ٺاهين ٿا</p>
                    </div>
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-4 text-center">
                        <div class="text-4xl mb-2">⚡</div>
                        <p class="text-white text-base font-medium" dir="rtl">روشني تمام تيز آهي!</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Topic Detail Modal -->
        <div id="topicModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeTopicModal(event)">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-5xl w-full max-h-[90vh] overflow-y-auto shadow-2xl" onclick="event.stopPropagation()">
                <div id="modalContent" class="p-8">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>

        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .animate-fade-in {
                animation: fade-in 0.8s ease-out;
            }
            
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            
            .animate-bounce {
                animation: bounce 2s ease-in-out infinite;
            }
            
            /* Smooth scrollbar */
            ::-webkit-scrollbar {
                width: 10px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(203, 213, 225, 0.3);
                border-radius: 10px;
            }
            
            ::-webkit-scrollbar-thumb {
                background: linear-gradient(to bottom, #10b981, #3b82f6);
                border-radius: 10px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(to bottom, #059669, #2563eb);
            }
        </style>

        <script>
            // Data from PHP
            const topicsData = <?php echo json_encode($topicsData); ?>;
            const lessonsData = <?php echo json_encode($lessonsData); ?>;

            function openTopicModal(topicId) {
                const modal = document.getElementById('topicModal');
                const modalContent = document.getElementById('modalContent');
                const topic = topicsData.find(t => t.id === topicId);
                
                if (!topic) return;
                
                // Get lessons for this topic
                const topicLessons = lessonsData.filter(l => l.topic === topicId);
                
                // Build modal content
                let content = `
                    <button onclick="closeTopicModal()" class="float-left mb-4 p-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    
                    <div class="text-center mb-8">
                        <div class="text-8xl mb-4">${topic.emoji}</div>
                        <h2 class="text-4xl font-bold bg-gradient-to-r ${topic.gradient} bg-clip-text text-transparent mb-3" dir="rtl">
                            ${topic.title}
                        </h2>
                        <p class="text-xl text-slate-600 dark:text-slate-300 mb-2" dir="rtl">${topic.subtitle}</p>
                        <p class="text-lg text-slate-500 dark:text-slate-400" dir="rtl">${topic.description}</p>
                    </div>
                    
                    <!-- Topic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gradient-to-br ${topic.gradient} rounded-2xl p-6 text-white text-center">
                            <div class="text-5xl mb-3">📚</div>
                            <h3 class="text-2xl font-bold mb-2">${topic.lessons} سبق</h3>
                            <p class="text-sm opacity-90">سکڻ لاءِ دلچسپ سبق</p>
                        </div>
                        <div class="bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl p-6 text-white text-center">
                            <div class="text-5xl mb-3">🎯</div>
                            <h3 class="text-2xl font-bold mb-2">${topic.difficulty}</h3>
                            <p class="text-sm opacity-90">سکيا جي سطح</p>
                        </div>
                    </div>
                    
                    <!-- Lessons List -->
                    ${topicLessons.length > 0 ? `
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-4" dir="rtl">🎓 سبقن جي فهرست</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            ${topicLessons.map(lesson => `
                                <div class="bg-white dark:bg-slate-700 rounded-xl p-5 shadow-lg hover:shadow-xl transition-shadow border-2 border-slate-200 dark:border-slate-600">
                                    <div class="flex items-start gap-3">
                                        <div class="text-4xl">${lesson.emoji}</div>
                                        <div class="flex-1">
                                            <h4 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2" dir="rtl">
                                                ${lesson.title}
                                            </h4>
                                            <div class="space-y-2">
                                                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-lg p-3">
                                                    <p class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-1">💡 تصورات:</p>
                                                    <ul class="text-xs text-slate-700 dark:text-slate-300 space-y-1">
                                                        ${lesson.concepts.slice(0, 2).map(c => `<li dir="rtl">• ${c}</li>`).join('')}
                                                    </ul>
                                                </div>
                                                ${lesson.examples && lesson.examples.length > 0 ? `
                                                <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-3">
                                                    <p class="text-sm font-semibold text-green-800 dark:text-green-200 mb-1">📝 مثال:</p>
                                                    <p class="text-xs text-slate-700 dark:text-slate-300" dir="rtl">${lesson.examples[0]}</p>
                                                </div>
                                                ` : ''}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    ` : ''}
                    
                    <!-- Learning Outcomes -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 rounded-2xl p-6 mb-6">
                        <h3 class="text-2xl font-bold text-purple-800 dark:text-purple-200 mb-4" dir="rtl">🎯 سکڻ جا فائدا</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✨</span>
                                <span class="text-slate-700 dark:text-slate-300" dir="rtl">بنيادي تصورات سمجهو</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🔬</span>
                                <span class="text-slate-700 dark:text-slate-300" dir="rtl">تجربا ڪري سکو</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🧠</span>
                                <span class="text-slate-700 dark:text-slate-300" dir="rtl">سوچڻ جي صلاحيت وڌايو</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🌟</span>
                                <span class="text-slate-700 dark:text-slate-300" dir="rtl">حقيقي دنيا ۾ استعمال</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button onclick="closeTopicModal()" class="bg-gradient-to-r ${topic.gradient} text-white px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105 transform transition-all shadow-lg">
                            سکڻ شروع ڪريو! 🚀
                        </button>
                    </div>
                `;
                
                modalContent.innerHTML = content;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeTopicModal(event) {
                if (event && event.target.id !== 'topicModal' && event.type === 'click') {
                    return;
                }
                
                const modal = document.getElementById('topicModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }

            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeTopicModal();
                }
            });
        </script>
        
        <?php
    }
]);
