<?php
/**
 * Hero Section Component
 * Reusable hero section for pages
 */

function renderHero($config = []) {
    $title = $config['title'] ?? '';
    $subtitle = $config['subtitle'] ?? '';
    $icon = $config['icon'] ?? '🎓';
    $description = $config['description'] ?? '';
    $buttons = $config['buttons'] ?? [];
    $class = $config['class'] ?? '';
    ?>
    
    <section class="container mx-auto px-4 py-8 lg:py-16 <?php echo $class; ?>">
        <div class="text-center">
            <!-- Icon -->
            <?php if ($icon): ?>
            <div class="text-7xl sm:text-8xl lg:text-9xl mb-6 animate-bounce">
                <?php echo $icon; ?>
            </div>
            <?php endif; ?>
            
            <!-- Title -->
            <?php if ($title): ?>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400 mb-4">
                <?php echo sanitize($title); ?>
            </h1>
            <?php endif; ?>
            
            <!-- Subtitle -->
            <?php if ($subtitle): ?>
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-indigo-700 dark:text-indigo-300 mb-6">
                <?php echo sanitize($subtitle); ?>
            </h2>
            <?php endif; ?>
            
            <!-- Description -->
            <?php if ($description): ?>
            <p class="text-lg sm:text-xl text-slate-600 dark:text-slate-300 mb-8 max-w-3xl mx-auto">
                <?php echo sanitize($description); ?>
            </p>
            <?php endif; ?>
            
            <!-- Buttons -->
            <?php if (!empty($buttons)): ?>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <?php 
                foreach ($buttons as $button) {
                    require_once __DIR__ . '/button.php';
                    renderButton($button);
                }
                ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
    <?php
}

/**
 * Section Header Component
 * Reusable section header with title and optional subtitle
 */
function renderSectionHeader($config = []) {
    $title = $config['title'] ?? '';
    $subtitle = $config['subtitle'] ?? '';
    $icon = $config['icon'] ?? '';
    $class = $config['class'] ?? 'mb-8';
    ?>
    
    <div class="text-center <?php echo $class; ?>">
        <?php if ($title): ?>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-indigo-800 dark:text-indigo-200 mb-4">
            <?php if ($icon): ?>
            <span class="inline-block"><?php echo $icon; ?></span>
            <?php endif; ?>
            <?php echo sanitize($title); ?>
            <?php if ($icon): ?>
            <span class="inline-block"><?php echo $icon; ?></span>
            <?php endif; ?>
        </h2>
        <?php endif; ?>
        
        <?php if ($subtitle): ?>
        <p class="text-xl text-slate-600 dark:text-slate-300">
            <?php echo sanitize($subtitle); ?>
        </p>
        <?php endif; ?>
    </div>
    
    <?php
}

/**
 * Grid Container Component
 * Reusable grid layout with responsive columns
 */
function renderGrid($config = []) {
    $items = $config['items'] ?? [];
    $cols = $config['cols'] ?? [
        'sm' => 1,
        'md' => 2,
        'lg' => 3,
        'xl' => 4
    ];
    $gap = $config['gap'] ?? 6;
    $class = $config['class'] ?? '';
    
    $gridClasses = "grid gap-{$gap} {$class}";
    $gridClasses .= " grid-cols-{$cols['sm']}";
    if (isset($cols['md'])) $gridClasses .= " md:grid-cols-{$cols['md']}";
    if (isset($cols['lg'])) $gridClasses .= " lg:grid-cols-{$cols['lg']}";
    if (isset($cols['xl'])) $gridClasses .= " xl:grid-cols-{$cols['xl']}";
    ?>
    
    <div class="<?php echo $gridClasses; ?>">
        <?php echo $items; ?>
    </div>
    
    <?php
}

/**
 * Loading Spinner Component
 */
function renderLoadingSpinner($config = []) {
    $text = $config['text'] ?? 'Loading...';
    $size = $config['size'] ?? 'md'; // sm, md, lg
    
    $sizeClasses = [
        'sm' => 'w-8 h-8',
        'md' => 'w-12 h-12',
        'lg' => 'w-16 h-16'
    ];
    
    $spinnerSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    ?>
    
    <div class="flex flex-col items-center justify-center p-8">
        <div class="<?php echo $spinnerSize; ?> border-4 border-indigo-200 dark:border-indigo-800 border-t-indigo-600 dark:border-t-indigo-400 rounded-full animate-spin"></div>
        <?php if ($text): ?>
        <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">
            <?php echo sanitize($text); ?>
        </p>
        <?php endif; ?>
    </div>
    
    <?php
}

/**
 * Badge Component
 */
function renderBadge($config = []) {
    $text = $config['text'] ?? '';
    $variant = $config['variant'] ?? 'default';
    $size = $config['size'] ?? 'md';
    
    $variantClasses = [
        'default' => 'bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200',
        'primary' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200',
        'success' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200',
        'danger' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200'
    ];
    
    $sizeClasses = [
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-3 py-1 text-sm',
        'lg' => 'px-4 py-2 text-base'
    ];
    
    $classes = $variantClasses[$variant] ?? $variantClasses['default'];
    $classes .= ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);
    $classes .= ' inline-flex items-center rounded-full font-semibold';
    ?>
    
    <span class="<?php echo $classes; ?>">
        <?php echo sanitize($text); ?>
    </span>
    
    <?php
}

/**
 * Breadcrumb Component
 */
function renderBreadcrumb($config = []) {
    $items = $config['items'] ?? [];
    ?>
    
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse">
            <?php foreach ($items as $index => $item): ?>
            <li class="inline-flex items-center">
                <?php if ($index > 0): ?>
                <svg class="w-4 h-4 mx-2 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <?php endif; ?>
                
                <?php if (isset($item['link']) && $index < count($items) - 1): ?>
                <a href="<?php echo sanitize($item['link']); ?>" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <?php echo sanitize($item['text']); ?>
                </a>
                <?php else: ?>
                <span class="text-slate-800 dark:text-slate-200 font-semibold">
                    <?php echo sanitize($item['text']); ?>
                </span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    
    <?php
}
