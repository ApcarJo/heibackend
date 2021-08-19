<?php

namespace App\Http\Controllers;

use App\Models\Van;
use Illuminate\Http\Request;

class VanController extends Controller
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

            $allvans = Van::all();

            return response()->json([
                'success' => true,
                'data' => $allvans,
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
                'customNote' => 'required',
                'model' => 'required',
                'licensePlate' => 'required',
            ]);

            $van = Van::create([
                'customNote' => $request->customNote,
                'model' => $request->model,
                'licensePlate' => $request->licensePlate
            ]);

            if ($van) {
                return response()->json([
                    'success' => true,
                    'data' => $van
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Van not added'
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
     * @param  \App\Models\Van  $van
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $van = Van::where('id', '=', $request->van_id)->get();
        if (!$van->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $van
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Van not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selector(Request $request)
    {
        $van = Van::where('customNote', '=', $request->customNote)->get();

        if (!$van->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $van
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This van does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Van  $van
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allVans = Van::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allVans,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Van  $van
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $van = Van::where('customNote', 'LIKE', '%'.$request->customName.'%')->get();
        if (!$van->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $van
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This van does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Van  $van
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Van $van)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $van = Van::find($request->van_id);

            if ($van) {

                $update = $van->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Van updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Van not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Van not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Van  $van
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $van = Van::where('id', '=', $request->van_id)->delete();

            if ($van) {

                return response()->json([
                    'success' => true,
                    'data' => $van,
                    'message' => 'Van deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Van not found'
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