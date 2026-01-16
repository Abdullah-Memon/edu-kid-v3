<?php
// Load grammar data
$grammarData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/learn-sindhi/grammar.json'), true) ?? [];
?>

<div class="text-center mb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-emerald-800 dark:text-emerald-200 mb-4">
        📝 Grammar Basics
    </h2>
    <p class="text-xl text-slate-600 dark:text-slate-300">
        Master Sindhi grammar fundamentals
    </p>
</div>

<?php foreach ($grammarData as $topic): ?>
    <div class="mb-12">
        <div class="text-center mb-6">
            <h3 class="text-3xl font-bold text-emerald-700 dark:text-emerald-300">
                <?php echo htmlspecialchars($topic['topic']); ?>
            </h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($topic['rules'] as $rule): ?>
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-700 p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border-2 border-emerald-200 dark:border-emerald-600">
                    <div class="mb-4">
                        <h4 class="text-xl font-bold text-emerald-900 dark:text-emerald-200 mb-2">
                            <?php echo htmlspecialchars($rule['title']); ?>
                        </h4>
                        <p class="text-slate-700 dark:text-slate-300 mb-3">
                            <?php echo htmlspecialchars($rule['description']); ?>
                        </p>
                        
                        <?php if (!empty($rule['examples'])): ?>
                            <div class="bg-white dark:bg-slate-900 rounded-xl p-4 space-y-2">
                                <?php foreach ($rule['examples'] as $example): ?>
                                    <div class="border-l-4 border-emerald-500 pl-3">
                                        <p class="text-sm text-emerald-900 dark:text-emerald-200 font-semibold">
                                            <?php echo htmlspecialchars($example['english']); ?>
                                        </p>
                                        <p class="text-lg text-teal-700 dark:text-teal-300 font-bold" dir="rtl">
                                            <?php echo htmlspecialchars($example['sindhi']); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
