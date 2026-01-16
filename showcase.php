<?php
/**
 * Component Showcase Page
 * Demonstrates all available components and their variants
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';
require_once __DIR__ . '/../components/button.php';
require_once __DIR__ . '/../components/card.php';
require_once __DIR__ . '/../components/input.php';
require_once __DIR__ . '/../components/popup.php';
require_once __DIR__ . '/../components/sections.php';

layout([
    'title' => getPageTitle('Component Showcase'),
    'content' => function() {
        renderHeader();
        ?>
        
        <div class="container mx-auto px-4 py-8">
            
            <!-- Hero Section Demo -->
            <?php renderHero([
                'title' => 'Component Showcase',
                'subtitle' => 'All Available UI Components',
                'icon' => '🎨',
                'description' => 'Browse all available components and see them in action',
                'buttons' => [
                    ['text' => 'View Docs', 'variant' => 'primary', 'onclick' => "alert('Documentation')"],
                    ['text' => 'GitHub', 'variant' => 'glass', 'onclick' => "alert('GitHub')"]
                ]
            ]); ?>

            <!-- Buttons Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Buttons',
                    'subtitle' => 'Various button variants and sizes',
                    'icon' => '🔘'
                ]); ?>
                
                <div class="space-y-8">
                    <!-- Button Variants -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">Variants</h3>
                        <div class="flex flex-wrap gap-4">
                            <?php 
                            $variants = ['primary', 'secondary', 'success', 'danger', 'warning', 'glass', 'outline'];
                            foreach ($variants as $variant) {
                                renderButton([
                                    'text' => ucfirst($variant),
                                    'variant' => $variant,
                                    'size' => 'md'
                                ]);
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Button Sizes -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">Sizes</h3>
                        <div class="flex flex-wrap items-center gap-4">
                            <?php 
                            $sizes = ['xs', 'sm', 'md', 'lg', 'xl'];
                            foreach ($sizes as $size) {
                                renderButton([
                                    'text' => strtoupper($size),
                                    'variant' => 'primary',
                                    'size' => $size
                                ]);
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Buttons with Icons -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">With Icons</h3>
                        <div class="flex flex-wrap gap-4">
                            <?php 
                            renderButton([
                                'text' => 'Download',
                                'variant' => 'success',
                                'icon' => '⬇️',
                                'iconPosition' => 'left'
                            ]);
                            renderButton([
                                'text' => 'Upload',
                                'variant' => 'primary',
                                'icon' => '⬆️',
                                'iconPosition' => 'right'
                            ]);
                            renderButton([
                                'text' => 'Delete',
                                'variant' => 'danger',
                                'icon' => '🗑️',
                                'iconPosition' => 'left'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cards Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Cards',
                    'subtitle' => 'Regular and glass morphism cards',
                    'icon' => '🎴'
                ]); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php 
                    renderCard([
                        'icon' => '📚',
                        'title' => 'Regular Card',
                        'content' => 'This is a regular card with solid background',
                        'hoverable' => true
                    ]);
                    
                    renderGlassCard([
                        'icon' => '✨',
                        'title' => 'Glass Card',
                        'content' => 'This is a glass morphism card with blur effect',
                        'hoverable' => true
                    ]);
                    
                    renderCard([
                        'icon' => '🔗',
                        'title' => 'Linked Card',
                        'content' => 'This card has a link',
                        'link' => '#',
                        'hoverable' => true
                    ]);
                    ?>
                </div>
            </section>

            <!-- Inputs Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Form Inputs',
                    'subtitle' => 'Text inputs, textareas, and selects',
                    'icon' => '📝'
                ]); ?>
                
                <div class="max-w-2xl mx-auto">
                    <form class="space-y-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-8">
                        <?php 
                        renderInput([
                            'name' => 'name',
                            'type' => 'text',
                            'label' => 'Name',
                            'placeholder' => 'Enter your name',
                            'required' => true
                        ]);
                        
                        renderInput([
                            'name' => 'email',
                            'type' => 'email',
                            'label' => 'Email',
                            'placeholder' => 'your@email.com',
                            'helpText' => 'We will never share your email'
                        ]);
                        
                        renderSelect([
                            'name' => 'class',
                            'label' => 'Select Class',
                            'options' => [
                                '1' => 'Class 1',
                                '2' => 'Class 2',
                                '3' => 'Class 3',
                                '4' => 'Class 4',
                                '5' => 'Class 5'
                            ],
                            'selected' => '1'
                        ]);
                        
                        renderInput([
                            'name' => 'message',
                            'type' => 'textarea',
                            'label' => 'Message',
                            'placeholder' => 'Your message here...',
                            'rows' => 4
                        ]);
                        
                        renderButton([
                            'text' => 'Submit',
                            'type' => 'submit',
                            'variant' => 'primary',
                            'class' => 'w-full'
                        ]);
                        ?>
                    </form>
                </div>
            </section>

            <!-- Alerts Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Alerts',
                    'subtitle' => 'Different alert types',
                    'icon' => '⚠️'
                ]); ?>
                
                <div class="max-w-2xl mx-auto space-y-4">
                    <?php 
                    renderAlert([
                        'message' => 'Success! Your changes have been saved.',
                        'type' => 'success',
                        'dismissible' => true
                    ]);
                    
                    renderAlert([
                        'message' => 'Error! Something went wrong.',
                        'type' => 'error',
                        'dismissible' => true
                    ]);
                    
                    renderAlert([
                        'message' => 'Warning! Please check your input.',
                        'type' => 'warning',
                        'dismissible' => true
                    ]);
                    
                    renderAlert([
                        'message' => 'Info: This is some useful information.',
                        'type' => 'info',
                        'dismissible' => true
                    ]);
                    ?>
                </div>
            </section>

            <!-- Badges Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Badges',
                    'subtitle' => 'Small labels and tags',
                    'icon' => '🏷️'
                ]); ?>
                
                <div class="flex flex-wrap gap-4 justify-center">
                    <?php 
                    $badgeVariants = ['default', 'primary', 'success', 'warning', 'danger'];
                    foreach ($badgeVariants as $variant) {
                        renderBadge(['text' => ucfirst($variant), 'variant' => $variant, 'size' => 'md']);
                    }
                    ?>
                </div>
                
                <div class="flex flex-wrap gap-4 justify-center mt-4">
                    <?php 
                    renderBadge(['text' => 'Small', 'variant' => 'primary', 'size' => 'sm']);
                    renderBadge(['text' => 'Medium', 'variant' => 'primary', 'size' => 'md']);
                    renderBadge(['text' => 'Large', 'variant' => 'primary', 'size' => 'lg']);
                    ?>
                </div>
            </section>

            <!-- Loading Spinner Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Loading Spinners',
                    'subtitle' => 'Various sizes',
                    'icon' => '⏳'
                ]); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-8">
                        <?php renderLoadingSpinner(['size' => 'sm', 'text' => 'Small']); ?>
                    </div>
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-8">
                        <?php renderLoadingSpinner(['size' => 'md', 'text' => 'Medium']); ?>
                    </div>
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-8">
                        <?php renderLoadingSpinner(['size' => 'lg', 'text' => 'Large']); ?>
                    </div>
                </div>
            </section>

            <!-- Modal Demo Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Modals',
                    'subtitle' => 'Click buttons to open modals',
                    'icon' => '🪟'
                ]); ?>
                
                <div class="flex flex-wrap gap-4 justify-center">
                    <?php 
                    renderButton([
                        'text' => 'Open Small Modal',
                        'variant' => 'primary',
                        'onclick' => "openModal('smallModal')"
                    ]);
                    renderButton([
                        'text' => 'Open Medium Modal',
                        'variant' => 'secondary',
                        'onclick' => "openModal('mediumModal')"
                    ]);
                    renderButton([
                        'text' => 'Open Large Modal',
                        'variant' => 'success',
                        'onclick' => "openModal('largeModal')"
                    ]);
                    ?>
                </div>

                <!-- Modals -->
                <?php 
                renderPopup([
                    'id' => 'smallModal',
                    'title' => 'Small Modal',
                    'content' => '<p>This is a small modal with minimal content.</p>',
                    'size' => 'sm',
                    'showFooter' => true
                ]);
                
                renderPopup([
                    'id' => 'mediumModal',
                    'title' => 'Medium Modal',
                    'content' => '<p>This is a medium-sized modal with more content. It can contain forms, images, or any other HTML elements.</p>',
                    'size' => 'md',
                    'showFooter' => true
                ]);
                
                renderPopup([
                    'id' => 'largeModal',
                    'title' => 'Large Modal',
                    'content' => '
                        <div class="space-y-4">
                            <p>This is a large modal that can contain lots of content.</p>
                            <p>You can put forms, images, videos, or any complex layout here.</p>
                            <div class="bg-indigo-100 dark:bg-indigo-900/30 p-4 rounded-lg">
                                <p class="font-semibold">Example Section</p>
                                <p>This demonstrates that you can have complex layouts inside modals.</p>
                            </div>
                        </div>
                    ',
                    'size' => 'lg',
                    'showFooter' => true
                ]);
                ?>
            </section>

            <!-- Breadcrumb Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Breadcrumbs',
                    'subtitle' => 'Navigation breadcrumbs',
                    'icon' => '🍞'
                ]); ?>
                
                <div class="max-w-2xl mx-auto">
                    <?php 
                    renderBreadcrumb([
                        'items' => [
                            ['text' => 'Home', 'link' => 'index.php'],
                            ['text' => 'Components', 'link' => 'showcase.php'],
                            ['text' => 'Breadcrumb']
                        ]
                    ]);
                    ?>
                </div>
            </section>

            <!-- Color Palette Section -->
            <section class="mb-16">
                <?php renderSectionHeader([
                    'title' => 'Color Palette',
                    'subtitle' => 'Tailwind color classes used in this project',
                    'icon' => '🎨'
                ]); ?>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-indigo-500 text-white p-6 rounded-xl text-center font-bold">
                        Indigo<br>Primary
                    </div>
                    <div class="bg-purple-600 text-white p-6 rounded-xl text-center font-bold">
                        Purple<br>Secondary
                    </div>
                    <div class="bg-green-500 text-white p-6 rounded-xl text-center font-bold">
                        Green<br>Success
                    </div>
                    <div class="bg-red-500 text-white p-6 rounded-xl text-center font-bold">
                        Red<br>Danger
                    </div>
                    <div class="bg-yellow-500 text-white p-6 rounded-xl text-center font-bold">
                        Yellow<br>Warning
                    </div>
                    <div class="bg-slate-700 text-white p-6 rounded-xl text-center font-bold">
                        Slate<br>Neutral
                    </div>
                    <div class="bg-white dark:bg-slate-900 border-2 border-slate-300 dark:border-slate-600 p-6 rounded-xl text-center font-bold">
                        White/Dark<br>Background
                    </div>
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-xl text-center font-bold">
                        Gradient<br>Special
                    </div>
                </div>
            </section>

        </div>

        <?php
        renderFooter();
    }
]);
?>
