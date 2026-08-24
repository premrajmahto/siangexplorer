<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class, 'category_id');
    }
}
