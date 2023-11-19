<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetsController extends Controller
{

    public function index()
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->all();
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
    public function store(Request $request)
    {
        try {
            $tweetModel = new Tweet();
            $tweetModel->user_id = $request->user_id;
            $tweetModel->tweet = $request->tweet;
            $tweetModel->save();
            return response()->json([
                'status' => 'success',
                'data' => $tweetModel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->find($id);
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
    public function update(Request $request, $id)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->find($id);
            $dataObj->user_id = $request->user_id;
            $dataObj->tweet = $request->tweet;
            $dataObj->save();
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
    public function destroy($id)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->find($id);
            $dataObj->delete();
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

    public function getTweetsByUserId($id)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->where('_id', $id)->get();
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

    public function getTweetsByUserName($name)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel->where('email', $name)->get();
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
