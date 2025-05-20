<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRequest;
use App\Models\ResearchPaper;

class AccessRequestController extends Controller
{
    public function store(ResearchPaper $paper)
{
    AccessRequest::firstOrCreate([
        'user_id' => auth()->id(),
        'research_paper_id' => $paper->id
    ]);

    return back()->with('success', 'Access request sent.');
}

}
