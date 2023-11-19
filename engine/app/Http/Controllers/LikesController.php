<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
class LikesController extends Controller
{
    public function index()
    {
        try {
            $likeModel = new Like();
            $dataObj = $likeModel
                            ->select('_id','user_id','tweet_id','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                },
                                'tweet'=>function ($query) {
                                    $query->select('tweet');
                                }
                            ])
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
    public function likes($tweetid)
    {
        try {
            $likeModel = new Like();
            $dataObj = $likeModel
                            ->select('_id','user_id','tweet_id','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                },
                                'tweet'=>function ($query) {
                                    $query->select('tweet');
                                }
                            ])
                            ->where('tweet_id', $tweetid)
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

    public function like($tweetid, $status, Request $request)
    {
        try {
            $user_id = $request->user_id;
            //$follow = Follower::where('followed_id', $id)->where('follower_id', $followuser_id)->first();
            $like = Like::where('tweet_id', $tweetid)->where('user_id', $user_id)->first();
            if ($status == 1) {
                if ($like) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Already liked',
                    ], 500);
                } else {
                    $likeModel = new Like();
                    $likeModel->user_id = $user_id;
                    $likeModel->tweet_id = $tweetid;
                    $likeModel->save();
                    return response()->json([
                        'status' => 'success',
                        'data' => $likeModel,
                    ], 200);
                }
            } else {
                if ($like) {
                    $like->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Unliked',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Not liked',
                    ], 500);
                }
            }
          
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);

        }
    }
    

    


}
