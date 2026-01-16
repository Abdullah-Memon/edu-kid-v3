<?php
/**
 * Popup/Modal Component
 * Reusable modal dialog
 * 
 * Usage: 
 * renderPopup([
 *     'id' => 'myModal',
 *     'title' => 'Modal Title',
 *     'content' => 'Modal content here',
 *     'showFooter' => true
 * ]);
 */

function renderPopup($config = []) {
    $id = $config['id'] ?? generateId();
    $title = $config['title'] ?? '';
    $content = $config['content'] ?? '';
    $size = $config['size'] ?? 'md'; // sm, md, lg, xl, full
    $showClose = $config['showClose'] ?? true;
    $showFooter = $config['showFooter'] ?? false;
    $footerContent = $config['footerContent'] ?? '';
    $closeButtonText = $config['closeButtonText'] ?? 'بند ڪريو';
    
    $sizeClasses = [
        'sm' => 'max-w-md',
        'md' => 'max-w-2xl',
        'lg' => 'max-w-4xl',
        'xl' => 'max-w-6xl',
        'full' => 'max-w-full mx-4'
    ];
    
    $modalSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    ?>
    
    <!-- Modal Overlay -->
    <div id="<?php echo $id; ?>" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-slate-900/75 dark:bg-slate-950/90 backdrop-blur-sm transition-opacity" onclick="closeModal('<?php echo $id; ?>')"></div>
        
        <!-- Modal Content -->
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative w-full <?php echo $modalSize; ?> transform transition-all">
                <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 dark:border-slate-700/50 overflow-hidden">
                    
                    <!-- Header -->
                    <?php if ($title || $showClose): ?>
                    <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700">
                        <?php if ($title): ?>
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 dark:text-slate-100" id="modal-title">
                            <?php echo sanitize($title); ?>
                        </h3>
                        <?php endif; ?>
                        
                        <?php if ($showClose): ?>
                        <button type="button" onclick="closeModal('<?php echo $id; ?>')" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Body -->
                    <div class="p-6 sm:p-8 text-lg sm:text-xl text-slate-700 dark:text-slate-300">
                        <?php echo $content; ?>
                    </div>
                    
                    <!-- Footer -->
                    <?php if ($showFooter): ?>
                    <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50">
                        <?php if ($footerContent): ?>
                            <?php echo $footerContent; ?>
                        <?php else: ?>
                            <button type="button" onclick="closeModal('<?php echo $id; ?>')" class="px-6 py-3 text-lg rounded-xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-100 transition-all duration-300">
                                <?php echo sanitize($closeButtonText); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('[role="dialog"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        closeModal(modal.id);
                    }
                });
            }
        });
    </script>
    
    <?php
}

/**
 * Alert/Toast Component
 */
function renderAlert($config = []) {
    $message = $config['message'] ?? '';
    $type = $config['type'] ?? 'info'; // success, error, warning, info
    $dismissible = $config['dismissible'] ?? true;
    $id = $config['id'] ?? generateId();
    
    $typeClasses = [
        'success' => 'bg-green-100 dark:bg-green-900/30 border-green-500 text-green-800 dark:text-green-200',
        'error' => 'bg-red-100 dark:bg-red-900/30 border-red-500 text-red-800 dark:text-red-200',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900/30 border-yellow-500 text-yellow-800 dark:text-yellow-200',
        'info' => 'bg-blue-100 dark:bg-blue-900/30 border-blue-500 text-blue-800 dark:text-blue-200'
    ];
    
    $icons = [
        'success' => '✓',
        'error' => '✕',
        'warning' => '⚠',
        'info' => 'ℹ'
    ];
    
    $alertClass = $typeClasses[$type] ?? $typeClasses['info'];
    $icon = $icons[$type] ?? $icons['info'];
    ?>
    
    <div id="<?php echo $id; ?>" class="<?php echo $alertClass; ?> backdrop-blur-xl border-l-4 p-4 rounded-xl shadow-lg mb-4 flex items-center justify-between" role="alert">
        <div class="flex items-center">
            <span class="text-2xl mr-3 rtl:ml-3 rtl:mr-0"><?php echo $icon; ?></span>
            <p class="text-lg sm:text-xl font-medium">
                <?php echo sanitize($message); ?>
            </p>
        </div>
        
        <?php if ($dismissible): ?>
        <button type="button" onclick="document.getElementById('<?php echo $id; ?>').remove()" class="p-1 hover:bg-black/10 dark:hover:bg-white/10 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <?php endif; ?>
    </div>
    
    <?php
}
