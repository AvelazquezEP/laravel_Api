<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class activityContoller extends Controller
{
    public function index()
    {
        // HOME/WELCOME
    }

    public function create()
    {
        //--
    }

    public function store(Request $request)
    {
        /* #region STORE */
        $activity_name = $request->input('activity_name');
        $data = array(
            'activity_name' => $activity_name,
        );

        $activity = Activity::create($data);

        if ($activity) {
            return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Success',
                    'id' => $activity->id,
                    'attributes' => $activity,
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'activities',
                'message' => 'Fail'
            ], 400);
        }
        /* #endregion */
    }

    public function store_lists(Request $request, $activity_id)
    {
        /* #region STORE LISTS */
        $item_name = $request->input('item_name');

        $item = Item::create([
            'item_name' => $item_name,
            'activity_id' => $activity_id,
            'status' => 0,
        ]);

        if ($item) {
            return response()->json([
                'data' => [
                    'type' => 'activity items',
                    'message' => 'Success',
                    'id' => $item->id,
                    'attributes' => $item
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'activity_items',
                'message' => 'Fail',
            ], 400);
        }
        /* #endregion */
    }

    public function show()
    {
        // $activities = Activity::with('items')->get();
        $activities = Activity::get()->all();

        return response()->json([
            'data' => $activities
        ], 200);
    }

    public function activity_update(Request $request, $activity_id)
    {
        /* #region ACTIVITY UPDATE */
        $activity = Activity::find($activity_id);

        if ($activity) {
            $activity->activity_name = $request->input('activity_name');
            $activity->save();

            return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Update Success',
                    'id' => $activity->id,
                    'attributes' => $activity,
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'activities',
                'message' => 'Not Found'
            ], 400);
        }
        /* #endregion */
    }

    public function item_update(Request $request, $activity_id, $item_id)
    {
        /* #region ITEM UPDATE */
        $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->first();

        if ($item) {
            $item->item_name = $request->input('item_name');
            $item->status = $request->input('status');
            $item->save();

            return response()->json([
                'data' => [
                    'type' => 'items',
                    'message' => 'Update Success',
                ]
            ], 201);
        } else {
            return response()->json([
                'type' => 'items',
                'message' => 'Not Found',

            ], 404);
        }
        /* #endregion */
    }

    public function activity_by_id($activity_id)
    {
        // $activity = Activity::with('items')->find($activity_id);
        $activity = Activity::find($activity_id);
        $item_activity = Item::where('activity_id', $activity->id)->get();

        if ($activity) {
            return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Success',
                    'attributes' => $item_activity
                    // 'attributes' => $activity
                ]
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Not Found',
                ]
            ], 400);
        }
    }

    public function activity_delete($activity_id)
    {
        $activity = Activity::find($activity_id);

        if ($activity) {
            $activity->delete();
            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'activities',
                'message' => 'Not Found'
            ], 404);
        }
    }

    public function activityItemDestroy($activity_id, $item_id)
    {
        $item = Item::where('activity_id', $item_id)->where('id', $item_id)->first();

        if ($item) {
            $item->delete();
            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'items',
                'message' => 'Not Found'
            ], 404);
        }
    }
}
