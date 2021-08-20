<?php

namespace App\Http\Controllers;

use App\Models\Matchgw;
use Illuminate\Http\Request;

class MatchgwController extends Controller
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

            $allMatchgws = Matchgw::all();

            return response()->json([
                'success' => true,
                'data' => $allMatchgws,
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
                'team_id' => 'required',
            ]);

            $Matchgw = Matchgw::create([
                'gwschedule_id' => $request->gwschedule_id,
                'team_id' => $request->team_id,

            ]);

            if ($Matchgw) {
                return response()->json([
                    'success' => true,
                    'data' => $Matchgw
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Matchgw not added'
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
     * @param  \App\Models\Matchgw  $Matchgw
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $Matchgw = Matchgw::where('id', '=', $request->Matchgw_id)->get();
        if (!$Matchgw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Matchgw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Matchgw not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byGwschedule(Request $request)
    {
        $Matchgw = Matchgw::where('gwschedule_id', '=', $request->gwschedule_id)->get();

        if (!$Matchgw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Matchgw
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This Matchgw does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matchgw  $Matchgw
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allMatchgws = Matchgw::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allMatchgws,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matchgw  $Matchgw
     * @return \Illuminate\Http\Response
     */
    public function byTeamId(Request $request)
    {
        $Matchgw = Matchgw::where('team_id', '=', $request->team_id)->get();
        if (!$Matchgw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Matchgw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Matchgw does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matchgw  $Matchgw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matchgw $Matchgw)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Matchgw = Matchgw::find($request->Matchgw_id);

            if ($Matchgw) {

                $update = $Matchgw->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Matchgw updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Matchgw not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Matchgw not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matchgw  $Matchgw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Matchgw = Matchgw::where('id', '=', $request->Matchgw_id)->delete();

            if ($Matchgw) {

                return response()->json([
                    'success' => true,
                    'data' => $Matchgw,
                    'message' => 'Matchgw deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Matchgw not found'
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
