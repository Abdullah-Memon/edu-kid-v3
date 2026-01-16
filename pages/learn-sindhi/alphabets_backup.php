<?php
// Load data
$alphabetsData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/alphabets/alphabet.json'), true) ?? [];
$testData = json_decode(file_get_contents(__DIR__ . '/../../assets/Data/alphabets/test.json'), true) ?? [];
?>

<!-- Mode Selector -->
<div class="flex justify-center gap-4 mb-10">
    <button onclick="switchMode('learn')" id="learnModeBtn" 
            class="mode-btn active px-10 py-6 rounded-3xl font-bold text-2xl transition-all duration-300 transform hover:scale-110 shadow-xl">
        <span class="text-5xl block mb-2">📖</span>
        <span>Learn Fun!</span>
    </button>
    <button onclick="switchMode('practice')" id="practiceModeBtn"
            class="mode-btn px-10 py-6 rounded-3xl font-bold text-2xl transition-all duration-300 transform hover:scale-110 shadow-xl">
        <span class="text-5xl block mb-2">✏️</span>
        <span>Draw Time!</span>
    </button>
    <button onclick="switchMode('test')" id="testModeBtn"
            class="mode-btn px-10 py-6 rounded-3xl font-bold text-2xl transition-all duration-300 transform hover:scale-110 shadow-xl">
        <span class="text-5xl block mb-2">🎯</span>
        <span>Quiz Adventure!</span>
    </button>
</div>

<!-- LEARN MODE -->
<div id="learnMode" class="mode-content">
    <div class="text-center mb-8">
        <h2 class="text-5xl font-bold text-pink-600 dark:text-pink-300 mb-3 animate-bounce">
            🔤 52 Magic Letters! ✨
        </h2>
        <p class="text-2xl text-slate-600 dark:text-slate-400">Tap to hear the magic sounds! 🎶</p>
    </div>
    
    <div class="flex justify-center gap-4 mb-8">
        <button onclick="playAllAlphabets()" 
                class="px-8 py-5 bg-gradient-to-r from-blue-400 to-cyan-500 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-110">
            <span class="text-3xl">▶️</span> Play All Magic!
        </button>
        <button onclick="stopPlayback()" id="stopBtn" 
                class="hidden px-8 py-5 bg-gradient-to-r from-orange-400 to-red-500 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-110">
            <span class="text-3xl">⏹️</span> Stop
        </button>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <?php foreach ($alphabetsData as $index => $alphabet): ?>
            <div class="alphabet-card group cursor-pointer rounded-2xl bg-gradient-to-br from-pink-100 to-blue-100 dark:from-slate-700 dark:to-slate-600 p-5 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-115 border-2 border-transparent hover:border-pink-400"
                 data-index="<?php echo $index; ?>"
                 data-audio="<?php echo BASE_URL . $alphabet['audio']; ?>"
                 onclick="playAlphabet(<?php echo $index; ?>)">
                
                <div class="text-6xl font-bold text-pink-600 dark:text-pink-300 text-center group-hover:scale-125 transition-transform" dir="rtl">
                    <?php echo htmlspecialchars($alphabet['letter']); ?>
                </div>
                
                <p class="text-sm font-semibold text-blue-600 dark:text-blue-300 text-center mt-3" dir="rtl">
                    <?php echo htmlspecialchars($alphabet['name']); ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- PRACTICE MODE -->
