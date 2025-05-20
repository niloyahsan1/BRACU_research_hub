<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['title', 'abstract', 'pdf_path', 'visibility', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function paper() {
        return $this->belongsTo(ResearchPaper::class);
    }
    
}
