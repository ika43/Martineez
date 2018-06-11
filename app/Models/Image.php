<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 2/23/2018
 * Time: 2:45 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Image
{
    //region data
    private $id;
    private $src;
    private $alt;
    private $active;
    private $user_id;
    //endregion

    //region getter and setter
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUserId(){
        return $this->id;
    }

    public function setUserId($id){
        $this->id = $id;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function setAlt($alt){
        $this->alt = $alt;
    }
    public function getSrc(){
        return $this->src;
    }

    public function setSrc($src){
        $this->src = $src;
    }

    public function getActive(){
        return $this->active;
    }

    public function setActive($active){
        $this->active = $active;
    }
    //endregion

    public function insertImg()
    {
        return DB::table('image')
            ->insertGetId([
                'src' => $this->getSrc(),
                'active' => $this->getActive(),
                'alt' => $this->getAlt(),
                'user_id' => $this->getUserId()
            ]);
    }

    public function getProfileImg($id){

        return DB::table('image')
            ->join('profileimg', 'image.id', '=', 'profileimg.img_id')
            ->where('profileimg.user_id','=',$id)
            ->select('image.*')
            ->orderByRaw('profileimg.created_at DESC')
            ->first();
    }

    public function getGallery($id){

        return DB::table('image')
            ->join('gallery', 'image.id', '=', 'gallery.img_id')
            ->where('gallery.user_id','=',$id)
            ->select('image.*')
            ->orderByRaw('gallery.created_at DESC')
            ->get();
    }

}