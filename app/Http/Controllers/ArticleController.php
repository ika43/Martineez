<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'tbArticle' => 'required|min:3'
        ];

        $messages = [
            'tbArticle.required' => 'Article cannot be empty!',
            'tbArticle.min' => 'Minimun three letters!'
        ];

        $request->validate($rules, $messages);
        try{
            $article = new Article();
            $article->setTitle($request->get('tbArticle'));
            $article->setUser_id(session()->get('user')[0]->getId());
            $article->insert();
            return redirect()->back()->with('msg','post successfully added post!');
        }
        catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }

    }
}
