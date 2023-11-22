<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Follower;
use App\Models\User;

class TweetsController extends Controller
{

    public function index($userid=null)
    {
        try {
            // Subquery to find the IDs of users followed by the given user
            $followedUserIds = Follower::where('follower_id', $userid)->pluck('followed_id')->toArray();

            $tweetModel = new Tweet();
            $dataObj = $tweetModel
                            ->select('_id','user_id','tweet','created_at')
                            ->with([
                                'user'=>function ($query) {
                                    $query->select('name','email');
                                },
                                'likes' => function ($query) {
                                    $query->select('user_id','tweet_id');
                                }
                            ])
                            ->has('user'); // Ensure the tweet has an associated user

            if (!empty($userid)) {
                $dataObj = $dataObj->whereIn('user_id', $followedUserIds);
            }

            $dataObj = $dataObj
                            ->orderBy('created_at', 'desc')
                            ->paginate(5); // paginate with 5 items per page

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
                                },
                                'likes' => function ($query) {
                                    $query->select('user_id','tweet_id');
                                }
                            ])
                            ->where('user_id', $userid)
                            ->orderBy('created_at', 'desc')
                            ->paginate(5); // paginate with 5 items per page
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

    public function trandingTweets($userid = null, Request $request)
    {
        try {
            $search = $request->search;
            $tweetModel = new Tweet();

            // Base query
            $query = $tweetModel
                        ->select('_id', 'user_id', 'tweet', 'created_at')
                        ->with(['user' => function ($query) {
                            $query->select('name', 'email');
                        }])
                        ->has('user') // Ensure the tweet has an associated user
                        ->where('user_id', '<>', $userid)
                        ->whereNotNull('user_id') // Exclude tweets where user_id is null
                        ->whereNotNull('tweet'); // Exclude tweets where tweet is null

            if (!empty($search)) {
                // Fetch tweets based on email search
                $userIds = User::where('email', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%")->pluck('_id')->toArray();
                $followedUserIds = Follower::where('follower_id', $userid)->pluck('followed_id')->toArray();
                $query = $query->whereIn('user_id', $userIds);
            } else {
                // Fetch tweets not from followed users
                $followedUserIds = Follower::where('follower_id', $userid)->pluck('followed_id')->toArray();
                $query = $query->whereNotIn('user_id', $followedUserIds);
            }

            $dataObj = $query->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get(); // Get top 10 trending tweets

            return response()->json([
                'status' => 'success',
                'data' => $dataObj,
                'followedUserIds' => $followedUserIds,
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
            // Load the user relationship
            $tweetModel->load('user');

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
