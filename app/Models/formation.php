<?php

namespace App\Models;

use App\Models\User;
use App\Models\episode;
use GuzzleHttp\Promise\CancellationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class formation extends Model
{
    use HasFactory;

    protected $fillable = ['title','description'];

    protected $appends = ['update'];

    protected static function booted(){

        static::creating(function($course){
            
            $course->user_id = auth()->id();

        });
    }

    public function getUpdateAttribute()
    {
     return  $this->can('update-course', $this);
    }

    public function episodes()
    {
            return $this->hasMany(episode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
