<?php
/**
 * Family Tree Page - Interactive Family Relations Learning
 * Sindhi Kids Education Platform
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load all components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';
require_once __DIR__ . '/../components/card.php';

// Load JSON data files
$paternalData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/family/paternal.json'), true);
$maternalData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/family/maternal.json'), true);
$immediateData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/family/immediate.json'), true);
$inlawsData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/family/inlaws.json'), true);
$descendantsData = json_decode(file_get_contents(__DIR__ . '/../assets/Data/family/descendants.json'), true);

// Start layout
layout([
    'title' => getPageTitle('مِٽِين مائِٽين جا نالا - Family Tree'),
    'meta' => [
        'title' => 'Sindhi Family Relations - Learn Family Tree Names | مِٽِين مائِٽين جا نالا',
        'description' => 'Interactive Sindhi family tree learning for kids. Learn all family relation names in Sindhi and English with fun games and activities.',
        'keywords' => 'sindhi family tree, family relations sindhi, mithin maithin, family names sindhi, learn sindhi family',
        'author' => 'Sindhi Educational Platform Team',
        'type' => 'article',
        'image' => SITE_URL . 'assets/images/family-tree-preview.jpg',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($paternalData, $maternalData, $immediateData, $inlawsData, $descendantsData) {
        ?>
        
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-8 lg:py-12">
            <div class="text-center mb-8">
                <div class="text-7xl mb-4 animate-bounce">🌳</div>
                <h1 class="text-4xl lg:text-6xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent dark:from-green-400 dark:to-emerald-400 mb-4">
                    مِٽِين مائِٽين جا نالا
                </h1>
                <h2 class="text-2xl lg:text-3xl font-semibold text-green-700 dark:text-green-300 mb-4">
                    Learn Sindhi Family Tree
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-300 max-w-3xl mx-auto">
                    سنڌيءَ ۾ ڪُٽنب ڀاتِين جا نالا سکو - Learn all family relation names in Sindhi with fun interactive cards!
                </p>
            </div>

            <!-- Search & Filter Section -->
            <div class="max-w-2xl mx-auto mb-12">
                <div class="relative">
                    <input 
                        type="text" 
                        id="familySearch" 
                        placeholder="🔍 Search family member... (ڳولھيو)"
                        class="w-full px-6 py-4 rounded-2xl bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl border-2 border-slate-200 dark:border-slate-600 focus:border-green-500 dark:focus:border-green-400 focus:outline-none text-lg shadow-lg"
                        oninput="searchFamily(this.value)"
                    >
                    <div id="searchResults" class="mt-2 text-center text-sm text-slate-500 dark:text-slate-400"></div>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <div class="bg-gradient-to-br from-pink-500/20 to-rose-500/20 dark:from-pink-500/30 dark:to-rose-500/30 backdrop-blur-xl rounded-xl p-4 text-center">
                        <div class="text-3xl mb-2">👴👵</div>
                        <div class="text-sm text-slate-600 dark:text-slate-300">Ancestors</div>
                        <div class="text-2xl font-bold text-pink-600 dark:text-pink-400" id="ancestorCount">0</div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 dark:from-blue-500/30 dark:to-cyan-500/30 backdrop-blur-xl rounded-xl p-4 text-center">
                        <div class="text-3xl mb-2">👨‍👩‍👧</div>
                        <div class="text-sm text-slate-600 dark:text-slate-300">Immediate</div>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="immediateCount">0</div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500/20 to-violet-500/20 dark:from-purple-500/30 dark:to-violet-500/30 backdrop-blur-xl rounded-xl p-4 text-center">
                        <div class="text-3xl mb-2">🏠</div>
                        <div class="text-sm text-slate-600 dark:text-slate-300">In-laws</div>
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400" id="inlawsCount">0</div>
                    </div>
                    <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 dark:from-green-500/30 dark:to-emerald-500/30 backdrop-blur-xl rounded-xl p-4 text-center">
                        <div class="text-3xl mb-2">👶</div>
                        <div class="text-sm text-slate-600 dark:text-slate-300">Descendants</div>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400" id="descendantCount">0</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Paternal Lineage Section -->
        <section class="container mx-auto px-4 py-8" id="paternal-section">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-indigo-800 dark:text-indigo-200 mb-2">
                    <?php echo $paternalData['icon']; ?> <?php echo $paternalData['title']; ?>
                </h2>
            </div>

            <?php foreach ($paternalData['generations'] as $generation): ?>
            <div class="mb-12" data-category="paternal">
                <h3 class="text-2xl font-bold text-center text-indigo-700 dark:text-indigo-300 mb-6">
                    <?php echo $generation['title']; ?>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($generation['members'] as $member): ?>
                    <div class="family-member-card" data-sindhi="<?php echo htmlspecialchars($member['sindhi']); ?>" data-english="<?php echo htmlspecialchars($member['english']); ?>">
                        <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-indigo-400 dark:hover:border-indigo-500">
                                <div class="text-6xl mb-4 text-center"><?php echo $member['icon']; ?></div>
                                <div class="text-2xl font-bold text-center text-indigo-900 dark:text-indigo-100 mb-2 font-sindhi" dir="rtl">
                                    <?php echo $member['sindhi']; ?>
                                </div>
                                <div class="text-center text-slate-600 dark:text-slate-300">
                                    <?php echo $member['english']; ?>
                                </div>
                                <!-- Audio Button Placeholder -->
                                <button onclick="playAudio('<?php echo htmlspecialchars($member['sindhi']); ?>')" class="mt-4 w-full px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white rounded-xl font-medium text-sm transition-all duration-300">
                                    🔊 Pronunciation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Maternal Lineage Section -->
        <section class="container mx-auto px-4 py-8" id="maternal-section">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-pink-800 dark:text-pink-200 mb-2">
                    <?php echo $maternalData['icon']; ?> <?php echo $maternalData['title']; ?>
                </h2>
            </div>

            <?php foreach ($maternalData['generations'] as $generation): ?>
            <div class="mb-12" data-category="maternal">
                <h3 class="text-2xl font-bold text-center text-pink-700 dark:text-pink-300 mb-6">
                    <?php echo $generation['title']; ?>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($generation['members'] as $member): ?>
                    <div class="family-member-card" data-sindhi="<?php echo htmlspecialchars($member['sindhi']); ?>" data-english="<?php echo htmlspecialchars($member['english']); ?>">
                        <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-pink-400 dark:hover:border-pink-500">
                                <div class="text-6xl mb-4 text-center"><?php echo $member['icon']; ?></div>
                                <div class="text-2xl font-bold text-center text-pink-900 dark:text-pink-100 mb-2 font-sindhi" dir="rtl">
                                    <?php echo $member['sindhi']; ?>
                                </div>
                                <div class="text-center text-slate-600 dark:text-slate-300">
                                    <?php echo $member['english']; ?>
                                </div>
                                <button onclick="playAudio('<?php echo htmlspecialchars($member['sindhi']); ?>')" class="mt-4 w-full px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white rounded-xl font-medium text-sm transition-all duration-300">
                                    🔊 Pronunciation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Immediate Family Section -->
        <section class="container mx-auto px-4 py-8" id="immediate-section">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-blue-800 dark:text-blue-200 mb-2">
                    <?php echo $immediateData['icon']; ?> <?php echo $immediateData['title']; ?>
                </h2>
            </div>

            <?php foreach ($immediateData['categories'] as $category): ?>
            <div class="mb-12" data-category="immediate">
                <h3 class="text-2xl font-bold text-center text-blue-700 dark:text-blue-300 mb-6">
                    <?php echo $category['icon']; ?> <?php echo $category['title']; ?>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($category['members'] as $member): ?>
                    <div class="family-member-card" data-sindhi="<?php echo htmlspecialchars($member['sindhi']); ?>" data-english="<?php echo htmlspecialchars($member['english']); ?>">
                        <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-blue-400 dark:hover:border-blue-500">
                                <div class="text-6xl mb-4 text-center"><?php echo $member['icon']; ?></div>
                                <div class="text-2xl font-bold text-center text-blue-900 dark:text-blue-100 mb-2 font-sindhi" dir="rtl">
                                    <?php echo $member['sindhi']; ?>
                                </div>
                                <div class="text-center text-slate-600 dark:text-slate-300">
                                    <?php echo $member['english']; ?>
                                </div>
                                <button onclick="playAudio('<?php echo htmlspecialchars($member['sindhi']); ?>')" class="mt-4 w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white rounded-xl font-medium text-sm transition-all duration-300">
                                    🔊 Pronunciation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- In-laws Section -->
        <section class="container mx-auto px-4 py-8" id="inlaws-section">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-purple-800 dark:text-purple-200 mb-2">
                    <?php echo $inlawsData['icon']; ?> <?php echo $inlawsData['title']; ?>
                </h2>
            </div>

            <div class="mb-12" data-category="inlaws">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($inlawsData['members'] as $member): ?>
                    <div class="family-member-card" data-sindhi="<?php echo htmlspecialchars($member['sindhi']); ?>" data-english="<?php echo htmlspecialchars($member['english']); ?>">
                        <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-purple-400 dark:hover:border-purple-500">
                                <div class="text-6xl mb-4 text-center"><?php echo $member['icon']; ?></div>
                                <div class="text-2xl font-bold text-center text-purple-900 dark:text-purple-100 mb-2 font-sindhi" dir="rtl">
                                    <?php echo $member['sindhi']; ?>
                                </div>
                                <div class="text-center text-slate-600 dark:text-slate-300">
                                    <?php echo $member['english']; ?>
                                </div>
                                <button onclick="playAudio('<?php echo htmlspecialchars($member['sindhi']); ?>')" class="mt-4 w-full px-4 py-2 bg-gradient-to-r from-purple-500 to-violet-500 hover:from-purple-600 hover:to-violet-600 text-white rounded-xl font-medium text-sm transition-all duration-300">
                                    🔊 Pronunciation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Descendants Section -->
        <section class="container mx-auto px-4 py-8 pb-16" id="descendants-section">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-green-800 dark:text-green-200 mb-2">
                    <?php echo $descendantsData['icon']; ?> <?php echo $descendantsData['title']; ?>
                </h2>
            </div>

            <?php foreach ($descendantsData['generations'] as $generation): ?>
            <div class="mb-12" data-category="descendants">
                <h3 class="text-2xl font-bold text-center text-green-700 dark:text-green-300 mb-6">
                    <?php echo $generation['icon']; ?> <?php echo $generation['title']; ?>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($generation['members'] as $member): ?>
                    <div class="family-member-card" data-sindhi="<?php echo htmlspecialchars($member['sindhi']); ?>" data-english="<?php echo htmlspecialchars($member['english']); ?>">
                        <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-green-400 dark:hover:border-green-500">
                                <div class="text-6xl mb-4 text-center"><?php echo $member['icon']; ?></div>
                                <div class="text-2xl font-bold text-center text-green-900 dark:text-green-100 mb-2 font-sindhi" dir="rtl">
                                    <?php echo $member['sindhi']; ?>
                                </div>
                                <div class="text-center text-slate-600 dark:text-slate-300">
                                    <?php echo $member['english']; ?>
                                </div>
                                <button onclick="playAudio('<?php echo htmlspecialchars($member['sindhi']); ?>')" class="mt-4 w-full px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium text-sm transition-all duration-300">
                                    🔊 Pronunciation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <script>
            // Search functionality
            function searchFamily(query) {
                const searchTerm = query.toLowerCase().trim();
                const cards = document.querySelectorAll('.family-member-card');
                let visibleCount = 0;
                
                cards.forEach(card => {
                    const sindhi = card.dataset.sindhi.toLowerCase();
                    const english = card.dataset.english.toLowerCase();
                    
                    if (searchTerm === '' || sindhi.includes(searchTerm) || english.includes(searchTerm)) {
                        card.style.display = 'block';
                        card.style.opacity = '1';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                        card.style.opacity = '0';
                    }
                });
                
                const resultsDiv = document.getElementById('searchResults');
                if (searchTerm === '') {
                    resultsDiv.textContent = '';
                } else {
                    resultsDiv.textContent = `Found ${visibleCount} family member${visibleCount !== 1 ? 's' : ''}`;
                    resultsDiv.className = visibleCount > 0 
                        ? 'mt-2 text-center text-sm text-green-600 dark:text-green-400 font-medium' 
                        : 'mt-2 text-center text-sm text-red-600 dark:text-red-400 font-medium';
                }
            }

            // Audio playback placeholder
            function playAudio(term) {
                // Placeholder for audio functionality
                console.log('Playing audio for:', term);
                alert(`🔊 Audio for "${term}" will be played here.\n\nAdd audio files to enable this feature!`);
            }

            // Calculate and display counts
            function updateCounts() {
                // Count ancestors (paternal + maternal generations)
                const ancestorCards = document.querySelectorAll('[data-category="paternal"] .family-member-card, [data-category="maternal"] .family-member-card');
                document.getElementById('ancestorCount').textContent = ancestorCards.length;
                
                // Count immediate family
                const immediateCards = document.querySelectorAll('[data-category="immediate"] .family-member-card');
                document.getElementById('immediateCount').textContent = immediateCards.length;
                
                // Count in-laws
                const inlawCards = document.querySelectorAll('[data-category="inlaws"] .family-member-card');
                document.getElementById('inlawsCount').textContent = inlawCards.length;
                
                // Count descendants
                const descendantCards = document.querySelectorAll('[data-category="descendants"] .family-member-card');
                document.getElementById('descendantCount').textContent = descendantCards.length;
            }

            // Initialize counts on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateCounts();
            });
        </script>

        <?php
    }
]);
?>
