<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use RealRashid\SweetAlert\Facades\Alert;



class CategoryController extends Controller
{
    //
    // public function categoryList(){

    // $categories = Category::orderBy('id', 'asc')
    //                         ->orderBy('created_at', 'desc')
    //                         ->paginate(3);

    //     return view('admin.category.categoryPage', compact('categories'));
    // }

    // public function createCategory(Request $request){

    //    $this->checkValidation($request);

    //    Category::create([
        
    //     'name'=>$request->input('categoryName')
    
    //    ]);

    //        Alert::success('Success Title', 'New Category created successfully! ');
            
    //      return redirect()->back()->with('success', 'Category created successfully!');
    // }


    //   public function editCategory($id){

    //     $category=Category::where('id', $id)->first();

    //     return view('admin.category.categoryEditPage', compact('category'));
    // }

    // public function deleteCategory($id){

    //     Category::where('id', $id)->delete();

    //     Alert::success('Success Title', 'Category deleted successfully! ');

    //     return redirect()->back()->with('success', 'Category deleted successfully!');
    // }

    //    private function checkValidation(Request $request){

    //     $request->validate([

    //         'categoryName'=>'required|min:2|max:30|unique:categories,name,'.$request->id
    //     ],[
    //         'categoryName.required' => 'The category name is required!',
    //         'categoryName.unique' => 'The category name must be unique!'
    //     ]);

        
    // }
    }


