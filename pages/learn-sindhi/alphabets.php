<?php
// Load data
$alphabetsData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/alphabets/alphabet.json'), true) ?? [];
$testData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/alphabets/test.json'), true) ?? [];
?>

<!-- Mode Selector - Horizontal Navigation Style -->
<section class="sticky top-20 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl shadow-md border-b border-indigo-200 dark:border-indigo-800 mb-8">
    <div class="container mx-auto px-4 py-4 justify-center flex">
        <div class="flex gap-3 scrollbar-hide">
            <button onclick="switchMode('learn')" id="learnModeBtn" 
                    class="mode-btn active ltr px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full text-base font-bold whitespace-nowrap hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                <!-- <span class="text-2xl">📖</span> -->
                <span>Learn</span>
            </button>
            <button onclick="switchMode('practice')" id="practiceModeBtn"
                    class="mode-btn ltr px-8 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-full text-base font-bold whitespace-nowrap hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                <!-- <span class="text-2xl">✏️</span> -->
                <span>Practice</span>
            </button>
            <button onclick="switchMode('test')" id="testModeBtn"
                    class="mode-btn ltr px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full text-base font-bold whitespace-nowrap hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                <!-- <span class="text-2xl">🎯</span> -->
                <span>Test</span>
            </button>
        </div>
    </div>
</section>

