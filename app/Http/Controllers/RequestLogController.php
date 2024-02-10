<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestLogController extends Controller
{
    public function index(){
        return view('Renstra.request-log',[
            'request_history' => RequestForm::with('reviewer') 
                                -> where('id_user', '=', Auth::user() -> id_user) 
                                -> orderBy('created_at','desc')
                                -> simplePaginate(10),
        ]);
    }
}
