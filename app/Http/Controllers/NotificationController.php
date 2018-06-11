<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function deleteNoty(Request $request){
        $id = $request->get('id');
        DB::table('comment')
            ->where('id', $id)
            ->update(['seen' => 1]);
        return $id;
    }
}
