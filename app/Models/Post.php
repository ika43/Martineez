<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 2/27/2018
 * Time: 7:01 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Post
{
    //region data
    private $id;
    private $title;
    private $user_id;
    private $img_id;
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

    public function getImg_id(){
        return $this->img_id;
    }

    public function setImg_id($img_id){
        $this->img_id = $img_id;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //endregion

    public function insertPost()
    {
        DB::table('post')
            ->insert([
               'title' => $this->title,
               'user_id' => $this->user_id,
               'img_id' => $this->img_id,
            ]);
    }

    public function getAllPost()
    {
        return DB::select('SELECT p.title, p.id, p.created_at, i.src as srcProfil, i.alt as altProfil, i2.src as srcPost, i2.alt as altPost , u.firstname, u.lastname,u.id as uid, COUNT(DISTINCT v.id) as numLike, COUNT(c.id) as numComment  
              FROM post p 
              LEFT JOIN vote v 
              ON v.post_id = p.id 
              LEFT JOIN comment c ON c.post_id = p.id
              LEFT JOIN profileimg pi 
              ON p.user_id = pi.user_id 
              LEFT JOIN image i ON pi.img_id =i.id 
              LEFT JOIN image i2 on p.img_id = i2.id 
              JOIN user u ON u.id = p.user_id 
              WHERE i2.active = 1 OR i2.active is null 
              GROUP BY p.id 
              ORDER BY p.created_at DESC');
    }

    public function getAllPostById()
    {
        return DB::select('SELECT p.title, p.id, p.created_at, i.src as srcProfil, i.alt as altProfil, i2.src as srcPost, i2.alt as altPost , u.firstname, u.lastname,u.id as uid, COUNT(DISTINCT v.id) as numLike, COUNT(DISTINCT c.id) as numComment  
              FROM post p 
              LEFT JOIN vote v 
              ON v.post_id = p.id 
              LEFT JOIN comment c ON c.post_id = p.id
              LEFT JOIN profileimg pi 
              ON p.user_id = pi.user_id 
              LEFT JOIN image i ON pi.img_id =i.id 
              LEFT JOIN image i2 on p.img_id = i2.id 
              JOIN user u ON u.id = p.user_id 
              WHERE (i2.active = 1 OR i2.active is null) AND p.user_id = ?
              GROUP BY p.id 
              ORDER BY p.created_at DESC', [$this->user_id]);
    }
    public function getAllPostForPagination($start, $rec){
        return DB::select('SELECT p.title, p.id, p.created_at, i.src as srcProfil, i.alt as altProfil, i2.src as srcPost, i2.alt as altPost , u.firstname, u.lastname, COUNT(DISTINCT v.id) as numLike, COUNT(DISTINCT c.id) as numComment  
              FROM post p 
              LEFT JOIN vote v 
              ON v.post_id = p.id 
              LEFT JOIN comment c ON c.post_id = p.id
              LEFT JOIN profileimg pi 
              ON p.user_id = pi.user_id 
              LEFT JOIN image i ON pi.img_id =i.id 
              LEFT JOIN image i2 on p.img_id = i2.id 
              JOIN user u ON u.id = p.user_id 
              WHERE (i2.active = 1 OR i2.active is null) AND p.user_id = ?
              GROUP BY p.id 
              ORDER BY p.created_at DESC LIMIT ?, ?', [session()->get('user')[0]->getId(), $start, $rec]);
    }

    public function getAllForUser(){
        return DB::select('SELECT Count(id) as num FROM post WHERE user_id = ?',[session()->get('user')[0]->getId()]);
    }


}