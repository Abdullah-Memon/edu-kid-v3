<?php
/**
 * Footer Component
 * Website footer with links and copyright
 * 
 * Usage: renderFooter();
 */

function renderFooter($config = []) {
    $year = date('Y');
    ?>
    
    <!-- Footer -->
    <footer class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border-t border-slate-200 dark:border-slate-700 mt-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- About Section -->
                <div>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">
                        <?php echo SITE_NAME; ?>
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg">
                        ٻارن لاءِ مفت آن لائين سنڌي سکيا جو پليٽ فارم
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg sm:text-xl font-semibold text-slate-800 dark:text-slate-200 mb-4">
                        فوري لنڪس
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="index.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                گھر
                            </a>
                        </li>
                        <li>
                            <a href="pages/learn-sindhi/" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                سنڌي سکو
                            </a>
                        </li>
                        <li>
                            <a href="sindhi.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                سنڌي
                            </a>
                        </li>
                        <li>
                            <a href="math.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                رياضي
                            </a>
                        </li>
                        <li>
                            <a href="science.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                سائنس
                            </a>
                        </li>
                        <li>
                            <a href="stories.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                ڪهاڻيون
                            </a>
                        </li>
                        <li>
                            <a href="family-tree.php" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg">
                                خانداني وڻ
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Project Documentation -->
                <div>
                    <h4 class="text-lg sm:text-xl font-semibold text-slate-800 dark:text-slate-200 mb-4">
                        دستاويز
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="https://docs.sindh.ai" target="_blank" rel="noopener noreferrer" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base sm:text-lg inline-flex items-center gap-2">
                                پروجيڪٽ دستاويز
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-slate-200 dark:border-slate-700 mt-8 pt-8 text-center">
                <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg">
                    © <?php echo $year; ?> <?php echo SITE_NAME; ?>. <a href="https://www.ambile.pk">عبدالماجد ڀرڳڙي انسٽيٽيوٽ آف لئنگئيج انجنيئرنگ</a>.
                </p>
                <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg">
                   ثقافت، سياحت، نوادرات ۽ آرڪائيوز کاتو، حڪومت سنڌ۔
                </p>

            </div>
        </div>
    </footer>
    
<?php
}
