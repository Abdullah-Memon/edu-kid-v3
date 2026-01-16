<?php
/**
 * Button Component
 * Reusable button with various styles using Tailwind CSS
 * 
 * Usage: 
 * renderButton([
 *     'text' => 'Click Me',
 *     'variant' => 'primary',
 *     'size' => 'md',
 *     'onclick' => 'handleClick()'
 * ]);
 */

function renderButton($config = []) {
    $text = $config['text'] ?? 'Button';
    $variant = $config['variant'] ?? 'primary';
    $size = $config['size'] ?? 'md';
    $type = $config['type'] ?? 'button';
    $onclick = $config['onclick'] ?? '';
    $id = $config['id'] ?? '';
    $class = $config['class'] ?? '';
    $disabled = $config['disabled'] ?? false;
    $icon = $config['icon'] ?? '';
    $iconPosition = $config['iconPosition'] ?? 'left';
    
    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    // Size classes
    $sizeClasses = [
        'xs' => 'px-3 py-1.5 text-sm',
        'sm' => 'px-4 py-2 text-base',
        'md' => 'px-6 py-3 text-lg',
        'lg' => 'px-8 py-4 text-xl',
        'xl' => 'px-10 py-5 text-2xl'
    ];
    
    // Variant classes
    $variantClasses = [
        'primary' => 'bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white shadow-lg hover:shadow-xl hover:scale-105 focus:ring-indigo-300 dark:focus:ring-indigo-800',
        'secondary' => 'bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-100 shadow-md hover:shadow-lg hover:scale-105 focus:ring-slate-300 dark:focus:ring-slate-600',
        'success' => 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white shadow-lg hover:shadow-xl hover:scale-105 focus:ring-green-300 dark:focus:ring-green-800',
        'danger' => 'bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white shadow-lg hover:shadow-xl hover:scale-105 focus:ring-red-300 dark:focus:ring-red-800',
        'warning' => 'bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-white shadow-lg hover:shadow-xl hover:scale-105 focus:ring-yellow-300 dark:focus:ring-yellow-800',
        'glass' => 'bg-white/30 dark:bg-slate-800/30 backdrop-blur-xl border border-white/40 dark:border-slate-600/40 hover:bg-white/50 dark:hover:bg-slate-800/50 text-slate-800 dark:text-slate-100 shadow-lg hover:shadow-xl hover:scale-105',
        'outline' => 'border-2 border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:scale-105'
    ];
    
    $buttonClasses = implode(' ', [
        $baseClasses,
        $sizeClasses[$size] ?? $sizeClasses['md'],
        $variantClasses[$variant] ?? $variantClasses['primary'],
        $class
    ]);
    
    $attributes = [];
    if ($id) $attributes[] = "id=\"{$id}\"";
    if ($onclick) $attributes[] = "onclick=\"{$onclick}\"";
    if ($disabled) $attributes[] = 'disabled';
    $attributes[] = "type=\"{$type}\"";
    $attributes[] = "class=\"{$buttonClasses}\"";
    
    ?>
    <button <?php echo implode(' ', $attributes); ?>>
        <?php if ($icon && $iconPosition === 'left'): ?>
            <span class="mr-2 rtl:ml-2 rtl:mr-0"><?php echo $icon; ?></span>
        <?php endif; ?>
        
        <span><?php echo sanitize($text); ?></span>
        
        <?php if ($icon && $iconPosition === 'right'): ?>
            <span class="ml-2 rtl:mr-2 rtl:ml-0"><?php echo $icon; ?></span>
        <?php endif; ?>
    </button>
    <?php
}
