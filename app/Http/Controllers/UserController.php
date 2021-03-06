<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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

            $allUsers = User::all();

            return response()->json([
                'success' => true,
                'data' => $allUsers,
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);

        } else {
            return response()->json([
                'success'=>false,
                'message'=>'User not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource by id.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userrole (Request $request)
    {
        $user = User::where("role", "=", $request->role)->get();
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);

        } else {
            return response()->json([
                'success'=>false,
                'message'=>'User not found'
            ], 400);
        }
    }

    /**
     * Display the specified resource by name.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $user = User::where('name', 'LIKE', '%'.$request->name.'%')->get();
        if (!$user->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This user does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource by name.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userSelector(Request $request)
    {

        $user = User::where('name', '=', $request->name)->get();

        if (!$user->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This user does not exist'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showActive()
    {
        $allUsers = User::where('isActive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allUsers,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showarchive()
    {
        $allUsers = User::where('isArchive', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $allUsers,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        if (($user->isAdmin)||($user->id==$request->user_id)) {

            $modifyuser = User::find($request->user_id);

            if ($modifyuser) {

                $update = $modifyuser->fill($request->all())->save();
                // $update = $modifyuser->fill([
                //     'phone'=>$request->phone,
                //     'picture'=>$request->picture,
                //     'postalcode'=>$request->postalcode,
                //     'address'=>$request->address,
                //     'city'=>$request->city,
                //     'nif'=>$request->nif,
                //     'isActive'=>$request->isActive,
                //     'password'=>bcrypt($request->password)
                // ])->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'data' => $modifyuser
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
     * Archive the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function archive (Request $request)
    {
        $user = auth()->user();

        if (($user->isAdmin)||($user->id==$request->id)) {
            $archive = User::find($request->id);
            if ($archive) {
                $archive->isArchive = 1;
                $archive->isActive = 0;
                $archive->isAdmin = 0;
                $archive->save();
                return response()->json([
                    'success' => true,
                    'data' => $archive,
                    'message' => 'User archived'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy (Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin) {
            $delete = User::find($request->user_id);
            $delete->delete();
            if ($delete) {
                return response()->json([
                    'success' => true,
                    'message' => 'User deleted'
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "You don't have permissions",
            ], 400);
        } 
    }

    /**
     * Change isActive to true the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        $user = auth()->user();

        if (($user->isAdmin)||($user->id==$request->user_id)) {

            $activate = User::find($request->user_id);

            if ($activate) {

                $activate->isActive = 1;
                $activate->save();


                return response()->json([
                    'success' => true,
                    'data' => $activate,
                    'message' => 'User activated'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
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
