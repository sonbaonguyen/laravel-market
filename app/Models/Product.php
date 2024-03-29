<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'categories',
        'total_review',
        'price',
        'image_path',
        'colors',
        'sizes',
        'short_description',
        'long_description'
    ];

    public function scopeFilter($query, array $filter)
    {
        if ($filter['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('short_description', 'like', '%' . request('search') . '%')
                ->orWhere('long_description', 'like', '%' . request('search') . '%');
        }

        if ($filter['category'] ?? false) {
            $query->where('categories', 'like', '%@' . request('category') . '@%');
        }
    }

    public static function filterForm(Request $request) {
        $products = DB::table('products');
        $products = $products->whereBetween('price', [0, $request->max_price]);

        if ($request->colors ?? false) {
            foreach ($request->colors as $color) {
                $products = $products->where('colors', 'like', '%' . $color . '%');
            }
        }

        if ($request->sizes ?? false) {
            foreach ($request->sizes as $size) {
                $products = $products->where('sizes', 'like', '%' . $size . '%');
            }
        }

        // dd($products->toSql());

        $pagingNumber = config('constants.PAGING_PAGENUMBER');
        $products = $products->paginate($pagingNumber);
        return $products;
    }

    public static function storeProduct(Request $request)
    {
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
                $imageAll = $imageAll . '@' . Storage::disk('public')->put('images', $image);
            }
            // dd($imageAll);
            $formFields['image_path'] = $imageAll;
        } else {
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
        } else {
            $formFields['categories'] = 'Not received';
        }

        // If color exist and not null
        if ($request->colors ?? false) {
            $allColors = '';
            foreach ($request->colors as $color) {
                $allColors = $allColors . '@' . $color;
            }
            $formFields['colors'] = $allColors;
        } else {
            $formFields['colors'] = 'Not received';
        }

        // If size exist and not null
        if ($request->sizes ?? false) {
            $allSizes = '';
            foreach ($request->sizes as $size) {
                $allSizes = $allSizes . '@' . $size;
            }
            $formFields['sizes'] = $allSizes;
        } else {
            $formFields['sizes'] = 'Not received';
        }

        // Set user id foreign key for product
        $formFields['user_id'] = auth()->id();

        // dd($formFields);
        Product::create($formFields);
    }

    public function updateProduct(Request $request)
    {
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
                $imageAll = $imageAll . '@' . $image->store('logos', 'public');
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
        $this->update($formFields);
    }

    public static function getFavoriteProducts()
    {
        $pagingNumber = config('constants.PAGING_PAGENUMBER');

        $products = DB::table('products')
            ->join('favorites', 'products.id', '=', 'favorites.product_id')
            ->where('favorites.user_id', '=', auth()->id())
            ->paginate($pagingNumber);

        // dd($products);

        return $products;
    }

    public static function getUploadedProducts()
    {
        $pagingNumber = config('constants.PAGING_PAGENUMBER');
        $products = Product::latest()
            ->where('user_id', '=', auth()->id())->paginate($pagingNumber);
        return $products;
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addFavorite()
    {
        $existItem = Favorite::all()
            ->where('user_id', '=', auth()->id())
            ->where('product_id', '=', $this->id);

        // dd($existItem);

        if (count($existItem) == 0) {
            // ADD
            $new_favorite = [
                'user_id' => auth()->id(),
                'product_id' => $this->id
            ];
            Favorite::create($new_favorite);
            return true;
        } else {
            return false;
        }
    }

    public function removeFavorite()
    {
        DB::table("favorites")
            ->where('user_id', '=', auth()->id())
            ->where('product_id', '=', $this->id)->delete();
    }

}
