<?php
/**
 * Splash Screen Component
 * Loading screen displayed while page components are loading
 * 
 * Usage: renderSplash(['message' => 'Loading...']);
 */

function renderSplash($config = []) {
    $message = $config['message'] ?? 'لوڊ ٿي رهيو آهي...';
    $showLogo = $config['showLogo'] ?? true;
    $backgroundColor = $config['backgroundColor'] ?? 'bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500';
    ?>
    
    <!-- Splash Screen -->
    <div id="splashScreen" class="fixed inset-0 z-[9999] flex items-center justify-center <?php echo $backgroundColor; ?> transition-opacity duration-500">
        <div class="text-center">
            
            <?php if ($showLogo): ?>
                <!-- Animated Logo -->
                <div class="mb-8 relative">
                    <!-- Main Logo Circle -->
                    <div class="relative inline-block">
                        <!-- Rotating Ring -->
                        <div class="absolute inset-0 -m-4">
                            <div class="w-40 h-40 border-4 border-white/30 border-t-white rounded-full animate-spin"></div>
                        </div>
                        
                        <!-- Logo Container -->
                        <div class="w-32 h-32 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center shadow-2xl animate-pulse">
                            <div class="text-center">
                                <!-- Icon/Logo -->
                                <svg class="w-16 h-16 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                
                                <!-- Site Name in Sindhi -->
                                <div class="text-white font-ambile2 text-xl font-bold">
                                    <?php echo SITE_NAME; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Particles -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-2 h-2 bg-white rounded-full absolute top-0 left-0 animate-ping" style="animation-delay: 0s;"></div>
                        <div class="w-2 h-2 bg-white rounded-full absolute top-0 right-0 animate-ping" style="animation-delay: 0.2s;"></div>
                        <div class="w-2 h-2 bg-white rounded-full absolute bottom-0 left-0 animate-ping" style="animation-delay: 0.4s;"></div>
                        <div class="w-2 h-2 bg-white rounded-full absolute bottom-0 right-0 animate-ping" style="animation-delay: 0.6s;"></div>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Loading Message -->
            <div class="mb-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-ambile2 font-bold text-white mb-2">
                    <?php echo $message; ?>
                </h2>
                <p class="text-white/80 text-lg sm:text-xl font-ambile">
                    توهان جو انتظار ڪيو پيو وڃي...
                </p>
            </div>
            
            <!-- Loading Bar -->
            <div class="w-64 sm:w-80 mx-auto">
                <div class="h-2 bg-white/20 rounded-full overflow-hidden backdrop-blur-sm">
                    <div class="h-full bg-white rounded-full animate-loading-bar shadow-lg"></div>
                </div>
            </div>
            
            <!-- Loading Dots -->
            <div class="flex justify-center space-x-2 rtl:space-x-reverse mt-6">
                <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                <div class="w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
            </div>
        </div>
    </div>
    
    <!-- Custom Animations -->
    <style>
        @keyframes loading-bar {
            0% {
                width: 0%;
            }
            50% {
                width: 70%;
            }
            100% {
                width: 100%;
            }
        }
        
        .animate-loading-bar {
            animation: loading-bar 1.5s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        /* Prevent scrolling while splash is visible */
        body:has(#splashScreen:not(.opacity-0)) {
            overflow: hidden;
        }
    </style>
    
    <?php
}
?>
