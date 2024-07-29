<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category'
    ];

    // Define the relationship with the Cart model
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    // Scope to search by category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope to search by description
    public function scopeByDescription($query, $description)
    {
        return $query->where('description', 'like', "%$description%");
    }

    // Scope to search by multiple criteria
    public function scopeSearch($query, $criteria)
    {
        return $query->where(function ($query) use ($criteria) {
            if (isset($criteria['category'])) {
                $query->where('category', $criteria['category']);
            }
            if (isset($criteria['description'])) {
                $query->where('description', 'like', "%{$criteria['description']}%");
            }
        });
    }
}
