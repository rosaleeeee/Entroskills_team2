<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('Start-level.css') }}" rel="stylesheet">
        <title>start</title>
    </head>   
<body>
    @include('layouts.sidebar')
    <div class="container">
        <div class="icon">
            <img class="image_start" src="{{ asset('images/Level4.png') }}" alt="Business Model Icon">
        </div>
        <h1>PROFILE</h1>
        <button class="start-button" onclick="window.location.href='quiz/show'">start</button>
    </div>
</body>
 

</x-app-layout>
