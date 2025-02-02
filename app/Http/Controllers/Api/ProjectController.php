<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create(Request $request)
    {
        // Store primary Image
        $primary_image = $request -> file('primaryImage');
        
        $primary_image_extension = $primary_image->getClientOriginalExtension();
        $primary_image_file_name = time() . '_' . Str::random(10) . '.' . $primary_image_extension;
        $primary_image_url = "/storage/" . $primary_image->storeAs('projects', $primary_image_file_name, 'public');

        $project = new Project();
        $project->name = $request-> name;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->type = $request->type;
        $project->image_url = $primary_image_url;
        $project->save();

        return response()->json([
            'message' => 'Project created successfully'
        ]);
    }

    public function get(Request $request)
    {
        $projects = Project::query() -> paginate(6);
        return response()->json(
            $projects
        );
    }

    public function view(Request $request)
    {
        $project = Project::find($request->project_id);

        if(!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }
        $project->projectImages;
        
        return response()->json(
            $project
        );
    }

    
    public function delete(Request $request)
    {
        $project = Project::find($request->project_id);

        if(!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }

}
