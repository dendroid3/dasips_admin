<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;

class PropertiesController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello World'
        ]);
    }

    public function get(Request $request)
    {
        $query = Property::query() -> where('is_active', true);

        if ($request->has('property_type')) {
            $query->where('property_type', $request->input('property_type'));
        }

        if ($request->has('location')) {
            $query->where('location', $request->input('location'));
        }

        $properties = $query-> paginate(3);
        return response()->json(
            $properties
        );
    }
}
