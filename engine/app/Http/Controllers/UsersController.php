<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        try {
            $userModel = new User();
            $dataObj = $userModel
                            ->select('_id','name','email','created_at')
                            ->get();
            return response()->json([
                'status' => 'success',
                'data' => $dataObj,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
