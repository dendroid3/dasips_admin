<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Property;

class PropertiesController extends Controller
{
    public function create(Request $request)
    {
        // Store primary Image
        $primary_image = $request -> file('primaryImage');
        
        $primary_image_extension = $primary_image->getClientOriginalExtension();
        $primary_image_file_name = time() . '_' . Str::random(10) . '.' . $primary_image_extension;
        $primary_image_url = "/storage/" . $primary_image->storeAs('images', $primary_image_file_name, 'public');

        $property = new Property();
        $property->title = $request-> title;
        $property->description = $request->description;
        $property->location = $request->location;
        $property->property_type = $request->property_type;
        $property->price = $request->price;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->is_active = true;
        $property->image_url = $primary_image_url;
        $property->save();

        $secondary_images = $request -> file('secondaryImages');
        foreach ($secondary_images as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $imageUrl = "/storage/" . $image->storeAs('images', $filename, 'public');
            $property->propertyImages()->create([
                'property_id' => $property -> id,
                'image_url' => $imageUrl
            ]);
        }

        return response()->json([
            'message' => 'Property created successfully'
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
        $locationsWithTypes = Property::where('is_active', true)
            -> select('location')
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

    public function delete(Request $request)
    {
        $property = Property::find($request->property_id);

        if(!$property) {
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }

        $property->is_active = false;
        $property->save();

        return response()->json([
            'message' => 'Property deleted successfully'
        ]);
    }
}
