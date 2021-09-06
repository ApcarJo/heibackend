<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
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

            $allAssets = Asset::all();

            return response()->json([
                'success' => true,
                'data' => $allAssets,
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
                'model' => 'required',
                'type' => 'required',
                // 'kit_van_id' => 'required',
                'serialNumber',
                'year',
                'warrantyExpiracyDate',
                'quantity',
                'crossCheckCode',
            ]);

            $Asset = Asset::create([
                'name' => $request->name,
                'model' => $request->model,
                'type' => $request->type,
                // 'kit_van_id' => $request->kit_van_id,
                'serialNumber' => $request->serialNumber,
                'year' => $request->year,
                'warrantyExpiracyDate' => $request->warrantyExpiracyDate,
                'quantity' => $request->quantity,
                'crossCheckCode' => $request->crossCheckCode

            ]);

            if ($Asset) {
                return response()->json([
                    'success' => true,
                    'data' => $Asset
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Asset not added'
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
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function byId(Request $request)
    {
        $Asset = Asset::find($request->asset_id);
        if ($Asset) {
            return response()->json([
                'success' => true,
                'data' => $Asset
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Asset not found'
            ], 400);
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byKitVan(Request $request)
    {
        $Asset = Asset::where('kit_van_id', '=', $request->kit_van_id)->get();

        if (!$Asset->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Asset
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This Asset does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function byName(Request $request)
    {
        $Asset = Asset::where('name', 'LIKE', '%'.$request->name.'%')->get();
        if (!$Asset->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Asset
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Asset does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function byModel(Request $request)
    {
        $Asset = Asset::where('model', 'LIKE', '%'.$request->model.'%')->get();
        if (!$Asset->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Asset
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Asset does not exist'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function byWarrantyYear(Request $request)
    {
        $Asset = Asset::whereYear('warrantyExpiracyDate', '=', $request->thisYear)->get();
        if (!$Asset->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $Asset
            ], 200);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'This Asset does not exist'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $Asset)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Asset = Asset::find($request->asset_id);

            if ($Asset) {

                $update = $Asset->fill($request->all())->save();

                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Asset updated',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Asset not updated'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Asset not found'
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $Asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin) {

            $Asset = Asset::find($request->asset_id)->delete();

            if ($Asset) {

                return response()->json([
                    'success' => true,
                    'data' => $Asset,
                    'message' => 'Asset deleted'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Asset not found'
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
