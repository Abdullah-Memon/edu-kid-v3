<?php
/**
 * Exercise Page - Interactive Quiz for Kids
 * URL: exercise.php?class=1&bait=0
 */

// Load configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Load required components
require_once __DIR__ . '/../components/layout.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/footer.php';

// Get parameters
$classId = isset($_GET['class']) ? intval($_GET['class']) : 1;
$baitIndex = isset($_GET['bait']) ? intval($_GET['bait']) : 0;

// Validate class ID
if ($classId < 1 || $classId > 5) {
    header('Location: class.php?id=1');
    exit;
}

// Class configuration
$classConfig = [
    1 => [
        'name' => 'ڪلاس پھريون',
        'color' => 'from-pink-400 via-rose-400 to-red-400',
        'emoji' => '🌸'
    ],
    2 => [
        'name' => 'ڪلاس ٻيون',
        'color' => 'from-blue-400 via-cyan-400 to-teal-400',
        'emoji' => '🌊'
    ],
    3 => [
        'name' => 'ڪلاس ٽيون',
        'color' => 'from-purple-400 via-violet-400 to-indigo-400',
        'emoji' => '🦋'
    ],
    4 => [
        'name' => 'ڪلاس چوٿون',
        'color' => 'from-green-400 via-emerald-400 to-lime-400',
        'emoji' => '🌿'
    ],
    5 => [
        'name' => 'ڪلاس پنجون',
        'color' => 'from-orange-400 via-amber-400 to-yellow-400',
        'emoji' => '⭐'
    ]
];

$currentClass = $classConfig[$classId];

// Load class data
$jsonFile = __DIR__ . '/../assets/Data/classes/class' . $classId . '.json';
$classData = [];
$baitData = null;
$exercises = [];

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $jsonContent = preg_replace('/^\xEF\xBB\xBF/', '', $jsonContent);
    $classData = json_decode($jsonContent, true);
    
    if (isset($classData[$baitIndex])) {
        $baitData = $classData[$baitIndex];
        $rawExercises = $baitData['exercise'] ?? [];
        
        // Filter exercises that have a 'type' field
        $exercises = [];
        foreach ($rawExercises as $exercise) {
            if (isset($exercise['type'])) {
                // Randomize option order for MCQs
                if ($exercise['type'] === 'mcqs' && isset($exercise['options'])) {
                    $options = $exercise['options'];
                    shuffle($options);
                    $exercise['options'] = $options;
                }
                $exercises[] = $exercise;
            }
        }
    }
}

// Redirect if no exercises found
if (empty($exercises)) {
    header('Location: class.php?id=' . $classId);
    exit;
}

// Page meta tags
$pageTitle = 'مشق - ' . $baitData['baitTitle'] . ' | ' . SITE_NAME;

