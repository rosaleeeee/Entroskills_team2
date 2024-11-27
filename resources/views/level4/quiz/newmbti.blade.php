<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MBTI Quiz - Start</title>
        <link rel="stylesheet" href="{{ asset('mbti_quiz.css') }}">
    </head>
    <body>
        @include('layouts.sidebar')
        <div class="quiz-container">
            <div class="bheader">
                <h1 class="big1">We would like to know more about you</h1>
                <img class="imgtest" src="{{ asset('all_mbti/question-mark1.png') }}" alt="">
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

            <form action="{{ route('quiz.submitStart') }}" method="POST" id="quizFormStart">
                @csrf
                @foreach ($questions as $question => $answers)
                    @php
                        $key = str_replace(' ', '_', strtolower($question));
                    @endphp
                    <div class="question">
                        <p>{{ $question }}</p>
                        <div class="answers">
                            @foreach($answers as $answer => $type)
                                <button type="button" class="answer-button" data-question="{{ $key }}" data-answer="{{ $type }}">{{ $answer }}</button>
                            @endforeach
                            <input type="hidden" name="{{ $key }}" value="">
                        </div>
                    </div>
                @endforeach
                <div class="center-buttons">
                    <button type="submit" class="submit-button1" onclick="window.location.href='/mmm';">Done</button>
                </div>
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
            });
        </script>
    </body>
    </html>
</x-app-layout>
