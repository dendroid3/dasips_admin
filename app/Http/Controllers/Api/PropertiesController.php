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

        $properties = $query-> paginate(6);
        return response()->json(
            $properties
        );
    }

    public function view(Request $request)
    {
        $property = Property::find($request->property_id);

        if(!$property) {
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }
        $property->propertyImages;
        
        return response()->json(
            $property
        );
    }

    public function types_and_locations(Request $request)
    {
        $locationsWithTypes = Property::select('location')
            ->distinct()
            ->get()
            ->map(function ($location) {
                $location->property_types = Property::select('property_type')
                    ->where('location', $location->location)
                    ->distinct()
                    ->get();
                return $location;
            });

        return response()->json(
            $locationsWithTypes
        );
    }
}
