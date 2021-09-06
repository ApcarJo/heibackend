<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
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

            $allTeams = Team::all();

            return response()->json([
                'success' => true,
                'data' => $allTeams,
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
                'isFD' => 'required',
                'stadium_id' => 'required',
            ]);

            $Team = Team::create([
                'name' => $request->name,
                'isFD' => $request->isFD,
                'stadium_id' => $request->stadium_id
            ]);

            if ($Team) {
                return response()->json([
                    'success' => true,
                    'data' => $Team
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Team not added'
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
        $Team = Team::where('name', '=', $request->name)->get();

        if (!$Team->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Team
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This Team does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $Team
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $Team = Team::find($request->team_id);
        if (!$Team->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Team
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Team not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $Team
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allActiveTeam = Team::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allActiveTeam,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $Team
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $Team = Team::where('name', 'LIKE', '%'.$request->name.'%')->get();
        if (!$Team->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Team
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Team does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $Team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Team = Team::find($request->team_id);

            if ($Team) {

                $update = $Team->fill($request->all())->save();                    

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Team info updated'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Team not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Can not update de Team'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $Team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Team = Team::find($request->team_id)->delete();

            if ($Team) {

                return response()->json([
                    'success' => true,
                    'data' => $Team,
                    'message' => 'Team deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Team not found'
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

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Team  $team
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Team $team)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Team  $team
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Team $team)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Team  $team
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Team $team)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Team  $team
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Team $team)
    // {
    //     //
    // }

