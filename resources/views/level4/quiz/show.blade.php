<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MBTI Quiz</title>
        <link rel="stylesheet" href="{{ asset('mbti_quiz.css') }}">
    </head>
    <body>
        @include('layouts.sidebar')
        <div class="quiz-container">
            <div class="bheader">
                <h1 class="big">MBTI TEST</h1>
                <img class="imgtest" src="{{ asset('all_mbti/question-mark.png') }}" alt="">
            </div>
    
            @if ($errors->any())
                <div>
                    <ul class="error-message">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <form action="{{ route('quiz.submit') }}" method="POST" id="quizForm">
                @csrf
                @php
                    $questionKeys = array_keys($questions);
                    $totalQuestions = count($questionKeys);
                    $questionsPerPage = 20;
                    $totalPages = ceil($totalQuestions / $questionsPerPage);
                @endphp
    
                @for ($page = 0; $page < $totalPages; $page++)
                    <div class="quiz-section" data-page="{{ $page }}" style="{{ $page === 0 ? '' : 'display: none;' }}">
                        @for ($i = $page * $questionsPerPage; $i < ($page + 1) * $questionsPerPage && $i < $totalQuestions; $i++)
                            @php
                                $question = $questionKeys[$i];
                                $key = str_replace(' ', '_', strtolower($question));
                            @endphp
                            <div class="question">
                                <p>{{ $question }}</p>
                                <div class="answers">
                                    @foreach($questions[$question] as $answer => $type)
                                        <button type="button" class="answer-button" data-question="{{ $key }}" data-answer="{{ $type }}">{{ $answer }}</button>
                                    @endforeach
                                    <input type="hidden" name="{{ $key }}" value="">
                                </div>
                            </div>
                        @endfor
                        <div class="center-buttons">
                            @if ($page < $totalPages - 1)
                                <button type="button" class="next-button" data-next-page="{{ $page + 1 }}">Next</button>
                            @endif
                            @if ($page == $totalPages - 1)
                                <button type="submit" class="submit-button">Submit</button>
                            @endif
                        </div>
                    </div>
                @endfor
            </form>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.answer-button').click(function() {
                    const questionKey = $(this).data('question');
                    const answerValue = $(this).data('answer');
    
                    $('[data-question="' + questionKey + '"]').removeClass('selected');
                    $(this).addClass('selected');
                    $('input[name="' + questionKey + '"]').val(answerValue);
                });
    
                $('.next-button').click(function() {
                    const nextPage = $(this).data('next-page');
                    $('.quiz-section').hide();
                    $('.quiz-section[data-page="' + nextPage + '"]').show();
                    if (nextPage === {{ $totalPages - 1 }}) {
                        $('.submit-button').show();
                    }
                });
            });
        </script>
    </body>
    </html>
    </x-app-layout>
    