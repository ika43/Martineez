<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 2/28/2018
 * Time: 9:37 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Article
{

    //region data
    private $id;
    private $title;
    private $user_id;
    private $created_at;
    //endregion
    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //endregion

    public function insert(){
        DB::table('post')
            ->insert([
                'title' => $this->title,
                'user_id' => $this->user_id,
            ]);
    }
}