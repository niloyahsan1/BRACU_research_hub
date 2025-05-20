<?php
namespace App\Http\Controllers;

use App\Models\ResearchPaper;
use App\Models\Like;
use App\Models\Comment;
use App\Models\AccessRequest;
use Illuminate\Http\Request;

class ResearchPaperController extends Controller
{
    public function index()
    {
        $papers = ResearchPaper::with(['user', 'likes', 'comments.user', 'accessRequests'])
            ->where('visibility', 'public')
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

        return view('papers.frontend-index', compact('papers'));
    }

    public function create()
    {
        return view('research_papers.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'abstract' => 'required|string',
            'visibility' => 'required|in:public,private',
            'pdf' => 'required|mimes:pdf|max:10240', // Max 10MB
        ]);

        $path = $request->file('pdf')->store('papers', 'public');

        ResearchPaper::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'abstract' => $request->abstract,
            'visibility' => $request->visibility,
            'pdf_path' => $path,
        ]);

        return redirect()->route('research-papers.index')->with('success', 'Paper uploaded!');
    }

    public function show(ResearchPaper $paper)
    {
        if ($paper->visibility === 'private' && $paper->user_id !== auth()->id()) {
            abort(403);
        }

        return view('research_papers.show', compact('paper'));
    }

    public function like($id)
    {
        $paper = ResearchPaper::findOrFail($id);

        $paper->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'research_paper_id' => $id,
            'comment' => $request->comment,
        ]);

        return back();
    }

    public function requestAccess($id)
    {
        AccessRequest::firstOrCreate([
            'user_id' => auth()->id(),
            'research_paper_id' => $id,
        ]);

        return back()->with('message', 'Access request sent.');
    }
}
