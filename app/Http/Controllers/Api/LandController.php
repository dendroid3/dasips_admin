<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Land;
use Illuminate\Support\Str;


class LandController extends Controller
{
    public function create(Request $request)
    {
        // Store primary Image
        $primary_image = $request -> file('primaryImage');
        $primary_image_extension = $primary_image->getClientOriginalExtension();
        $primary_image_file_name = time() . '_' . Str::random(10) . '.' . $primary_image_extension;
        $primary_image_url = "/storage/" . $primary_image->storeAs('lands', $primary_image_file_name, 'public');

        $land = new Land();
        $land->title = $request-> title;
        $land->description = $request->description;
        $land->location = $request->location;
        $land->price = $request->price;
        $land->is_active = true;
        $land->image_url = $primary_image_url;
        $land->save();

        $secondary_images = $request -> file('secondaryImages');
        foreach ($secondary_images as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $imageUrl = "/storage/" . $image->storeAs('lands', $filename, 'public');
            $land->landImages()->create([
                'land_id' => $land -> id,
                'image_url' => $imageUrl
            ]);
        }

        return response()->json([
            'message' => 'Land created successfully'
        ]);
    }


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

    public function delete(Request $request)
    {
        $land = Land::find($request->land_id);

        if(!$land) {
            return response()->json([
                'message' => 'Land not found'
            ], 404);
        }

        $land->delete();

        return response()->json([
            'message' => 'Land deleted successfully'
        ]);
    }   
}
