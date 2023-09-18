<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class DynamicTable extends Model
{
    // use Sluggable;
    
    protected $guarded = ['id'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name',
    //             'unique' => true, // Pastikan slug unik
    //             'onUpdate' => true, // Pastikan slug berubah ketika nama berubah
    //         ],
    //     ];
    // }

    // Add any additional methods or relationships here
}
