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
            <p class="user-score">{{ Auth::user()->score }}</p>
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

                <!-- Nouvelles cellules draggable en bas -->
                <div class="draggable-container">
                    <div class="draggable" id="cell1"><h3>1<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Value Propositions.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell2"><h3>2<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Customer Segments.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell3"><h3>3<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Channels.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell4"><h3>4<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Customer Relationships.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell5"><h3>5<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Revenue Streams.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell6"><h3>6<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Key Resources.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell7"><h3>7<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Key Activities.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell8"><h3>8<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Key Parteners.png') }}" alt="Business Model Icon"></h3></div>
                    <div class="draggable" id="cell9"><h3>9<img class="BM-Icones" style="height: 80px;" src="{{ asset('images/Cost Structure.png') }}" alt="Business Model Icon"></h3></div>
                    </div>
            </div>

            <button id="submitBtn" class="submit-button">Submit</button>
        </main>

        <script>
    $(document).ready(function() {
        $(".draggable").draggable({
            revert: "invalid",
            zIndex: 100,
            scroll: false
        });

        $(".droppable").droppable({
            accept: ".draggable",
            drop: function(event, ui) {
                $(this).append(ui.helper.css({
                    left: 0,
                    top: 0,
                    position: "relative"
                }));
            }
        });

        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
      
        var attempts = 1; // Initialize attempts counter
        var maxAttempts = 3;
        var score = 0;

        // Function to check answers on submit
        $("#submitBtn").click(function() {
            var userAnswers = {};
            var correctCount = 0;

            $(".droppable").each(function() {
                var cellId = $(this).children(".draggable").attr("id");
                var category = $(this).data("category");
                userAnswers[cellId] = category;

                if (correctAnswers[cellId] === category) {
                    correctCount++;
                }
            });

            if (correctCount === Object.keys(correctAnswers).length) {
                if (attempts === 1) {
                    score = 5;
                } else if (attempts === 2) {
                    score = 3;
                } else if (attempts === 3) {
                    score = 1;
                }
                alert("Congratulations! All answers are correct. Score: " + score + " Points. Attempts: " + attempts);

                // Redirection vers une autre page après avoir terminé avec succès
                window.location.href='FinLevel'
               // window.location.href = "{{ route('FinLevel') }}"; // Assurez-vous que cette route correspond à la route définie dans web.php
            } else {
                if (attempts < maxAttempts) {
                    alert("Some answers are incorrect. Correct Answers: " + correctCount + " / " + Object.keys(correctAnswers).length + ". Attempts: " + attempts);
                    attempts++;
                } else {
                    alert("Incorrect answers on the third attempt. The correct answers will now be displayed.");

                    // Afficher les réponses correctes après avoir épuisé les tentatives
                    $(".droppable").each(function() {
                        var cellId = $(this).children(".draggable").attr("id");
                        if (correctAnswers[cellId] !== $(this).data("category")) {
                            $(this).append($("#" + cellId).css({ left: 0, top: 0, position: "relative" }));
                        }
                    });
                    $(".droppable").each(function() {
                        var category = $(this).data("category");
                        var correctCellId = Object.keys(correctAnswers).find(key => correctAnswers[key] === category);
                        if (correctCellId) {
                            $(this).append($("#" + correctCellId).css({ left: 0, top: 0, position: "relative" }));
                        }
                    });
                }
            }

            // Vous pouvez conserver votre code AJAX ici si nécessaire
            $.ajax({
    url: '/check-answers', // URL de l'itinéraire définie dans web.php
    type: 'POST',
    data: {
        userAnswers: userAnswers,
        attempts: attempts
    },
    success: function(response) {
        if (response.allCorrect) {
            alert(response.message + " Your total score is: " + response.score);

            // Redirection vers une autre page après avoir terminé avec succès
            window.location.href = 'FinExercice';
        } else {
            if (attempts < maxAttempts) {
                alert(response.message + " Attempts: " + attempts);
                attempts++;
            } else {
                alert("Incorrect answers on the third attempt. The correct answers will now be displayed.");

                // Afficher les réponses correctes après avoir épuisé les tentatives
                $(".droppable").each(function() {
                    var cellId = $(this).children(".draggable").attr("id");
                    if (correctAnswers[cellId] !== $(this).data("category")) {
                        $(this).append($("#" + cellId).css({ left: 0, top: 0, position: "relative" }));
                    }
                });
                $(".droppable").each(function() {
                    var category = $(this).data("category");
                    var correctCellId = Object.keys(correctAnswers).find(key => correctAnswers[key] === category);
                    if (correctCellId) {
                        $(this).append($("#" + correctCellId).css({ left: 0, top: 0, position: "relative" }));
                    }
                });
            }
        }
    },
    error: function(xhr, status, error) {
        alert('Error: ' + error);
    }
});

        });
    });
</script>



    </body>
</x-app-layout>