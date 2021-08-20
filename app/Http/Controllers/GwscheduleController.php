<?php

namespace App\Http\Controllers;

use App\Models\gwschedule;
use Illuminate\Http\Request;

class GwscheduleController extends Controller
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

            $allGwschedules = gwschedule::all();

            return response()->json([
                'success' => true,
                'data' => $allGwschedules,
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
                'date' => 'required',
                'title' => 'required',
                'roles' => 'required',
            ]);

            $gwschedule = gwschedule::create([
                'date' => $request->date,
                'title' => $request->title,
                'roles' => $request->roles
            ]);

            if ($gwschedule) {
                return response()->json([
                    'success' => true,
                    'data' => $gwschedule
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'gwschedule not added'
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
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $gwschedule = gwschedule::where('id', '=', $request->gwschedule_id)->get();
        if (!$gwschedule->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $gwschedule
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'gwschedule not found'
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
        $gwschedule = gwschedule::where('GW', '=', $request->GW)->get();

        if (!$gwschedule->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $gwschedule
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This gwschedule does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allgwschedules = gwschedule::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allgwschedules,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $gwschedule = gwschedule::where('Competition', 'LIKE', '%' . $request->competition . '%')->get();
        if (!$gwschedule->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $gwschedule
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This gwschedule does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function byDate(Request $request)
    {
        $gwschedule = gwschedule::where('Date', '=', $request->date)->get();
        if (!$gwschedule->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $gwschedule
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This gwschedule does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gwschedule $gwschedule)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $gwschedule = gwschedule::find($request->gwschedule_id);

            if ($gwschedule) {

                $update = $gwschedule->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'gwschedule updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'gwschedule not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'gwschedule not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $gwschedule = gwschedule::where('id', '=', $request->gwschedule_id)->delete();

            if ($gwschedule) {

                return response()->json([
                    'success' => true,
                    'data' => $gwschedule,
                    'message' => 'gwschedule deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'gwschedule not found'
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "You don't have permissions"
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gwschedule  $gwschedule
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request)
    {
        $user = auth()->user();

        if (($user->isAdmin) || ($user->id == $request->user_id)) {

            $deactive = gwschedule::find($request->gwschedule_id);

            if ($deactive) {

                $deactive->isActive = 0;
                $deactive->save();


                return response()->json([
                    'success' => true,
                    'data' => $deactive,
                    'message' => 'Gwschedule archived'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gwschedule not found'
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

