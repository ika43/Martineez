<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    private $data;

    public function delPost(Request $request){
        try{
            $id = $request->get('id');
            $idImg = DB::table('post')
                ->where('id','=',$id)
                ->get();
           foreach ($idImg as $item){
               $ids = $item->img_id;
            }
            DB::table('gallery')
                ->where('img_id','=',$ids)
                ->delete();
            DB::table('image')
                ->where('id','=',$ids)
                ->delete();
            DB::table('post')
                ->where('id','=',$id)
                ->delete();
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }

    public function like(Request $request)
    {
        $post_id = $request->get('id');
        $user_id = session()->get('user')[0]->getId();
        $vote = new Vote();
        $vote->setPost_id($post_id);
        $vote->setUser_id($user_id);
        try{
            $lp = $vote->checkIfLiked();
            if(empty($lp)){
                $vote->insertLike();
            }else{
                $vote->unlike();
            }
            $likes = $vote->showNumLikes();
            return Json::encode($likes);

        }
        catch(\Exception $e)
        {
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }

    public function viewLikes(Request $request)
    {
        $post_id = $request->get('id');
        $vote = new Vote();
        $vote->setPost_id($post_id);
        try{
            $names = $vote->likers();
            return Json::encode($names);
        }catch(\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
    }

    }

    public function survey(Request $request)
    {
        $surveyId = $request->get('surId');
        $user_id = session()->get('user')[0]->getId();
        $res = DB::table('survey-user')
            ->where('user_id','=',$user_id)
            ->where('survey_id','=',$surveyId)
            ->first();
        if(isset($res))
        {
            return Json::encode('You already vote! Thanks');
        }else{
            $q1 = $request->get('rbQuestion1');
            $q2 = $request->get('rbQuestion2');
            $q3 = $request->get('rbQuestion3');
            $q1Id = $request->get('quesId1');
            $q2Id = $request->get('quesId2');
            $q3Id = $request->get('quesId3');

            try{
                DB::table('answer')
                    ->insert([[
                        'question_id' =>  $q1Id,
                        'answer' => $q1,
                        'user_id' => $user_id,
                    ],[
                        'question_id' => $q2Id,
                        'answer' => $q2,
                        'user_id' => $user_id,
                    ],[
                        'question_id' => $q3Id,
                        'answer' => $q3,
                        'user_id' => $user_id,
                    ]]);
                DB::table('survey-user')
                    ->insert([
                        'survey_id' => $surveyId,
                        'user_id' => $user_id,
                    ]);
            }catch (\Exception $e){
                Log::error($e);
                return 'Sorry! Something is wrong with database!';
            }

        }

    }

   
    public function getSuggestion(){
        $id = session()->get('user')[0]->getId();
        return DB::table('user')
            ->where('role_id','=',2)
            ->where('id','!=',$id)
            ->select('firstname','lastname','id')
            ->get();
    }

    public function viewProfil(Request $request){

        $id = $request->get('id');
        $user = new User();
        $this->data['user'] = $user->getUserById($id);
        $img = new Image();
        $this->data['profilimg']=$img->getProfileImg($id);
        $this->data['gallery'] = $img->getGallery($id);

        $post = new Post();
        $post->setUser_id($id);
        try{
            $this->data['post'] = $post->getAllPostById();
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
        return (string) view('pages.test',$this->data);

    }

    public function pagination(Request $request){
        $page = $request->get('page');
        $record_per_page = 2;
        $start_from = ($page - 1)*$record_per_page;
        $post = new Post();
        try{
            $res = $post->getAllPostForPagination($start_from,$record_per_page);
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
        $output = '';
        if(empty($res)){
            $output .="<div class='jumbotron mx-5'><h1 class='display-4'>Hello, from Martineez!</h1><p class='lead'>We see you are here for the first time, We give you some information about us. We are social network only for caterer's. Here we don't post pic about us, we make some masterpieceof our work, like some cocktail, dishes or everything else from restaurant, bar, hotel, etc. Take a photo and share with others here.</p><hr class='my-4'><p>Click on button bellow to share your picture or some post</p><p class='lead'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>Share Photo</button> <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#article-modal'>Share Article</button></p></div>";
        }else{
            foreach ($res as $item){
                if(empty($item->srcPost)){
                    //TEKSTUALNI POST
                    $output .= "<div class='d-flex justify-content-center'><div id='post' class='list-group mb-5'><div class='list-group-item list-group-item-action flex-column align-items-start pb-0'><div class='w-100 justify-content-between'>";
                    $output .= "<button class='btnDel' rel='$item->id'><img src='images/btnDel.png'></button><h6 class='mb-1'>".$item->firstname.' '.$item->lastname."</h6><small>".\Carbon\Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</small></div><figure class='figure mb-0'><p class='text-justify h4'>".$item->title."</p></figure><hr class='my-0'><div class='container py-1'><div class='row'><button class='ajax-link a-like-com' rel='".$item->id."'><div class='container'><div class='row'><i class='material-icons mx-1'>favorite_border</i>Like</div></div> </button><button class='a-like-com commPost' rel='".$item->id."'><div class='container'><div class='row'><i class='material-icons ml-3 mr-1'>folder_open</i>Comment</div></div></button></div></div></div>";
                    if($item->numLike!=0){
                        $output .= "<div class='list-group-item list-group-item-action flex-column align-items-start'><a id='".$item->id."' href='' class='a-like-com num viewLikes' rel='".$item->id."'>".$item->numLike." person like</a></div>";}
                    else{
                        $output .= "<div class='list-group-item list-group-item-action flex-column align-items-start'><a id='".$item->id."' href='' class='a-like-com'></a></div>";}
                    if($item->numComment!=0){
                        $output .= "<div id='".$item->id."showComm' class='list-group-item list-group-item-action flex-column align-items-start pb-2'><a href='' class='viewComment' rel='".$item->id."'>View Comment</a> </div>";}
        $output .= "<div id='".$item->id.'comm'."'></div></div></div>";

                }else{
                    $output .= "<div class='d-flex justify-content-center'><div class='list-group mb-5' style='max-width: 542px !important;'><div class='list-group-item list-group-item-action flex-column align-items-start pb-0'><div class='w-100 justify-content-between'><button class='btnDel' rel='$item->id'><img src='images/btnDel.png'></button><h6 class='mb-1'><img src='";

                                    if($item->srcProfil!=""){
                                        $output .= $item->srcProfil;
                                    }
                                    else{
									$output .= "images/blank-profile.png";
                                    }
                                    $output .= "'class='rounded-circle mb-2 mr-2 xs-img'/>".$item->firstname." ".$item->lastname."</h6><small>".\Carbon\Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</small></div><p class='h4'>".$item->title."</p><figure class='figure mb-0'><a href='".$item->srcPost."' data-lightbox='".$item->id."'><img src='".$item->srcPost."' class='figure-img img-fluid rounded'></a><figcaption class='figure-caption'></figcaption></figure><div class='container pb-1'><div class='row'><button class='ajax-link a-like-com' rel='".$item->id."'><div class='container'><div class='row'><i class='material-icons mx-1'>favorite_border</i>Like</div></div></button><button class='commPost a-like-com' rel='".$item->id."'><div class='container'><div class='row'><i class='material-icons ml-3 mr-1'>folder_open</i>Comment</div></div></button></div></div></div>";
                    if($item->numLike!=0){
                        $output .= "<div class='list-group-item list-group-item-action flex-column align-items-start'><a id='".$item->id."' href='' class='a-like-com num viewLikes' rel='".$item->id."'>".$item->numLike." person like</a></div>";}
                    else{
                        $output .= "<div class='list-group-item list-group-item-action flex-column align-items-start'><a id='".$item->id."' href='' class='a-like-com'></a></div>";}
                    if($item->numComment!=0){
                        $output .= "<div id='".$item->id."showComm' class='list-group-item list-group-item-action flex-column align-items-start pb-2'><a href='' class='viewComment' rel='".$item->id."'>View Comment</a> </div>";}
                    $output .= "<div id='".$item->id.'comm'."'></div></div></div>";

                }

            };
            try{
                $total_records = $post->getAllForUser();
            }catch (\Exception $e){
                Log::error($e);
                return 'Sorry! Something is wrong with database!';
            }
            $tr = $total_records[0]->num;
            $total_pages = ceil($tr/$record_per_page);
            $output .= "<div class='pagination pagination-sm justify-content-center d-flex'>";
            for ($i=1; $i<=$total_pages; $i++){
                $output .= "<span class='pagination_link page-link' style='cursor: pointer; border: 1px solid #ccc;' id='".$i."'>".$i."</span>";
                $output .= "";
            }
            $output .= "</div>";
        }

        return $output;
    }
}
