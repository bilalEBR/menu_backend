<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

       protected $casts = [
        'price' => 'float',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'category_id',
        'name',
        'description',
        'price',
    ];

    protected $table = 'menu_items';

    /**
     * Define the relationship: A MenuItem belongs to one Hotel.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Define the relationship: A MenuItem belongs to one Category.
     * This is essential for full mapping completeness.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
