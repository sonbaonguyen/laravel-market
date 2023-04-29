<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        // dd(request()->all());
        $filterMessage = [];
        $index = 0;
        if ($request->search ?? false) {
            $filterMessage[$index] = $request->search;
            $index++;
        }

        if ($request->category ?? false) {
            $filterMessage[$index] = $request->category;
            $index++;
        }

        // $pagingNumber = 1;
        $pagingNumber = config('constants.PAGING_PAGENUMBER');


        // return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->paginate($pagingNumber)])->with('message', $filterMessage);
        if (auth()->check()) {
            $index = 0;
            $favorites = [];
            foreach (auth()->user()->favorites as $item) {
                $favorites[$index] = $item->product_id;
                $index++;
            }

            return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->paginate($pagingNumber), 'favorites' => $favorites])->with('message', $filterMessage);
        }
        else if (auth()->check() == false) {
            // dd(empty($filterMessage));
            return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->paginate($pagingNumber)])->with('message', $filterMessage);
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
        Product::storeProduct($request);
        return redirect('/products')->with('message', 'Add product successfully !');
    }

    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $product->updateProduct($request);
        return redirect('/products/'.$product->id)->with('message', 'Add product successfully !');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect('/products')->with('message', 'Delete product successful !');
    }

    public function uploadedProducts() {
        return view('products.uploaded',
            [
                'products' => Product::getUploadedProducts()
            ]
        );
    }

    public function favorite(Product $product) {
        if ($product->addFavorite()) {
            return back()->with('message', 'Add favorite!');
        }
        else {
            return back()->with('message', 'Failed to add favorite!');
        }
    }
}
