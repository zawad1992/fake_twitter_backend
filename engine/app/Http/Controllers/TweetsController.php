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
            $dataObj = $tweetModel
                            ->select('_id','user_id','tweet','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                }
                            ])
                            ->orderBy('created_at', 'desc')
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
    
    public function usertweets($userid=null)
    {
        try {
            $tweetModel = new Tweet();
            $dataObj = $tweetModel
                            ->select('_id','user_id','tweet','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                }
                            ])
                            ->where('user_id', $userid)
                            ->orderBy('created_at', 'desc')
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
            $dataObj = $tweetModel
                            ->select('_id','user_id','tweet','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                }
                            ])
                            ->where('_id', $id)
                            ->first();
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
                'status' => 'updated',
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
            if (!$dataObj) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tweet not found',
                ], 404);
            }

            $dataObj->delete();
            $response['message'] = "Tweet deleted successfully";
            $response['id'] = $id;

            return response()->json([
                'status' => 'deleted',
                'data' => $response,
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
