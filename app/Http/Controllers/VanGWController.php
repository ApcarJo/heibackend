<?php

namespace App\Http\Controllers;

use App\Models\VanGW;
use Illuminate\Http\Request;

class VanGWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $allVangws = VanGW::all();

            return response()->json([
                'success' => true,
                'data' => $allVangws,
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'You have no permissions'
            ], 401);
        }
    }
    /**
     * Display the specified resource by id.
     *
     * @param  \App\Models\VanGW  $vangw
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $vangw = VanGW::where('id', '=', $request->vangw_id)->get();
        if (!$vangw->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $vangw,
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'User not found'
            ], 400);
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
                'van_id' => 'required'
            ]);

            $vangw = VanGW::create([
                'gwschedule_id' => $request->gwschedule_id,
                'van_id' => $request->van_id
            ]);

            if ($vangw) {
                return response()->json([
                    'success' => true,
                    'data' => $vangw
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Party not added'
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VanGW  $vanGW
     * @return \Illuminate\Http\Response
     */
    public function show(VanGW $vanGW)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VanGW  $vanGW
     * @return \Illuminate\Http\Response
     */
    public function edit(VanGW $vanGW)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VanGW  $vanGW
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VanGW $vangw)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $vangw = VanGW::find($request->vangw_id);

            if ($vangw) {

                // $update = $modifyuser->fill($request->all())->save();
                $update = $vangw->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'data' => $vangw
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'User not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VanGW  $vanGW
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $vangw = VanGW::find($request->vangw_id)->delete();

            if ($vangw) {

                return response()->json([
                    'success' => true,
                    'data' => $vangw,
                    'message' => 'Party deleted'
                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Party not found'
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
