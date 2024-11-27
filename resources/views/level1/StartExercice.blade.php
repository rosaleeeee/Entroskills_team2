<x-app-layout>
    
            <!-- Page Content -->

   
    @include('layouts.sidebar')

    @php
        $userScore = Auth::user()->score;  
        @endphp
        <div class="co_score">
            <img class="dia_img" src="{{ asset('images/diamond.png') }}" alt="Congratulations">
            <p class="user-score">{{ Auth::user()->score }}</p>
        </div>
       

<!-- end navbar -->   

<link href="{{ asset('level-obj.css') }}" rel="stylesheet">
<body>
    <div id="content">
        <div id="left">
            <h1>Application Exercise:</h1>
            <p>In the second part of this level, you will apply the knowledge you’ve acquired by organizing the steps of the Business Model Canvas, 
                as if you were working on a real project. This exercise will help you consolidate your understanding of the Business Model Canvas by 
                arranging each component correctly based on the given project scenario.</p></br>
            
           
            
        </div>
        <div id="right">
            <img src="{{ asset('images/Startexercice.png') }}" alt="Illustration" style="height: 400px; width:400px;  margin-left: 150px; margin-top: 50px;">
        </div>
    </div>
    <div class="conteneur">
    <button class="start_level_btn" onclick="window.location.href='ExerciceBUSINESSMODEL'">Start</button>
</div>
    
</body>
</x-app-layout>
