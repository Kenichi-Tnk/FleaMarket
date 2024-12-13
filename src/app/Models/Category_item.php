<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_id',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item');
    }

    public function children()
    {
        return $this->hasMany(Catengory::class, 'parent_id');
    }
}
