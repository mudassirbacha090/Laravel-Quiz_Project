<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center">
                <h1 class="text-3xl font-bold text-white">Ready for the Quiz?</h1>
                <p class="text-blue-100 mt-2">Test your knowledge and start now 🚀</p>
            </div>

            <!-- Content -->
            <div class="p-8 text-center">

                <!-- Quiz Info -->
                <div class="mb-6 text-gray-600">
                    <p class="mb-2"><strong>Total Questions:</strong> 10</p>
                    <p class="mb-2"><strong>Time:</strong> 10 Minutes</p>
                    <p><strong>Passing Marks:</strong> 50%</p>
                </div>

                <!-- Start Button -->
                <a href="/user-signup"
                   class="inline-block w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold py-3 rounded-lg
                          hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg
                          hover:shadow-xl transform hover:-translate-y-0.5">
                    Start Quiz
                </a>

                <!-- Back -->
                <a href="/dashboard" class="block mt-4 text-sm text-gray-500 hover:text-gray-700">
                    ← Back to Dashboard
                </a>
            </div>

        </div>
    </div>

</body>
</html>
