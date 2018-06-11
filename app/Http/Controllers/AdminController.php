<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Survey;
use App\Models\User;
use App\Rules\ddlRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as img;

class AdminController extends Controller
{
    private $data;
    private $model;

    //region user methods
    public function index(){
        $this->model = new User();
        try{
            $this->data['users'] = $this->model->getAllUsers();
            return view('pages.admin-pages.user',$this->data);
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }

    }

    public function delete($id){
        try{
            DB::table('user')
                ->where('id','=',$id)
                ->delete();
        }catch(\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
        return redirect()->back();
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $url = url()->current()."/update/".$id;
        $this->model = new User();
        try{
            $this->data = $this->model->getUserById($id);
            $output = "<form action='".$url."' method='post'>".csrf_field()."<div class='form-group row'><label for='tbFirstname' class='col-sm-2 col-form-label'>Firstname:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbFirstname' value='".$this->data->firstname."'></div></div><div class='form-group row'><label for='tbLastname' class='col-sm-2 col-form-label'>Lastname:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbLastname' value='".$this->data->lastname."'></div></div><div class='form-group row'><label for='tbPosition' class='col-sm-2 col-form-label'>Position:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbPosition' value='".$this->data->position."'></div></div><div class='form-group row'><label for='tbWorkplace' class='col-sm-2 col-form-label'>Workplace:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbWorkplace' value='".$this->data->workplace."'></div></div><div class='form-group row'><label for='tbCity' class='col-sm-2 col-form-label'>City:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbCity' value='".$this->data->city."'></div></div><div class='form-group row'><label for='tbState' class='col-sm-2 col-form-label'>State:</label><div class='col-sm-10'><input type='text' class='form-control' name='tbState' value='".$this->data->state."'></div></div><div class='form-group row'><label for='date' class='col-sm-2 col-form-label'>Date of Birth:</label><div class='col-sm-10'><input type='date' class='form-control' name='date'></div></div><div class='form-group row'><div class='col-sm-10'><button type='submit' class='btn btn-dark'>Confirm</button></div></div></form>";
            return $output;
        }catch(\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }

    }
    
        public function showUpForm(Request $request){
        $id = $request->get('id');
        try{
            $res = DB::table('post')
                ->join('user','user.id','=','post.user_id')
                ->leftJoin('image','image.id','=','post.img_id')
                ->select('post.created_at','post.title','image.src','post.id')
                ->where('post.id','=',$id)
                ->orderBy('created_at', 'desc')
                ->get();
                $out="<div class='row'>";
                foreach ($res as $item){
                    if($item->src==""){
                        $out .= "<div class='card w-75'>
   <div class='card-body'>
      <h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5>
	  <form method='post' action='".url('/admin/updatePostTitle')."'>
	  <input type='hidden' name='_token' value='".csrf_token()."'>
      <input type='text' class='form-control' value='$item->title' name='title' autofocus>
      <input type='hidden' name='postId' value='$item->id'>
      <button class='btn btn-primary mt-3'>Update</button>
	  </form>
   </div>
</div>";
                    }else {
                        $out .= "<div class='card w-75'>
   <div class='card-body'>
      <h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5>
	  <form method='post' action='".url('/admin/updatePostTitle')."'>
	  <input type='hidden' name='_token' value='".csrf_token()."'>
      <input type='text' class='form-control mb-2' value='$item->title' name='title' autofocus>
      <input type='hidden' name='postId' value='$item->id'>
      <img class='card-img' style='max-height: 600px' src='".asset('').$item->src."'><button class='btn btn-primary mt-3'>Update</button>
	  </form>
	  <div class='alert alert-warning'>Sorry, I can not allow you to change someone's picture, because you are violating copyright by doing that</div>
   </div>
</div>";
                    }
                }
                $out.="</div>";
                return $out;

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function updatePost(Request $request){
        $value = $request->input('title');
        $id = $request->input('postId');
        DB::table('post')
            ->where('id', $id)
            ->update(['title' => $value]);
        return redirect()->back();
    }

    public function editUser(Request $request, $id){
        $fname = $request->get('tbFirstname');
        $lname = $request->get('tbLastname');
        $pos = $request->get('tbPosition');
        $work = $request->get('tbWorkplace');
        $city = $request->get('tbCity');
        $state = $request->get('tbState');
        $date = $request->get('date');
        try{
            $this->model = new User();
            $this->model->setFirstname($fname);
            $this->model->setLastname($lname);
            $this->model->setPosition($pos);
            $this->model->setWorkplace($work);
            $this->model->setCity($city);
            $this->model->setState($state);
            $this->model->setDateOfBirth($date);
            $this->model->editUser($id);
            return redirect()->back();

        }catch(\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }
    
    public function showPostCom(Request $request){
        $id = $request->get('id');
        try{
            $res = DB::table('post')
                ->join('user','user.id','=','post.user_id')
                ->leftJoin('image','image.id','=','post.img_id')
                ->select('post.created_at','post.title','image.src','post.id')
                ->where('post.user_id','=',$id)
                ->orderBy('created_at', 'desc')
                ->get();
            if(count($res)>=1){
                $out="<div class='row'>";
                foreach ($res as $item){
                    if($item->src==""){
                        $out .= "<div class='card w-75'><div class='card-body'><h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5><p class='card-text'>$item->title</p><button class='btn btn-primary btn-comment-post' rel='$item->id'>Comment</button></div></div><div id='".$item->id."com'></div>";
                    }else {
                        $out .= "<div class='card w-75'><div class='card-body'><h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5><p class='card-text'>$item->title</p><img class='card-img' style='max-height: 600px' src='".asset('').$item->src."'><button class='btn btn-primary mt-3 btn-comment-post' rel='$item->id'>Comment</button></div></div><div id='".$item->id."com'></div>";
                    }
                }
                $out.="</div>";
                return $out;
            }else{
                $out="<div class='alert alert-danger'>This user has no post</div>";
                return $out;
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function registerUser(Request $request){
        //CHECKING EMAIL
        $this->model = new User();
        $mail = $request->input('tbMail');
        $check = $this->model->checkMail($mail);
        if($check)
        {
            return redirect()->back()->with('msg','There is already user with this email address!');
        }
        else
        {
            try{
                $this->model->setFirstname($request->input('tbFirstname'));
                $this->model->setLastname($request->input('tbLastname'));
                $pass = Hash::make($request->input('tbPassword'));
                $this->model->setPassword($pass);
                $this->model->setEmail($request->input('tbMail'));
                $this->model->setWorkplace($request->input('tbWorkplace'));
                $this->model->setPosition($request->input('tbPosition'));
                $this->model->setCity($request->input('tbCity'));
                $this->model->setState($request->input('tbState'));
                $this->model->setDateOfBirth($request->input('date'));
                $this->model->regUser();
                return redirect()->back();
            }catch (\Exception $e){
                Log::error($e);
                return 'Sorry! Something is wrong with database!';
            }

        }
    }
    //endregion

    //region post methods
    public function post(){

        try{
            $this->data['users'] = DB::table('user')
                ->get();
            return view('pages.admin-pages.post',$this->data);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }

    public function showPost(Request $request){
        $id = $request->get('id');
        try{
            $res = DB::table('post')
                ->join('user','user.id','=','post.user_id')
                ->leftJoin('image','image.id','=','post.img_id')
                ->select('post.created_at','post.title','image.src','post.id')
                ->where('post.user_id','=',$id)
                ->orderBy('created_at', 'desc')
                ->get();
            if(count($res)>=1){
                $out="<div class='row'>";
                foreach ($res as $item){
                    if($item->src==""){
                        $out .= "<div class='card w-75'><div class='card-body'><h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5><p class='card-text'>$item->title</p><button class='btn btn-primary btn-delete-post' rel='$item->id'>Delete</button><button class='btn btn-primary btn-update-post ml-2' rel='$item->id'>Update</button></div></div>";
                    }else {
                        $out .= "<div class='card w-75'><div class='card-body'><h5 class='card-title'>Published ". Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')."</h5><p class='card-text'>$item->title</p><img class='card-img' style='max-height: 600px' src='".asset('').$item->src."'><button class='btn btn-primary mt-3 btn-delete-post' rel='$item->id'>Delete</button><button class='btn btn-primary mt-3 btn-update-post ml-2' rel='$item->id'>Update</button></div></div>";
                    }
                }
                $out.="</div>";
                return $out;
            }else{
                $out="<div class='alert alert-danger'>This user has no post</div>";
                return $out;
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }
    
    public function deletePost(Request $request){
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
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }
    //endregion

    //region comment methods
    public function comment(){
        $this->data['users'] = DB::table('user')
                ->where('role_id','=',2)
                ->get();
        return view('pages.admin-pages.comment',$this->data);
    }

    public function showComment(Request $request){
        $id = $request->get('id');
        try{
            $res = DB::select('SELECT c.id, c.text, c.created_at, u.firstname, u.lastname FROM (comment c JOIN post p ON c.post_id = p.id) JOIN user u ON u.id = p.user_id WHERE c.user_id = ?', [$id]);
            if(count($res)>=1){
                $output = "<div class='row'>";
                foreach ($res as $item){
                    $output .="<div class='card w-75'><div class='card-body' id='$item->id'><h5 class='card-title'>Commented ".Carbon::createFromTimestamp($item->created_at)->toDateTimeString()."<small> at $item->firstname $item->lastname post</small></h5><p class='card-text' id='com$item->id'>$item->text</p><button class='btn btn-primary btn-del-comment' rel='$item->id'>Delete</button><button class='btn btn-primary btn-upd-comment ml-3' rel='$item->id'>Update</button></div></div>";
                }
                $output.="</div>";
                return $output;
            }else{
                $output = "<div class='alert alert-danger'>This user has no comments!</div>";
                return $output;
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function deleteComment(Request $request){
        try{
            $id = $request->get('id');
            DB::table('comment')
                ->where('id','=',$id)
                ->delete();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function updateComment(Request $request){
        $id = $request->get('id');
        $text = $request->get('txt');
        try{
            DB::table('comment')
                ->where('id','=',$id)
                ->update(['text'=>$text]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }
    //endregion

    //region user activities
    public function activities(){
        $this->data['users'] = DB::table('user')
                ->where('role_id','=',2)
                ->get();
        return view('pages.admin-pages.activities',$this->data);
    }

    public function showActivities(Request $request){
        $id = $request->get('id');
        try{
            $regDate = DB::table('user')
                ->select('created_at','firstname')
                ->where('id','=',$id)
                ->first();
            $output = "<div class='alert alert-success'>$regDate->firstname registered on Martinez ".Carbon::parse($regDate->created_at)->format('d.m.Y  \a\t H:i')."</div>";

            $posts = DB::table('post')
                ->join('user','user.id','=','post.user_id')
                ->where('post.user_id','=',$id)
                ->select('post.created_at','post.img_id')
                ->get();
            if(count($posts)>=1){
                $output.="<div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom\"><h1 class=\"h2\">Posts</h1></div>";
                $output.="<ul class=\"list-group\">";
                foreach ($posts as $item){
                    if($item->img_id == ""){
                        $output .="<li class='list-group-item'>".Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')." $regDate->firstname posted article</li>";
                    }else{
                        $output .="<li class='list-group-item'>".Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')." $regDate->firstname posted photo</li>";
                    }
                }
                $output.="</ul>";
            }

            $res = DB::select('SELECT c.created_at, u.firstname, u.lastname FROM (comment c JOIN post p ON c.post_id = p.id) JOIN user u ON u.id = p.user_id WHERE c.user_id = ?', [$id]);
            if(count($res)>=1){
                $output.="<div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 pb-2 mb-3 border-bottom\"><h1 class=\"h2\">Comments</h1></div>";
                $output.="<ul class=\"list-group\">";
                foreach ($res as $item){
                    $output.="<li class='list-group-item'>".Carbon::createFromTimestamp($item->created_at)->toDateTimeString()." $regDate->firstname commented on $item->firstname posts!</li>";
                }
                $output.="</ul>";
            }

            $likes = DB::select('SELECT v.created_at, u.firstname, u.lastname FROM (vote v JOIN post p ON v.post_id = p.id) JOIN user u ON u.id = p.user_id WHERE v.user_id = ?', [$id]);
            if(count($likes)>=1){
                $output.="<div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 pb-2 mb-3 border-bottom\"><h1 class=\"h2\">Likes</h1></div>";
                $output.="<ul class=\"list-group\">";
                foreach ($likes as $item){
                    $output.="<li class='list-group-item'>".Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')." $regDate->firstname likes $item->firstname posts!</li>";
                }
                $output.="</ul>";
            }
            return $output;


        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }
    //endregion

    //region survey
    public function survey(){

        try{
            $this->data['surveys'] = DB::table('survey')
                ->get();
        }catch(\Exception $e) {
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
        return view('pages.admin-pages.survey', $this->data);

    }

    public function showSurvey(Request $request){
        $id = $request->get('id');
        $this->model = new Survey();
        $this->model->setId($id);
        try{
            $res = $this->model->getStatistic($id);
            if(count($res)>=1){
                $output = "<table class='table table-hover'><thead><th>Question</th><th>Average rate</th><th>Statistic</th><th>Update question</th></thead><tbody>";
                foreach ($res as $item){
                    $output.="<tr><td>$item->question</td><td>$item->avg</td><td>";
                    for($i =1 ; $i<=5;$i++){
                        $num = $this->model->getNumUser($item->id, $i);
                        $output.= "<ul>";
                        if($num[0]->num!=0){
                            $output.= "<li>".$num[0]->num." user rate with ".$i."</li>";
                        }
                        $output.= "</ul>";
                    }
                    $output.="</td><td><button type=\"button\" class=\"btn btn-dark btn-up-ques\" rel=$item->id>Update</button></td></tr>";
                }
                $output .= "</tbody></table>";

            }else{
                $output = "<div class='alert alert-danger'>No statistic for this survey, wait for someone to vote!</div>";
            }
            return $output;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function updateSurvey(Request $request){
        try{
            $id = $request->get('idQuestion');
            $text = $request->get('tbQuestion');
            $this->model = new Survey();
            $this->model->updateQuestion($text, $id);
            return redirect()->back();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public function insertSurvey(Request $request){
        $q1 = $request->get('question1');
        $q2 = $request->get('question2');
        $q3 = $request->get('question3');
        $name = $request->get('name');
        try{
            $this->model=new Survey();

            $idSurvey = $this->model->insertSurvey($name);
            $idq1 = $this->model->insertQuestion($q1);
            $idq2 = $this->model->insertQuestion($q2);
            $idq3 = $this->model->insertQuestion($q3);
            $this->model->insertQuestionSurvey($idSurvey, $idq1, $idq2, $idq3);

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
        return redirect()->back();
    }

    public function deleteSurvey(Request $request){
        $btn = $request->get('btnAction');
        $id = $request->get('ddlDelete');
        try{
            if($btn==0){
                $this->model = new Survey();
                $this->model->deleteSurvey($id);
                return redirect()->back();
            }else{
                $this->model = new Survey();
                $this->model->setSurveyActive($id);
                return redirect()->back();
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }


    }
    //endregion

    //region advertisement
    public function adv(){
        try{
            $this->model = new Advertisement();
            $this->data['advs'] = $this->model->getAllAdvertisement();
            return view('pages.admin-pages.advertisement',$this->data);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }

    public function insertAdv(Request $request){
        $text = $request->get('text');
        $title = $request->get('title');
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2400'
        ];
        $custom_messages = [
            'image.max' => 'Fajl ne sme biti veci od :max KB.',
            'image.mimes' => 'Dozvoljeni formati su: :values.'
        ];
        $request->validate($rules, $custom_messages);

        $photo = $request->file('image');
        $imagename = time().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $thumb_img = img::make($photo->getRealPath())->resize(200, 200);

        try{
            $thumb_img->save($destinationPath.'/'.$imagename,80);
            $this->model=new Advertisement();
            $this->model->setText($text);
            $this->model->setTitle($title);
            $this->model->setAlt($title);
            $this->model->setSrc('images/'.$imagename);
            $this->model->insertAdv();
            return redirect()->back();
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
    }

    public  function updateAdv(Request $request){
        $id = $request->get('id');
        $this->model = new Advertisement();
        $this->model->setId($id);
        $url = url('/')."/admin/adv/update/fin";
        $output = "";
        try{
            $advs = $this->model->getAdvById();
            foreach ($advs as $item){
                $output .= "<form id='insertAdv' method='POST' action='$url' enctype='multipart/form-data'>
                ".csrf_field()."
                <input type='hidden' name='idAdv' value='$id'/>
                <div class='form-group'>
                    <label for='Title'>Title</label>
                    <input type='text' class='form-control' placeholder='Title' name='title' value='$item->title'>
                </div>
                <div class='form-group'>
                    <label for='text'>Text</label>
                    <textarea class='form-control' name='text' rows='3'>$item->text</textarea>
                </div>
                <div class='form-group'>
                Image
                <img src='".asset('/')."$item->src' alt='$item->alt' class='img-thumbnail'>
                </div>
                <div class='form-group'>
                <label for='image'>Change Image</label>                   
                <input type='file' class='form-control' name='image'>
                </div>
                <button type='submit' class='btn btn-dark'>Insert</button>
            </form>";
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }
        return $output;
    }

    public function updateAdvFin(Request $request){
        $id = $request->get('idAdv');
        $text = $request->get('text');
        $title = $request->get('title');
        $photo = $request->file('image');
        if(isset($photo)){
            $rules = [
                'image' => 'required|mimes:jpg,jpeg,png,gif|max:2400'
            ];
            $custom_messages = [
                'image.max' => 'Fajl ne sme biti veci od :max KB.',
                'image.mimes' => 'Dozvoljeni formati su: :values.'
            ];
            $request->validate($rules, $custom_messages);


            $imagename = time().'.'.$photo->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $thumb_img = img::make($photo->getRealPath())->resize(200, 200);

            try{
                $thumb_img->save($destinationPath.'/'.$imagename,80);
                $this->model=new Advertisement();
                $this->model->setText($text);
                $this->model->setTitle($title);
                $this->model->setAlt($title);
                $this->model->setSrc('images/'.$imagename);
                $this->model->setId($id);
                $this->model->updateAdv();
                return redirect()->back();
            }
            catch (\Exception $e) {
                Log::error($e->getMessage());
                return "Sorry! Something went wrong with database!";
            }
        }else{
            try{
                DB::table('advertisement')
                    ->where('id', $id)
                    ->update([
                        'text' => $text,
                        'title' => $title
                    ]);
                return redirect()->back();
            }catch (\Exception $e){
                Log::error($e->getMessage());
                return "Sorry! Something went wrong with database!";
            }

        }

    }

    public function deleteAdv(Request $request){
        $request->validate([
           'ddlDelAdv' => new ddlRule
        ]);
        $id = $request->input('ddlDelAdv');
        $this->model = new Advertisement();
        $this->model->setId($id);
        try{
            $this->model->delete();
            return redirect()->back();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return "Sorry! Something went wrong with database!";
        }

    }
    //endregion
}
