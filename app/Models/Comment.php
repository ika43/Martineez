<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 3/4/2018
 * Time: 6:27 PM
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Comment
{

    //region data
    private $id;
    private $user_id;
    private $post_id;
    private $text;
    private $created_at;
    //endregion

    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function getPost_id(){
        return $this->post_id;
    }

    public function setPost_id($post_id){
        $this->post_id = $post_id;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //endregion

    public function store()
    {
        $date = Carbon::now()->timestamp;
        DB::table('comment')
            ->insert([
               'user_id' => $this->user_id,
               'post_id' => $this->post_id,
               'text' => $this->text,
                'created_at' => $date
            ]);
    }

    public function show()
    {
        return DB::table('comment')
            ->join('user', 'user.id', '=', 'comment.user_id')
            ->where('post_id','=',$this->post_id)
            ->select('user.firstname', 'user.lastname', 'comment.text', 'comment.created_at', 'user.id as uid', 'comment.id')
            ->get();
    }
    
    public function checkNotf($id){
        return DB::select('SELECT c.id as commentId, p.id AS postId, u.firstname, u.lastname FROM post p 
        JOIN comment c ON p.id = c.post_id
        JOIN user u ON u.id = c.user_id
        WHERE c.seen = 0 AND p.user_id = ? AND  c.user_id !=?', [$id, $id]);
    }

}