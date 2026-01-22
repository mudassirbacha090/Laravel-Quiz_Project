<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quizName }} - Quiz</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">
    <x-user-navbar />

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Quiz Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $quizName }}</h1>
            <div class="flex justify-between items-center text-gray-600">
                <p><strong>Total Questions:</strong> {{ $quizCount }}</p>
            </div>
        </div>

        @if($quizCount == 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <p class="text-yellow-800 text-lg">No questions available for this quiz yet.</p>
                <a href="{{ url()->previous() }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Go Back
                </a>
            </div>
        @else
            <form action="/submit-quiz" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $id }}">

                <!-- Questions -->
                @foreach($mcqs as $index => $mcq)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <!-- Question Number and Text -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <span class="bg-blue-600 text-white rounded-full w-8 h-8 inline-flex items-center justify-center mr-3">
                                {{ $index + 1 }}
                            </span>
                            {{ $mcq->question }}
                        </h3>
                    </div>

                    <!-- Options -->
                    <div class="space-y-3">
                        @php
                            $options = [
                                'A' => $mcq->a,
                                'B' => $mcq->b,
                                'C' => $mcq->c,
                                'D' => $mcq->d
                            ];
                        @endphp

                        @foreach($options as $key => $value)
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition-all">
                            <input type="radio" 
                                   name="answers[{{ $mcq->id }}]" 
                                   value="{{ $key }}"
                                   class="w-5 h-5 text-blue-600"
                                   required>
                            <span class="ml-4 text-gray-800 font-medium">
                                <strong>{{ $key }}.</strong> {{ $value }}
                            </span>
                        </label>
                        @endforeach
                    </div>

                    @error("answers.{$mcq->id}")
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                <!-- Submit Button -->
                <div class="flex gap-4 mt-8">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold py-3 rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Submit Quiz
                    </button>
                    <a href="{{ url()->previous() }}" class="flex-1 bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg hover:bg-gray-400 transition-all duration-200 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        @endif
    </div>

    @vite('resources/js/app.js')
</body>
</html>
