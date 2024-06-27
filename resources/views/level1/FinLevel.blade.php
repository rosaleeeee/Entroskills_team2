<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('Start-level.css') }}" rel="stylesheet">
        <title>start</title>
    </head>  
<body>
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
    <div class="container">
        <div class="icon">
            <img class="image_end" src="{{ asset('images/bravo.gif') }}" alt="Business Model Icon">
        </div>
       
        <form action="{{ route('dashboard') }}" method="POST">
            @csrf
            <!-- Your questions here -->
        
            <button class="start-button" type="submit">Next</button>
        </form>    </div>
</body>
 

</x-app-layout>
