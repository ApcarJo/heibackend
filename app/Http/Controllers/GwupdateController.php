<?php

namespace App\Http\Controllers;

use App\Models\Gwupdate;
use Illuminate\Http\Request;

class GwupdateController extends Controller
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

            $allGwupdates = Gwupdate::all();

            return response()->json([
                'success' => true,
                'data' => $allGwupdates,
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
                'infoUpdate',
            ]);

            $Gwupdate = Gwupdate::create([
                'date' => $request->date,
                'title' => $request->title,
                'roles' => $request->roles,
                'infoUpdate' => $request->infoUpdate,
            ]);

            if ($Gwupdate) {
                return response()->json([
                    'success' => true,
                    'data' => $Gwupdate
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gwupdate not added'
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
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $Gwupdate = Gwupdate::find($request->gwupdate_id);
        if ($Gwupdate) {
            return response()->json([
                'success' => true,
                'data' => $Gwupdate
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Gwupdate not found'
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
        $Gwupdate = Gwupdate::where('title', '=', $request->title)->get();

        if (!$Gwupdate->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Gwupdate
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This Gwupdate does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allGwupdates = Gwupdate::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allGwupdates,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function showArchive()
    {
        $allGwupdates = Gwupdate::where('isArchive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allGwupdates,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $Gwupdate = Gwupdate::where('title', 'LIKE', '%'.$request->title.'%')->get();
        if (!$Gwupdate->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Gwupdate
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Gwupdate does not exist'
            ], 400);
        }
    }

    public function archive (Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $archive = Gwupdate::find($request->id);

            if ($archive) {

                $archive->isArchive = 1;
                $archive->isActive = 0;
                $archive->save();


                return response()->json([
                    'success' => true,
                    'data' => $archive,
                    'message' => 'GWU archived'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'GWU not found'
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gwupdate $Gwupdate)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Gwupdate = Gwupdate::find($request->gwupdate_id);

            if ($Gwupdate) {

                $update = $Gwupdate->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Gwupdate updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gwupdate not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gwupdate not found'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gwupdate  $Gwupdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Gwupdate = Gwupdate::find($request->gwupdate_id)->delete();

            if ($Gwupdate) {

                return response()->json([
                    'success' => true,
                    'data' => $Gwupdate,
                    'message' => 'Gwupdate deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gwupdate not found'
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
