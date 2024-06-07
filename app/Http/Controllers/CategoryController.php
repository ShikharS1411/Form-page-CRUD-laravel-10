<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        // return 'Shikhar';
        $categories= Category::get();
        // return $categories;
        return view('category.index',compact('categories'));
    }
    public function create(){
        return view("category.create");
    }
    public function store(Request $request){
        $request->validate([
            "name"=> "required|max:255",
            "description"=> "required|max:255|string",
            "is_active"=> "sometimes",
        ]);
        Category::create([
            "name"=> $request->name,
            "description"=> $request->description,
            "is_active"=> $request->is_active== true? 1:0,
        ]);
        return redirect("categories/create")->with("status","Category Created");
    }
        public function edit(int $id){
            // $category=Category::findOrFail($id);
            $category=Category::findOrFail($id);
            // return $category;
            return view("category.edit",compact("category"));   
        }   
        public function update(Request $request,int $id){ 
            $request->validate([
                "name"=> "required|max:255",
                "description"=> "required|max:255|string",
                "is_active"=> "sometimes",
            ]);
            Category::findOrFail($id)->update([
                "name"=> $request->name,
                "description"=> $request->description,
                "is_active"=> $request->is_active== true? 1:0,
            ]);
            return redirect()->back()->with("status","Category Created");
        }
        public function destroy(int $id){
            // $category=Category::findOrFail($id);
            $category=Category::findOrFail($id);
            $category->delete();
            return redirect("categories")->with("status","Category Deleted");  
        } 
        public function updateStatus(Request $request)
        {
            $category = Category::find($request->id);
            if ($category) {
                $category->is_active = $request->is_active;
                $category->save();
                return response()->json(['success' => true, 'message' => 'Status updated successfully']);
            }
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }
}