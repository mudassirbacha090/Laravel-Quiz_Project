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
    <div class="max-w-7xl mx-auto px-4 py-8">          
    @if(Session('category'))
    <div class="container mx-auto px-4 py-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ Session('category') }}</span>
          
        </div>
    </div>
    @endif
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side - Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 text-center">
                        <h2 class="text-xl font-bold text-white">Add Category</h2>
                    </div>

                    <!-- Form Body -->
                    <div class="p-6">
                        <form action="/add-category" method="POST">
                            @csrf
                            
                            <!-- Category Name -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="category_name">
                                    Category Name
                                </label>
                                <input 
                                    type="text" 
                                    id="category_name"
                                    name="category_name"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                                    placeholder="Enter category name"
                                    value="{{ old('category_name') }}"
                                />
                                @error('category_name')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p> 
                                    
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl"
                            >
                                Add Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side - Table -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">S.No</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Creator</th>
                                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 -->
                                @foreach($categories as $category)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $category->creator }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="category/delete/{{ $category->id }}" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <button class="text-red-600 hover:text-red-800 font-medium text-sm">
                                               <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </a> 
                                        <a href="quiz-list/{{ $category->id }}/{{ $category->name }}">
                                            <button class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
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