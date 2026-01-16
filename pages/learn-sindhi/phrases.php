<?php
// Load phrases data
$phrasesData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/learn-sindhi/phrases.json'), true) ?? [];
?>

<div class="text-center mb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-indigo-800 dark:text-indigo-200 mb-4">
        💬 Common Phrases
    </h2>
    <p class="text-xl text-slate-600 dark:text-slate-300">
        Learn essential Sindhi phrases for everyday conversation
    </p>
</div>

<?php foreach ($phrasesData as $phraseGroup): ?>
    <div class="mb-12">
        <h3 class="text-3xl font-bold text-purple-700 dark:text-purple-300 mb-6 text-center">
            <?php echo htmlspecialchars($phraseGroup['category']); ?>
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($phraseGroup['phrases'] as $phrase): ?>
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-800 dark:to-slate-700 p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-indigo-200 dark:border-indigo-600">
                    <div class="absolute top-0 right-0 text-6xl opacity-10">💬</div>
                    
                    <div class="relative">
                        <div class="mb-4">
                            <p class="text-xl font-bold text-indigo-900 dark:text-indigo-200 mb-2">
                                <?php echo htmlspecialchars($phrase['english']); ?>
                            </p>
                            <p class="text-3xl font-bold text-purple-700 dark:text-purple-300 mb-2 text-right" dir="rtl">
                                <?php echo htmlspecialchars($phrase['sindhi']); ?>
                            </p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 italic">
                                🔊 <?php echo htmlspecialchars($phrase['pronunciation']); ?>
                            </p>
                        </div>
                        
                        <button class="w-full px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white rounded-xl font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            🔊 Play Audio
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
