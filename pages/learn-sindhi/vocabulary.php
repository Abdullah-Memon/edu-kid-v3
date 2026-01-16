<?php
// Load vocabulary data
$vocabularyData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/learn-sindhi/vocabulary.json'), true) ?? [];
?>

<div class="text-center mb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-blue-800 dark:text-blue-200 mb-4">
        📖 Vocabulary Builder
    </h2>
    <p class="text-xl text-slate-600 dark:text-slate-300">
        Expand your Sindhi vocabulary by category
    </p>
</div>

<?php foreach ($vocabularyData as $vocabCategory): ?>
    <div class="mb-12">
        <div class="text-center mb-6">
            <h3 class="text-4xl font-bold text-blue-700 dark:text-blue-300 mb-2">
                <span class="text-5xl mr-3"><?php echo $vocabCategory['icon']; ?></span>
                <?php echo htmlspecialchars($vocabCategory['category']); ?>
            </h3>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <?php foreach ($vocabCategory['words'] as $word): ?>
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-slate-800 dark:to-slate-700 p-4 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border-2 border-blue-200 dark:border-blue-600">
                    <div class="text-center">
                        <div class="text-4xl mb-2"><?php echo $word['icon']; ?></div>
                        <p class="text-lg font-bold text-blue-900 dark:text-blue-200 mb-1">
                            <?php echo htmlspecialchars($word['english']); ?>
                        </p>
                        <p class="text-2xl font-bold text-cyan-700 dark:text-cyan-300 mb-1" dir="rtl">
                            <?php echo htmlspecialchars($word['sindhi']); ?>
                        </p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 italic">
                            <?php echo htmlspecialchars($word['pronunciation']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
