<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    protected $fillable = ['title', 'abstract', 'pdf_path', 'visibility', 'user_id'];

}
