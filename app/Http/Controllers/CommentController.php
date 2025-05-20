<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResearchPaper;

class CommentController extends Controller
{
    public function store(Request $request, ResearchPaper $paper)
    {
        $request->validate(['body' => 'required']);
        $paper->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
        return back();
    }
    
}
