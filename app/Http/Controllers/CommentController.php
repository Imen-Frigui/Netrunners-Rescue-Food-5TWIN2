<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment_body' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        $comment = new Comment();
        $comment->comment_body = $request->comment_body;
        $comment->review_id = $request->review_id;
    
        // Get the authenticated user's ID and assign it to the comment
        $comment->user_id = Auth::id(); // Assuming the user is logged in
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('comments', 'public'); // Store the image
            $comment->image_path = $path;
        }
    
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    /**
     * Show the form to edit a comment.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
    
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        return view('reviews.comments.edit', compact('comment'));
    }
    

    /**
     * Update the specified comment.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment_body' => 'required|string|max:500',
        ]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $comment->update([
            'comment_body' => $request->input('comment_body'),
        ]);

        return redirect()->route('reviews.show', $comment->review_id)->with('success', 'Comment updated successfully.');
    }

    /**
     * Delete a comment.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
