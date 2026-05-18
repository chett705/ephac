<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class ActivityCategory extends Model
{
    // If you didn't use the default 'activities' table name
    protected $table = 'activity_categories';

    public $timestamps = false;

    protected $fillable = ['title', 'image', 'sort_order'];

    /**
     * Get all the clickable links/items for this category.
     */
    public function items(): HasMany
    {
        // We order by sort_order so they appear in your preferred sequence
        return $this->hasMany(ActivityItem::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}
