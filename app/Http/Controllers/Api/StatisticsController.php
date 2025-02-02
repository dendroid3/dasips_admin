<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Land;
use App\Models\Project;

class StatisticsController extends Controller
{
    public function property(Request $request) {
        $count = Property::where('is_active', true)->count();
        return response()->json($count);
    }

    public function land(Request $request) {
        $count = Land::count();
        return response()->json($count);
    }

    public function project(Request $request) {
        $count = Project::count();
        return response()->json($count);
    }
}
