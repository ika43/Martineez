<?php
/**
 * Created by PhpStorm.
 * User: Laba
 * Date: 3/14/2018
 * Time: 12:58 AM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Advertisement
{
    //region data
    private $id;
    private $title;
    private $alt;
    private $src;
    private $text;
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

    public function getAlt(){
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

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }
    //endregion

    public function getAllAdvertisement(){
        return DB::table('advertisement')
            ->get();
    }

    public function insertAdv(){
        DB::table('advertisement')->insert(
            [
                'text' => $this->text,
                'src' => $this->src,
                'alt' => $this->src,
                'title' => $this->title
                ]
        );
    }

    public function getAdvById(){
        return DB::table('advertisement')
            ->where('id','=',$this->id)
            ->get();
    }

    public function updateAdv(){
        DB::table('advertisement')
            ->where('id', $this->id)
            ->update([
                'text' => $this->text,
                'src' => $this->src,
                'alt' => $this->alt,
                'title' => $this->title
                ]);
    }

    public function delete(){
        DB::table('advertisement')
            ->where('id','=',$this->id)
            ->delete();
    }
}