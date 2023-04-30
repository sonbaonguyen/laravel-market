<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function homepage() {
        return view('pages.home', [
            'lastests' => Product::latest()->take(8)->get()
        ]);
    }

    public function index(Request $request)
    {
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

        $dataToPass = [];

        // return view('products.index', ['products' => Product::latest()->filter(request(['search', 'category']))->paginate($pagingNumber)])->with('message', $filterMessage);
        if (auth()->check()) {
            $favorites = Favorite::userFavorites();

            $dataToPass = [
                'products' => Product::latest()
                    ->filter(request(['search', 'category']))
                    ->paginate($pagingNumber),
                'favorites' => $favorites
            ];

            return view('products.index', $dataToPass)->with('message', $filterMessage);
        } else if (auth()->check() == false) {
            // dd(empty($filterMessage));
            $dataToPass = ['products' => Product::latest()->filter(request(['search', 'category']))->paginate($pagingNumber)];
            return view('products.index', $dataToPass)->with('message', $filterMessage);
        }
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'lastests' => Product::latest()->take(5)->where('id', '!=', $product->id)->get()
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::storeProduct($request);
        return redirect('/products')->with('message', 'Add product successfully !');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $product->updateProduct($request);
        return redirect('/products/' . $product->id)->with('message', 'Add product successfully !');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->with('message', 'Delete product successful !');
    }

    public function uploadedProducts()
    {
        $favorites = null;
        if (auth()->check()) {
            $favorites = Favorite::userFavorites();
        }

        // dd($favorites);
        return view(
            'products.u_uploaded',
            [
                'products' => Product::getUploadedProducts(),
                'favorites' => $favorites
            ]
        );
    }

    public function favoriteProducts()
    {
        $favorites = null;
        if (auth()->check()) {
            $favorites = Favorite::userFavorites();
        }

        // dd($favorites);
        return view(
            'products.u_favorites',
            [
                'products' => Product::getFavoriteProducts(),
                'favorites' => $favorites
            ]
        );
    }


    public function toggleFavorite(Product $product)
    {
        // Adding favorite
        if (!$product->addFavorite()) {
            // Remove if already a favorite
            $product->removeFavorite();
        }
        // Return number of favorites
        return $this->countFavorite();
    }

    public function countFavorite()
    {
        $total_favorite = count(Favorite::all()->where('user_id', '=', auth()->id()));
        return $total_favorite;
    }
}
