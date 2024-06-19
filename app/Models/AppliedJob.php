<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{

    use HasFactory;
    protected $fillable = [
        'freelancer_id',
        'job_id',
        'salary',
        'status',

    ];
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function job()
    {
        return $this->belongsTo(Project::class, 'job_id');
    }
}
