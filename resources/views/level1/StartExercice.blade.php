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
        <style>
             .co_score {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-bottom: 10px;
  }
  
  .user-score {
      font-size: 18px;
      font-weight: 600;
      margin-left: 10px; /* Espace entre l'image et le score */
      margin-right: 20px;
  }
  
  .dia_img {
      width: 30px;
  }
        </style>

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
            <img src="{{ asset('images/Level1.png') }}" alt="Illustration">
        </div>
    </div>
    <div class="conteneur">
    <button class="start_level_btn" onclick="window.location.href='ExerciceBUSINESSMODEL'">Start</button>
</div>
    
</body>
</x-app-layout>
