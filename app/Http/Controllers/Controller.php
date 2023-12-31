<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // STORE
    public function store(Request $request)
    {
        $activity_name = $request->input('activity_name');
        $data = array(
            'activity_name' => $activity_name
        );
        $activity = Activity::create($data);
        if ($activity) {
            return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Success',
                    'id' => $activity->id,
                    'attributes' => $activity
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'activities',
                'message' => 'Fail'
            ], 400);
        }
    }

    // // STORElIST
    // public function storeLists(Request $request, $activity_id)
    // {
    //     $item_name = $request->input('item_name');
    //     $item = Item::create([
    //         'item_name' => $item_name,
    //         'activity_id' => $activity_id,
    //         'status' => 0
    //     ]);
    //     if ($item) {
    //         return response()->json([
    //             'data' => [
    //                 'type' => 'activity items',
    //                 'message' => 'Success',
    //                 'id' => $item->id,
    //                 'attributes' => $item
    //             ]
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'type' => 'activity_items',
    //             'message' => 'Fail'
    //         ], 400);
    //     }
    // }

    // // SHOW
    // public function show()
    // {
    //     $activities = Activity::with('items')->get();
    //     return response()->json([
    //         'data' => $activities
    //     ], 200);
    // }

    // // ACTIVITY UPDATE
    // public function activityUpdate(Request $request, $activity_id)
    // {
    //     $activity = Activity::find($activity_id);
    //     if ($activity) {
    //         $activity->activity_name = $request->input('activity_name');
    //         $activity->save();
    //         return response()->json([
    //             'data' => [
    //                 'type' => 'activities',
    //                 'message' => 'Update Success',
    //                 'id' => $activity->id,
    //                 'attributes' => $activity
    //             ]
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'type' => 'activities',
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
    // }

    // // ITEM UPDATE
    // public function itemUpdate(Request $request, $activity_id, $item_id)
    // {
    //     $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->first();
    //     if ($item) {
    //         $item->item_name = $request->input('item_name');
    //         $item->status = $request->input('status');
    //         $item->save();
    //         return response()->json([
    //             'data' => [
    //                 'type' => 'items',
    //                 'message' => 'Update Success'
    //             ]
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'type' => 'items',
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
    // }

    // // (FILTER) GET ACTIVITY BY ID
    // public function getActivityById($activity_id)
    // {
    //     $activity = Activity::with('items')->find($activity_id);
    //     if ($activity) {
    //         return response()->json([
    //             'data' => [
    //                 'type' => 'activities',
    //                 'message' => 'Success',
    //                 'attributes' => $activity
    //             ]
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'type' => 'activities',
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
    // }

    // // ACTIVITY DESTROY
    // public function activityDestroy($activity_id)
    // {
    //     $activity = Activity::find($activity_id);
    //     if ($activity) {
    //         $activity->delete();
    //         return response()->json([], 204);
    //     } else {
    //         return response()->json([
    //             'type' => 'activities',
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
    // }

    // // ACTIVITY ITEM DESTROY
    // public function activityItemDestroy($activity_id, $item_id)
    // {
    //     $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->first();
    //     if ($item) {
    //         $item->delete();
    //         return response()->json([], 204);
    //     } else {
    //         return response()->json([
    //             'type' => 'items',
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
    // }
}
