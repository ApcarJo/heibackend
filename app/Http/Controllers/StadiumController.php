<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumController extends Controller
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

            $allStadiums = Stadium::all();

            return response()->json([
                'success' => true,
                'data' => $allStadiums,
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
                'name' => 'required',
                'address' => 'required',
                'contact' => 'required',
            ]);

            $stadium = Stadium::create([
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact
            ]);

            if ($stadium) {
                return response()->json([
                    'success' => true,
                    'data' => $stadium
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Stadium not added'
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
    public function selector(Request $request)
    {
        $stadium = Stadium::where('name', '=', $request->name)->get();

        if (!$stadium->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $stadium
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This stadium does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $stadium = Stadium::where('id', '=', $request->stadium_id)->get();
        if (!$stadium->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $stadium
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Stadium not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allActiveStadium = Stadium::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allActiveStadium,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $stadium = Stadium::where('name', 'LIKE', '%'.$request->name.'%')->get();
        if (!$stadium->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $stadium
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Stadium does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $stadium = Stadium::find($request->stadium_id);

            if ($stadium) {

                $update = $stadium->fill($request->all())->save();                    

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Stadium info updated'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stadium not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Can not update de stadium'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $stadium = Stadium::where('id', '=', $request->stadium_id)->delete();

            if ($stadium) {

                return response()->json([
                    'success' => true,
                    'data' => $stadium,
                    'message' => 'Stadium deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Stadium not found'
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
