<?php
/**
 * Index Page - Main Homepage
 * Sindhi Kids Education Platform
 */

// Load configuration and functions
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Load all components
require_once __DIR__ . '/components/layout.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/footer.php';
require_once __DIR__ . '/components/splash.php';
require_once __DIR__ . '/components/card.php';
require_once __DIR__ . '/components/button.php';

// Start layout with splash screen
layout([
    'title' => getPageTitle(),
    'meta' => [
        'title' => 'سنڌي سکيا - Learn Sindhi Online for Kids | Free Interactive Education',
        'description' => 'Best free platform to learn Sindhi language for children. Interactive games, alphabet learning, stories, and cultural education for Class 1-5 students.',
        'keywords' => 'learn sindhi online free, sindhi for kids, sindhi alphabet, sindhi education, alif bay pay, sindhi language learning, kids education platform',
        'author' => 'Sindhi Educational Platform Team',
        'type' => 'website',
        'image' => SITE_URL . 'assets/images/homepage-preview.jpg',
        'robots' => 'index, follow'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => true,
    'content' => function() {
        global $classes;
        ?>
        
        <!-- Hero Section - Modern & Engaging -->
        <section id="home" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-purple-100 via-pink-100 to-blue-100 dark:from-slate-800 dark:via-purple-900/30 dark:to-slate-800">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-10 left-10 text-6xl animate-bounce opacity-30">📚</div>
                <div class="absolute top-20 right-20 text-5xl animate-pulse opacity-30">✨</div>
                <div class="absolute bottom-20 left-40 text-5xl animate-bounce opacity-30">🎨</div>
                <div class="absolute bottom-40 right-10 text-6xl animate-pulse opacity-30">🚀</div>
                <div class="absolute top-1/2 left-20 text-4xl animate-spin-slow opacity-20">⭐</div>
                <div class="absolute top-1/3 right-40 text-4xl animate-bounce opacity-20">🌈</div>
            </div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center space-y-6">
                    <!-- Main Heading -->
                    <div class="space-y-3 animate-fade-in-up">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 dark:from-purple-400 dark:via-pink-400 dark:to-blue-400 bg-clip-text text-transparent leading-tight" dir="rtl">
                            سنڌي سکيا
                        </h1>
                        <!-- <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
                            Learn Sindhi the Fun Way! 🎉
                        </h2> -->
                    </div>
                    
                    <!-- Animated Characters -->
                    <!-- <div class="flex justify-center items-center gap-6 sm:gap-8 my-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="text-5xl sm:text-6xl animate-bounce" style="animation-delay: 0s;">🧙‍♂️</div>
                        <div class="text-5xl sm:text-6xl animate-bounce" style="animation-delay: 0.2s;">📖</div>
                        <div class="text-5xl sm:text-6xl animate-bounce" style="animation-delay: 0.4s;">🎮</div>
                    </div> -->
                    
                    <!-- Description -->
                    <p class="text-lg sm:text-xl lg:text-2xl text-slate-700 dark:text-slate-300 font-medium max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.4s;">
                        <span>تفريح، راند ۽ سکيا جو بهترين پليٽ فارم</span>
                        <br/>
                        <span class="ltr">Interactive Games • Stories • Alphabet • Culture • Math & Science</span>
                    </p>
                    
                    <!-- Stats Badges -->
                    <div class="flex flex-wrap justify-center items-center gap-3 sm:gap-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                        <div class="px-5 py-2.5 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-full shadow-lg border-2 border-purple-300 dark:border-purple-700 ltr">
                            <span class="text-xl font-bold text-purple-600 dark:text-purple-400">50+</span>
                            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 ml-2">Lessons</span>
                        </div>
                        <div class="px-5 py-2.5 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-full shadow-lg border-2 border-pink-300 dark:border-pink-700 ltr">
                            <span class="text-xl font-bold text-pink-600 dark:text-pink-400">100%</span>
                            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 ml-2">Free</span>
                        </div>
                        <div class="px-5 py-2.5 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-full shadow-lg border-2 border-blue-300 dark:border-blue-700 ltr">
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">10+</span>
                            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 ml-2">Categories</span>
                        </div>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 pt-4 animate-fade-in-up" style="animation-delay: 0.8s;">
                        <button onclick="document.getElementById('categories').scrollIntoView({behavior: 'smooth'})" class="ltr px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-lg font-bold rounded-xl shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-purple-500/50">
                            🚀 Start Learning Now!
                        </button>
                        <button onclick="document.getElementById('features').scrollIntoView({behavior: 'smooth'})" class="ltr px-6 py-3 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-lg font-bold rounded-xl shadow-xl transition-all duration-300 hover:scale-105 border-2 border-purple-300 dark:border-purple-700">
                            ✨ Explore Features
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </section>
        
        <!-- Quick Navigation Bar -->
        <section class="sticky top-20 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl shadow-md border-b border-indigo-200 dark:border-indigo-800">
            <div class="container mx-auto px-4 py-4 justify-center flex">
                <div class="flex overflow-x-auto gap-2 scrollbar-hide">
                    <a href="#categories" class="ltr px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-full text-sm font-semibold whitespace-nowrap hover:shadow-lg transition-all duration-300 hover:scale-105">
                        👥 Choose Your Path
                    </a>
                    <a href="#features" class="ltr px-6 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-full font-semibold whitespace-nowrap hover:shadow-lg transition-all duration-300 hover:scale-105">
                        ⭐ Features
                    </a>
                    <a href="#general-section" class="ltr px-6 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full font-semibold whitespace-nowrap hover:shadow-lg transition-all duration-300 hover:scale-105">
                        🎓 General Topics
                    </a>
                    <a href="#subjects" class="ltr px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full font-semibold whitespace-nowrap hover:shadow-lg transition-all duration-300 hover:scale-105">
                        📚 All Subjects
                    </a>
                    <a href="#why-us" class="ltr px-6 py-2 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-full font-semibold whitespace-nowrap hover:shadow-lg transition-all duration-300 hover:scale-105">
                        💡 Why Choose Us
                    </a>
                </div>
            </div>
        </section>

        <!-- 3 Main Categories Section -->
        <section id="categories" class="py-16 sm:py-24 bg-gradient-to-b from-white to-slate-50 dark:from-slate-900 dark:to-slate-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header with Decorative Elements -->
                <div class="text-center mb-16 animate-fade-in-up relative">
                    <h2 class="ltr text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent mb-3">
                        Choose Your Learning Path 🎯
                    </h2>
                    <p class="text-lg sm:text-xl text-slate-600 dark:text-slate-300 font-medium">
                        پنهنجو سکيا جو رستو چونڊيو
                    </p>
                    
                    <!-- Decorative Doodle Lines -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 top-full mt-4 hidden lg:block">
                        <svg width="400" height="80" viewBox="0 0 400 80" fill="none" class="opacity-30">
                            <path d="M 0 40 Q 100 10, 200 40 T 400 40" stroke="currentColor" stroke-width="3" stroke-dasharray="5,5" class="text-indigo-500 dark:text-indigo-400"/>
                        </svg>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 top-full mt-2 lg:hidden">
                        <svg width="200" height="40" viewBox="0 0 200 40" fill="none" class="opacity-30">
                            <path d="M 100 5 L 100 35" stroke="currentColor" stroke-width="3" stroke-dasharray="5,5" class="text-indigo-500 dark:text-indigo-400"/>
                        </svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto">
                
                <!-- Section 1: Sindhi Students -->
                <div class="relative group animate-fade-in-up" style="animation-delay: 0.1s;">
                    <!-- Decorative Corner Doodles -->
                    <div class="absolute -top-6 -right-6 text-4xl opacity-20 group-hover:opacity-40 transition-opacity duration-300 animate-bounce">✨</div>
                    <div class="absolute -bottom-6 -left-6 text-4xl opacity-20 group-hover:opacity-40 transition-opacity duration-300 animate-pulse">📚</div>
                    
                    <div class="relative bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-3xl p-8 lg:p-10 border-2 border-indigo-200 dark:border-indigo-800 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <!-- Icon Header -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="text-6xl">📚</div>
                            <div class="flex-1">
                                <h3 class="text-2xl lg:text-3xl font-bold text-indigo-800 dark:text-indigo-100">
                                    سنڌي شاگرد
                                </h3>
                                <p class="text-sm text-indigo-600 dark:text-indigo-300">
                                    ڪلاس 1 کان 5، الفابيٽ، گرامر
                                </p>
                            </div>
                        </div>
                        
                        <!-- Features Grid -->
                        <div class="grid grid-cols-3 gap-3 mb-8">
                            <div class="text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">📚</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">ڪلاس 1-5</p>
                            </div>
                            <div class="text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">🎮</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">راندون</p>
                            </div>
                            <div class="text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">📖</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">ڪهاڻيون</p>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <button onclick="window.location.href='pages/sindhi.php'" class="w-full px-6 py-4 bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white text-lg font-bold rounded-xl shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/50">
                            شروع ڪريو →
                        </button>
                    </div>
                </div>
                
                <!-- Section 2: Non-Sindhi Students -->
                <div class="relative group animate-fade-in-up" style="animation-delay: 0.2s;">
                    <!-- Decorative Corner Doodles -->
                    <div class="absolute -top-6 -left-6 text-4xl opacity-20 group-hover:opacity-40 transition-opacity duration-300 animate-bounce">🌟</div>
                    <div class="absolute -bottom-6 -right-6 text-4xl opacity-20 group-hover:opacity-40 transition-opacity duration-300 animate-pulse">🌎</div>
                    
                    <div class="relative bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-3xl p-8 lg:p-10 border-2 border-purple-200 dark:border-purple-800 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <!-- Icon Header -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="text-6xl">🌎</div>
                            <div class="flex-1 ltr">
                                <h3 class="text-2xl lg:text-3xl font-bold text-purple-800 dark:text-purple-100">
                                    Non-Sindhi Students
                                </h3>
                                <p class="text-sm text-purple-600 dark:text-purple-300">
                                    Learn from basics
                                </p>
                            </div>
                        </div>
                        
                        <!-- Features Grid -->
                        <div class="grid grid-cols-3 gap-3 mb-8">
                            <div class="ltr text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">🗣️</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">Phrases</p>
                            </div>
                            <div class="ltr text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">📖</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">Alphabet</p>
                            </div>
                            <div class="ltr text-center bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-xl p-4 hover:scale-105 transition-transform duration-300">
                                <div class="text-3xl mb-2">🎭</div>
                                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">Culture</p>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <button onclick="window.location.href='pages/learn-sindhi/'" class="ltr w-full px-6 py-4 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white text-lg font-bold rounded-xl shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-purple-500/50">
                            Start Learning →
                        </button>
                    </div>
                </div>

            </div>
        </section>
        
        <!-- Features Showcase Section -->
        <section id="features" class="py-16 sm:py-24 bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 dark:from-slate-800 dark:via-purple-900/20 dark:to-slate-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12 animate-fade-in-up">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold  ltr bg-gradient-to-r from-pink-600 to-purple-600 dark:from-pink-400 dark:to-purple-400 bg-clip-text text-transparent mb-3">
                        Why Kids Love Us! ⭐
                    </h2>
                    <p class="text-lg sm:text-xl text-slate-600 dark:text-slate-300 font-medium">
                        سکيا تفريحي ۽ آسان طريقي سان
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 max-w-7xl mx-auto ltr">
                    <!-- Feature 1 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-2 border-purple-200 dark:border-purple-800 animate-fade-in-up" style="animation-delay: 0.1s;">
                        <div class="text-5xl mb-3 group-hover:scale-110 transition-transform duration-300">🎮</div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Interactive Games</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Learn through fun games and quizzes that make education exciting!</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-pink-200 dark:border-pink-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">📖</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Story Time</h3>
                        <p class="text-slate-600 dark:text-slate-300">Moral stories in Sindhi that teach values and life lessons.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-blue-200 dark:border-blue-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">🎨</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Creative Learning</h3>
                        <p class="text-slate-600 dark:text-slate-300">Colorful visuals and animations that keep kids engaged.</p>
                    </div>
                    
                    <!-- Feature 4 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-green-200 dark:border-green-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">🏆</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Progress Tracking</h3>
                        <p class="text-slate-600 dark:text-slate-300">Track your learning journey and celebrate achievements!</p>
                    </div>
                    
                    <!-- Feature 5 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-orange-200 dark:border-orange-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">🌍</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Cultural Heritage</h3>
                        <p class="text-slate-600 dark:text-slate-300">Discover Sindhi culture, traditions, and rich history.</p>
                    </div>
                    
                    <!-- Feature 6 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-indigo-200 dark:border-indigo-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">📱</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Mobile Friendly</h3>
                        <p class="text-slate-600 dark:text-slate-300">Learn anywhere, anytime on any device - phone, tablet, or PC!</p>
                    </div>
                    
                    <!-- Feature 7 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-red-200 dark:border-red-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">💯</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">100% Free</h3>
                        <p class="text-slate-600 dark:text-slate-300">All content is completely free - quality education for everyone!</p>
                    </div>
                    
                    <!-- Feature 8 -->
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-teal-200 dark:border-teal-800">
                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-300">🌙</div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-3">Dark Mode</h3>
                        <p class="text-slate-600 dark:text-slate-300">Easy on the eyes with beautiful dark mode support.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- General Knowledge Section - Detailed View -->
        <section id="general-section" class="py-16 sm:py-24 bg-gradient-to-b from-slate-50 to-white dark:from-slate-800 dark:to-slate-900 relative overflow-hidden">
            <!-- Doodle Background Elements -->
            <div class="absolute inset-0 pointer-events-none opacity-10">
                <svg class="absolute top-10 left-10 w-20 h-20 text-indigo-500 animate-bounce" viewBox="0 0 100 100" fill="currentColor">
                    <circle cx="50" cy="50" r="40"/>
                </svg>
                <svg class="absolute top-40 right-20 w-16 h-16 text-pink-500 animate-pulse" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4">
                    <path d="M50 10 L90 90 L10 90 Z"/>
                </svg>
                <svg class="absolute bottom-20 left-40 w-24 h-24 text-purple-500 animate-spin-slow" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
                    <rect x="25" y="25" width="50" height="50" rx="5"/>
                </svg>
            </div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-4xl sm:text-5xl font-black bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent mb-3">
                        🎓 عام سکيا
                    </h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 ltr">Explore Beyond Language</p>
                </div>
            
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    
                    <!-- Family Tree Card -->
                    <div class="group relative animate-fade-in-up" style="animation-delay: 0.1s;">
                        <!-- Doodle decoration -->
                        <div class="absolute -top-3 -right-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">✨</div>
                        <div class="absolute -bottom-3 -left-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">💫</div>
                        
                        <div class="relative bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-3xl p-6 border-2 border-indigo-200 dark:border-indigo-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
                            <!-- Hover glow effect -->
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-400/0 to-blue-400/0 group-hover:from-indigo-400/10 group-hover:to-blue-400/10 transition-all duration-500 rounded-3xl"></div>
                            
                            <div class="relative z-10">
                                <!-- Icon with animation -->
                                <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-6 transition-all duration-500 text-center">
                                    🌳
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-2xl font-bold text-indigo-800 dark:text-indigo-100 mb-3 text-center">
                                    مِٽِين مائٽين
                                </h3>
                                
                                <!-- Quick icons preview -->
                                <div class="flex justify-center gap-3 mb-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <span class="text-2xl">👴</span>
                                    <span class="text-2xl">👵</span>
                                    <span class="text-2xl">👨‍👩‍👧</span>
                                    <span class="text-2xl">🏠</span>
                                </div>
                                
                                <!-- CTA Button -->
                                <button onclick="window.location.href='family-tree.php'" class="w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-xl">
                                    شروع ڪريو →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Math Card -->
                    <div class="group relative animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="absolute -top-3 -right-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">🎯</div>
                        <div class="absolute -bottom-3 -left-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">⚡</div>
                        
                        <div class="relative bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-3xl p-6 border-2 border-purple-200 dark:border-purple-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-400/0 to-pink-400/0 group-hover:from-purple-400/10 group-hover:to-pink-400/10 transition-all duration-500 rounded-3xl"></div>
                            
                            <div class="relative z-10">
                                <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-6 transition-all duration-500 text-center">
                                    🧮
                                </div>
                                
                                <h3 class="text-2xl font-bold text-purple-800 dark:text-purple-100 mb-3 text-center">
                                    رياضي
                                </h3>
                                
                                <div class="flex justify-center gap-3 mb-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <span class="text-2xl">➕</span>
                                    <span class="text-2xl">➖</span>
                                    <span class="text-2xl">✖️</span>
                                    <span class="text-2xl">➗</span>
                                </div>
                                
                                <button onclick="window.location.href='pages/math.php'" class="w-full px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-xl">
                                    شروع ڪريو →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Science Card -->
                    <div class="group relative animate-fade-in-up" style="animation-delay: 0.3s;">
                        <div class="absolute -top-3 -right-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">🌟</div>
                        <div class="absolute -bottom-3 -left-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">💡</div>
                        
                        <div class="relative bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-3xl p-6 border-2 border-green-200 dark:border-green-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-400/0 to-emerald-400/0 group-hover:from-green-400/10 group-hover:to-emerald-400/10 transition-all duration-500 rounded-3xl"></div>
                            
                            <div class="relative z-10">
                                <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-6 transition-all duration-500 text-center">
                                    🧪
                                </div>
                                
                                <h3 class="text-2xl font-bold text-green-800 dark:text-green-100 mb-3 text-center">
                                    سائنس
                                </h3>
                                
                                <div class="flex justify-center gap-3 mb-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <span class="text-2xl">🌱</span>
                                    <span class="text-2xl">🐘</span>
                                    <span class="text-2xl">💧</span>
                                    <span class="text-2xl">🌍</span>
                                </div>
                                
                                <button onclick="window.location.href='pages/science.php'" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-xl">
                                    شروع ڪريو →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Stories Card -->
                    <div class="group relative animate-fade-in-up" style="animation-delay: 0.4s;">
                        <div class="absolute -top-3 -right-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">🎨</div>
                        <div class="absolute -bottom-3 -left-3 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">🌈</div>
                        
                        <div class="relative bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-3xl p-6 border-2 border-orange-200 dark:border-orange-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-400/0 to-amber-400/0 group-hover:from-orange-400/10 group-hover:to-amber-400/10 transition-all duration-500 rounded-3xl"></div>
                            
                            <div class="relative z-10">
                                <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-6 transition-all duration-500 text-center">
                                    📖
                                </div>
                                
                                <h3 class="text-2xl font-bold text-orange-800 dark:text-orange-100 mb-3 text-center">
                                    آکاڻيُون
                                </h3>
                                
                                <div class="flex justify-center gap-3 mb-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <span class="text-2xl">🌳</span>
                                    <span class="text-2xl">🐜</span>
                                    <span class="text-2xl">🧠</span>
                                    <span class="text-2xl">🤝</span>
                                </div>
                                
                                <button onclick="window.location.href='pages/stories.php'" class="w-full px-4 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-xl">
                                    پڙهو →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- All Subjects Section -->
        <section id="subjects" class="py-16 sm:py-24 bg-gradient-to-br from-slate-50 to-white dark:from-slate-900 dark:to-slate-800 ltr relative overflow-hidden">
            <!-- Animated Doodle Background -->
            <div class="absolute inset-0 pointer-events-none opacity-5">
                <div class="absolute top-10 left-10 text-8xl animate-bounce" style="animation-duration: 3s;">🎨</div>
                <div class="absolute top-40 right-20 text-6xl animate-pulse" style="animation-duration: 4s;">⭐</div>
                <div class="absolute bottom-20 left-1/4 text-7xl animate-bounce" style="animation-duration: 5s;">✨</div>
                <div class="absolute bottom-40 right-1/3 text-6xl animate-pulse" style="animation-duration: 3.5s;">🚀</div>
            </div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Header -->
                <div class="text-center mb-16 animate-fade-in-up">
                    <h2 class="text-5xl sm:text-6xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 bg-clip-text text-transparent mb-4">
                        📚 Explore All Subjects
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400">Everything you need in one place</p>
                </div>
                
                <!-- Bento Grid Layout -->
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Classes Row - Hero Section -->
                    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
                        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-3xl p-8 shadow-2xl hover:shadow-purple-500/50 transition-all duration-500 hover:scale-[1.02] relative overflow-hidden">
                            <div class="absolute inset-0 bg-white/10 backdrop-blur-3xl"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="text-6xl">🎒</div>
                                        <div>
                                            <h3 class="text-3xl font-black text-white">Classes 1-5</h3>
                                            <p class="text-white/80 text-lg">Interactive Learning Paths</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-5 gap-4">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                    <a href="<?php echo BASE_URL; ?>pages/class.php?id=<?php echo $i; ?>" class="group relative bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-2xl p-6 transition-all duration-300 hover:scale-110 hover:-translate-y-2">
                                        <div class="text-5xl mb-2 group-hover:scale-125 transition-transform duration-300"><?php echo $i; ?>️⃣</div>
                                        <p class="text-white font-bold text-lg">Class <?php echo $i; ?></p>
                                    </a>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Sindhi Language - Large Card -->
                        <div class="md:col-span-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                            <div class="group bg-gradient-to-br from-indigo-500 to-blue-600 rounded-3xl p-8 shadow-2xl hover:shadow-indigo-500/50 transition-all duration-500 hover:scale-[1.02] h-full relative overflow-hidden">
                                <div class="absolute top-0 right-0 text-9xl opacity-10">🗣️</div>
                                <div class="relative z-10">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="text-6xl">🗣️</div>
                                        <div>
                                            <h3 class="text-3xl font-black text-white">Sindhi Language</h3>
                                            <p class="text-white/90 text-lg">Master the language</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">🔤</div>
                                            <p class="text-white font-bold text-sm">Alphabet</p>
                                        </div>
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">💬</div>
                                            <p class="text-white font-bold text-sm">Phrases</p>
                                        </div>
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">📝</div>
                                            <p class="text-white font-bold text-sm">Grammar</p>
                                        </div>
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">📚</div>
                                            <p class="text-white font-bold text-sm">Vocabulary</p>
                                        </div>
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">✍️</div>
                                            <p class="text-white font-bold text-sm">Writing</p>
                                        </div>
                                        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-xl rounded-xl p-4 text-center transition-all duration-300 hover:scale-105">
                                            <div class="text-4xl mb-2">📖</div>
                                            <p class="text-white font-bold text-sm">Reading</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Family Tree - Tall Card -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                            <a href="<?php echo BASE_URL; ?>pages/family-tree.php" class="block group bg-gradient-to-br from-emerald-400 to-green-500 rounded-3xl p-8 shadow-2xl hover:shadow-emerald-500/50 transition-all duration-500 hover:scale-105 h-full relative overflow-hidden">
                                <div class="absolute bottom-0 right-0 text-9xl opacity-10">🌳</div>
                                <div class="relative z-10 h-full flex flex-col">
                                    <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-12 transition-all duration-500">🌳</div>
                                    <h3 class="text-3xl font-black text-white mb-2">Family Tree</h3>
                                    <p class="text-white/90 text-lg mb-6">Learn relationships</p>
                                    <div class="mt-auto flex gap-2 flex-wrap">
                                        <span class="text-3xl">👴</span>
                                        <span class="text-3xl">👵</span>
                                        <span class="text-3xl">👨‍👩‍👧</span>
                                        <span class="text-3xl">🏠</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Math - Square Card -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.4s;">
                            <a href="<?php echo BASE_URL; ?>pages/math.php" class="block group bg-gradient-to-br from-orange-400 to-red-500 rounded-3xl p-8 shadow-2xl hover:shadow-orange-500/50 transition-all duration-500 hover:scale-105 relative overflow-hidden">
                                <div class="absolute bottom-0 right-0 text-9xl opacity-10">🧮</div>
                                <div class="relative z-10">
                                    <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-12 transition-all duration-500">🧮</div>
                                    <h3 class="text-3xl font-black text-white mb-2">Math</h3>
                                    <p class="text-white/90 text-lg mb-4">Numbers & Logic</p>
                                    <div class="flex gap-2">
                                        <span class="text-3xl">➕</span>
                                        <span class="text-3xl">➖</span>
                                        <span class="text-3xl">✖️</span>
                                        <span class="text-3xl">➗</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Science - Square Card -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.5s;">
                            <a href="<?php echo BASE_URL; ?>pages/science.php" class="block group bg-gradient-to-br from-cyan-400 to-blue-500 rounded-3xl p-8 shadow-2xl hover:shadow-cyan-500/50 transition-all duration-500 hover:scale-105 relative overflow-hidden">
                                <div class="absolute bottom-0 right-0 text-9xl opacity-10">🧪</div>
                                <div class="relative z-10">
                                    <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-12 transition-all duration-500">🧪</div>
                                    <h3 class="text-3xl font-black text-white mb-2">Science</h3>
                                    <p class="text-white/90 text-lg mb-4">Explore nature</p>
                                    <div class="flex gap-2">
                                        <span class="text-3xl">🌱</span>
                                        <span class="text-3xl">🐘</span>
                                        <span class="text-3xl">💧</span>
                                        <span class="text-3xl">🌍</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Stories - Square Card -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
                            <a href="<?php echo BASE_URL; ?>pages/stories.php" class="block group bg-gradient-to-br from-amber-400 to-yellow-500 rounded-3xl p-8 shadow-2xl hover:shadow-amber-500/50 transition-all duration-500 hover:scale-105 relative overflow-hidden">
                                <div class="absolute bottom-0 right-0 text-9xl opacity-10">📖</div>
                                <div class="relative z-10">
                                    <div class="text-7xl mb-4 group-hover:scale-125 group-hover:rotate-12 transition-all duration-500">📖</div>
                                    <h3 class="text-3xl font-black text-white mb-2">Stories</h3>
                                    <p class="text-white/90 text-lg mb-4">Moral tales</p>
                                    <div class="flex gap-2">
                                        <span class="text-3xl">🌳</span>
                                        <span class="text-3xl">🐜</span>
                                        <span class="text-3xl">🧠</span>
                                        <span class="text-3xl">🤝</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Project Documentation Banner -->
        <section class="py-12 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-slate-800 dark:to-indigo-900/30">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl overflow-hidden hover:shadow-purple-500/50 transition-all duration-500 hover:scale-[1.02]">
                    <div class="flex flex-col md:flex-row items-center justify-between p-8 md:p-10 gap-6">
                        <!-- Left Side - Button -->
                         <div class="w-full md:w-auto text-center md:text-right">
                            <p class="text-white text-2xl md:text-3xl font-bold leading-relaxed" dir="rtl">
                                پراجيڪٽ جي مڪمل دستاويز
                            </p>
                            <p class="text-white/90 text-lg mt-2">
                                تفصيلي معلومات لاءِ
                            </p>
                        </div>s
                        
                        
                        <!-- Right Side - Sindhi Text -->
                        <div class="w-full md:w-auto">
                            <a href="https://docs.sindh.ai" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 px-8 py-4 bg-white hover:bg-slate-50 text-indigo-700 font-bold text-lg rounded-2xl shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span class="ltr">Documentation</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
        <!-- Stories Section -->
        <section id="why-us" class="py-16 sm:py-24 bg-gradient-to-b from-white to-purple-50 dark:from-slate-900 dark:to-slate-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black bg-gradient-to-r from-orange-600 to-red-600 dark:from-orange-400 dark:to-red-400 bg-clip-text text-transparent mb-4">
                        📖 سنڌي آکاڻيون
                    </h2>
                    <p class="ltr text-xl sm:text-2xl text-slate-600 dark:text-slate-300 font-medium">
                        Moral Stories with Life Lessons
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto mb-8">
                    <!-- Story Category 1 -->
                    <div class="bg-gradient-to-br from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-emerald-200 dark:border-emerald-800">
                        <div class="text-6xl mb-4 text-center">🌳</div>
                        <h3 class="text-xl font-bold text-emerald-800 dark:text-emerald-100 mb-2 text-center">فطرت</h3>
                        <p class="ltr text-sm text-slate-600 dark:text-slate-300 text-center">Nature & Environment</p>
                    </div>
                    
                    <!-- Story Category 2 -->
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-amber-200 dark:border-amber-800">
                        <div class="text-6xl mb-4 text-center">💪</div>
                        <h3 class="text-xl font-bold text-amber-800 dark:text-amber-100 mb-2 text-center">محنت</h3>
                        <p class="ltr text-sm text-slate-600 dark:text-slate-300 text-center">Hard Work & Dedication</p>
                    </div>
                    
                    <!-- Story Category 3 -->
                    <div class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-purple-200 dark:border-purple-800">
                        <div class="text-6xl mb-4 text-center">🧠</div>
                        <h3 class="text-xl font-bold text-purple-800 dark:text-purple-100 mb-2 text-center">عقل</h3>
                        <p class="ltr text-sm text-slate-600 dark:text-slate-300 text-center">Wisdom & Intelligence</p>
                    </div>
                    
                    <!-- Story Category 4 -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-blue-200 dark:border-blue-800">
                        <div class="text-6xl mb-4 text-center">❤️</div>
                        <h3 class="text-xl font-bold text-blue-800 dark:text-blue-100 mb-2 text-center">دوستي</h3>
                        <p class="ltr text-sm text-slate-600 dark:text-slate-300 text-center">Friendship & Love</p>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <div class="text-center">
                    <button onclick="window.location.href='<?php echo BASE_URL; ?>pages/stories.php'" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white text-xl font-bold rounded-2xl shadow-2xl transition-all duration-300 hover:scale-110 hover:shadow-orange-500/50">
                        📖 سڀي آکاڻيون پڊهو →
                    </button>
                </div>
            </div>
        </section>
        
        <style>
            @keyframes spin-slow {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-spin-slow {
                animation: spin-slow 20s linear infinite;
            }
            .animate-fade-in-up {
                animation: fade-in-up 0.6s ease-out forwards;
            }
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
        <?php
    }
]);
?>
