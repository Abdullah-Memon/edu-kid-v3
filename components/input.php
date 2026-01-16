<?php
/**
 * Input Component
 * Form input with various types and styles
 * 
 * Usage: 
 * renderInput([
 *     'name' => 'username',
 *     'type' => 'text',
 *     'placeholder' => 'Enter username',
 *     'required' => true
 * ]);
 */

function renderInput($config = []) {
    $name = $config['name'] ?? '';
    $type = $config['type'] ?? 'text';
    $value = $config['value'] ?? '';
    $placeholder = $config['placeholder'] ?? '';
    $label = $config['label'] ?? '';
    $id = $config['id'] ?? ($name ? "input_{$name}" : generateId());
    $class = $config['class'] ?? '';
    $required = $config['required'] ?? false;
    $disabled = $config['disabled'] ?? false;
    $readonly = $config['readonly'] ?? false;
    $pattern = $config['pattern'] ?? '';
    $min = $config['min'] ?? '';
    $max = $config['max'] ?? '';
    $rows = $config['rows'] ?? 4;
    $error = $config['error'] ?? '';
    $helpText = $config['helpText'] ?? '';
    
    $inputClasses = 'w-full px-4 py-3 text-lg rounded-xl border-2 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-offset-2';
    $inputClasses .= ' bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl';
    $inputClasses .= ' border-slate-300 dark:border-slate-600';
    $inputClasses .= ' focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-300 dark:focus:ring-indigo-800';
    $inputClasses .= ' text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500';
    
    if ($error) {
        $inputClasses .= ' border-red-500 dark:border-red-400 focus:border-red-500 focus:ring-red-300';
    }
    
    $inputClasses .= ' ' . $class;
    
    $attributes = [];
    if ($id) $attributes[] = "id=\"{$id}\"";
    if ($name) $attributes[] = "name=\"{$name}\"";
    if ($placeholder) $attributes[] = "placeholder=\"" . sanitize($placeholder) . "\"";
    if ($required) $attributes[] = 'required';
    if ($disabled) $attributes[] = 'disabled';
    if ($readonly) $attributes[] = 'readonly';
    if ($pattern) $attributes[] = "pattern=\"{$pattern}\"";
    if ($min) $attributes[] = "min=\"{$min}\"";
    if ($max) $attributes[] = "max=\"{$max}\"";
    $attributes[] = "class=\"{$inputClasses}\"";
    
    ?>
    
    <div class="mb-4">
        <?php if ($label): ?>
        <label for="<?php echo $id; ?>" class="block text-lg sm:text-xl font-semibold text-slate-700 dark:text-slate-300 mb-2">
            <?php echo sanitize($label); ?>
            <?php if ($required): ?>
            <span class="text-red-500">*</span>
            <?php endif; ?>
        </label>
        <?php endif; ?>
        
        <?php if ($type === 'textarea'): ?>
        <textarea <?php echo implode(' ', $attributes); ?> rows="<?php echo $rows; ?>"><?php echo sanitize($value); ?></textarea>
        <?php else: ?>
        <input type="<?php echo $type; ?>" <?php echo implode(' ', $attributes); ?> value="<?php echo sanitize($value); ?>">
        <?php endif; ?>
        
        <?php if ($error): ?>
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            <?php echo sanitize($error); ?>
        </p>
        <?php endif; ?>
        
        <?php if ($helpText && !$error): ?>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            <?php echo sanitize($helpText); ?>
        </p>
        <?php endif; ?>
    </div>
    
    <?php
}

/**
 * Select/Dropdown Component
 */
function renderSelect($config = []) {
    $name = $config['name'] ?? '';
    $options = $config['options'] ?? [];
    $selected = $config['selected'] ?? '';
    $label = $config['label'] ?? '';
    $id = $config['id'] ?? ($name ? "select_{$name}" : generateId());
    $class = $config['class'] ?? '';
    $required = $config['required'] ?? false;
    $disabled = $config['disabled'] ?? false;
    
    $selectClasses = 'w-full px-4 py-3 text-lg rounded-xl border-2 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-offset-2';
    $selectClasses .= ' bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl';
    $selectClasses .= ' border-slate-300 dark:border-slate-600';
    $selectClasses .= ' focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-300 dark:focus:ring-indigo-800';
    $selectClasses .= ' text-slate-800 dark:text-slate-100';
    $selectClasses .= ' ' . $class;
    
    ?>
    
    <div class="mb-4">
        <?php if ($label): ?>
        <label for="<?php echo $id; ?>" class="block text-lg sm:text-xl font-semibold text-slate-700 dark:text-slate-300 mb-2">
            <?php echo sanitize($label); ?>
            <?php if ($required): ?>
            <span class="text-red-500">*</span>
            <?php endif; ?>
        </label>
        <?php endif; ?>
        
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $selectClasses; ?>" <?php echo $required ? 'required' : ''; ?> <?php echo $disabled ? 'disabled' : ''; ?>>
            <?php foreach ($options as $value => $text): ?>
            <option value="<?php echo sanitize($value); ?>" <?php echo $selected == $value ? 'selected' : ''; ?>>
                <?php echo sanitize($text); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <?php
}
