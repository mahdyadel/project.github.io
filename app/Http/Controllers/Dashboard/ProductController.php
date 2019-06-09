<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function($q) use ($request){

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);
        
        return view('dashboard.products.index', compact('products' , 'categories'));

    }//end of index
    public function show($id)
    {
        // $category = Category::all();
        // $clients = Client::all();
        // $cashiers = Cashier::all();
        $product = Product::findOrFail($id);

        // return $users;
        return view('dashboard.products.view', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

    }//end of create

    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
           
        ];
        $msg =  [
           
            'name.required' => ' الاسم ',
            'description.required' => 'الوصف',
            'price.required' => 'السعر',
            

            
        ];
        $this->validate($request , $rules , $msg);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if
        // dd($request_data);

        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of store

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product' , 'categories'));

    }//end of edit

    public function update(Request $request, Product $product)
    {
       
        $rules = [

            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
           
        ];
        $msg =  [
           
            'name.required' => ' الاسم ',
            'description.required' => 'الوصف',
            'price.required' => 'السعر',
            
        ];
        $this->validate($request , $rules , $msg);

        $request_data = $request->all();

        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
                    
            }//end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if
        
        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of update

    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        }//end of if

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of destroy

}//end of controller
