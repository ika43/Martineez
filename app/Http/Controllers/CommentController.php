<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $text =  $request->get('tbComment');
        $id = $request->get('id');
        $rules=[
          'tbComment' => 'required|min:3',
        ];
        $message = [
            'tbComment' => 'required',
        ];
        $request->validate($rules, $message);
        $comment = new Comment();
        if(session()->has('user')){
            $comment ->setUser_id(session()->get('user')[0]->getId());
        }else{
            $comment->setUser_id(session()->get('admin')[0]->getId());
        }
        $comment ->setPost_id($id);
        $comment ->setText($text);
        try{
            $comment->store();
            return redirect()->back();
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }

    public function show(Request $request){
        $comm = new Comment();
        $comm->setPost_id($request->get('id'));
        $suid = session()->get('user')[0]->getId();
        try{
            $res = $comm->show();
            $output = "";
            foreach ($res as $item){

                $output .="<p class='text-justify nb text-left comment-text font-weight-bold'>$item->text</p>";
                $output .="<p class='text-right nb'><small>$item->firstname $item->lastname";
                if($suid==$item->uid){
                    $output .="<br><button class='btnDelComm' rel='$item->id'><img src='images/rsz_btnDel.png'></button>";
                }
                $output .= "</small></p><hr>";

            }
            return Json::encode($output);
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }

    }

    public function delComm(Request $request){
        try{
            $id = $request->get('id');
            DB::table('comment')
                ->where('id','=',$id)
                ->delete();
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }
}
