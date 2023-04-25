<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('products.index', ['products' => Product::latest()->get()]);
    }

    public function show(Product $product) {
        return view('products.show', [
            'product' => $product,
            'lastests' => Product::latest()->take(5)->where('id','!=',$product->id)->get()
    ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'short_description' => ['required'],
            'long_description' => ['required']
        ]);

        // Total reviews will be 0 (Obviously)
        $formFields['total_review'] = 0;

        // If has file named 'image'
        if ($request->hasFile('image_path')) {
            $imageAll = '';
            // dd($request->file('image_path'));
            foreach ($request->file('image_path') as $image) {
                $imageAll = $imageAll.'@'.$image->store('logos', 'public');
            }
            // dd($imageAll);
            $formFields['image_path'] = $imageAll;
        }
        else {
            $formFields['image_path'] = 'Not received';
        }

        // If color exist and not null
        if ($request->colors ?? false) {
            $allColors = '';
            foreach ($request->colors as $color) {
                $allColors = $allColors . '@' . $color;
            }
            $formFields['colors'] = $allColors;
        }
        else {
            $formFields['colors'] = 'Not received';
        }

        // If size exist and not null
        if ($request->sizes ?? false) {
            $allSizes = '';
            foreach ($request->sizes as $size) {
                $allSizes = $allSizes . '@' . $size;
            }
            $formFields['sizes'] = $allSizes;
        }
        else {
            $formFields['sizes'] = 'Not received';
        }

        // Set user id foreign key for product
        $formFields['user_id'] = auth()->id();

        // dd($formFields);
        Product::create($formFields);

        return redirect('/products')->with('message', 'Add product successfully !');
    }

    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        // dd($request->all());
        $formFields = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'short_description' => ['required'],
            'long_description' => ['required']
        ]);

        // If has file named 'image'
        if ($request->hasFile('image_path')) {
            $imageAll = '';
            // dd($request->file('image_path'));
            foreach ($request->file('image_path') as $image) {
                $imageAll = $imageAll.'@'.$image->store('logos', 'public');
            }
            // dd($imageAll);
            $formFields['image_path'] = $imageAll;
        }

        // If color exist and not null
        if ($request->colors ?? false) {
            $allColors = '';
            foreach ($request->colors as $color) {
                $allColors = $allColors . '@' . $color;
            }
            $formFields['colors'] = $allColors;
        }

        // If size exist and not null
        if ($request->sizes ?? false) {
            $allSizes = '';
            foreach ($request->sizes as $size) {
                $allSizes = $allSizes . '@' . $size;
            }
            $formFields['sizes'] = $allSizes;
        }

        // Set user id foreign key for product
        $formFields['user_id'] = auth()->id();

        // dd($formFields);
        $product->update($formFields);

        return redirect('/products/'.$product->id)->with('message', 'Add product successfully !');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect('/products')->with('message', 'Delete product successful !');
    }

    public function uploadedProducts() {
        // dd(auth()->user()->products);
        return view('products.uploaded', ['products' => auth()->user()->products]);
    }
}