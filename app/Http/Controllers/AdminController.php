<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $request)
    {
        //  Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Check admin credentials
        $admin = Admin::where('name', $request->username)
                      ->where('password', $request->password)
                      ->first();

        // If admin not found, return back with error
        if (!$admin) {
            return back()->withErrors([
                'user' => 'The username or password is not valid'
            ])->withInput();
        }
    Session::put('admin', $admin);

       return redirect('dashboard');
        
    }
    function dashboard()
    {
       
        $admin = Session::get('admin');
        if($admin){
        return view('admin', ['admin' => $admin]);
        }else{
            return redirect('admin-login');
        }
    }
    function categories()
    {
       $categories = Category::all();
        $admin = Session::get('admin');
        if($admin){
        return view('categories', ['admin' => $admin, 'categories' => $categories]);
        }else{
            return redirect('admin-login');
        }
    }
    function logout()
    {
        Session::forget('admin');
        return redirect('admin-login');
    }
    function addCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,name|min:5|max:255',
        ]);
      $admin = Session::get('admin');
      $category = new Category();
      $category->name = $request->input('category_name');
      $category->creator = $admin->name;
        if( $category->save()){
            Session::flash('category',"category ".$request->category_name." added successfully");
            return redirect('categories');
        }
    //   return redirect('categories')->with('success', 'Category added successfully!');

    }
    function deleteCategory($id)
    {
      $category = Category::find($id);
      if($category){
        $categoryName = $category->name;
        $category->delete();
        Session::flash('category',"category ".$categoryName." deleted successfully");
      }
      return redirect('categories');
    }
    function addQuiz()
    {   
        $categories = Category::all();
        $admin = Session::get('admin');

        if($admin){ 
            $quizName=request()->input('quiz_name');
            $category_id=request()->input('category_id');
            if($quizName && $category_id && !Session::has('quizDetails')){
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $category_id;
                if( $quiz->save()){
                    Session::put('quizDetails',$quiz);
                    return redirect('add-quiz');
                }
            }
            return view('add-quiz', ['admin' => $admin, 'categories' => $categories]);
        }else{
            return redirect('admin-login');
        }
    }
}
