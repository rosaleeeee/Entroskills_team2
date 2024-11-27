<x-app-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('BUSINESMODEL.css') }}" rel="stylesheet">
    <title>Business Model Canvas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
</x-app-layout>

<body>
    @include('layouts.sidebar')
    <!-- Affichage du score en haut de la page -->
    @php
    $userScore = Auth::user()->score;  
    @endphp
    <div class="co_score">
        <img class="dia_img" src="{{ asset('images/diamond.png') }}" alt="Congratulations">
        <p class="user-score" id="userScore">{{ Auth::user()->score }}</p>
    </div>
    <!-- Help Button -->
    <button id="helpBtn">Help</button>

    <!-- The Popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Game Rules</h2>
            <p>You'll work with an empty Business Model Canvas, where each cell contains the name of a key component along with a brief definition. Your task is to drag each component cell to its correct position. Need more info? Click on the "Details" button. Here's how scoring works: Correct placement on the first try earns you 5 points, on the second try earns you 3 points, and on the third try earns you 1 point. If you're incorrect on the fourth try, you'll lose 1 point, and the correct answer will be shown.</p>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        <div class="wrapper">
            <!-- Nouvelles cellules draggable à gauche -->
            <div class="draggable-container">
                <div class="draggable-column">
                    <div class="draggable" id="cell1">
                        <h3>Unique offerings creating customer value.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup1" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The unique combination of products or services that create value for specific customer segments, addressing their needs or solving their problems better than competitors.</p>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell2">
                        <h3>Targeted groups for products/services.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup2" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The types of interactions and connections a business establishes with its customers to attract, retain, and support them throughout their journey with the company.</p>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell3">
                        <h3>Methods to deliver products/services to customers.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup3" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The various ways and platforms through which a business reaches and interacts with its customers to deliver its value proposition, including physical and digital channels.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Business Model Canvas (existant) -->
                <div class="bmc" id="bmc">
                    <div class="droppable" data-category="Key Resources"><h3>Key Resources</h3></div>
                    <div class="droppable" data-category="Key Activities"><h3>Key Activities</h3></div>
                    <div class="droppable" data-category="Key Partnerships"><h3>Key Partnerships</h3></div>
                    <div class="droppable" data-category="Value Propositions"><h3>Value Propositions</h3></div>
                    <div class="droppable" data-category="Customer Relationships"><h3>Customer Relationships</h3></div>
                    <div class="droppable" data-category="Channels"><h3>Channels</h3></div>
                    <div class="droppable" data-category="Customer Segments"><h3>Customer Segments</h3></div>
                    <div class="droppable" data-category="Cost Structure"><h3>Cost Structure</h3></div>
                    <div class="droppable" data-category="Revenue Streams"><h3>Revenue Streams</h3></div>
                </div>

                <!-- Nouvelles cellules draggable à droite -->
                <div class="draggable-column">
                    <div class="draggable" id="cell4">
                        <h3>Ways to attract and retain customers.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup4" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The types of interactions and connections a business establishes with its customers to attract, retain, and support them throughout their journey with the company.</p>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell5">
                        <h3>Sources generating business income.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup5" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The sources through which a business earns income from its customer segments, encompassing different pricing mechanisms, sales models, and monetization strategies.</p>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell6">
                        <h3>Necessary assets for business operations.</h3>
                        <button class="learn-more-btn">Learn More</button>
                        <div id="popup6" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Details</h2>
                                <p>The critical assets, whether physical, financial, intellectual, or human, required for a business to operate and deliver its value proposition to customers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nouvelles cellules draggable en bas -->
            <div class="draggable-container">
                <div class="draggable" id="cell7">
                    <h3>Essential tasks for creating and delivering value.</h3>
                    <button class="learn-more-btn">Learn More</button>
                    <div id="popup7" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Details</h2>
                            <p>Essential tasks and processes that a business must perform to create and deliver its value proposition, reach customers, and sustain its operations effectively.</p>
                        </div>
                    </div>
                </div>
                <div class="draggable" id="cell8">
                    <h3>External collaborators crucial for business operations</h3>
                    <button class="learn-more-btn">Learn More</button>
                    <div id="popup8" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Details</h2>
                            <p>External entities such as suppliers, business partners, or other companies that collaborate to enhance operational efficiency, mitigate risks, or access additional resources.</p>
                        </div>
                    </div>
                </div>
                <div class="draggable" id="cell9">
                    <h3>Main expenses for business operations.</h3>
                    <button class="learn-more-btn">Learn More</button>
                    <div id="popup9" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Details</h2>
                            <p>The comprehensive breakdown of all costs incurred to operate a business, including fixed and variable expenses, essential for understanding and managing profitability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bouton de soumission -->
    <button id="submitBtn" class="submit-button">Submit</button>

    <audio id="correctSound">
    <source src="{{ asset('sounds/correct-answer.mp3') }}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="wrongSound">
    <source src="{{ asset('sounds/wrong-answer.mp3') }}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

    <script>
        $(document).ready(function() {
            var score = 0;
            var cellAttempts = {};
            var maxAttempts = 5;

            $(".draggable").draggable({
                revert: "invalid",
                stack: ".draggable",
                cursor: "move"
            });

            $(".droppable").droppable({
                accept: ".draggable",
                drop: function(event, ui) {
                    var cellId = ui.helper.attr("id");
                    var category = $(this).data("category");

                    if (!cellAttempts[cellId]) {
                        cellAttempts[cellId] = 0;
                    }

                    cellAttempts[cellId]++;

                    if (correctAnswers[cellId] === category) {
                        ui.helper.css({
                            left: 0,
                            top: 0,
                            position: "relative"
                        }).appendTo($(this));

                        var points = 0;
                        if (cellAttempts[cellId] === 1) {
                            points = 5;
                        } else if (cellAttempts[cellId] === 2) {
                            points = 3;
                        } else if (cellAttempts[cellId] === 3) {
                            points = 1;
                        } else if (cellAttempts[cellId] === 4) {
                            points = -1;
                        } else if (cellAttempts[cellId] === 5) {
                            points = -2;
                        }
                        score += points;
                        delete cellAttempts[cellId];  // Réinitialiser les tentatives après un placement correct
                        alert("Correct! Points for this cell: " + points + ". Total score: " + score);

                        // Jouer le son de réponse correcte
                        var correctSound = document.getElementById("correctSound");
                        correctSound.play();

                        // Ajouter une classe pour l'animation de couleur
                        ui.helper.addClass("correct-drop");
                    } else {
                        if (cellAttempts[cellId] >= maxAttempts) {
                            score -= 3;
                            ui.helper.css({
                                left: 0,
                                top: 0,
                                position: "relative"
                            }).appendTo($(".droppable[data-category='" + correctAnswers[cellId] + "']"));
                            delete cellAttempts[cellId];  // Réinitialiser les tentatives après le nombre maximal d'essais
                            alert("Max attempts reached for this cell. You lost 3 points. Total score: " + score);
                        } else {
                            // Jouer le son de réponse incorrecte
                            var wrongSound = document.getElementById("wrongSound");
                            wrongSound.play();

                            ui.helper.draggable("option", "revert", true);
                            

                            // Ajouter une classe pour l'animation de couleur
                            ui.helper.addClass("incorrect-drop");
                        }
                    }

                    // Retour à la couleur d'origine après un court délai
                    setTimeout(function() {
                        ui.helper.removeClass("correct-drop incorrect-drop");
                    }, 1000); // Délai en millisecondes
                }
            });

            var correctAnswers = {
                "cell1": "Value Propositions",
                "cell2": "Customer Segments",
                "cell3": "Channels",
                "cell4": "Customer Relationships",
                "cell5": "Revenue Streams",
                "cell6": "Key Resources",
                "cell7": "Key Activities",
                "cell8": "Key Partnerships",
                "cell9": "Cost Structure"
            };

            $("#submitBtn").click(function() {
                // Sauvegarder le score dans la base de données
                $.ajax({
                    url: '{{ route("save.score") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        score: score
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Score saved successfully! Total score: ' + score);
                            window.location.href = 'FinExercice';
                        } else {
                            alert('Error: Could not save the score.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });

            // Bouton d'aide
            $("#helpBtn").click(function() {
                $("#popup").css("display", "block");
            });

            // Fermeture du popup
            $(".close").click(function() {
                $(this).closest(".popup").css("display", "none");
            });

            // Fermeture du popup en cliquant à l'extérieur
            $(window).click(function(event) {
                if ($(event.target).hasClass("popup")) {
                    $(event.target).css("display", "none");
                }
            });

            // Bouton "Learn More"
            $(".learn-more-btn").click(function() {
                var popup = $(this).siblings(".popup");
                popup.css("display", "block");
            });

            // Fermeture du popup "Learn More"
            $(".popup .close").click(function() {
                $(this).closest(".popup").css("display", "none");
            });

            // Fermeture du popup "Learn More" en cliquant à l'extérieur
            $(window).click(function(event) {
                if ($(event.target).hasClass("popup")) {
                    $(event.target).css("display", "none");
                }
            });
        });
    </script>
</body>
