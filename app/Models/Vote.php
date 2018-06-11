<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 3/2/2018
 * Time: 12:34 AM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Vote
{
    //region data
    private $id;
    private $post_id;
    private $user_id;
    //endregion

    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPost_id(){
        return $this->post_id;
    }

    public function setPost_id($post_id){
        $this->post_id = $post_id;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
    //endregion

    public function insertLike()
    {
        DB::table('vote')
            ->insert([
                'post_id' => $this->post_id,
                'user_id' => $this->user_id,
            ]);
    }

    public function checkIfLiked()
    {
            return   DB::table('vote')->where([
                ['post_id', '=', $this->post_id],
                ['user_id', '=', $this->user_id],
            ])->first();
    }

    public function unlike()
    {
        DB::table('vote')->where([
            ['post_id', '=', $this->post_id],
            ['user_id', '=', $this->user_id],
        ])->delete();
    }

    public function showNumLikes()
    {
        return DB::table('vote')
            ->select(DB::raw('count(post_id) as likes'))
            ->where('post_id', '=' , $this->post_id)
            ->groupBy('post_id')
            ->get();
    }

    public function likers()
    {
        return DB::table('user')
            ->select('user.firstname', 'user.lastname')
            ->join('vote', 'vote.user_id', '=', 'user.id')
            ->where('vote.post_id','=',$this->post_id)
            ->get();
    }
}