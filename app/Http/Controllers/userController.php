<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;

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

        // // Create a new user (assuming you have a User model)
        // $user = new \App\Models\User();
        // $user->name = $request->username;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();

        // // Redirect to a desired page with success message
        // return redirect('/')->with('success', 'User registered successfully!');
    }
    
}