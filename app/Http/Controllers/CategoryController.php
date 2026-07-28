<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //

     public function categoryList(){

    $categories = Category::when(request('searchKey'), function($query){
                                $query->where( 'name', 'like', '%' .request('searchKey'). '%' );
                            })
                            ->orderBy('id', 'asc')
                            
                            ->orderBy('created_at', 'desc')

                            ->paginate(3);

           
            

        return view('admin.category.categoryPage', compact('categories'));
    }

    public function createCategory(Request $request){

       $this->checkValidation($request);

       Category::create([
        
        'name'=>$request->input('categoryName')
    
       ]);

           Alert::success('Success Title', 'New Category created successfully! ');
            
         return redirect()->back()->with('success', 'Category created successfully!');
    }


      public function editCategory($id){

        $category=Category::where('id', $id)->first();
      

        return view('admin.category.categoryEditPage', compact('category'));
    }

    public function updateCategory(Request $request, $id){

        $request['id'] = $id;

       
      $this->checkValidation($request);
       

      

        Category::where('id', $id)->update([
        
        'name'=>$request->categoryName
    
       ]);

           Alert::success('Success Title', 'Category updated successfully! ');

        return redirect()->route('category#list');
    }


    public function deleteCategory($id){

        Category::where('id', $id)->delete();
      

           Alert::success('Success Title', 'Category deleted successfully! ');

        return redirect()->back();
    }


       private function checkValidation(Request $request){

        $request->validate([

            'categoryName'=>'required|min:2|max:30|unique:categories,name,'. $request->id
        ],[
            'categoryName.required' => 'The category name is required!',
            'categoryName.unique' => 'The category name must be unique!',
            'categoryName.min' => 'The category name must be at least 2 characters!'
        ]);

        
    }
}