<div id="practiceMode" class="mode-content hidden">
    <div class="text-center mb-8">
        <h2 class="text-5xl font-bold text-cyan-600 dark:text-cyan-300 mb-3 animate-pulse">
            ✏️ Magic Drawing Time! 🎨
        </h2>
        <p class="text-2xl text-slate-600 dark:text-slate-400">Draw the letters like a wizard! 🪄</p>
    </div>

    <div class="max-w-5xl mx-auto">
        <!-- Reference Card -->
        <div class="bg-gradient-to-br from-cyan-100 to-pink-100 dark:from-slate-700 dark:to-slate-600 rounded-3xl p-8 mb-8 shadow-2xl">
            <div class="flex items-center justify-between gap-6">
                <div class="text-center flex-1">
                    <div class="text-8xl font-bold text-cyan-600 dark:text-cyan-300 mb-3" dir="rtl" id="practiceLetter">
                        <?php echo htmlspecialchars($alphabetsData[0]['letter']); ?>
                    </div>
                    <p class="text-2xl font-semibold text-cyan-700 dark:text-cyan-400" dir="rtl" id="practiceName">
                        <?php echo htmlspecialchars($alphabetsData[0]['name']); ?>
                    </p>
                </div>
                
                <!-- GIF Reference -->
                <div class="flex-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-cyan-300 dark:border-cyan-600 bg-white">
                        <img id="practiceGif" src="<?php echo BASE_URL; ?>assets/Data/alphabets/write-gif/1.gif" 
                             alt="Writing guide" class="w-full h-56 object-contain">
                    </div>
                </div>
                
                <button onclick="playPracticeAudio()" 
                        class="px-8 py-8 bg-gradient-to-r from-blue-400 to-cyan-500 text-white rounded-3xl font-bold shadow-xl hover:shadow-2xl transition-all transform hover:scale-110">
                    <span class="text-5xl">🔊</span>
                </button>
            </div>
        </div>

            <!-- Drawing Canvas -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-2xl mb-6 border-4 border-purple-200 dark:border-purple-600">
                <!-- Canvas Title -->
                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 dark:text-purple-300 flex items-center justify-center gap-2">
                        <span class="text-3xl">🎨</span>
                        <span>Your Drawing Board</span>
                    </h3>
                </div>
                
                <canvas id="practiceCanvas" width="800" height="400" 
                        class="w-full border-4 border-dashed border-purple-300 dark:border-purple-600 rounded-2xl cursor-crosshair bg-white shadow-inner"></canvas>
                
                <!-- Drawing Tools -->
                <div class="flex flex-wrap justify-center gap-3 mt-6">
                <button onclick="setPenTool()" id="penBtn"
                        class="px-8 py-4 bg-blue-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <span class="text-3xl">✏️</span> Magic Pen
                </button>
                <button onclick="setEraserTool()" id="eraserBtn"
                        class="px-8 py-4 bg-slate-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <span class="text-3xl">🧹</span> Magic Eraser
                </button>
                <button onclick="clearCanvas()" 
                        class="px-8 py-4 bg-red-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <span class="text-3xl">🗑️</span> Clear All
                </button>
                
                <div class="flex items-center gap-3 px-6 py-3 bg-slate-100 dark:bg-slate-700 rounded-2xl">
                    <span class="text-lg font-semibold">Color Magic:</span>
                    <input type="color" id="colorPicker" value="#6366f1" 
                           class="w-14 h-12 rounded cursor-pointer border-2 border-slate-300">
                </div>
                
                <div class="flex items-center gap-3 px-6 py-3 bg-slate-100 dark:bg-slate-700 rounded-2xl">
                    <span class="text-lg font-semibold">Size:</span>
                    <input type="range" id="thicknessSlider" min="2" max="20" value="5" 
                           class="w-32">
                    <span id="thicknessValue" class="text-lg font-bold w-10">5</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-between items-center gap-6">
            <button onclick="previousLetter()" 
                    class="px-10 py-6 bg-gradient-to-r from-orange-400 to-red-400 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                <span class="text-4xl">⬅️</span> Back
            </button>
            
            <div class="text-3xl font-bold text-cyan-600 dark:text-cyan-300">
                <span id="currentLetterNum">1</span> / 52
            </div>
            
            <button onclick="nextLetter()" 
                    class="px-10 py-6 bg-gradient-to-r from-green-400 to-lime-400 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                Next <span class="text-4xl">➡️</span>
            </button>
        </div>
    </div>
</div>

