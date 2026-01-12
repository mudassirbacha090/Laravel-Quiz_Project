<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Page Header -->
    <x-header :name="$admin->name" />
  
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 flex items-center justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Add Quiz</h2>
                    <p class="text-blue-100 text-sm mt-1">Create a new quiz</p>
                </div>

                <!-- Form Body -->
                <div class="p-6">
                    @if(!session('quizDetails'))
                        
                    
                    <form action="/add-quiz" method="GET">
                        @csrf
                        <!-- Quiz Name -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-semibold mb-2" for="category_name">
                                Quiz Name
                            </label>
                            <input 
                                type="text" 
                                name="quiz_name"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter quiz name"
                            />
                        </div>
                        <div class="mb-6">
                            <select required type="text" name="category_id" class="text-blue-600 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors">
                                <option value="" disabled selected >Select Category</option>
                                @foreach ($categories as $category)
                                    <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            Add Quiz
                        </button>
                    </form>
                    @else
                        <div class="text-center">
                            <p class="text-gray-700 mb-2 text-left">Quiz Name: <span class="font-bold">{{ session('quizDetails.name') }}</span></p>
                            <p class="text-gray-700 mb-2 text-left"><span>Total MCQs: {{ $totalMcqs }}</span>
                         @if ($totalMcqs>0)
                           <a  href="show-quizzes/{{ session('quizDetails.id') }}">Show MCQs</a>
                        @else
                            <p class="text-red-600 mb-4 text-left">Please add at least one question to finish the quiz.</p>
                            
                        @endif</p>
                       
                              <form action="/add-mcq" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                           
                            <textarea 
                                name="question"
                               
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter Your Questions"
                            ></textarea>
                    
                                @error('question')
                                    <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="mb-6 space-y-4">
                          
                            <input 
                                type="text" 
                                name="a"
                                
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter Your First Option"
                            />
                            @error('a')
                                <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                                
                            @enderror
                            <input 
                                type="text" 
                                name="b"
                                
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter Your Second Option"
                            />
                            @error('b')
                                <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <input 
                                type="text" 
                                name="c"
                                
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter Your Third Option"
                            />
                            @error('c')
                                <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <input 
                                type="text" 
                                name="d"
                               
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                placeholder="Enter Your Fourth Option"
                            />
                            @error('d')
                                <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <select name="correct_ans" class="text-blue-600 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors">
                                <option value="" disabled selected>Select Correct Option</option>
                                <option value="a">Option A</option>
                                <option value="b">Option B</option>
                                <option value="c">Option C</option>
                                <option value="d">Option D</option>
                            </select>   
                            @error('correct_ans')
                                <p class="text-left text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror


                        </div>
                       

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            value="done"
                            name="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            Add and Submit
                        </button>
                            <button 
                            type="submit"
                            name="submit"
                            value="add-more"
                            class="w-full my-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            Add More Questions
                        </button>
                        <a href="/end-quiz" class="w-full block  bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"> Finish Quiz</a>
                    </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

</body>
</html>