<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeFilter($query, array $filter) {
        if ($filter['search'] ?? false) {
            $query->where('name', 'like', '%'.request('search').'%')
            ->orWhere('short_description', 'like', '%'.request('search').'%')
            ->orWhere('long_description', 'like', '%'.request('search').'%');
        }

        if ($filter['category'] ?? false) {
            $query->where('categories', 'like', '%@'.request('category').'@%');
        }
    }

    // Relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
