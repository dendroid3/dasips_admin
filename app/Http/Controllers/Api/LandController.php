<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Land;

class LandController extends Controller
{
    public function view(Request $request)
    {
        $land = Land::find($request->land_id);

        if(!$land) {
            return response()->json([
                'message' => 'Land not found'
            ], 404);
        }

        $land->landImages;
        
        return response()->json(
            $land
        );
    }

    public function get(Request $request)
    {
        $query = Land::query() -> where('is_active', true);

        if ($request->has('location')) {
            $query->where('location', $request->input('location'));
        }

        $lands = $query-> paginate(6);
        return response()->json(
            $lands
        );
    }
}
