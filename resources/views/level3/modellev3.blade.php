<x-app-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('BUSINESMODEL.css') }}" rel="stylesheet">
    <title>Business Model Canvas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
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
            </div>
        </div>

        <script>
            // Get the popup
            var popup = document.getElementById('popup');

            // Get the button that opens the popup
            var btn = document.getElementById('helpBtn');

            // Get the <span> element that closes the popup
            var span = document.getElementsByClassName('close')[0];

            // When the user clicks the button, open the popup
            btn.onclick = function() {
                popup.style.display = 'block';
            }

            // When the user clicks on <span> (x), close the popup
            span.onclick = function() {
                popup.style.display = 'none';
            }

            // When the user clicks anywhere outside of the popup, close it
            window.onclick = function(event) {
                if (event.target == popup) {
                    popup.style.display = 'none';
                }
            }
        </script>

        <!-- Page Content -->
        <main>
            <div class="wrapper">
                <!-- Nouvelles cellules draggable à gauche -->
                <div class="draggable-container">
                    <div class="draggable-column">
                        <div class="draggable" id="cell1">
                            <h3>Product Manager</h3>
                            <div id="popup1" class="popup">
                                <div class="popup-content">
                                    <span class="close">&times;</span>
                                </div>
                            </div>
                        </div>
                        <div class="draggable" id="cell2">
                            <h3>Marketing manager </h3>
                            <div id="popup2" class="popup">
                                <div class="popup-content">
                                    <span class="close">&times;</span>
                                </div>
                            </div>
                        </div>
                        <div class="draggable" id="cell3">
                            <h3>Sales Manager</h3>
                            <div id="popup3" class="popup">
                                <div class="popup-content">
                                    <span class="close">&times;</span>
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
                        <h3>Customer Service Manager</h3>
                        <div id="popup4" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell5">
                        <h3> Chief Financial Officer </h3>
                        <div id="popup5" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                            </div>
                        </div>
                    </div>
                    <div class="draggable" id="cell6">
                        <h3>Chief Operating Officer</h3>                     
                           <div id="popup6" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nouvelles cellules draggable en bas -->
            <div class="draggable-container">
                <div class="draggable" id="cell7">
                    <h3>Project Manager </h3>
                    <div id="popup7" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                        </div>
                    </div>
                </div>
                <div class="draggable" id="cell8">
                    <h3> Partnership Manager </h3>
                    <div id="popup8" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                        </div>
                    </div>
                </div>
                <div class="draggable" id="cell9">
                    <h3>Accountant</h3>
                    <div id="popup9" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <button id="submitBtn" class="submit-button">Submit</button>
</main>
<script>
    function updateScoreDisplay(score) {
    $("#userScore").text(score);  // Met à jour l'élément d'affichage du score
}
            $(document).ready(function() {
                var score = 0;
                var cellAttempts = {};

                $(".draggable").draggable({
                    revert: "invalid",
                    zIndex: 100,
                    scroll: false
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
    delete cellAttempts[cellId];  // Réinitialise les tentatives après un dépôt correct
    alert("Correct! Points for this cell: " + points + ". Total score: " + score);
    updateScoreDisplay(score);  // Met à jour l'affichage du score
} else {
    ui.helper.draggable("option", "revert", true);
    if (cellAttempts[cellId] >= 5) {
        alert("Max attempts reached for this cell.");
    }
}

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
    // Enregistre le score dans la base de données
    $.ajax({
        url: '/save-score',
        type: 'POST',
        data: {
            score: score,
            _token: "{{ csrf_token() }}"  // Inclut le token CSRF
        },
        success: function(response) {
            alert('Score saved successfully! Total score: ' + score);
            window.location.href = 'finlevel';
        },
        error: function(xhr, status, error) {
            alert('Error: ' + error);
        }
    });
});

                // Help Button Click Event
                $("#helpBtn").click(function() {
                    $("#popup").css("display", "block");
                });

                // Close Popup
                $(".close").click(function() {
                    $("#popup").css("display", "none");
                });

                // Close Popup When Clicking Outside of It
                $(window).click(function(event) {
                    if (event.target == $("#popup")[0]) {
                        $("#popup").css("display", "none");
                    }
                });

                // Learn More Button Click Event
                $(".learn-more-btn").click(function() {
                    var popupId = $(this).siblings(".popup").attr("id");
                    $("#" + popupId).css("display", "block");
                });

                // Close Learn More Popup
                $(".popup .close").click(function() {
                    $(this).parent().parent().css("display", "none");
                });

                // Close Learn More Popup When Clicking Outside of It
                $(window).click(function(event) {
                    if ($(event.target).hasClass("popup")) {
                        $(event.target).css("display", "none");
                    }
                });
            });
        </script>

</body>
</x-app-layout>