<x-app-layout>
    <link href="{{ asset('howtoplay.css') }}" rel="stylesheet">
    <!-- Page Content -->
    <main>
        <div style="display: flex; height: 85vh;">
            <div style=" color: black; padding: 20px;">
                <!-- start navbar --> 
                @include('layouts.sidebar')    
                <!-- end navbar -->
            </div>
            <div class="container">
                <div class="card">
                    <div class="image">
                        <img class="card-image" id="card-image" src="{{ asset('images/quiz-time.gif') }}" alt="quiz"> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup pour les règles du quiz -->
        <div class="popup" id="popup">
            <div class="popup-content">
            <h2>Quiz Rules</h2>
                    <ul>
                        <li>You will have 20 seconds to answer each question.</li>
                        <li>Each question has one correct answer.</li>
                        <li>You can only select one answer per question.</li>
                        <li>Your score will be displayed at the end of the quiz.</li>
                        <li>Click "Next" to proceed to the next question.</li>
                <button class="close-btn" id="close-btn">Close</button>
            </div>
        </div>
    </main>

    <!-- Script JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardImage = document.getElementById('card-image');
            const popup = document.getElementById('popup');
            const closeBtn = document.getElementById('close-btn');

            cardImage.addEventListener('click', function() {
                popup.style.display = 'flex'; // Affiche le popup
            });

            closeBtn.addEventListener('click', function() {
                popup.style.display = 'none'; // Cache le popup
            });
        });
    </script>
        
    </main>
    <button class="bottom-right-button" onclick="window.location.href='quiz'">I AM READY</button>

</x-app-layout>

