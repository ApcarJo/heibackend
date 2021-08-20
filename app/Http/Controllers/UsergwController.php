<?php

namespace App\Http\Controllers;

use App\Models\usergw;
use Illuminate\Http\Request;

class UsergwController extends Controller
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

            $allusergws = usergw::all();

            return response()->json([
                'success' => true,
                'data' => $allusergws,
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
                'user_id' => 'required',
                'userTeam_id' => 'required',
            ]);

            $usergw = usergw::create([
                'user_id' => $request->user_id,
                'userTeam_id' => $request->userTeam_id,

            ]);

            if ($usergw) {
                return response()->json([
                    'success' => true,
                    'data' => $usergw
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'usergw not added'
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
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $usergw = usergw::where('id', '=', $request->usergw_id)->get();
        if (!$usergw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $usergw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'usergw not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byUserTeam(Request $request)
    {
        $usergw = usergw::where('userTeam_id', '=', $request->userTeam_id)->get();

        if (!$usergw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $usergw
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This usergw does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allusergws = usergw::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allusergws,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function byuserId(Request $request)
    {
        $usergw = usergw::where('user_id', '=', $request->user_id)->get();
        if (!$usergw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $usergw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This usergw does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function byAllGW(Request $request)
    {
        $usergw = usergw::all()->groupBy('GW');
        if (!$usergw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $usergw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This usergw does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function byGW(Request $request)
    {
        $usergw = usergw::where('GW', '=', $request->GW)->get();
        if (!$usergw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $usergw
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This usergw does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usergw $usergw)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $usergw = usergw::find($request->usergw_id);

            if ($usergw) {

                $update = $usergw->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'usergw updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'usergw not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'usergw not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usergw  $usergw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $usergw = usergw::where('id', '=', $request->usergw_id)->delete();

            if ($usergw) {

                return response()->json([
                    'success' => true,
                    'data' => $usergw,
                    'message' => 'usergw deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'usergw not found'
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
