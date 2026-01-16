<?php
/**
 * Card Component
 * Reusable card with glass morphism effect
 * 
 * Usage: 
 * renderCard([
 *     'title' => 'Card Title',
 *     'content' => 'Card content',
 *     'icon' => '📚',
 *     'link' => 'page.php'
 * ]);
 */

function renderCard($config = []) {
    $title = $config['title'] ?? '';
    $content = $config['content'] ?? '';
    $icon = $config['icon'] ?? '';
    $link = $config['link'] ?? '';
    $onclick = $config['onclick'] ?? '';
    $class = $config['class'] ?? '';
    $hoverable = $config['hoverable'] ?? true;
    $gradient = $config['gradient'] ?? 'from-indigo-500/20 to-purple-600/20';
    
    $cardClasses = 'bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-white/40 dark:border-slate-700/40 overflow-hidden transition-all duration-300';
    
    if ($hoverable) {
        $cardClasses .= ' hover:shadow-2xl hover:-translate-y-2 hover:scale-105';
    }
    
    $cardClasses .= ' ' . $class;
    
    $isLink = !empty($link);
    $tag = $isLink ? 'a' : 'div';
    $attributes = [];
    
    if ($isLink) {
        $attributes[] = "href=\"{$link}\"";
    }
    if ($onclick) {
        $attributes[] = "onclick=\"{$onclick}\"";
        $attributes[] = "role=\"button\"";
        $attributes[] = "tabindex=\"0\"";
        $cardClasses .= ' cursor-pointer';
    }
    $attributes[] = "class=\"{$cardClasses}\"";
    
    ?>
    <<?php echo $tag; ?> <?php echo implode(' ', $attributes); ?>>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br <?php echo $gradient; ?> opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <div class="relative p-6 sm:p-8">
            <?php if ($icon): ?>
            <div class="text-6xl sm:text-7xl mb-4 transform transition-transform duration-300 group-hover:scale-110">
                <?php echo $icon; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($title): ?>
            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 dark:text-slate-100 mb-3">
                <?php echo sanitize($title); ?>
            </h3>
            <?php endif; ?>
            
            <?php if ($content): ?>
            <div class="text-lg sm:text-xl text-slate-600 dark:text-slate-300">
                <?php echo $content; ?>
            </div>
            <?php endif; ?>
        </div>
    </<?php echo $tag; ?>>
    <?php
}

/**
 * Glass Card - Enhanced card with more prominent glass effect
 */
function renderGlassCard($config = []) {
    $title = $config['title'] ?? '';
    $content = $config['content'] ?? '';
    $icon = $config['icon'] ?? '';
    $class = $config['class'] ?? '';
    $hoverable = $config['hoverable'] ?? true;
    
    $cardClasses = 'relative bg-white/30 dark:bg-slate-800/30 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 dark:border-slate-600/50 overflow-hidden p-6 sm:p-8 transition-all duration-500';
    
    if ($hoverable) {
        $cardClasses .= ' hover:shadow-3xl hover:-translate-y-3 hover:scale-105 hover:bg-white/40 dark:hover:bg-slate-800/40';
    }
    
    $cardClasses .= ' ' . $class;
    ?>
    
    <div class="<?php echo $cardClasses; ?> group">
        <!-- Shimmer Effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
        
        <div class="relative">
            <?php if ($icon): ?>
            <div class="text-7xl sm:text-8xl mb-6 transform transition-all duration-500 group-hover:scale-125 group-hover:rotate-12">
                <?php echo $icon; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($title): ?>
            <h3 class="text-3xl sm:text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">
                <?php echo sanitize($title); ?>
            </h3>
            <?php endif; ?>
            
            <?php if ($content): ?>
            <div class="text-xl sm:text-2xl text-slate-700 dark:text-slate-200">
                <?php echo $content; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php
}
