<?php

namespace App\Http\Controllers;

use App\Models\userTeam;
use Illuminate\Http\Request;

class UserTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user) {

            $allUserTeams = userTeam::all();

            return response()->json([
                'success' => true,
                'data' => $allUserTeams,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You have no permissions'
            ], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $this->validate($request, [
                'gwschedule_id' => 'required',
                'user_owner_id' => 'required',
  
            ]);

            $userTeam = userTeam::create([
                'gwschedule_id' => $request->gwschedule_id,
                'user_owner_id' => $request->gwschedule_id,

            ]);

            if ($userTeam) {
                return response()->json([
                    'success' => true,
                    'data' => $userTeam
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'UserTeam not added'
                ], 500);
            };
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You need to log in first'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\userTeam  $userTeam
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $userTeam = userTeam::where('id', '=', $request->userTeam_id)->get();
        if (!$userTeam->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $userTeam
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'UserTeam not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userTeam  $userTeam
     * @return \Illuminate\Http\Response
     */
    public function byGWSchedule(Request $request)
    {
        $userTeam = userTeam::where('gwschedule_id', '=', $request->gwschedule_id)->get();
        if (!$userTeam->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $userTeam
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'UserTeam not found'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userTeam  $userTeam
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allUserTeams = userTeam::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allUserTeams,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userTeam  $userTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userTeam $userTeam)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $userTeam = userTeam::find($request->userTeam_id);

            if ($userTeam) {

                $update = $userTeam->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'userTeam updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'userTeam not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'userTeam not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userTeam  $userTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $userTeam = userTeam::find($request->userTeam_id)->delete();

            if ($userTeam) {

                return response()->json([
                    'success' => true,
                    'data' => $userTeam,
                    'message' => 'userTeam deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'userTeam not found'
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "You don't have permissions"
            ], 400);
        }
    }
}