<!-- TEST MODE -->
<div id="testMode" class="mode-content hidden">
    <div class="text-center mb-8">
        <h2 class="text-5xl font-bold text-lime-600 dark:text-lime-300 mb-3 animate-spin">
            🎯 Super Quiz Time! 🏆
        </h2>
        <p class="text-2xl text-slate-600 dark:text-slate-400">Show your super powers! 💪</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Score Display -->
        <div class="bg-gradient-to-r from-lime-100 to-green-100 dark:from-slate-700 dark:to-slate-600 rounded-3xl p-8 mb-8 shadow-2xl">
            <div class="flex justify-between items-center">
                <div class="text-center">
                    <div class="text-4xl font-bold text-lime-600 dark:text-lime-300">
                        <span id="scoreDisplay">0</span> / <span id="totalQuestions"><?php echo count($testData); ?></span>
                    </div>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Super Score</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-300">
                        <span id="questionNumber">1</span>
                    </div>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Question</p>
                </div>
                <button onclick="restartTest()" 
                        class="px-8 py-5 bg-gradient-to-r from-purple-400 to-pink-400 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                    <span class="text-3xl">🔄</span> Play Again
                </button>
            </div>
        </div>

            <!-- Question Card -->
            <div id="questionCard" class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-2xl mb-6 border-4 border-green-200 dark:border-green-600">
                <!-- Decorative corner emoji -->
                <div class="absolute top-4 right-4 text-4xl opacity-20">❓</div>
                
                <div class="relative">
                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200 mb-4" id="questionText"></h3>
                    <p class="text-xl lg:text-2xl text-purple-600 dark:text-purple-400 mb-8 font-bold" dir="rtl" id="questionUrdu"></p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="optionsContainer"></div>
                    
                    <div id="feedbackMessage" class="hidden mt-8 p-6 rounded-2xl text-center font-bold text-xl shadow-lg"></div>
                </div>
            </div>

        <!-- Next Button -->
        <div class="text-center">
            <button onclick="nextQuestion()" id="nextQuestionBtn" 
                    class="hidden px-14 py-6 bg-gradient-to-r from-blue-400 to-cyan-400 text-white rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-105">
                Next Adventure <span class="text-3xl">➡️</span>
            </button>
        </div>

        <!-- Test Complete -->
        <div id="testComplete" class="hidden text-center">
            <div class="bg-gradient-to-br from-yellow-100 to-orange-100 dark:from-slate-700 dark:to-slate-600 rounded-3xl p-14 shadow-3xl">
                <div class="text-9xl mb-6" id="completionEmoji">🎉</div>
                <h3 class="text-5xl font-bold text-orange-600 dark:text-orange-300 mb-6">Super Done!</h3>
                <p class="text-4xl font-bold text-slate-800 dark:text-slate-200 mb-8">
                    Your Score: <span id="finalScore">0</span> / <?php echo count($testData); ?>
                </p>
                <p class="text-2xl text-slate-600 dark:text-slate-400 mb-10" id="performanceMessage"></p>
                <button onclick="restartTest()" 
                        class="px-14 py-6 bg-gradient-to-r from-green-400 to-lime-400 text-white rounded-3xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all transform hover:scale-110">
                    <span class="text-4xl">🔄</span> Play Again!
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .mode-btn {
        background: linear-gradient(135deg, #ffe4e6 0%, #fef3c7 100%);
        color: #db2777;
        border: 4px solid transparent;
    }
    
    .mode-btn:hover {
        border-color: #fbbf24;
        transform: scale(1.15) !important;
    }
    
    .mode-btn.active {
        background: linear-gradient(135deg, #ec4899 0%, #f59e0b 100%);
        color: white;
        box-shadow: 0 12px 40px rgba(236, 72, 153, 0.5);
    }
    
    .dark .mode-btn {
        background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
        color: #f687b3;
    }
    
    .dark .mode-btn.active {
        background: linear-gradient(135deg, #ec4899 0%, #f59e0b 100%);
        color: white;
    }
    
    @keyframes bounce-in {
        0% { transform: scale(0.7); opacity: 0; }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .alphabet-card {
        animation: bounce-in 0.6s ease-out;
    }

    .option-btn {
        transition: all 0.3s ease;
        transform-origin: center;
    }

    .option-btn:hover {
        transform: scale(1.1) rotate(2deg);
    }
</style>

<script>
// Alphabet data from PHP
const alphabetsData = <?php echo json_encode($alphabetsData); ?>;
const testData = <?php echo json_encode($testData); ?>;
const baseUrl = '<?php echo BASE_URL; ?>';

// Audio player
let currentAudio = null;
let isPlayingAll = false;
let currentPlayIndex = 0;

// Practice mode
let currentPracticeIndex = 0;
let isDrawing = false;
let ctx = null;
let currentTool = 'pen';
let currentColor = '#6366f1';
let lineThickness = 5;

// Test mode
let currentQuestionIndex = 0;
let score = 0;
let answeredQuestions = [];

// Mode switching
function switchMode(mode) {
    document.querySelectorAll('.mode-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.mode-btn').forEach(el => {
        el.classList.remove('active');
        el.querySelector('.mode-indicator')?.classList.add('hidden');
    });
    
    document.getElementById(mode + 'Mode').classList.remove('hidden');
    const modeBtn = document.getElementById(mode + 'ModeBtn');
    modeBtn.classList.add('active');
    modeBtn.querySelector('.mode-indicator')?.classList.remove('hidden');
    
    if (mode === 'practice') {
        initCanvas();
    } else if (mode === 'test') {
        startTest();
    }
}

// LEARN MODE FUNCTIONS
function playAlphabet(index) {
    if (currentAudio) {
        currentAudio.pause();
    }
    
    document.querySelectorAll('.playing-indicator').forEach(el => el.classList.add('hidden'));
    
    const card = document.querySelector(`[data-index="${index}"]`);
    const audioPath = card.getAttribute('data-audio');
    
    currentAudio = new Audio(audioPath);
    currentAudio.play();
    
    const indicator = card.querySelector('.playing-indicator');
    if (indicator) {
        indicator.classList.remove('hidden');
        indicator.classList.add('flex');
    }
    
    currentAudio.onended = () => {
        if (indicator) {
            indicator.classList.add('hidden');
            indicator.classList.remove('flex');
        }
    };
}

function playAllAlphabets() {
    isPlayingAll = true;
    currentPlayIndex = 0;
    document.getElementById('stopBtn').classList.remove('hidden');
    playNextAlphabet();
}

function playNextAlphabet() {
    if (!isPlayingAll || currentPlayIndex >= alphabetsData.length) {
        stopPlayback();
        return;
    }
    
    playAlphabet(currentPlayIndex);
    
    currentAudio.onended = () => {
        document.querySelectorAll('.playing-indicator').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('flex');
        });
        currentPlayIndex++;
        setTimeout(() => playNextAlphabet(), 500);
    };
}

function stopPlayback() {
    isPlayingAll = false;
    if (currentAudio) {
        currentAudio.pause();
        currentAudio = null;
    }
    document.querySelectorAll('.playing-indicator').forEach(el => {
        el.classList.add('hidden');
        el.classList.remove('flex');
    });
    document.getElementById('stopBtn').classList.add('hidden');
}

// PRACTICE MODE FUNCTIONS
function initCanvas() {
    const canvas = document.getElementById('practiceCanvas');
    if (!canvas) return;
    
    ctx = canvas.getContext('2d');
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    canvas.addEventListener('touchstart', handleTouch);
    canvas.addEventListener('touchmove', handleTouch);
    canvas.addEventListener('touchend', stopDrawing);
    
    updatePracticeLetter(0);
}

function startDrawing(e) {
    isDrawing = true;
    const rect = e.target.getBoundingClientRect();
    ctx.beginPath();
    ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
}

function draw(e) {
    if (!isDrawing) return;
    
    const rect = e.target.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    ctx.strokeStyle = currentTool === 'pen' ? currentColor : '#ffffff';
    ctx.lineWidth = currentTool === 'pen' ? lineThickness : lineThickness * 3;
    ctx.lineTo(x, y);
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
    document.getElementById('penBtn').classList.add('ring-4', 'ring-blue-300');
    document.getElementById('eraserBtn').classList.remove('ring-4', 'ring-slate-300');
}

function setEraserTool() {
    currentTool = 'eraser';
    document.getElementById('eraserBtn').classList.add('ring-4', 'ring-slate-300');
    document.getElementById('penBtn').classList.remove('ring-4', 'ring-blue-300');
}

function clearCanvas() {
    if (ctx) {
        ctx.clearRect(0, 0, practiceCanvas.width, practiceCanvas.height);
    }
}

document.getElementById('colorPicker')?.addEventListener('change', (e) => {
    currentColor = e.target.value;
});

document.getElementById('thicknessSlider')?.addEventListener('input', (e) => {
    lineThickness = parseInt(e.target.value);
    document.getElementById('thicknessValue').textContent = lineThickness;
});

function updatePracticeLetter(index) {
    currentPracticeIndex = index;
    const letter = alphabetsData[index];
    
    document.getElementById('practiceLetter').textContent = letter.letter;
    document.getElementById('practiceName').textContent = letter.name;
    document.getElementById('practiceGif').src = `${baseUrl}assets/Data/alphabets/write-gif/${index + 1}.gif`;
    document.getElementById('currentLetterNum').textContent = index + 1;
    
    clearCanvas();
}

function playPracticeAudio() {
    const letter = alphabetsData[currentPracticeIndex];
    if (currentAudio) currentAudio.pause();
    currentAudio = new Audio(baseUrl + letter.audio);
    currentAudio.play();
}

function previousLetter() {
    if (currentPracticeIndex > 0) {
        updatePracticeLetter(currentPracticeIndex - 1);
    }
}

function nextLetter() {
    if (currentPracticeIndex < alphabetsData.length - 1) {
        updatePracticeLetter(currentPracticeIndex + 1);
    }
}

// TEST MODE FUNCTIONS
function startTest() {
    currentQuestionIndex = 0;
    score = 0;
    answeredQuestions = [];
    document.getElementById('testComplete').classList.add('hidden');
    document.getElementById('questionCard').classList.remove('hidden');
    loadQuestion();
}

function loadQuestion() {
    if (currentQuestionIndex >= testData.length) {
        showTestComplete();
        return;
    }
    
    const question = testData[currentQuestionIndex];
    document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
    document.getElementById('questionText').textContent = question.question;
    document.getElementById('questionUrdu').textContent = question.questionUrdu;
    document.getElementById('scoreDisplay').textContent = score;
    document.getElementById('feedbackMessage').classList.add('hidden');
    document.getElementById('nextQuestionBtn').classList.add('hidden');
    
    const container = document.getElementById('optionsContainer');
    container.innerHTML = '';
    
    question.options.forEach((option, index) => {
        const btn = document.createElement('button');
        btn.className = 'option-btn relative overflow-hidden p-6 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-600 rounded-2xl font-bold text-2xl hover:shadow-2xl transition-all transform hover:scale-105 border-4 border-slate-200 dark:border-slate-600 hover:border-green-400';
        btn.setAttribute('dir', 'rtl');
        btn.innerHTML = `<div class="absolute top-2 left-2 w-8 h-8 bg-slate-200 dark:bg-slate-600 rounded-full flex items-center justify-center text-sm font-bold">${index + 1}</div><span class="block pt-2">${option}</span>`;
        btn.onclick = () => checkAnswer(index, question.correctAnswer, btn);
        container.appendChild(btn);
    });
}

function checkAnswer(selected, correct, btn) {
    const allBtns = document.querySelectorAll('.option-btn');
    allBtns.forEach(b => b.disabled = true);
    
    const feedback = document.getElementById('feedbackMessage');
    feedback.classList.remove('hidden');
    
    if (selected === correct) {
        score++;
        btn.classList.add('bg-gradient-to-br', 'from-lime-400', 'to-green-500', 'text-white');
        feedback.className = 'mt-8 p-6 rounded-2xl text-center font-bold text-2xl bg-lime-100 dark:bg-lime-900 text-lime-800 dark:text-lime-200 animate-bounce';
        feedback.innerHTML = '<span class="text-5xl">🎉✨</span><br>Super Correct! You\'re a star! 🌟';
        
        // Play audio if available
        if (testData[currentQuestionIndex].audio) {
            const audio = new Audio(baseUrl + 'assets/Data/alphabets/audio/' + testData[currentQuestionIndex].audio);
            audio.play();
        }
    } else {
        btn.classList.add('bg-gradient-to-br', 'from-red-400', 'to-orange-500', 'text-white');
        allBtns[correct].classList.add('bg-gradient-to-br', 'from-lime-400', 'to-green-500', 'text-white');
        feedback.className = 'mt-8 p-6 rounded-2xl text-center font-bold text-2xl bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 animate-shake';
        feedback.innerHTML = '<span class="text-5xl">😊</span><br>Oops! Try again next time! 💕';
    }
    
    document.getElementById('scoreDisplay').textContent = score;
    document.getElementById('nextQuestionBtn').classList.remove('hidden');
}

function nextQuestion() {
    currentQuestionIndex++;
    loadQuestion();
}

function showTestComplete() {
    document.getElementById('questionCard').classList.add('hidden');
    document.getElementById('testComplete').classList.remove('hidden');
    document.getElementById('finalScore').textContent = score;
    
    const percentage = (score / testData.length) * 100;
    const emoji = document.getElementById('completionEmoji');
    const message = document.getElementById('performanceMessage');
    
    if (percentage >= 90) {
        emoji.textContent = '🌟✨';
        message.textContent = 'You\'re a Super Alphabet Wizard! 🧙‍♂️';
    } else if (percentage >= 70) {
        emoji.textContent = '🎉🥳';
        message.textContent = 'Awesome job! Keep the magic going! 🔮';
    } else if (percentage >= 50) {
        emoji.textContent = '👍😊';
        message.textContent = 'Good try! Practice makes perfect! 🏅';
    } else {
        emoji.textContent = '💪❤️';
        message.textContent = 'You\'re getting there! Let\'s try again! 🚀';
    }
}

function restartTest() {
    startTest();
}

// Initialize
setPenTool();
</script>