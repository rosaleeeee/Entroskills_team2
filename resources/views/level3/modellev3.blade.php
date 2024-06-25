<x-app-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('BUSINESMODEL.css') }}" rel="stylesheet">
    <title>Business Model Canvas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <body>
        <!-- Sidebar inclusion -->
        @include('layouts.sidebar')

        <!-- Help Button -->
        <button id="helpBtn">Help</button>

        <!-- Popup for Game Rules -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>Game Rules</h2>
                <p>You'll work with an empty Business Model Canvas, where each cell contains the name of a key component along with a brief definition. Your task is to drag each component cell to its correct position. Need more info? Click on the "Details" button. Here's how scoring works: Correct placement on the first try earns you 5 points, on the second try earns you 3 points, and on the third try earns you 1 point. If you're incorrect on the fourth try, you'll lose 1 point, and the correct answer will be shown.</p>
            </div>
        </div>

        <!-- JavaScript for Popup -->
        <script>
            $(document).ready(function() {
                // Open popup when Help button is clicked
                $("#helpBtn").click(function() {
                    $("#popup").css("display", "block");
                });

                // Close popup when close button (X) is clicked
                $(".close").click(function() {
                    $(this).closest(".popup").css("display", "none");
                });

                // Close popup when clicked outside of it
                $(window).click(function(event) {
                    if (event.target == document.getElementById("popup")) {
                        $("#popup").css("display", "none");
                    }
                });
            });
        </script>

        <!-- Page Content -->
        <main>
            <div class="wrapper">
                <!-- Draggable cells on the left -->
                <div class="draggable-container">
                    <div class="draggable-column">
                        <div class="draggable" id="cell1">
                            <h3>External collaborators crucial for business operations.</h3>
                          
                        </div>
                        <div class="draggable" id="cell2">
                            <h3>Essential tasks for creating and delivering value.</h3>
                            
                            
                        </div>
                        <div class="draggable" id="cell3">
                            <h3>Necessary assets for business operations.</h3>
                            
                        </div>
                    </div>

                    <!-- Business Model Canvas (existing) -->
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

                    <!-- Draggable cells on the right -->
                    <div class="draggable-column">
                        <div class="draggable" id="cell4">
                            <h3>Unique offerings creating customer value.</h3>
                            
                        </div>
                        <div class="draggable" id="cell5">
                            <h3>Ways to attract and retain customers.</h3>
                          
                        </div>
                        <div class="draggable" id="cell6">
                            <h3>Methods to deliver products/services to customers.</h3>
                            
                        </div>
                    </div>
                </div>

                <!-- Draggable cells at the bottom -->
                <div class="draggable-container">
                    <div class="draggable" id="cell7">
                        <h3>Targeted groups for products/services.</h3>
                        <button class="learn-more-btn">Learn More</button>
                      
                    </div>
                    <div class="draggable" id="cell8">
                        <h3>Main expenses for business operations.</h3>
                      
                    </div>
                    <div class="draggable" id="cell9">
                        <h3>Sources generating business income.</h3>
                        
                     
                    </div>
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

                $(".learn-more-btn").click(function() {
                    var popupId = $(this).closest(".draggable").attr("id");
                    $("#" + popupId + " .popup").css("display", "block");
                });

                $(".close").click(function() {
                    $(this).closest(".popup").css("display", "none");
                });

                // Set up CSRF token for all AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Function to check answers on submit
                $("#submitBtn").click(function() {
                    var userAnswers = {};

                    $(".droppable").each(function() {
                        var cellId = $(this).children(".draggable").attr("id");
                        var droppedText = $(this).find("h3").text().trim();
                        userAnswers[cellId] = droppedText;
                    });

                    var attempts = 1; // Assuming a variable to track attempts

                    // Send AJAX request to backend to check answers and calculate score
                    $.ajax({
                        url: '/check-answers',
                        type: 'POST',
                        data: {
                            userAnswers: userAnswers,
                            attempts: attempts
                        },
                        success: function(response) {
                            console.log('Response:', response); // Log the response for debugging
                            if (response.allCorrect) {
                                alert(response.message);
                            } else {
                                alert("Sorry, you didn't get all answers correct. The correct answers will now be displayed.");
                                $(".droppable").each(function() {
                                    var cellId = $(this).children(".draggable").attr("id");
                                    $(this).find(".draggable").css({ left: 0, top: 0, position: "relative" }).appendTo($(this));
                                });
                            }
                            attempts = response.attempts; // Update attempts from response
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText); // Log the error response for debugging
                            alert("An error occurred. Please try again.");
                        }
                    });
                });
            });
        </script>
    </body>
</x-app-layout>
