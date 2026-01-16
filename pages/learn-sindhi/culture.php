<?php
// Load culture data
$cultureData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/learn-sindhi/culture.json'), true) ?? [];
?>

<div class="text-center mb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-rose-800 dark:text-rose-200 mb-4">
        🏛️ Sindhi Culture & Traditions
    </h2>
    <p class="text-xl text-slate-600 dark:text-slate-300">
        Explore the rich heritage of Sindhi culture
    </p>
</div>

<?php foreach ($cultureData as $category): ?>
    <div class="mb-12">
        <h3 class="text-3xl font-bold text-rose-700 dark:text-rose-300 mb-6 text-center">
            <?php echo htmlspecialchars($category['category']); ?>
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($category['items'] as $item): ?>
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-50 to-pink-50 dark:from-slate-800 dark:to-slate-700 p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-rose-200 dark:border-rose-600">
                    <div class="mb-4">
                        <h4 class="text-xl font-bold text-rose-900 dark:text-rose-200 mb-2">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </h4>
                        <p class="text-slate-700 dark:text-slate-300 mb-2">
                            <?php echo htmlspecialchars($item['english']); ?>
                        </p>
                        <p class="text-xl font-bold text-rose-700 dark:text-rose-300 mb-2" dir="rtl">
                            <?php echo htmlspecialchars($item['sindhi']); ?>
                        </p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 italic">
                            <?php echo htmlspecialchars($item['pronunciation']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
