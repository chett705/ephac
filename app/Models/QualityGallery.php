<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityGallery extends Model
{
    protected $table = 'quality_galleries';

    protected $fillable = ['image'];
}