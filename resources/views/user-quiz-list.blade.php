<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen ">
    <x-user-navbar />

    <!-- Back Button -->
    <div class="px-4 py-4">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </div>

            <!-- Right Side - Table -->
            <div class="lg:col-span-2 px-4 py-6">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">S.No</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Mcqs Count</th>
                                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 -->
                                @foreach($quizData as $quiz)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $quiz->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                       {{ App\Models\Mcq::where('quiz_id', $quiz->id)->count() }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                         <a href="/start-quiz/{{ $quiz->id }}/{{ $quiz->name }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Attempt Quiz
                                        </a>

                                        
                                        <!-- <a href="/show-quizzes/{{ $quiz->id }}/{{ $quiz->name }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Attempt Quiz
                                        </a> -->
                                    </td>
                                    @endforeach
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>