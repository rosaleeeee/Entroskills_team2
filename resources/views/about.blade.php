<x-app-layout>
<link href="{{ asset('about.css') }}" rel="stylesheet">

            <!-- Page Content -->

            <main>
            <div style="display: flex; height: 85vh;">
    <div style="width: 100px; height:1000px; color: black; padding: 20px;">
        <!-- start navbar --> 
    @include('layouts.sidebar')

<!-- end navbar -->
    </div>
    <div class="card-list">
        <a href="#" class="card-item">
            <span class="developer">OUR MISSION</span>
            <h3>Our application aims to revolutionize entrepreneurial education by leveraging the power of gamification and serious games. We are committed to providing an engaging, interactive, and effective learning experience for aspiring entrepreneurs.</h3>
            
        </a>
        <a href="#" class="card-item">
            <span class="editor">GAME RULES</span>
            <h3>Here's how scoring works: Correct placement on the first try earns you 5 points, on the second try earns you 3 points, and on the third try earns you 1 point. If you're incorrect on the fourth try, you'll lose 1 point, and the correct answer will be shown.</p></h3>
            
           
        </a>
        <a href="#" class="card-item">
            <span class="designer">PRIVACY AND SECURITY</span>
            <h3>Our app prioritizes privacy and security. We ensure that all user data is kept confidential and protected. We adhere to strict privacy policies and employ robust security measures to safeguard your information.</h3>
            
        </a>
        <a href="#" class="card-item">
            <span class="community">COMMUNITY GUIDELINES</span>
            <h3>Our app prioritizes privacy and security. We ensure that all user data is kept confidential and protected. We adhere to strict privacy policies and employ robust security measures to safeguard your information.</h3>
            
        </a>
        
    </div>
    
  </main>
  

</x-app-layout>
