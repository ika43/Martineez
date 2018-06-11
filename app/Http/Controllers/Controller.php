<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function rules()
    {
        return $rules = [
            'tbFirstname' => 'required|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/|min:2',
            'tbLastname' => 'required|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/|min:2',
            'tbWorkplace' => 'required|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/|min:3',
            'tbPosition' => 'required|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/|min:3',
        ];
    }


    public function message(){
        return $custom_messages = [
            'tbFirstname.required' => 'We need your firstname',
            'tbLastname.required' => 'We need your lastname',
            'tbPosition.required' => 'We need your position',
            'tbWorkplace.required' => 'We need your workplace, if you are unemployed, put unemployed',
            'tbFirstname.regex' => 'Invalid firstname!',
            'tbLastname.regex' => 'Invalid lastname!',
        ];
    }


}