<!-- LEARN MODE -->
<div id="learnMode" class="mode-content">
    <section class="container mx-auto px-4">
        <!-- Simple Header -->
        <div class="max-w-4xl mx-auto text-center mb-8">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <span class="text-5xl">🔤</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-indigo-600 dark:text-indigo-400">
                    Sindhi Alphabets
                </h2>
            </div>
            <p class="text-lg text-slate-600 dark:text-slate-400 mb-6" dir="rtl">
                سنڌي جا 52 اکر - Click any letter to hear pronunciation
            </p>
            
            <!-- Control Buttons -->
            <div class="ltr flex flex-wrap justify-center gap-3">
                <button onclick="startPlayAll()" id="startBtn"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <span class="text-xl">▶️</span>
                    <span>Start</span>
                </button>
                <button onclick="pausePlayback()" id="pauseBtn" 
                        class="hidden px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <span class="text-xl">⏸️</span>
                    <span>Pause</span>
                </button>
                <button onclick="stopPlayback()" id="stopBtn" 
                        class="hidden px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <span class="text-xl">⏹️</span>
                    <span>Stop</span>
                </button>
            </div>
        </div>
        
        <!-- Alphabets Grid -->
        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 xl:grid-cols-13 gap-3 max-w-7xl mx-auto">
            <?php foreach ($alphabetsData as $index => $alphabet): ?>
                <div class="alphabet-card group relative cursor-pointer rounded-xl bg-white dark:bg-slate-800 p-4 shadow-md hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700 hover:border-indigo-400 dark:hover:border-indigo-500"
                     data-index="<?php echo $index; ?>"
                     data-audio="<?php echo BASE_URL . $alphabet['audio']; ?>"
                     onclick="playAlphabet(<?php echo $index; ?>)">
                    
                    <!-- Letter -->
                    <div class="text-center">
                        <div class="text-4xl lg:text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2 group-hover:scale-110 transition-transform duration-200" dir="rtl">
                            <?php echo htmlspecialchars($alphabet['letter']); ?>
                        </div>
                        
                        <p class="text-xs font-medium text-slate-600 dark:text-slate-400" dir="rtl">
                            <?php echo htmlspecialchars($alphabet['name']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<!-- PRACTICE MODE -->
<div id="practiceMode" class="mode-content hidden">
    <section class="container mx-auto px-4">
        <!-- Compact container with fixed height -->
        <div class="max-w-7xl mx-auto" style="height: 95dvh; display: flex; flex-direction: column;">
            
            <!-- Compact Header -->
            <div class="text-center mb-3 flex-shrink-0">
                <div class="inline-flex items-center justify-center gap-2 mb-1">
                    <span class="text-3xl">✏️</span>
                    <h2 class="text-2xl lg:text-3xl font-bold text-purple-600 dark:text-purple-400">
                        Writing Practice
                    </h2>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400" dir="rtl">
                    لکڻ جي مشق - Practice writing each letter
                </p>
            </div>

            <!-- Main Content Area - Flex grow to fill space -->
            <div class="flex-1 flex flex-col gap-3 overflow-hidden">
                
                <!-- Top Section: Reference Card (Letter, GIF, Audio) -->
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-lg border border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center">
                        <!-- Letter Display -->
                        <div class="text-center">
                            <div class="text-5xl lg:text-6xl font-bold text-purple-600 dark:text-purple-400 mb-1" dir="rtl" id="practiceLetter">
                                <?php echo htmlspecialchars($alphabetsData[0]['letter']); ?>
                            </div>
                            <p class="text-lg font-semibold text-slate-700 dark:text-slate-300" dir="rtl" id="practiceName">
                                <?php echo htmlspecialchars($alphabetsData[0]['name']); ?>
                            </p>
                        </div>
                        
                        <!-- GIF Reference -->
                        <div class="flex justify-center">
                            <div class="rounded-lg overflow-hidden shadow-md border border-slate-200 dark:border-slate-700 bg-white" style="max-height: 180px;">
                                <img id="practiceGif" src="<?php echo BASE_URL; ?>assets/Data/alphabets/write-gif/1.gif" 
                                     alt="Writing guide" class="w-full h-full object-contain" style="max-height: 180px;">
                            </div>
                        </div>
                        
                        <!-- Audio Button -->
                        <div class="flex justify-center">
                            <button onclick="playPracticeAudio()" 
                                    class="ltr px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-md transition-all flex items-center gap-2">
                                <span class="text-xl">🔊</span>
                                <span>Listen</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Drawing Canvas Section - Flex grow to fill remaining space -->
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-lg border border-slate-200 dark:border-slate-700 flex-1 flex flex-col min-h-0">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="ltr text-base font-semibold text-slate-700 dark:text-slate-300">
                            🎨 Drawing Board
                        </h3>
                        
                        <!-- Drawing Tools - Compact inline -->
                        <div class="ltr flex flex-wrap gap-2">
                            <button onclick="setPenTool()" id="penBtn"
                                    class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-sm font-semibold transition-all flex items-center gap-1">
                                <span>✏️</span>
                                <span class="hidden sm:inline">Pen</span>
                            </button>
                            <button onclick="setEraserTool()" id="eraserBtn"
                                    class="px-3 py-1.5 bg-slate-600 hover:bg-slate-700 text-white rounded text-sm font-semibold transition-all flex items-center gap-1">
                                <span>🧹</span>
                                <span class="hidden sm:inline">Eraser</span>
                            </button>
                            <button onclick="clearCanvas()" 
                                    class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-semibold transition-all flex items-center gap-1">
                                <span>🗑️</span>
                                <span class="hidden sm:inline">Clear</span>
                            </button>
                            
                            <input type="color" id="colorPicker" value="#6366f1" 
                                   class="w-8 h-8 rounded cursor-pointer border border-slate-300 dark:border-slate-600"
                                   title="Color">
                            
                            <div class="flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">
                                <input type="range" id="thicknessSlider" min="2" max="20" value="5" 
                                       class="w-16 accent-indigo-600"
                                       title="Brush size">
                                <span id="thicknessValue" class="text-xs font-semibold text-slate-700 dark:text-slate-300 w-5">5</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Canvas - Takes remaining space -->
                    <div class="flex-1 min-h-0">
                        <canvas id="practiceCanvas" width="800" height="400" 
                                class="w-full h-full border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-lg cursor-crosshair bg-white"></canvas>
                    </div>
                </div>

                <!-- Navigation - Fixed at bottom -->
                <div class="ltr flex justify-between items-center gap-3 bg-slate-50 dark:bg-slate-800 rounded-lg p-3 border border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <button onclick="previousLetter()" 
                            class="px-5 py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg font-semibold shadow-sm transition-all flex items-center gap-2">
                        <span class="text-lg">⬅️</span>
                        <span>Previous</span>
                    </button>
                    
                    <div class="px-4 py-2 bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
                        <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                            <span id="currentLetterNum">1</span> <span class="text-sm opacity-50">/</span> <span class="text-sm">52</span>
                        </div>
                    </div>
                    
                    <button onclick="nextLetter()" 
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-sm transition-all flex items-center gap-2">
                        <span>Next</span>
                        <span class="text-lg">➡️</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- TEST MODE -->
<div id="testMode" class="mode-content hidden">
    <section class="container mx-auto px-4">
        <!-- Simple Header -->
        <div class="max-w-4xl mx-auto text-center mb-8">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <span class="text-5xl">🎯</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-green-600 dark:text-green-400">
                    Test Your Knowledge
                </h2>
            </div>
            <p class="text-lg text-slate-600 dark:text-slate-400" dir="rtl">
                تجربو ڪريو - Answer 15 questions
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <!-- Score Display -->
            <div class="ltr bg-white dark:bg-slate-800 rounded-xl p-6 mb-8 shadow-lg border border-slate-200 dark:border-slate-700">
                <div class="flex flex-wrap justify-between items-center gap-6">
                    <div class="flex items-center gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                                <span id="scoreDisplay">0</span><span class="text-lg opacity-50">/</span><span id="totalQuestions" class="text-lg"><?php echo count($testData); ?></span>
                            </div>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Score</p>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                <span id="questionNumber">1</span>
                            </div>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Question</p>
                        </div>
                    </div>
                    <button onclick="restartTest()" 
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-md transition-all flex items-center gap-2">
                        <span class="text-xl">🔄</span>
                        <span>Restart</span>
                    </button>
                </div>
            </div>

            <!-- Question Card -->
            <div id="questionCard" class="bg-white dark:bg-slate-800 rounded-xl p-8 shadow-lg mb-6 border border-slate-200 dark:border-slate-700">
                <h3 class="ltr text-xl lg:text-2xl font-semibold text-slate-800 dark:text-slate-200 mb-3" id="questionText"></h3>
                <p class="text-lg lg:text-xl text-indigo-600 dark:text-indigo-400 mb-6 font-semibold" dir="rtl" id="questionUrdu"></p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="optionsContainer"></div>
                
                <div id="feedbackMessage" class="hidden mt-6 p-4 rounded-lg text-center font-semibold text-lg"></div>
            </div>

            <!-- Test Complete -->
            <div id="testComplete" class="hidden text-center">
                <div class="ltr bg-white dark:bg-slate-800 rounded-xl p-10 shadow-lg border border-slate-200 dark:border-slate-700">
                    <div class="text-7xl mb-6" id="completionEmoji">🎉</div>
                    <h3 class="text-3xl lg:text-4xl font-bold text-slate-800 dark:text-slate-200 mb-6">Test Complete!</h3>
                    
                    <div class="inline-block px-10 py-6 bg-slate-50 dark:bg-slate-900 rounded-xl mb-6">
                        <p class="text-lg font-semibold text-slate-600 dark:text-slate-400 mb-2">Your Score</p>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400">
                            <span id="finalScore">0</span><span class="text-2xl opacity-50">/</span><span class="text-2xl"><?php echo count($testData); ?></span>
                        </p>
                    </div>
                    
                    <p class="text-xl text-slate-700 dark:text-slate-300 mb-8 font-medium" id="performanceMessage"></p>
                    
                    <button onclick="restartTest()" 
                            class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold text-lg shadow-md transition-all flex items-center justify-center gap-2 mx-auto">
                        <span class="text-2xl">🔄</span>
                        <span>Try Again</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* Mode Button Styles */
    .mode-btn {
        position: relative;
        overflow: hidden;
    }
    
    .mode-btn.active {
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.6);
        transform: scale(1.08);
    }
    
    .mode-btn.active::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 10px;
        height: 10px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        animation: pulse-dot 2s ease-in-out infinite;
    }
    
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }
    
    /* Scrollbar hide for horizontal scroll */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Card Animations */
    @keyframes bounce-in {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .alphabet-card {
        animation: bounce-in 0.5s ease-out;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Grid column support for 13 columns */
    @media (min-width: 1280px) {
        .xl\:grid-cols-13 {
            grid-template-columns: repeat(13, minmax(0, 1fr));
        }
    }
</style>

<script>
// Data
const alphabetsData = <?php echo json_encode($alphabetsData); ?>;
const testData = <?php echo json_encode($testData); ?>;
const baseUrl = '<?php echo BASE_URL; ?>';

// Learn Mode State
let currentAudio = null;
let isPlayingAll = false;
let isPaused = false;
let currentPlayIndex = 0;

// Practice Mode State
let currentPracticeIndex = 0;
let isDrawing = false;
let ctx = null;
let currentTool = 'pen';
let currentColor = '#6366f1';
let lineThickness = 5;

// Test Mode State
let currentQuestionIndex = 0;
let score = 0;
let answeredQuestions = new Set();

// Mode switching
function switchMode(mode) {
    // Hide all mode contents
    document.querySelectorAll('.mode-content').forEach(el => el.classList.add('hidden'));
    
    // Remove active class from all buttons
    document.querySelectorAll('.mode-btn').forEach(el => {
        el.classList.remove('active');
    });
    
    // Show selected mode and mark button as active
    document.getElementById(mode + 'Mode').classList.remove('hidden');
    document.getElementById(mode + 'ModeBtn').classList.add('active');
    
    // Scroll to mode selector navigation
    const modeSelector = document.querySelector('.sticky');
    if (modeSelector) {
        const offset = modeSelector.offsetTop - 20;
        window.scrollTo({ top: offset, behavior: 'smooth' });
    }
    
    // Initialize mode-specific functionality
    if (mode === 'practice') {
        initCanvas();
    } else if (mode === 'test') {
        startTest();
    }
}

// ===== LEARN MODE =====
function playAlphabet(index) {
    const alphabet = alphabetsData[index];
    const card = document.querySelector(`.alphabet-card[data-index="${index}"]`);
    
    // Stop any currently playing audio
    if (currentAudio) {
        currentAudio.pause();
        currentAudio.currentTime = 0;
    }
    
    // Remove highlight from all cards
    document.querySelectorAll('.alphabet-card').forEach(el => {
        el.classList.remove('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    });
    
    // Highlight current card
    card.classList.add('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    
    currentAudio = new Audio(baseUrl + alphabet.audio);
    currentAudio.play();
    
    currentAudio.onended = () => {
        card.classList.remove('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    };
}

function startPlayAll() {
    if (isPaused) {
        // Resume from pause
        resumePlayback();
        return;
    }
    
    isPlayingAll = true;
    isPaused = false;
    currentPlayIndex = 0;
    
    // Update button visibility
    document.getElementById('startBtn').classList.add('hidden');
    document.getElementById('pauseBtn').classList.remove('hidden');
    document.getElementById('stopBtn').classList.remove('hidden');
    
    playNextAlphabet();
}

function pausePlayback() {
    isPaused = true;
    
    if (currentAudio) {
        currentAudio.pause();
    }
    
    // Update button visibility and text
    document.getElementById('pauseBtn').classList.add('hidden');
    document.getElementById('startBtn').classList.remove('hidden');
    document.getElementById('startBtn').innerHTML = '<span class="text-xl">▶️</span><span>Resume</span>';
}

function resumePlayback() {
    isPaused = false;
    
    if (currentAudio) {
        currentAudio.play();
        
        // Update button visibility
        document.getElementById('startBtn').classList.add('hidden');
        document.getElementById('pauseBtn').classList.remove('hidden');
    }
}

function playNextAlphabet() {
    if (!isPlayingAll || currentPlayIndex >= alphabetsData.length) {
        stopPlayback();
        return;
    }
    
    const alphabet = alphabetsData[currentPlayIndex];
    const card = document.querySelector(`.alphabet-card[data-index="${currentPlayIndex}"]`);
    
    // Remove highlight from all cards
    document.querySelectorAll('.alphabet-card').forEach(el => {
        el.classList.remove('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    });
    
    // Highlight current card
    card.classList.add('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    
    currentAudio = new Audio(baseUrl + alphabet.audio);
    currentAudio.play();
    
    currentAudio.onended = () => {
        card.classList.remove('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
        currentPlayIndex++;
        if (isPlayingAll && !isPaused) {
            setTimeout(() => playNextAlphabet(), 500);
        }
    };
}

function stopPlayback() {
    isPlayingAll = false;
    isPaused = false;
    currentPlayIndex = 0;
    
    if (currentAudio) {
        currentAudio.pause();
        currentAudio.currentTime = 0;
    }
    
    // Remove highlight from all cards
    document.querySelectorAll('.alphabet-card').forEach(el => {
        el.classList.remove('border-4', 'border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'ring-4', 'ring-green-300');
    });
    
    // Reset button visibility and text
    document.getElementById('startBtn').classList.remove('hidden');
    document.getElementById('startBtn').innerHTML = '<span class="text-xl">▶️</span><span>Start</span>';
    document.getElementById('pauseBtn').classList.add('hidden');
    document.getElementById('stopBtn').classList.add('hidden');
}

// ===== PRACTICE MODE =====
function initCanvas() {
    const canvas = document.getElementById('practiceCanvas');
    ctx = canvas.getContext('2d');
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    // Clear and set background
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch events
    canvas.addEventListener('touchstart', handleTouch);
    canvas.addEventListener('touchmove', handleTouch);
    canvas.addEventListener('touchend', stopDrawing);
    
    // Color picker
    document.getElementById('colorPicker').addEventListener('change', (e) => {
        currentColor = e.target.value;
    });
    
    // Thickness slider
    document.getElementById('thicknessSlider').addEventListener('input', (e) => {
        lineThickness = e.target.value;
        document.getElementById('thicknessValue').textContent = e.target.value;
    });
    
    setPenTool();
}

function startDrawing(e) {
    isDrawing = true;
    const canvas = e.target;
    const rect = canvas.getBoundingClientRect();
    
    // Calculate scaling factors
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    
    // Get mouse position relative to canvas and scale it
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;
    
    ctx.beginPath();
    ctx.moveTo(x, y);
}

function draw(e) {
    if (!isDrawing) return;
    
    const canvas = e.target;
    const rect = canvas.getBoundingClientRect();
    
    // Calculate scaling factors
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    
    // Get mouse position relative to canvas and scale it
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;
    
    ctx.lineTo(x, y);
    ctx.strokeStyle = currentTool === 'eraser' ? '#ffffff' : currentColor;
    ctx.lineWidth = currentTool === 'eraser' ? lineThickness * 3 : lineThickness;
    ctx.stroke();
}

function stopDrawing() {
    isDrawing = false;
}

function handleTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : 'mousemove', {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    e.target.dispatchEvent(mouseEvent);
}

function setPenTool() {
    currentTool = 'pen';
    document.getElementById('penBtn').style.opacity = '1';
    document.getElementById('eraserBtn').style.opacity = '0.6';
}

function setEraserTool() {
    currentTool = 'eraser';
    document.getElementById('eraserBtn').style.opacity = '1';
    document.getElementById('penBtn').style.opacity = '0.6';
}

function clearCanvas() {
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, practiceCanvas.width, practiceCanvas.height);
}

function updatePracticeLetter() {
    const alphabet = alphabetsData[currentPracticeIndex];
    document.getElementById('practiceLetter').textContent = alphabet.letter;
    document.getElementById('practiceName').textContent = alphabet.name;
    document.getElementById('practiceGif').src = baseUrl + 'assets/Data/alphabets/write-gif/' + (currentPracticeIndex + 1) + '.gif';
    document.getElementById('currentLetterNum').textContent = currentPracticeIndex + 1;
    clearCanvas();
}

function playPracticeAudio() {
    const alphabet = alphabetsData[currentPracticeIndex];
    if (currentAudio) {
        currentAudio.pause();
    }
    currentAudio = new Audio(baseUrl + alphabet.audio);
    currentAudio.play();
}

function previousLetter() {
    if (currentPracticeIndex > 0) {
        currentPracticeIndex--;
        updatePracticeLetter();
    }
}

function nextLetter() {
    if (currentPracticeIndex < alphabetsData.length - 1) {
        currentPracticeIndex++;
        updatePracticeLetter();
    }
}

// ===== TEST MODE =====
function startTest() {
    currentQuestionIndex = 0;
    score = 0;
    answeredQuestions.clear();
    document.getElementById('scoreDisplay').textContent = '0';
    document.getElementById('questionCard').classList.remove('hidden');
    document.getElementById('testComplete').classList.add('hidden');
    loadQuestion();
}

function loadQuestion() {
    const question = testData[currentQuestionIndex];
    document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
    document.getElementById('questionText').textContent = question.question;
    document.getElementById('questionUrdu').textContent = question.questionUrdu || '';
    
    const container = document.getElementById('optionsContainer');
    container.innerHTML = '';
    document.getElementById('feedbackMessage').classList.add('hidden');
    
    question.options.forEach((option, index) => {
        const btn = document.createElement('button');
        btn.className = 'option-btn p-5 bg-slate-50 dark:bg-slate-700 hover:bg-indigo-50 dark:hover:bg-slate-600 rounded-lg font-semibold text-xl transition-all border border-slate-200 dark:border-slate-600 hover:border-indigo-400 text-left';
        btn.setAttribute('dir', 'rtl');
        btn.innerHTML = `<span class="inline-block w-7 h-7 bg-slate-200 dark:bg-slate-600 rounded-full text-center text-sm font-bold leading-7 mr-3">${index + 1}</span>${option}`;
        btn.onclick = () => checkAnswer(index, question.correctAnswer, btn);
        container.appendChild(btn);
    });
}

function checkAnswer(selectedIndex, correctIndex, btn) {
    if (answeredQuestions.has(currentQuestionIndex)) return;
    
    answeredQuestions.add(currentQuestionIndex);
    const feedback = document.getElementById('feedbackMessage');
    const isCorrect = selectedIndex === correctIndex;
    
    if (isCorrect) {
        score++;
        document.getElementById('scoreDisplay').textContent = score;
        btn.className = 'option-btn p-5 bg-green-500 text-white rounded-lg font-semibold text-xl border-2 border-green-600';
        feedback.className = 'mt-6 p-4 rounded-lg text-center font-semibold text-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300';
        feedback.innerHTML = '<div class="text-3xl mb-2">🎉</div><div>شاباش! بلڪل صحيح!</div>';
        
        if (testData[currentQuestionIndex].audio) {
            const audio = new Audio(baseUrl + 'assets/Data/alphabets/audio/' + testData[currentQuestionIndex].audio);
            audio.play();
        }
    } else {
        btn.className = 'option-btn p-5 bg-red-500 text-white rounded-lg font-semibold text-xl border-2 border-red-600';
        feedback.className = 'mt-6 p-4 rounded-lg text-center font-semibold text-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300';
        feedback.innerHTML = `<div class="text-3xl mb-2">😔</div><div>غلط! صحيح جواب: ${testData[currentQuestionIndex].options[correctIndex]}</div>`;
    }
    
    feedback.classList.remove('hidden');
    
    setTimeout(() => {
        nextQuestion();
    }, 2500);
}

function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < testData.length) {
        loadQuestion();
    } else {
        showTestComplete();
    }
}

function showTestComplete() {
    document.getElementById('questionCard').classList.add('hidden');
    document.getElementById('testComplete').classList.remove('hidden');
    document.getElementById('finalScore').textContent = score;
    
    const percentage = (score / testData.length) * 100;
    const emoji = document.getElementById('completionEmoji');
    const message = document.getElementById('performanceMessage');
    
    if (percentage >= 90) {
        emoji.textContent = '🌟';
        message.textContent = 'Outstanding! You\'re a Sindhi alphabet master!';
    } else if (percentage >= 70) {
        emoji.textContent = '🎉';
        message.textContent = 'Great job! You know your alphabets well!';
    } else if (percentage >= 50) {
        emoji.textContent = '👍';
        message.textContent = 'Good effort! Keep practicing!';
    } else {
        emoji.textContent = '💪';
        message.textContent = 'Keep learning! Practice makes perfect!';
    }
}

function restartTest() {
    startTest();
}
</script>
