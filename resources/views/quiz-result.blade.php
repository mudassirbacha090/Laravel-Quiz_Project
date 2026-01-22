<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - {{ $submission->quiz->name }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">
    <x-user-navbar />

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Result Header -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Quiz Complete! 🎉</h1>
            <p class="text-gray-600 text-lg">{{ $submission->quiz->name }}</p>
        </div>

        <!-- Score Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Percentage -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-5xl font-bold mb-2 
                    @if($submission->percentage >= 80)
                        text-green-600
                    @elseif($submission->percentage >= 50)
                        text-yellow-600
                    @else
                        text-red-600
                    @endif">
                    {{ number_format($submission->percentage, 2) }}%
                </div>
                <p class="text-gray-600 font-semibold">Score</p>
            </div>

            <!-- Correct Answers -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-5xl font-bold text-green-600 mb-2">{{ $submission->correct_answers }}</div>
                <p class="text-gray-600 font-semibold">Correct Answers</p>
                <p class="text-sm text-gray-500">out of {{ $submission->total_questions }}</p>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="text-5xl font-bold mb-2
                    @if($submission->passed)
                        text-green-600
                    @else
                        text-red-600
                    @endif">
                    @if($submission->passed)
                        ✓
                    @else
                        ✗
                    @endif
                </div>
                <p class="text-gray-600 font-semibold">
                    @if($submission->passed)
                        <span class="text-green-600">PASSED</span>
                    @else
                        <span class="text-red-600">FAILED</span>
                    @endif
                </p>
                <p class="text-sm text-gray-500">Minimum: 50%</p>
            </div>
        </div>

        <!-- Detailed Results -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Detailed Results</h2>

            <div class="space-y-6">
                @foreach($submission->userAnswers as $answer)
                <div class="border-l-4 
                    @if($answer->is_correct)
                        border-green-500
                    @else
                        border-red-500
                    @endif
                    pl-4 py-4">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-gray-800">{{ $answer->mcq->question }}</h3>
                        <span class="
                            @if($answer->is_correct)
                                bg-green-100 text-green-800
                            @else
                                bg-red-100 text-red-800
                            @endif
                            px-3 py-1 rounded-full text-sm font-medium">
                            @if($answer->is_correct)
                                ✓ Correct
                            @else
                                ✗ Incorrect
                            @endif
                        </span>
                    </div>

                    <div class="space-y-2 text-sm">
                        <!-- User's Answer -->
                        <div>
                            <strong class="text-gray-700">Your Answer:</strong>
                            <span class="
                                @if($answer->is_correct)
                                    text-green-600
                                @else
                                    text-red-600
                                @endif">
                                @if($answer->user_answer)
                                    {{ $answer->user_answer }}. 
                                    @switch($answer->user_answer)
                                        @case('A')
                                            {{ $answer->mcq->a }}
                                            @break
                                        @case('B')
                                            {{ $answer->mcq->b }}
                                            @break
                                        @case('C')
                                            {{ $answer->mcq->c }}
                                            @break
                                        @case('D')
                                            {{ $answer->mcq->d }}
                                            @break
                                    @endswitch
                                @else
                                    <span class="text-gray-500">Not answered</span>
                                @endif
                            </span>
                        </div>

                        <!-- Correct Answer -->
                        @if(!$answer->is_correct)
                        <div>
                            <strong class="text-gray-700">Correct Answer:</strong>
                            <span class="text-green-600">
                                {{ $answer->mcq->correct_ans }}. 
                                @switch($answer->mcq->correct_ans)
                                    @case('A')
                                        {{ $answer->mcq->a }}
                                        @break
                                    @case('B')
                                        {{ $answer->mcq->b }}
                                        @break
                                    @case('C')
                                        {{ $answer->mcq->c }}
                                        @break
                                    @case('D')
                                        {{ $answer->mcq->d }}
                                        @break
                                @endswitch
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 mb-8">
            <a href="/" class="flex-1 bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition-all text-center">
                Back to Categories
            </a>
            @if(!$submission->passed)
            <a href="/user-quiz-list/{{ $submission->quiz->category_id }}/{{ $submission->quiz->category->name }}" class="flex-1 bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition-all text-center">
                Try Another Quiz
            </a>
            @else
            <a href="/user-quiz-list/{{ $submission->quiz->category_id }}/{{ $submission->quiz->category->name }}" class="flex-1 bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition-all text-center">
                Next Quiz
            </a>
            @endif
        </div>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
