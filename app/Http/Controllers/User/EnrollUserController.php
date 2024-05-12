<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollUserController extends Controller
{
    public function enroll_user() {
        return view('user.enroll_user.index');
    }

    public function getDataEnroll(Request $request) {
        
    }
}
