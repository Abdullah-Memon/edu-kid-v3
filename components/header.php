<?php
/**
 * Header Component
 * Navigation header with logo, dark mode toggle, and navigation links
 * 
 * Usage: renderHeader(['transparent' => true]);
 */

function renderHeader($config = []) {
    $transparent = $config['transparent'] ?? false;
    $sticky = $config['sticky'] ?? true;
    $currentPage = getCurrentPage();
    
    $navClass = $transparent 
        ? 'bg-white/90 dark:bg-slate-900/90' 
        : 'bg-white/95 dark:bg-slate-900/95';
    
    if ($sticky) {
        $navClass .= ' sticky top-0';
    }
    ?>
    
    <!-- Navigation Header -->
    <nav class="<?php echo $navClass; ?> backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-700/50 shadow-lg z-50 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Logo -->
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <a href="index.php" class="flex items-center space-x-2 rtl:space-x-reverse group">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                            <span class="text-xl sm:text-2xl">📚</span>
                        </div>
                        <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent hidden sm:inline">
                            <?php echo SITE_NAME; ?>
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6 rtl:space-x-reverse">
                    <!-- Home -->
                    <a href="<?php echo BASE_URL; ?>" class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-lg text-lg font-medium transition-colors <?php echo $currentPage === 'index' ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' : ''; ?>">
                        گھر
                    </a>
                    
                    <!-- Learning Dropdown -->
                    <div class="relative group">
                        <button class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-lg text-lg font-medium transition-colors flex items-center space-x-1 rtl:space-x-reverse">
                            <span>سکيا</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="<?php echo BASE_URL; ?>pages/learn-sindhi/" class="block px-4 py-3 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 first:rounded-t-lg text-base">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">🌎</span>
                                    <div>
                                        <div class="font-semibold">Non-Sindhi Students</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">غير سنڌي شاگرد</div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo BASE_URL; ?>pages/sindhi.php" class="block px-4 py-3 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 last:rounded-b-lg text-base">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">📚</span>
                                    <div>
                                        <div class="font-semibold">Sindhi Students</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">سنڌي شاگرد</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <!-- General Section Dropdown -->
                    <div class="relative group">
                        <button class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-lg text-lg font-medium transition-colors flex items-center space-x-1 rtl:space-x-reverse">
                            <span>عام سکيا</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="<?php echo BASE_URL; ?>pages/family-tree.php" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 first:rounded-t-lg text-base">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">🌳</span>
                                    <span>مِٽِين مائِٽين</span>
                                </div>
                            </a>
                            <a href="<?php echo BASE_URL; ?>pages/math.php" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 text-base">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">🧮</span>
                                    <span>رياضي</span>
                                </div>
                            </a>
                            <a href="<?php echo BASE_URL; ?>pages/science.php" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 last:rounded-b-lg text-base">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">🧪</span>
                                    <span>سائنس</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Stories Link -->
                    <a href="<?php echo BASE_URL; ?>pages/stories.php" class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-lg text-lg font-medium transition-colors <?php echo $currentPage === 'stories' ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' : ''; ?>">
                        آکاڻيُون
                    </a>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" class="p-2 sm:p-3 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all duration-300 hover:scale-110" aria-label="Toggle dark mode">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                        </svg>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 block dark:hidden text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuToggle" class="md:hidden p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                        <svg class="w-6 h-6 text-slate-700 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700">
            <div class="px-4 py-3 space-y-2">
                <a href="<?php echo BASE_URL; ?>" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-lg font-medium <?php echo $currentPage === 'index' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : ''; ?>">
                    گھر
                </a>
                
                <!-- Learning Section -->
                <div class="px-4 py-2 text-slate-500 dark:text-slate-400 text-sm font-semibold">سکيا</div>
                <a href="<?php echo BASE_URL; ?>pages/learn-sindhi/" class="block px-6 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-base">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🌎</span>
                        <span>Non-Sindhi Students</span>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>pages/sindhi.php" class="block px-6 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-base">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">📚</span>
                        <span>Sindhi Students</span>
                    </div>
                </a>
                
                <!-- Stories -->
                <a href="<?php echo BASE_URL; ?>pages/stories.php" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-lg font-medium <?php echo $currentPage === 'stories' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : ''; ?>">
                    آکاڻيُون
                </a>
                
                <!-- General Section -->
                <div class="px-4 py-2 text-slate-500 dark:text-slate-400 text-sm font-semibold">عام سکيا</div>
                <a href="<?php echo BASE_URL; ?>pages/family-tree.php" class="block px-6 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-base">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🌳</span>
                        <span>مِٽِين مائِٽين</span>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>pages/math.php" class="block px-6 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-base">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🧮</span>
                        <span>رياضي</span>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>pages/science.php" class="block px-6 py-2 text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg text-base">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🧪</span>
                        <span>سائنس</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>
    
<?php
}
