<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $address = $request->ip();
        $host = $request->getHttpHost();
        $file = 'visitors.txt';
        $con = fopen($file,'ab');
        $input = "ip: ".$address."\t"."host: ".$host."\r\n";
        fwrite($con,$input);
        fclose($con);
        return view('app.index');
    }

    public function showLogin()
    {
        return  view('pages.login');
    }
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'tbMail' => 'required|email',
            'tbPassword' => 'required|regex:/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{7,}$/',
        ]);

        if ($validator->fails()) {
            return view('pages.login')
                ->with('msg','Invalid username or password!');
        }
        else{
            try{
                $user = new User();
                $mail = $request->input('tbMail');
                $check = $user->checkMail($mail);
                if($check!=""){

                    $user->setEmail($mail);
                    try{
                        $hashedPassword = DB::table('user')
                            ->where('email','=',$mail)
                            ->select('password')
                            ->first();
                        $hash = $hashedPassword->password;
                    }catch (\Exception $e){
                        return $e->getMessage();
                    }
                    $pass = $request->input('tbPassword');
                    if(Hash::check($pass, $hash)){
                        $res = DB::table('user')
                            ->where('email','=',$mail)
                            ->first();
                        if($res)
                        {
                            $user->setId($res->id);
                            $user->setFirstname($res->firstname);
                            $user->setLastname($res->lastname);
                            $user->setPosition($res->position);
                            $user->setWorkplace($res->workplace);
                            $user->setState($res->state);
                            $user->setCity($res->city);
                            $user->setDateOfBirth($res->dateOfBirth);
                            $user->setRole_id($res->role_id);
                            if($res->role_id==2){
                                $request->session()->push('user',$user);
                                return redirect()->route('home');
                            }else{
                                $request->session()->push('admin',$user);
                                return redirect()->route('admin');
                            }

                        }
                    }
                    else{
                        return view('pages.login')
                            ->with('msg','Invalid username or password!');
                    }
                }else{
                    return view('pages.login')
                        ->with('msg','Invalid username or password!');
                }
            }catch (\Exception $e){
                Log::error($e);
                return 'Sorry! Something is wrong with database!';
            }
        }

    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('index');
    }

    public function store(Request $request){



        //VALIDATION OF DATA

        $request->validate($this->rules(), $this->message());
        $request->validate([
            'tbMail' => 'required|email',
            'tbPassword' => 'regex:/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{7,}$/',
        ]);

        //CHECKING EMAIL
        $user = new User();
        $mail = $request->input('tbMail');
        $check = $user->checkMail($mail);
        if($check)
        {
            return redirect()->back()->with('msg','There is already user with this email address!');
        }
        else
        {
            $user->setFirstname($request->input('tbFirstname'));
            $user->setLastname($request->input('tbLastname'));
            $pass = Hash::make($request->input('tbPassword'));
            $user->setPassword($pass);
            $user->setEmail($request->input('tbMail'));
            $user->setWorkplace($request->input('tbWorkplace'));
            $user->setPosition($request->input('tbPosition'));
            try{
                $id = $user->newUser();
                $user->setId($id);
                $user->setRole_id(2);
                $request->session()->push('user',$user);
                return redirect()->route('profil');
            }catch(\Exception $e){
                Log::error($e);
                return 'Sorry! Something is wrong with database!';
            }

        }
  }
}
