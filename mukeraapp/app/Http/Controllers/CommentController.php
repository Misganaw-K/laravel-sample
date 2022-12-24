<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
//use Illuminate\Support\Facades\Validator;
use Validator;

class CommentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json(['message'=>'Success','data'=>$comments],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $validator = $this->validateComment();
        if($validator->fails()){
            return response()->json(['message'=>$validator->messages(),'data'=>null],400);
        }

        $comment = new Comment($validator->validate());
        if($article->comments()->save($comment)){
            return response()->json(['message'=>'Comment Saved','data'=>$comment],200);
        }

        return response()->json(['message'=>'Error Occured','data'=>null],400);
    }

    public function best_comment(Comment $comment){
        if($comment->article->set_best_comment($comment)){
            return response()->json(['message'=>'Best Comment Saved','data'=>$comment],200);
        }
            return response()->json(['message'=>'Error Occurred','data'=>null],400);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response()->json(['message'=>'Success','data'=>$comment],200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->delete()){
            return response()->json(['message'=>'Comment Deleted','data'=>null],200);
        }
        return response()->json(['message'=>'Error Occurred','data'=>null],400);
    }

    public function validateComment(){
        return Validator::make(request()->all(), [
            'text' => 'required|string|min:3|max:255',
            'star' => 'required|integer|min:0|max:5',
        ]);
    } 
}