// Render page
layout([
    'title' => $pageTitle,
    'meta' => [
        'title' => $pageTitle,
        'description' => 'Interactive exercise for Sindhi learning',
        'keywords' => 'sindhi exercise, quiz, learning',
        'type' => 'website'
    ],
    'showHeader' => true,
    'showFooter' => true,
    'showSplash' => false,
    'content' => function() use ($classId, $currentClass, $baitData, $exercises) {
        ?>
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-8 lg:py-12 bg-gradient-to-br <?php echo $currentClass['color']; ?>">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 text-8xl animate-bounce">✏️</div>
                <div class="absolute top-20 right-20 text-6xl animate-pulse">📝</div>
                <div class="absolute bottom-10 left-1/4 text-5xl animate-bounce" style="animation-delay: 0.2s;">✨</div>
                <div class="absolute bottom-20 right-1/3 text-7xl animate-pulse" style="animation-delay: 0.4s;">🎯</div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center text-white">
                    <!-- Icon Badge -->
                    <div class="inline-block mb-4 px-6 py-3 bg-white/20 backdrop-blur-lg rounded-full border-2 border-white/40 shadow-xl animate-bounce">
                        <span class="text-5xl"><?php echo $currentClass['emoji']; ?></span>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-4xl lg:text-5xl font-bold mb-3 drop-shadow-lg">
                        مشق جو وقت! 🎉
                    </h1>
                    <h2 class="text-xl lg:text-2xl font-semibold mb-4 opacity-90">
                        <?php echo htmlspecialchars($baitData['baitTitle']); ?>
                    </h2>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-3 mb-4">
                        <div class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-2xl font-bold"><?php echo count($exercises); ?></div>
                            <div class="text-xs opacity-90">سوال</div>
                        </div>
                        <div class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30">
                            <div class="text-2xl font-bold">⏱️</div>
                            <div class="text-xs opacity-90">وقت جي ڪا حد ناهي</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Exercise Container -->
        <section class="container mx-auto px-4 py-6">
            <div class="max-w-4xl mx-auto" style="max-height: 85dvh; display: flex; flex-direction: column;">
                
                <!-- Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-400">ترقي</span>
                        <span id="progressText" class="text-sm font-bold text-slate-600 dark:text-slate-400">
                            <span id="currentQuestion">1</span> / <?php echo count($exercises); ?>
                        </span>
                    </div>
                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden shadow-inner">
                        <div id="progressBar" class="h-full bg-gradient-to-r <?php echo $currentClass['color']; ?> transition-all duration-500 ease-out" style="width: 0%"></div>
                    </div>
                </div>
                
                <!-- Question Container (scrollable if needed) -->
                <div class="flex-1 overflow-y-auto mb-6">
                    <?php foreach ($exercises as $index => $exercise): ?>
                        <div id="question<?php echo $index; ?>" class="question-container <?php echo $index === 0 ? '' : 'hidden'; ?>" data-question="<?php echo $index; ?>" data-type="<?php echo htmlspecialchars($exercise['type']); ?>">
                            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden border-4 border-slate-200 dark:border-slate-700">
                                
                                <!-- Question Header -->
                                <div class="bg-gradient-to-r <?php echo $currentClass['color']; ?> p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/50 shadow-lg">
                                            <span class="text-xl font-bold text-white"><?php echo $index + 1; ?></span>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl lg:text-2xl font-bold text-white leading-relaxed text-center">
                                                <?php echo htmlspecialchars($exercise['question']); ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Answer Area -->
                                <div class="p-6">
                                    <?php if ($exercise['type'] === 'mcqs'): ?>
                                        <!-- Multiple Choice Options -->
                                        <div class="space-y-3">
                                            <?php foreach ($exercise['options'] as $optIndex => $option): ?>
                                                <button 
                                                    type="button"
                                                    class="option-btn w-full p-5 text-right bg-slate-50 dark:bg-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 rounded-2xl border-3 border-slate-200 dark:border-slate-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                                                    data-question="<?php echo $index; ?>"
                                                    data-option="<?php echo htmlspecialchars($option); ?>"
                                                    data-correct="<?php echo htmlspecialchars($exercise['answer']); ?>"
                                                    onclick="selectOption(<?php echo $index; ?>, this)">
                                                    <div class="flex items-center gap-4">
                                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white dark:bg-slate-800 border-2 border-slate-300 dark:border-slate-500 flex items-center justify-center font-bold text-slate-600 dark:text-slate-300">
                                                            <?php echo chr(65 + $optIndex); ?>
                                                        </div>
                                                        <span class="flex-1 text-lg font-medium text-slate-700 dark:text-slate-200 leading-loose">
                                                            <?php echo htmlspecialchars($option); ?>
                                                        </span>
                                                    </div>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    <?php elseif ($exercise['type'] === 'fill-blank'): ?>
                                        <!-- Fill in the Blank -->
                                        <div class="space-y-4">
                                            <div class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-600 rounded-2xl p-6 border-2 border-slate-200 dark:border-slate-500">
                                                <label class="block text-sm font-bold text-slate-600 dark:text-slate-400 mb-3 text-center">پنهنجو جواب لکو:</label>
                                                <input 
                                                    type="text"
                                                    id="fillBlankInput<?php echo $index; ?>"
                                                    class="w-full px-6 py-4 text-xl text-center bg-white dark:bg-slate-800 border-3 border-slate-300 dark:border-slate-500 rounded-xl focus:ring-4 focus:ring-blue-400 focus:border-blue-400 transition-all duration-300"
                                                    placeholder="هتي لکو..."
                                                    data-correct="<?php echo htmlspecialchars($exercise['answer']); ?>"
                                                    onkeyup="handleFillBlankInput(<?php echo $index; ?>)"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        
                                    <?php elseif ($exercise['type'] === 'true-false'): ?>
                                        <!-- True/False Options -->
                                        <div class="space-y-3">
                                            <button 
                                                type="button"
                                                class="option-btn w-full p-6 text-center bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/30 dark:to-teal-900/30 hover:from-emerald-100 hover:to-teal-100 dark:hover:from-emerald-900/50 dark:hover:to-teal-900/50 rounded-2xl border-3 border-emerald-300 dark:border-emerald-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                                                data-question="<?php echo $index; ?>"
                                                data-option="صحيح"
                                                data-correct="<?php echo htmlspecialchars($exercise['answer']); ?>"
                                                onclick="selectOption(<?php echo $index; ?>, this)">
                                                <div class="flex items-center justify-center gap-4">
                                                    <span class="text-4xl">✓</span>
                                                    <span class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">صحيح</span>
                                                </div>
                                            </button>
                                            <button 
                                                type="button"
                                                class="option-btn w-full p-6 text-center bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/30 dark:to-rose-900/30 hover:from-red-100 hover:to-rose-100 dark:hover:from-red-900/50 dark:hover:to-rose-900/50 rounded-2xl border-3 border-red-300 dark:border-red-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                                                data-question="<?php echo $index; ?>"
                                                data-option="غلط"
                                                data-correct="<?php echo htmlspecialchars($exercise['answer']); ?>"
                                                onclick="selectOption(<?php echo $index; ?>, this)">
                                                <div class="flex items-center justify-center gap-4">
                                                    <span class="text-4xl">✗</span>
                                                    <span class="text-2xl font-bold text-red-700 dark:text-red-300">غلط</span>
                                                </div>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Action Buttons -->
                <div class="text-center space-y-3">
                    <!-- Check Button -->
                    <button 
                        id="checkBtn"
                        onclick="checkAnswer()"
                        disabled
                        class="w-full px-8 py-5 bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 text-white text-xl font-bold rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:hover:shadow-2xl">
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>چيڪ ڪريو</span>
                        </span>
                    </button>
                    
                    <!-- Next Button -->
                    <button 
                        id="nextBtn"
                        onclick="nextQuestion()"
                        class="hidden w-full px-8 py-5 bg-gradient-to-r from-purple-400 via-indigo-400 to-blue-400 text-white text-xl font-bold rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center justify-center gap-3">
                            <span>اڳيان وڌو</span>
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </button>
                    
                    <!-- Finish Button -->
                    <button 
                        id="finishBtn"
                        onclick="finishExercise()"
                        class="hidden w-full px-8 py-5 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 text-white text-xl font-bold rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>مڪمل ڪريو</span>
                        </span>
                    </button>
                </div>
                
                <!-- Toast Notification -->
                <div id="toastNotification" class="fixed inset-0 z-50 hidden flex items-center justify-center">
                    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
                    <div id="toastContent" class="relative z-10 max-w-md w-full mx-4 p-8 rounded-3xl shadow-2xl transform transition-all duration-300 scale-0">
                        <!-- Toast content will be inserted here -->
                    </div>
                </div>
                
                <!-- Results Modal -->
                <div id="resultsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm"></div>
                    
                    <div class="flex min-h-screen items-center justify-center p-4">
                        <div class="relative w-full max-w-2xl transform transition-all">
                            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden">
                                
                                <!-- Results Content -->
                                <div id="resultsContent" class="p-8 text-center">
                                    <!-- Will be populated by JavaScript -->
                                </div>
                                
                                <!-- Actions -->
                                <div class="p-6 bg-slate-50 dark:bg-slate-900 border-t-4 border-slate-200 dark:border-slate-700">
                                    <div class="flex flex-wrap justify-center gap-3">
                                        <a href="class.php?id=<?php echo $classId; ?>" class="px-8 py-4 bg-gradient-to-r <?php echo $currentClass['color']; ?> text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                            </svg>
                                            <span>واپس وڃو</span>
                                        </a>
                                        <button onclick="retryExercise()" class="px-8 py-4 bg-gradient-to-r from-purple-400 to-indigo-400 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            <span>ٻيهر ڪوشش ڪريو</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        
        <!-- Floating Animation & Scripts -->
        <style>
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
            .option-btn.selected {
                background: linear-gradient(to right, rgb(147, 197, 253), rgb(191, 219, 254));
                border-color: rgb(59, 130, 246);
            }
            .dark .option-btn.selected {
                background: linear-gradient(to right, rgb(30, 58, 138), rgb(30, 64, 175));
                border-color: rgb(96, 165, 250);
            }
            .option-btn.correct {
                background: linear-gradient(to right, rgb(134, 239, 172), rgb(187, 247, 208));
                border-color: rgb(34, 197, 94);
            }
            .dark .option-btn.correct {
                background: linear-gradient(to right, rgb(20, 83, 45), rgb(22, 101, 52));
                border-color: rgb(74, 222, 128);
            }
            .option-btn.incorrect {
                background: linear-gradient(to right, rgb(252, 165, 165), rgb(254, 202, 202));
                border-color: rgb(239, 68, 68);
            }
            .dark .option-btn.incorrect {
                background: linear-gradient(to right, rgb(127, 29, 29), rgb(153, 27, 27));
                border-color: rgb(248, 113, 113);
            }
            .fill-blank-correct {
                border-color: rgb(34, 197, 94) !important;
                background: linear-gradient(to right, rgb(134, 239, 172), rgb(187, 247, 208)) !important;
            }
            .fill-blank-incorrect {
                border-color: rgb(239, 68, 68) !important;
                background: linear-gradient(to right, rgb(252, 165, 165), rgb(254, 202, 202)) !important;
            }
        </style>
        
        <script>
            let currentQuestionIndex = 0;
            let selectedAnswer = null;
            let answers = [];
            let answerChecked = false;
            const totalQuestions = <?php echo count($exercises); ?>;
            
            // Select an option
            function selectOption(questionIndex, button) {
                // Only allow selection if answer hasn't been checked yet
                if (answerChecked) return;
                
                const allButtons = document.querySelectorAll(`#question${questionIndex} .option-btn`);
                
                // Remove selected class from all buttons
                allButtons.forEach(btn => btn.classList.remove('selected'));
                
                // Add selected class to clicked button
                button.classList.add('selected');
                
                // Store selected answer
                selectedAnswer = button.dataset.option;
                
                // Enable check button
                document.getElementById('checkBtn').disabled = false;
            }
            
            // Handle fill-in-the-blank input
            function handleFillBlankInput(questionIndex) {
                if (answerChecked) return;
                
                const input = document.getElementById('fillBlankInput' + questionIndex);
                const value = input.value.trim();
                
                // Enable check button if there's input
                if (value.length > 0) {
                    selectedAnswer = value;
                    document.getElementById('checkBtn').disabled = false;
                } else {
                    selectedAnswer = null;
                    document.getElementById('checkBtn').disabled = true;
                }
            }
            
            // Check the answer
            function checkAnswer() {
                if (selectedAnswer === null) return;
                
                // Mark that answer has been checked
                answerChecked = true;
                
                const currentQuestion = document.getElementById('question' + currentQuestionIndex);
                const questionType = currentQuestion.dataset.type;
                let correctAnswer = null;
                let isCorrect = false;
                
                if (questionType === 'mcqs' || questionType === 'true-false') {
                    // Handle MCQs and True/False
                    const allButtons = currentQuestion.querySelectorAll('.option-btn');
                    
                    // Find correct answer and check user's answer
                    allButtons.forEach(btn => {
                        if (btn.dataset.correct) {
                            correctAnswer = btn.dataset.correct;
                        }
                        
                        // Disable all buttons
                        btn.disabled = true;
                        btn.classList.remove('hover:scale-105', 'hover:bg-slate-100', 'hover:shadow-lg');
                        
                        // For true-false, normalize the answer comparison
                        let userAnswer = selectedAnswer;
                        let correctAnswerNormalized = correctAnswer;
                        
                        if (questionType === 'true-false') {
                            // Normalize answers to handle both English and Sindhi
                            if (correctAnswer.toLowerCase() === 'true' || correctAnswer === 'صحيح') {
                                correctAnswerNormalized = 'صحيح';
                            } else if (correctAnswer.toLowerCase() === 'false' || correctAnswer === 'غلط') {
                                correctAnswerNormalized = 'غلط';
                            }
                        }
                        
                        // Highlight correct/incorrect
                        if (btn.dataset.option === selectedAnswer) {
                            if ((questionType === 'true-false' && userAnswer === correctAnswerNormalized) || 
                                (questionType !== 'true-false' && btn.dataset.option === correctAnswer)) {
                                btn.classList.add('correct');
                                isCorrect = true;
                            } else {
                                btn.classList.add('incorrect');
                            }
                        }
                        
                        // Always show the correct answer
                        if ((questionType === 'true-false' && btn.dataset.option === correctAnswerNormalized) ||
                            (questionType !== 'true-false' && btn.dataset.option === correctAnswer)) {
                            btn.classList.add('correct');
                        }
                    });
                } else if (questionType === 'fill-blank') {
                    // Handle Fill in the Blank
                    const input = document.getElementById('fillBlankInput' + currentQuestionIndex);
                    correctAnswer = input.dataset.correct;
                    
                    // Disable input
                    input.disabled = true;
                    
                    // Check answer (case-insensitive)
                    if (selectedAnswer.toLowerCase().trim() === correctAnswer.toLowerCase().trim()) {
                        isCorrect = true;
                        input.classList.add('fill-blank-correct');
                    } else {
                        isCorrect = false;
                        input.classList.add('fill-blank-incorrect');
                    }
                }
                
                // Store result
                answers[currentQuestionIndex] = isCorrect;
                
                // Show toast notification
                showToast(isCorrect, correctAnswer);
                
                // Update progress
                updateProgress();
                
                // Hide check button, show appropriate next button after toast delay
                setTimeout(() => {
                    document.getElementById('checkBtn').classList.add('hidden');
                
                    if (currentQuestionIndex < totalQuestions - 1) {
                        document.getElementById('nextBtn').classList.remove('hidden');
                    } else {
                        document.getElementById('finishBtn').classList.remove('hidden');
                    }
                }, 2000);
            }
            
            // Show toast notification
            function showToast(isCorrect, correctAnswer) {
                const toast = document.getElementById('toastNotification');
                const toastContent = document.getElementById('toastContent');
                
                if (isCorrect) {
                    toastContent.className = 'relative z-10 max-w-md w-full mx-4 p-8 rounded-3xl shadow-2xl transform transition-all duration-300 bg-gradient-to-br from-emerald-400 to-teal-400';
                    toastContent.innerHTML = `
                        <div class="text-center text-white">
                            <div class="text-6xl mb-4 animate-bounce">🎉</div>
                            <div class="text-2xl font-bold mb-2">واهه! صحيح جواب!</div>
                            <div class="text-lg opacity-90">شاباش! تون ڪمال ڪيو!</div>
                        </div>
                    `;
                } else {
                    toastContent.className = 'relative z-10 max-w-md w-full mx-4 p-8 rounded-3xl shadow-2xl transform transition-all duration-300 bg-gradient-to-br from-orange-400 to-red-400';
                    toastContent.innerHTML = `
                        <div class="text-center text-white space-y-3">
                            <div class="text-6xl mb-4">❌</div>
                            <div class="text-2xl font-bold mb-2">غلط جواب!</div>
                        </div>
                    `;
                }
                
                // Show toast with animation
                toast.classList.remove('hidden');
                setTimeout(() => {
                    toastContent.classList.add('scale-100');
                    toastContent.classList.remove('scale-0');
                }, 10);
                
                // Hide toast after 2 seconds
                setTimeout(() => {
                    toastContent.classList.remove('scale-100');
                    toastContent.classList.add('scale-0');
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 300);
                }, 2000);
            }
            
            // Move to next question
            function nextQuestion() {
                // Hide current question
                document.getElementById('question' + currentQuestionIndex).classList.add('hidden');
                
                // Move to next question
                currentQuestionIndex++;
                
                // Show next question
                document.getElementById('question' + currentQuestionIndex).classList.remove('hidden');
                
                // Reset state
                selectedAnswer = null;
                answerChecked = false;
                
                // Update UI
                document.getElementById('currentQuestion').textContent = currentQuestionIndex + 1;
                document.getElementById('checkBtn').classList.remove('hidden');
                document.getElementById('checkBtn').disabled = true;
                document.getElementById('nextBtn').classList.add('hidden');
                
                // Scroll to top of question
                document.querySelector('.overflow-y-auto').scrollTop = 0;
                
                // Focus on fill-blank input if it's a fill-blank question
                const currentQuestion = document.getElementById('question' + currentQuestionIndex);
                if (currentQuestion.dataset.type === 'fill-blank') {
                    const input = document.getElementById('fillBlankInput' + currentQuestionIndex);
                    if (input) input.focus();
                }
            }
            
            // Update progress bar
            function updateProgress() {
                const answered = answers.filter(a => a !== undefined).length;
                const percentage = (answered / totalQuestions) * 100;
                document.getElementById('progressBar').style.width = percentage + '%';
            }
            
            // Finish exercise and show results
            function finishExercise() {
                const correctCount = answers.filter(a => a === true).length;
                showResults(correctCount);
            }
            
            // Show results modal
            function showResults(correctCount) {
                const percentage = Math.round((correctCount / totalQuestions) * 100);
                const modal = document.getElementById('resultsModal');
                const content = document.getElementById('resultsContent');
                
                let emoji = '🎉';
                let message = 'واهه! شاندار!';
                let color = 'from-emerald-400 to-teal-400';
                
                if (percentage === 100) {
                    emoji = '🏆';
                    message = 'مڪمل! توهان هڪ اسٽار آهيو!';
                    color = 'from-yellow-400 to-orange-400';
                } else if (percentage >= 70) {
                    emoji = '🎉';
                    message = 'واهه! شاندار ڪم!';
                    color = 'from-emerald-400 to-teal-400';
                } else if (percentage >= 50) {
                    emoji = '👍';
                    message = 'سٺو! وڌيڪ ڪوشش ڪريو!';
                    color = 'from-blue-400 to-cyan-400';
                } else {
                    emoji = '💪';
                    message = 'ڪوشش جاري رکو!';
                    color = 'from-purple-400 to-indigo-400';
                }
                
                content.innerHTML = `
                    <div class="text-8xl mb-6 animate-bounce">${emoji}</div>
                    <h2 class="text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">${message}</h2>
                    <div class="mb-6">
                        <div class="inline-block px-8 py-4 bg-gradient-to-r ${color} text-white rounded-2xl shadow-xl">
                            <div class="text-5xl font-bold">${percentage}%</div>
                            <div class="text-lg">توهان جو نتيجو</div>
                        </div>
                    </div>
                    <div class="flex justify-center gap-6 text-slate-600 dark:text-slate-400">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">${correctCount}</div>
                            <div class="text-sm">صحيح</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600 dark:text-red-400">${totalQuestions - correctCount}</div>
                            <div class="text-sm">غلط</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-slate-600 dark:text-slate-400">${totalQuestions}</div>
                            <div class="text-sm">ڪل</div>
                        </div>
                    </div>
                `;
                
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            // Retry exercise
            function retryExercise() {
                location.reload();
            }
            
            // Initialize
            updateProgress();
        </script>
        
        <?php
    }
]);
?>
