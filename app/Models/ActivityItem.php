<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ActivityItem extends Model
{
    protected $table = 'activity_items';

    public $timestamps = false;

    protected $fillable = ['category_id', 'name', 'description', 'sort_order'];

    /**
     * Get the category that owns this item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class, 'category_id');
    }
}
