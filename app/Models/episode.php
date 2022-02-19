<?php

namespace App\Models;

use App\Models\formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class episode extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','video_url','formation_id'];

    public function formation()
    {
            return $this->belongsTo(formation::class);
    }
}
