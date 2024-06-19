<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'creator_id',
        'creator_type',
        'category',
        'title',
        'description',
        'Responsibilities',
        'needed_skills',
        'salary',
        'image',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

}
