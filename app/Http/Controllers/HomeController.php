<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    private $data;
    private $model;

    public function index()
    {
        $post = new Post();
        $adv = new Advertisement();
        $comm = new Comment();
        $idUser = session()->get('user')[0]->getId();
        try{
            $this->model=new Survey();
            $id = $this->model->getSurveyShow();
            $this->model->setId($id->survey_id);
            $this->data['survey'] = $this->model->getSurveyById();
            $this->data['post'] = $post->getAllPost();
            $this->data['adv'] = $adv->getAllAdvertisement();
            $this->data['notf'] = $comm->checkNotf($idUser);
            return view('pages.home', $this->data);

        }catch (\Exception $e){
            Log::error($e);
            return $e->getMessage();
        }
    }

}
