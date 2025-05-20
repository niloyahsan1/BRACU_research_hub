<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchPaper extends Model
{
    protected $fillable = [
        'user_id', 'title', 'abstract', 'visibility', 'pdf_path',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function accessRequests()
    {
        return $this->hasMany(AccessRequest::class);
    }
    
}