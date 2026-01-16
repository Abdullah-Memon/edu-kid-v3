<?php
/**
 * Math Learning Platform - رياضي سکيا
 * Interactive math learning for kids with fun exercises
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load all components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';

// Load JSON data
$topicsData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/math/topics.json'), true);
$shapesData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/math/shapes.json'), true);

// Start layout
layout([
    'title' => getPageTitle('رياضي سکيا - Math Learning Platform'),
    'meta' => [
        'title' => 'رياضي سکيا | Interactive Math Learning for Kids',
        'description' => 'Learn math through fun games! Counting, addition, subtraction, multiplication, fractions, and geometry - perfect for kids.',
        'keywords' => 'math learning, رياضي, mathematics for kids, counting, addition, subtraction, multiplication, fractions, geometry',
        'author' => 'Math Learning Platform Team',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/math-preview.jpg',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($topicsData, $shapesData) {
        ?>
        
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-8 lg:py-12">
            <div class="text-center">
                <h1 class="text-4xl lg:text-6xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400 mb-4 animate-fade-in">
                    🧮 رياضي سکيا جي جادوگر دنيا! 🧮
                </h1>
                <p class="text-xl lg:text-2xl text-slate-700 dark:text-slate-300 mb-8">
                    🎯 راند راند ۾ رياضي سکو! 🎯<br>
                    Learn Math Through Fun & Interactive Games
                </p>
                
                <!-- Animated Character -->
                <div class="mb-8 animate-bounce">
                    <div class="text-8xl mb-4" role="img" aria-label="Math genius character">🤓</div>
                    <p class="text-blue-700 dark:text-blue-300 text-lg font-medium">توهان جو رياضي جو دوست!</p>
                </div>
            </div>
        </section>

        <!-- Math Topics Grid -->
        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-center text-blue-800 dark:text-blue-200 mb-8">
                📊 رياضي جا موضوع
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <?php foreach ($topicsData as $topic): ?>
                <div class="transform transition-all duration-300 hover:scale-105 cursor-pointer group" onclick="openTopicModal('<?php echo $topic['id']; ?>')">
                    <div class="bg-gradient-to-br <?php echo $topic['gradient']; ?> rounded-3xl p-8 shadow-xl hover:shadow-2xl border-2 border-white/20 dark:border-white/10 h-full backdrop-blur-sm">
                        <div class="text-center">
                            <div class="text-7xl mb-6 transform group-hover:scale-110 transition-transform duration-300">
                                <?php echo $topic['emoji']; ?>
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-3 drop-shadow-lg" dir="rtl">
                                <?php echo $topic['title']; ?>
                            </h3>
                            <p class="text-lg text-white/90 mb-4" dir="rtl">
                                <?php echo $topic['subtitle']; ?>
                            </p>
                            <div class="bg-white/30 backdrop-blur-md rounded-xl p-4 mb-4">
                                <p class="text-sm text-white font-medium" dir="rtl">
                                    <?php echo $topic['description']; ?>
                                </p>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <span class="bg-white/40 backdrop-blur-sm px-4 py-2 rounded-full text-white text-sm font-semibold border border-white/30">
                                    📈 <?php echo $topic['difficulty']; ?>
                                </span>
                                <span class="bg-white/40 backdrop-blur-sm px-4 py-2 rounded-full text-white text-sm font-semibold border border-white/30">
                                    🎮 <?php echo count($topic['exercises']); ?> Games
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Geometry Shapes Preview Section -->
        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-center text-purple-800 dark:text-purple-200 mb-8">
                🔷 شڪلين جو جادو
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">
                <?php foreach (array_slice($shapesData, 0, 8) as $shape): ?>
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105 text-center">
                    <div class="text-5xl mb-3"><?php echo $shape['emoji']; ?></div>
                    <h4 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2" dir="rtl">
                        <?php echo $shape['name']; ?>
                    </h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        <?php echo $shape['sides']; ?> <?php echo $shape['sides'] == 0 ? 'ڪو ڪنارو ناهي' : ($shape['sides'] == 1 ? 'ڪنارو' : 'ڪنارا'); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Fun Math Facts Section -->
        <section class="container mx-auto px-4 py-8 mb-12">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-400 dark:from-yellow-600 dark:to-orange-600 rounded-3xl p-8 shadow-2xl">
                <h2 class="text-3xl lg:text-4xl font-bold text-center text-white mb-6">
                    💡 مزيدار رياضياتي حقيقتون
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-6 text-center">
                        <div class="text-5xl mb-3">🎯</div>
                        <p class="text-white text-lg font-medium" dir="rtl">رياضي هر جاءِ تي استعمال ٿئي ٿو!</p>
                    </div>
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-6 text-center">
                        <div class="text-5xl mb-3">🌟</div>
                        <p class="text-white text-lg font-medium" dir="rtl">روزانو مشق ڪندا رهو!</p>
                    </div>
                    <div class="bg-white/30 backdrop-blur-md rounded-2xl p-6 text-center">
                        <div class="text-5xl mb-3">🚀</div>
                        <p class="text-white text-lg font-medium" dir="rtl">رياضي سان سکيا مزيدار آهي!</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Topic Detail Modal -->
        <div id="topicModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeTopicModal(event)">
            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl" onclick="event.stopPropagation()">
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
                background: linear-gradient(to bottom, #6366f1, #8b5cf6);
                border-radius: 10px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(to bottom, #4f46e5, #7c3aed);
            }
        </style>

        <script>
            // Topic data from PHP
            const topicsData = <?php echo json_encode($topicsData); ?>;
            const shapesData = <?php echo json_encode($shapesData); ?>;

            function openTopicModal(topicId) {
                const modal = document.getElementById('topicModal');
                const modalContent = document.getElementById('modalContent');
                const topic = topicsData.find(t => t.id === topicId);
                
                if (!topic) return;
                
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
                        <p class="text-xl text-slate-600 dark:text-slate-300" dir="rtl">${topic.subtitle}</p>
                    </div>
                    
                    <!-- Learning Content -->
                    <div class="bg-gradient-to-br ${topic.gradient} rounded-2xl p-6 mb-6 text-white">
                        <h3 class="text-2xl font-bold mb-4" dir="rtl">📖 تعارف</h3>
                        <p class="text-lg leading-relaxed" dir="rtl">${topic.learningContent.introduction}</p>
                    </div>
                    
                    <!-- Tips -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-2xl p-6 mb-6">
                        <h3 class="text-2xl font-bold text-yellow-800 dark:text-yellow-200 mb-4" dir="rtl">💡 مددگار صلاح</h3>
                        <ul class="space-y-2">
                            ${topic.learningContent.tips.map(tip => `
                                <li class="flex items-start gap-3 text-slate-700 dark:text-slate-300">
                                    <span class="text-2xl">✨</span>
                                    <span class="text-lg" dir="rtl">${tip}</span>
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                    
                    <!-- Examples -->
                    <div class="bg-green-50 dark:bg-green-900/30 rounded-2xl p-6 mb-6">
                        <h3 class="text-2xl font-bold text-green-800 dark:text-green-200 mb-4" dir="rtl">📝 مثال</h3>
                        <div class="space-y-2">
                            ${topic.learningContent.examples.map(example => `
                                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 text-center">
                                    <code class="text-2xl font-bold text-blue-600 dark:text-blue-400">${example}</code>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <!-- Exercises -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-indigo-800 dark:text-indigo-200 mb-4" dir="rtl">🎮 راندون ۽ مشقون</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            ${topic.exercises.map((exercise, idx) => `
                                <div class="bg-gradient-to-br ${topic.gradient} rounded-xl p-6 text-white transform hover:scale-105 transition-transform cursor-pointer">
                                    <div class="text-4xl mb-3">${['🎯', '🎨', '📚'][idx] || '🎮'}</div>
                                    <h4 class="text-xl font-bold mb-2" dir="rtl">${exercise.title}</h4>
                                    <p class="text-sm" dir="rtl">${exercise.description}</p>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button onclick="closeTopicModal()" class="bg-gradient-to-r ${topic.gradient} text-white px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105 transform transition-all shadow-lg">
                            شروع ڪريو! 🚀
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
