<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResearchPaper;

class LikeController extends Controller
{
    public function store(ResearchPaper $paper)
    {
        $paper->likes()->firstOrCreate(['user_id' => auth()->id()]);
        return back();
    }

}
