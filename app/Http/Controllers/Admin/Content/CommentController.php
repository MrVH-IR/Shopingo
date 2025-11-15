<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Content\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::where('commentable_type' , Post::class)
            ->orderBy('created_at' , 'DESC')
            ->where('seen' , 0)
            ->get();
        foreach ($comments as $comment) {
            if ($comment->seen == 0) {
                $comment->seen = 1;
                $comment->save();
            }
        }
        $comments = null;
        $comments = Comment::where('commentable_type' , Post::class)
            ->orderBy('created_at' , 'DESC')
            ->simplePaginate(15);
        return view('admin.content.comment.index' , compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show' , compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($comment->status == 1) {
                    return response()->json([
                        'status' => true,
                        'checked' => true,
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function approved(Comment $comment)
    {
        $comment->approved = ! $comment->approved;

        if ($comment->save()) {
            return response()->json([
                'approved' => (bool) $comment->approved,
            ]);
        }

        return response()->json([
            'approved' => false,
        ], 500);
    }

    /**
     * @throws \Throwable
     */
    public function answer(CommentRequest $request , Comment $comment)
    {
        if ($comment->parent == null) {
            DB::beginTransaction();
            try {
                $validated = $request->validated();
                $validated['author_id'] = 41;
                $validated['parent_id'] = $comment->id;
                $validated['commentable_id'] = $comment->commentable_id;
                $validated['commentable_type'] = $comment->commentable_type;
                $validated['approved'] = 1;
                $validated['status'] = 1;
                $comment = Comment::create($validated);
                DB::commit();
                return redirect()->route('admin.content.comment.index')
                    ->with('swal-success', 'پاسخ شما با موفقیت ارسال شد');
            } catch (\Throwable $e) {
                DB::rollBack();
                $errorID = now()->format("YmdHis") . rand(1000 , 9999);
                \Log::error("Exception : [$errorID]" . $e->getMessage());
                return redirect()->route('admin.content.comment.index')
                    ->with('swal-error', 'پاسخ ارسال نشد.'. $errorID);
            }
        } else {
                return redirect()->route('admin.content.comment.index')
                    ->with('swal-error', 'خطا ، شما یکبار پاسخ این کامنت را ارسال کرده اید');
            }
    }
}
