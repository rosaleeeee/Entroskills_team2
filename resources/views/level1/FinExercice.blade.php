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
       
    <div class="container">
        <div class="icon">
            <img class="image_end" src="{{ asset('images/bravo.gif') }}" alt="Business Model Icon">
        </div>
       
        <button class="start-button" onclick="window.location.href='StartExercice'">next</button>
    </div>
</body>
 

</x-app-layout>
