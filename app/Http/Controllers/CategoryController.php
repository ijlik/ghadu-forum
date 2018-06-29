<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->id == 1){
          $category = Category::all();
          return view('category', [
            'category' => $category
          ]);
        } else {
          return redirect()->to('/');
        }
    }
    public function create(Request $request)
    {
      if(Auth::user()->id == 1){
          $category = new Category();
          $category->nama = $request->nama;
        
          if($category->save()){
            return redirect()->to('/category');
          } else {
            return view('404');
          }
        } else {
          return redirect()->to('/');
        }
        
    }
    public function update(Request $request)
    {
        if(Auth::user()->id == 1){
          $category = Category::find($request->id);
          $category->nama = $request->nama;
        
          if($category->save()){
            return redirect()->to('/category');
          } else {
            return view('404');
          }
        } else {
          return redirect()->to('/');
        }
        
    }
    public function delete($id)
    {
        if(Auth::user()->id == 1){
          $category = Category::find($id);
        
          if($category->delete()){
            return redirect()->to('/category');
          } else {
            return view('404');
          }
        } else {
          return redirect()->to('/');
        }
        
    }
}
