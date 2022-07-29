<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $blog, Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $request->merge([
            'user_id' => auth()->id()
        ]);

        $blog->comments()->create($request->all());

        return redirect()->back();
    }

    public function storeReply(Blog $blog, Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'parent_id' => 'required|exists:comments,id'
        ]);
        $parent = $blog->comments()->find($request->parent_id);
        if ($parent->parent_id) {
            $parent_username = $parent->user->username;
            $request->merge([
                'comment' => 'Re: ' . $parent_username . ' '  . $request->comment,
                'parent_id' => $parent->parent_id
            ]);
        }
        $request->merge([
            'user_id' => auth()->id()
        ]);
        $blog->comments()->create($request->all());
        return redirect()->back();
    }

    public function update(Blog $blog, Comment $comment, Request $request)
    {
        // SECURITY OF ALL UPDATE -> CAUSE CSRF TOKEN CAN BE GETTED
        $request->validate([
            'comment' => 'required'
        ]);
        $comment->update($request->all());
        return redirect()->back();
    }

    public function destroy(Blog $blog, Comment $comment)
    {
        // if ($blog->id != $comment->blog_id) {
        //     abort(403);
        // }
        if ($comment->user_id == auth()->id()) {
            $comment->delete();
        }
        // dd();
        return redirect()->back();
    }
}
