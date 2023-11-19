<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Follower;

class FollowersController extends Controller
{
    public function index()
    {
        try {
            $followerModel = new Follower();
            $dataObj = $followerModel
                            ->select('follower_id','followed_id','created_at')
                            ->with([
                                'follower'=>function ($query) {
                                    $query->select('name','email');
                                },
                                'followed'=>function ($query) {
                                    $query->select('name','email');
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
    public function followers($id)
    {
        try {
            $followerModel = new Follower();
            $dataObj = $followerModel
                            ->select('follower_id','followed_id','created_at')
                            ->with([
                                'follower'=>function ($query) {
                                    $query->select('name','email');
                                },
                                'followed'=>function ($query) {
                                    $query->select('name','email');
                                }
                            ])
                            ->where('followed_id', $id)
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
    public function follow($id, $status, Request $request)
    {
        try {
            $followuser_id = $request->user_id;

            $follow = Follower::where('followed_id', $id)->where('follower_id', $followuser_id)->first();
           
            if ($status == 1) {
                if ($follow) {
                    return response()->json([
                                                'status' => 'error',
                                                'message' => 'Already following'
                                            ], 200);
                } else {
                    $follow = new Follower();
                    $follow->followed_id = $id;
                    $follow->follower_id = $followuser_id;
                    $follow->save();
                    return response()->json([
                                                'status' => 'success',
                                                'message' => 'Followed'
                                            ], 200);
                }
            } else {
                if ($follow) {
                    $follow->delete();
                    return response()->json([
                                                'status' => 'deleted',
                                                'message' => 'Unfollowed'
                                            ] ,200);
                } else {
                    return response()->json([
                                                'status' => 'error',
                                                'message' => 'Not following'
                                            ] ,200);
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
