<?php
// Load facts data
$factsData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/learn-sindhi/facts.json'), true) ?? [];
?>

<div class="text-center mb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-orange-800 dark:text-orange-200 mb-4">
        💡 Fun Facts About Sindhi
    </h2>
    <p class="text-xl text-slate-600 dark:text-slate-300">
        Discover interesting facts about Sindhi language and culture
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php foreach ($factsData as $index => $fact): ?>
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-50 to-amber-50 dark:from-slate-800 dark:to-slate-700 p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border-2 border-orange-200 dark:border-orange-600">
            <div class="absolute top-4 left-4 text-6xl font-bold text-orange-200 dark:text-orange-900 opacity-50">
                #<?php echo $index + 1; ?>
            </div>
            
            <div class="relative pt-8">
                <div class="text-5xl mb-4"><?php echo $fact['icon']; ?></div>
                <h3 class="text-2xl font-bold text-orange-900 dark:text-orange-200 mb-3">
                    <?php echo htmlspecialchars($fact['title']); ?>
                </h3>
                <p class="text-lg text-slate-700 dark:text-slate-300 leading-relaxed">
                    <?php echo htmlspecialchars($fact['description']); ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
