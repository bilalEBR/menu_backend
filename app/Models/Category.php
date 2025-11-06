<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Added BelongsTo import

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'hotel_id', // Added hotel_id assuming this links to the Hotel model
    ];

    /**
     * Define the inverse relationship: A Category belongs to one Hotel.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * A Category has many Menu Items.
     * The method name is camelCase: 'menuItems'.
     */
    public function menuItems(): HasMany
    {
        // Eloquent will look for the foreign key 'category_id' on the 'menu_items' table
        return $this->hasMany(MenuItem::class);
    }
}
