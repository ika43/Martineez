<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as img;

class ImgController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'tbTitle' => 'regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/|min:3|nullable',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2400'
        ];
        $custom_messages = [
            'tbTitle.regex' => 'Invalid format of title!',
            'image.max' => 'Fajl ne sme biti veci od :max KB.',
            'image.mimes' => 'Dozvoljeni formati su: :values.'
        ];
        $request->validate($rules, $custom_messages);

        $title = $request->get('tbTitle');
        $bit = $request->get('rbShare');

        $photo = $request->file('image');
        $extension = $photo->getClientOriginalExtension();
        $tmp_path = $photo->getPathName();

        $folder = '/images/';
        $file_name = time().".".$extension;
        $new_path = public_path($folder).$file_name;
        try{
            //move photo to server
            File::move($tmp_path, $new_path);
            $image = new Image();
            //insert into image
            if(session()->has('user')){
                $user_id = session()->get('user')[0]->getId();
                $image->setActive($bit);
            }else{
                $user_id = session()->get('admin')[0]->getId();
                $image->setActive(1);
            }
            $image->setSrc('images/'.$file_name);
            $image->setAlt($title);
            $image->setUserId($user_id);
            $image_id = $image->insertImg();

            DB::table('gallery')
                ->insert([
                   'img_id' => $image_id,
                   'user_id' => $user_id
                ]);
            //insert into post
            $post = new Post();
            if(isset($title))
                $post->setTitle($title);
            $post->setUser_id($user_id);
            $post->setImg_id($image_id);
            $post->insertPost();

            return redirect()->back()->with('msg','successfully uploaded post');

        }
        catch (\Exception $e) {
            Log::error($e);
            return $e->getMessage();
        }

    }

    public function editProfilImg(Request $request)
    {
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
        $destinationPath = public_path('/images/');
        $thumb_img = img::make($photo->getRealPath())->resize(200, 200);

        try{
            $user_id = session()->get('user')[0]->getId();
            $thumb_img->save($destinationPath.'/'.$imagename,80);
            $image = new Image();
            $image->setSrc('images/'.$imagename);
            $image->setAlt(session()->get('user')[0]->getFirstname()."-".session()->get('user')[0]->getLastname()."-profil");
            $image->setUserId($user_id);
            $image_id = $image->insertImg();
            DB::table('profileimg')
                ->insert([
                   'user_id' => $user_id,
                   'img_id' => $image_id
                ]);
            return redirect()->back()->with('msg','profile img was changed');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }


}
