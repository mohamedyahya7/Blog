<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Illuminate\Support\Facades\DB;
class Tag extends Model
{
    use HasFactory;
    // protected $table = 'tags';
    protected $fillable = ['name'];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
