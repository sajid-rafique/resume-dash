<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $projects = Project::all();
            return $this->apiResponse->success($projects->toArray());
        } catch (\Throwable $th) {
            return $this->apiResponse->error($th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'cost' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->apiResponse->error("Validation failed", 422, $validator->errors());
            }

            $project = Project::create($data);

            return $this->apiResponse->success(
                $project,
                'Project created successfully'
            );

        } catch (\Throwable $th) {
            return $this->apiResponse->error($th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        try {
            return $this->apiResponse->success([$project->toArray()], 'Project found');
        } catch (\Throwable $th) {
            return $this->apiResponse->error($th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Project $project)
    // {
    //     try {
    //         $project->update($request->all());

    //         return $this->apiResponse->success(['project' => new ProjectResource($project)]);
    //     } catch (\Throwable $th) {
    //         return $this->apiResponse->error($th->getMessage(), 500);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Project $project)
    // {
    //     try {
    //         $project->delete();

    //         return $this->apiResponse->success(['message' => 'Deleted']);
    //     } catch (\Throwable $th) {
    //         return $this->apiResponse->error($th->getMessage(), 500);
    //     }
    // }
}