<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfilController extends Controller
{

    private $data;

    public function index(Request $request)
    {
        $id = $request->session()->get('user')[0]->getId();
        $user = new User();
        $this->data['user'] = $user->getUserById($id);
        $img = new Image();
        $this->data['profilimg']=$img->getProfileImg($id);
        $this->data['gallery'] = $img->getGallery($id);
        $comm = new Comment();
        $this->data['notf'] = $comm->checkNotf($id);
        $post = new Post();
        $post->setUser_id($id);
        try{
            $this->data['post'] = $post->getAllPostById();
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }

        return view('pages.profil',$this->data);
    }

    public function edit(Request $request)
    {
        try{
            $request->validate($this->rules(), $this->message());
            $user = new User();
            $user->setFirstname($request->input('tbFirstname'));
            $user->setLastname($request->input('tbLastname'));
            $user->setWorkplace($request->input('tbWorkplace'));
            $user->setPosition($request->input('tbPosition'));
            $user->setDateOfBirth($request->input('tbDate'));
            $id = $request->session()->get('user')[0]->getId();

            if($request->input('tbCity')=="" && $request->input('tbState')=="")
            {
                $user->editUser($id);
            }
            else
            {
                $rules = [
                    'tbCity' => 'regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/',
                    'tbState' => 'regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/'
                ];
                $message = [
                    'tbCity.regex' => 'Please enter both, State and City!',
                    'tbState.regex' => 'Please enter both, State and City!'
                ];
                $request->validate($rules,$message);
                $user->setCity($request->input('tbCity'));
                $user->setState($request->input('tbState'));
                $user->editUser($id);
            }
            return redirect()->back()->with('msg','You have successfully changed the data');
        }catch (\Exception $e){
            Log::error($e);
            return 'Sorry! Something is wrong with database!';
        }
    }
}
