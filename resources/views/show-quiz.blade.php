<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen ">
    <x-header :name="$admin->name" />

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
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Questions</th>
                                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 -->
                                @foreach($quizzes as $quiz)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $quiz->question }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="category/delete/" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <button class="text-red-600 hover:text-red-800 font-medium text-sm">
                                               <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </a> 
                                        
                                        
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