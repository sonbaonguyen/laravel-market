<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        // dd(request()->all());
        $filterMessage = [];
        $index = 0;
        if (request('search') ?? false) {
            $filterMessage[$index] = request('search');
            $index++;
        }

        if (request('category') ?? false) {
            $filterMessage[$index] = request('category');
            $index++;
        }


        if (auth()->check()) {
            $index = 0;
            $favorites = [];
            foreach (auth()->user()->favorites as $item) {
                $favorites[$index] = $item->product_id;
                $index++;
            }

            return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->simplePaginate(5), 'favorites' => $favorites])->with('message', $filterMessage);
        }
        else if (auth()->check() == false) {
            // dd(empty($filterMessage));
            return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->simplePaginate(5)])->with('message', $filterMessage);
        }
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

        // If categories exist and not null
        if ($request->categories ?? false) {
            $allCategories = '';
            foreach ($request->categories as $cat) {
                $allCategories = $allCategories . '@' . $cat;
            }
            $allCategories = $allCategories . '@';
            $formFields['categories'] = $allCategories;
        }
        else {
            $formFields['categories'] = 'Not received';
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

        // If categories exist and not null
        if ($request->categories ?? false) {
            $allCategories = '';
            foreach ($request->categories as $cat) {
                $allCategories = $allCategories . '@' . $cat;
            }
            $allCategories = $allCategories . '@';
            $formFields['categories'] = $allCategories;
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

    public function favorite(Product $product) {
        $existItem = Favorite::all()
        ->where('user_id', '=', auth()->id())
        ->where('product_id', '=', $product->id);

        if (count($existItem) == 0) {
            // ADD
            $new_favorite = [
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ];
            Favorite::create($new_favorite);
            return back()->with('message', 'Add favorite!');
        }
        else {
            // DELETE
            return back()->with('message', 'Remove favorite!');
        }
    }
}
