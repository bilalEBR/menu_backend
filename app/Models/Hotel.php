<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * We allow 'name', 'address', and 'city' to be created/updated in the controller.
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    /**
     * Define the one-to-many relationship: A Hotel has many MenuItems.
     */
    public function menuItems(): HasMany
    {
        // This assumes the 'menu_items' table has a 'hotel_id' foreign key.
        return $this->hasMany(MenuItem::class);
    }

    public function categories(): HasMany
    {
        // Eloquent will look for the foreign key 'hotel_id' on the 'categories' table
        return $this->hasMany(Category::class);
    }
}
