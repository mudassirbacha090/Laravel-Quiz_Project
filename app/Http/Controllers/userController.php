<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;

class userController extends Controller
{
    
    function welcome(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('creator', 'like', '%' . $search . '%');
        }

        // Get categories with quiz count
        $categories = $query->withCount('quizzes')->paginate(3);
        
        return view('welcome', ['categories' => $categories]);
    }
    function userQuiz($id, $category)
    {
        $quizData = Quiz::where('category_id', $id)->get();
        return view('user-quiz-list', ['quizData' => $quizData, 'category' => $category]);
    }   



    function userSignup(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        // Create a new user (assuming you have a User model)
        $user = new \App\Models\User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Log the user in
        auth()->login($user);

        // Redirect to home page with success message
        return redirect('/')->with('success', 'User registered successfully!');
    }
    function startQuiz($id, $quizName)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs = Mcq::where('quiz_id', $id)->get();
        return view('start-quiz', ['id' => $id, 'quizName' => $quizName, 'quizCount' => $quizCount, 'mcqs' => $mcqs]);
    }

    function submitQuiz(\Illuminate\Http\Request $request)
    {
        // Validate that user is authenticated
        if (!auth()->check()) {
            return redirect('/user-signup')->with('error', 'Please signup to submit a quiz.');
        }

        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array'
        ]);

        $quizId = $request->quiz_id;
        $answers = $request->answers;
        $user = auth()->user();

        // Get all MCQs for this quiz
        $mcqs = Mcq::where('quiz_id', $quizId)->get();
        
        $correctCount = 0;
        $incorrectCount = 0;

        // Create quiz submission record
        $submission = new \App\Models\QuizSubmission();
        $submission->user_id = $user->id;
        $submission->quiz_id = $quizId;
        $submission->total_questions = $mcqs->count();

        // Process each answer
        foreach ($mcqs as $mcq) {
            $userAnswer = $answers[$mcq->id] ?? null;
            $isCorrect = false;

            if ($userAnswer && $userAnswer === $mcq->correct_ans) {
                $isCorrect = true;
                $correctCount++;
            } else {
                $incorrectCount++;
            }

            // Save user answer
            $answerRecord = new \App\Models\UserAnswer();
            $answerRecord->quiz_submission_id = $submission->id ?? 0; // Will update after saving submission
            $answerRecord->mcq_id = $mcq->id;
            $answerRecord->user_answer = $userAnswer ?? '';
            $answerRecord->is_correct = $isCorrect;
            // Don't save yet, need submission ID first
        }

        // Calculate results
        $submission->correct_answers = $correctCount;
        $submission->incorrect_answers = $incorrectCount;
        $submission->percentage = ($correctCount / $submission->total_questions) * 100;
        $submission->passed = $submission->percentage >= 50; // 50% passing mark
        $submission->save();

        // Now save user answers with the submission ID
        foreach ($mcqs as $mcq) {
            $userAnswer = $answers[$mcq->id] ?? null;
            $isCorrect = false;

            if ($userAnswer && $userAnswer === $mcq->correct_ans) {
                $isCorrect = true;
            }

            $answerRecord = new \App\Models\UserAnswer();
            $answerRecord->quiz_submission_id = $submission->id;
            $answerRecord->mcq_id = $mcq->id;
            $answerRecord->user_answer = $userAnswer ?? '';
            $answerRecord->is_correct = $isCorrect;
            $answerRecord->save();
        }

        return redirect('/quiz-result/' . $submission->id);
    }

    function quizResult($submissionId)
    {
        $submission = \App\Models\QuizSubmission::with('userAnswers.mcq', 'quiz')->findOrFail($submissionId);
        
        // Verify that the current user owns this submission
        if (auth()->check() && $submission->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        if (!auth()->check()) {
            return redirect('/user-signup')->with('error', 'Please login to view results.');
        }

        return view('quiz-result', ['submission' => $submission]);
    }

    function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    function userLogout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}