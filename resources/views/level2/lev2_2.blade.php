<x-app-layout>
    <link href="{{ asset('level2_2.css') }}" rel="stylesheet">
    @include('layouts.sidebar')
    
    <div class="container">
        <div class="co_score">
            <img class="dia_img" src="{{ asset('all_mbti/diamond.png') }}" alt="Congratulations">
            <p class="user-score">{{ $userScore }}</p>
        </div>
        
        <div class="centered-container">
            <div class="idea-details">
                @if(Auth::user()->id == $winningIdea->user->id)
                    <img class="img_mo" src="{{ asset('all_mbti/party.png') }}" alt="Congratulations">
                    <h1>Congratulations!</h1>
                    <p>Your idea has been selected as the winning idea!</p>
                    
                    @if(!$winningIdea->user->has_received_idea_points)
                        <form method="post" action="{{ route('claim-idea-points') }}">
                            @csrf
                            <button type="submit" class="comment-button1 claim-button">Click Here To Gain 5 Points</button>
                        </form>
                    @else
                        <p class="already-claimed">You have already claimed your points.</p>
                    @endif
                    
                @else
                    <img class="img_mo" src="{{ asset('images_mbti/motivation.png') }}" alt="Like">
                    <h1>The Winning Idea</h1>
                @endif
                <h3>{{ $winningIdea->title }}</h3>
                <p>{{ $winningIdea->description }}</p>
                <p class="submitted-by">Submitted by: {{ $winningIdea->user->name }}</p>
                @if (Auth::user()->id == $winningIdea->user->id)
                <button class="comment-button1" onclick="window.location.href='business-model/create'">Start making the business model</button>
                @else
                <button class="comment-button" onclick="window.location.href='business-model/create'">Start making the business model</button>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
