<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Page Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">AdminPanel</h1>
                        <p class="text-xs text-gray-500">Management System</p>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Catagory</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Quiz</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Welcome {{$admin->name}}</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Login</a>
                </nav>
                
                
            </div>
        </div>
    </header>

</body>
</html>