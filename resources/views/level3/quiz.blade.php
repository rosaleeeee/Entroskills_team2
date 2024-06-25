<x-app-layout>
    <link href="{{ asset('lv3quiz.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <body>
        <div>
            <!-- start navbar -->
            @include('layouts.sidebar')
            <!-- end navbar -->
        </div>

        <section class="content">
            <div class="app">
                <div class="header">
                    <h1 class="title">WHAT AM I?</h1>
                    <div id="timer" class="timer">Time left: 20s</div>
                </div>
                <div class="quiz">
                    <h2 id="question" class="question">Question goes here</h2>
                    <div id="answer-buttons" class="answer-buttons">
                        <!-- Answer buttons will be dynamically added here -->
                    </div>
                    <button id="next-btn">Next</button>
                </div>
            </div>
        </section>
        <button id="done-btn" class="bbttnn hidden" onclick="window.location.href='modellev3'">DONE</button>

        <script>
            const questions = [
                {
                    question: "What is a crucial task for a Marketing Manager?",
                    answers: [
                        { text: "a) Managing the production process ", correct: false },
                        { text: "b) Developing and executing marketing plans", correct: true },
                        { text: "c) Handling customer complaints", correct: false },
                        { text: "d) Overseeing financial audits", correct: false },
                    ]
                },
                {
                    question: "What is a key skill required for a Partnerships Manager?",
                    answers: [
                        { text: "a) Strong negotiation and communication skills ", correct: true },
                        { text: "b) To manage the company's marketing strategy", correct: false },
                        { text: "c) To oversee the company's sales team", correct: false },
                        { text: "d) To develop the company's product roadmap", correct: false },
                    ]
                },
                {
                    question: "What is a primary responsibility of a Product Manager?",
                    answers: [
                        { text: "a) Managing the company's financial planning", correct: false },
                        { text: "b) Developing the product roadmap and strategy", correct: true },
                        { text: "c) Overseeing the customer service department", correct: false },
                        { text: "d) Designing advertising materials", correct: false },
                    ]
                },
                {
                    question: "A Sales Manager is primarily responsible for:",
                    answers: [
                        { text: "a) Setting sales goals and quotas ", correct: true },
                        { text: "b) Designing the company website", correct: false },
                        { text: "c) Managing customer service teams", correct: false },
                        { text: "d) Conducting market analysis", correct: false },
                    ]
                },
                {
                    question: "What is the primary goal of an Accountant?",
                    answers: [
                        { text: "a) To prepare and examine financial records ", correct: true },
                        { text: "b) To develop the company's marketing strategy", correct: false },
                        { text: "c) To manage the company's sales team", correct: false },
                        { text: "d) To oversee the company's day-to-day operations", correct: false },
                    ]
                },
                {
                    question: "What is the primary goal of a Chief Financial Officer (CFO)?",
                    answers: [
                        { text: "a) To oversee the company's marketing strategy ", correct: false },
                        { text: "b) To develop the company's product roadmap ", correct: false },
                        { text: "c) To manage the company's human resources", correct: false },
                        { text: "d) To manage the company's financial planning and budgeting ", correct: true },
                    ]
                },
                {
                    question: "A Project Manager is responsible for:",
                    answers: [
                        { text: "a) Leading projects from initiation to completion ", correct: true },
                        { text: "b) Designing advertising materials", correct: false },
                        { text: "c) Managing payroll", correct: false },
                        { text: "d) Conducting customer surveys", correct: false },
                    ]
                },
                {
                    question: "Who manages daily operations and ensures the company's efficiency and effectiveness?",
                    answers: [
                        { text: "a) Project Manager ", correct: false },
                        { text: "b) Chief Operating Officer (COO)", correct: true },
                        { text: "c) Accountant", correct: false },
                        { text: "d) Marketing Manager", correct: false },
                    ]
                },
                {
                    question: "Who oversees the customer service department and ensures customer satisfaction?",
                    answers: [
                        { text: "a) Partnerships Manager ", correct: false },
                        { text: "b) Chief Operating Officer (COO)", correct: false },
                        { text: "c) Sales Manager", correct: false },
                        { text: "d) Customer Service Manager", correct: true },
                    ]
                },
                // Add more questions here as needed
            ];

            const questionElement = document.getElementById("question");
            const answerButtonsElement = document.getElementById("answer-buttons");
            const nextButton = document.getElementById("next-btn");
            const doneButton = document.getElementById("done-btn");
            const timerElement = document.getElementById("timer");

            let currentQuestionIndex = 0;
            let score = 0;
            let timeLeft = 20;
            let timer;

            function startQuiz() {
                currentQuestionIndex = 0;
                score = 0;
                timeLeft = 20;
                nextButton.innerHTML = "Next";
                nextButton.removeEventListener("click", startQuiz);
                doneButton.classList.add("hidden"); // Masquer le bouton DONE au début
                showQuestion();
            }

            function showQuestion() {
                resetState();
                startTimer();
                let currentQuestion = questions[currentQuestionIndex];
                questionElement.innerHTML = `${currentQuestionIndex + 1}. ${currentQuestion.question}`;

                currentQuestion.answers.forEach(answer => {
                    const button = document.createElement("button");
                    button.innerHTML = answer.text;
                    button.classList.add("btn");
                    if (answer.correct) {
                        button.dataset.correct = answer.correct;
                    }
                    button.addEventListener("click", selectAnswer);
                    answerButtonsElement.appendChild(button);
                });
            }

            function resetState() {
                nextButton.style.display = "none";
                while (answerButtonsElement.firstChild) {
                    answerButtonsElement.removeChild(answerButtonsElement.firstChild);
                }
                clearInterval(timer);
            }

            function startTimer() {
                timeLeft = 20;
                timerElement.style.display = "block"; // Afficher le minuteur lorsque le quiz commence
                timerElement.innerHTML = `Time left: ${timeLeft}s`;
                timer = setInterval(() => {
                    timeLeft--;
                    timerElement.innerHTML = `Time left: ${timeLeft}s`;
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        showCorrectAnswer();
                        nextButton.style.display = "block";
                    }
                }, 1000);
            }

            function showCorrectAnswer() {
                Array.from(answerButtonsElement.children).forEach(button => {
                    if (button.dataset.correct === "true") {
                        button.classList.add("correct");
                    }
                    button.disabled = true;
                });
            }

            function selectAnswer(e) {
                const selectedBtn = e.target;
                const isCorrect = selectedBtn.dataset.correct === "true";

                if (isCorrect) {
                    selectedBtn.classList.add("correct");
                    score++;
                } else {
                    selectedBtn.classList.add("incorrect");
                }

                Array.from(answerButtonsElement.children).forEach(button => {
                    if (button.dataset.correct === "true") {
                        button.classList.add("correct");
                    }
                    button.disabled = true;
                });

                nextButton.style.display = "block";
                clearInterval(timer); // Arrêter le minuteur lorsque la réponse est sélectionnée
            }

            function showScore() {
                resetState();
                timerElement.style.display = "none"; // Masquer le minuteur lors de l'affichage du score
                questionElement.innerHTML = `You scored ${score} out of ${questions.length}`;
                nextButton.innerHTML = "Play Again";
                nextButton.style.display = "block";
                doneButton.classList.remove("hidden"); // Afficher le bouton DONE
                nextButton.addEventListener("click", startQuiz);
            }

            function handleNextButton() {
                currentQuestionIndex++;
                if (currentQuestionIndex < questions.length) {
                    showQuestion();
                } else {
                    showScore();
                }
            }

            nextButton.addEventListener("click", handleNextButton);

            startQuiz();
        </script>
    </body>
</x-app-layout>
 