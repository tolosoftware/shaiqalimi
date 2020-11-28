<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        // return Carbon::parse($request->issue_date);
        // $this->validate($request, [
        //     // 's_number' => 'required',
        //     // 'issue_date' => 'required',
        //     // 'issue_address' => '',
        //     // 'source_address' => '',
        //     // 'title' => 'required',
        //     // 'img' => '',
        //     // 'auth_number' => '',
        //     // 'type' => 'required',
        //     // 'price' => 'required',
        //     // 'duration' => '',
        //     // 'offer_date' => 'required',
        //     // 'close_date' => 'required',
        //     // 'offer_price' => 'required',
        //     // 'project_price' => 'required',
        //     // 'announce_id' => 'required',
        //     // 'organization_id' => 'required',
        //     // 'status' => '',
        //     // 'progress' => ''

        // ]);

         Project::create($request->all());
         return "ok";
        // $project = new Project();
        // $project_data = $request->all();
        // $project->fill($project_data);
        // $status = $project->save();
        // return $status;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
