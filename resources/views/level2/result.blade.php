<x-app-layout>
    <link href="{{ asset('use_case2.css') }}" rel="stylesheet">
    @include('layouts.sidebar')
    <div class="container">
        @php
        $userScore = Auth::user()->score;  
        @endphp
        <div class="co_score"> 
            <img class="dia_img" src="{{ asset('all_mbti/diamond.png') }}" alt="Congratulations">
            <p class="user-score">{{ $userScore }}</p>
        </div>
        <div class="header-container">
            <h1 class="page-title">Business Model Results</h1>
            <img class="job_image" src="{{ asset('all_mbti/united.png')}}" alt="image">
        </div>
        <div class="business-model-canvas">
            <div class="canvas-section key-partnerships">
                <h2 class="tit_">Key Partnerships</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->key_partnerships }}</p>
                @endforeach
            </div>
            <div class="canvas-section key-activities">
                <h2 class="tit_">Key Activities</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->key_activities }}</p>
                @endforeach
            </div>
            <div class="canvas-section value-propositions">
                <h2 class="tit_">Value Propositions</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->value_propositions }}</p>
                @endforeach
            </div>
            <div class="canvas-section customer-relationships">
                <h2 class="tit_">Customer Relationships</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->customer_relationships }}</p>
                @endforeach
            </div>
            <div class="canvas-section customer-segments">
                <h2 class="tit_">Customer Segments</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->customer_segments }}</p>
                @endforeach
            </div>
            <div class="canvas-section key-resources">
                <h2 class="tit_">Key Resources</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->key_resources }}</p>
                @endforeach
            </div>
            <div class="canvas-section channels">
                <h2 class="tit_">Channels</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->channels }}</p>
                @endforeach
            </div>
            <div class="canvas-section cost-structure">
                <h2 class="tit_">Cost Structure</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->cost_structure }}</p>
                @endforeach
            </div>
            <div class="canvas-section revenue-streams">
                <h2 class="tit_">Revenue Streams</h2><br>
                @foreach ($businessModels as $model)
                    <p class="response-item">{{ $model->revenue_streams }}</p>
                @endforeach
            </div>
        </div>
        <div class="btcont" >
        <button class="start-button" onclick="window.location.href='fin'">Next</button>
    </div>
</div>
</x-app-layout>
