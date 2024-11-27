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
            <img class="image_start" src="{{ asset('images/finlevel.png') }}" alt="Business Model Icon">
        </div>
        <h1>GREAT WORK ,KEEP IT UP!</h1>
    </div>
</body>


</x-app-layout>
