<!-- resources/views/affect-mbti/index.blade.php -->
<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Drag and Drop pour Affecter des Utilisateurs</title>
        <link rel="stylesheet" href="{{ asset('affichage_poste.css') }}">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        @php
        $jobs = [
 'Product Manager' => 'product_manager.png',
 'Marketing Manager' => 'marketing_manager.png',
 'Sales Manager' => 'sales_manager.png',
 'Customer Service Manager' => 'customer_service_manager.png',
 'Chief Financial Officer (CFO)' => 'cfo.png',
 'Chief Operating Officer (COO)' => 'coo.png',
 'Project Manager' => 'project_manager.png',
 'Partnerships Manager' => 'partnerships_manager.png',
 'Accountant' => 'accountant.png',
 ];
     @endphp
        @include('layouts.sidebar')
        <br><br>
        <div class="titreee" >
        <h1 class="titre" >     Final positions  </h1></div>
        <div class="clacla">
       <main class="main">
        <section class="card-area">
            @foreach($users as $user)
            <section class="card-section">
                <div class="card">
                    <div class="flip-card">
                        <div class="flip-card__container">
                            <div class="card-front">
                                <div class="card-front__tp card-front__tp--ski">
                                    <h2 class="card-front__heading">{{ $user->name }}</h2>
                                </div>
                                <div class="card-front__bt">
                                    <p class="card-front__text-view card-front__text-view--ski">{{ $user->mbti_type }}</p>
                                </div>
                            </div>
                            <div class="card-back">
                                <video class="video__container" autoplay muted loop>
                                    <source class="video__media" src="https://player.vimeo.com/external/195913085.sd.mp4?s=7c12f7a83de62a8900fd2ae049297070b9bc8a54&profile_id=164&oauth2_token_id=574477611" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="inside-page">
                        <div class="inside-page__container">
                            <p class="inside-page__text">
                                <img class="iimmgg" src="{{ asset('images_mbti/' . $jobs[$user->job]) }}" alt="image">
                            </p>
                            <h3 class="inside-page__heading inside-page__heading--ski">{{ $user->job }}</h3>
                        </div>
                    </div>
                </div>                
            </section>
            @endforeach
        </section>
    </main>   
    <div class="btcont" >
        <button class="start-button" onclick="window.location.href='fin'">Next</button>
    </div> 
   </div>   
    </body>
    </html>
</x-app-layout>
