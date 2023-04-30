<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    // Relationship with user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Return user's favorite list as an array, not collection
    public static function userFavorites()
    {
        $index = 0;
        $favorites = [];
        foreach (auth()->user()->favorites as $item) {
            $favorites[$index] = $item->product_id;
            $index++;
        }
        return $favorites;
    }
}
