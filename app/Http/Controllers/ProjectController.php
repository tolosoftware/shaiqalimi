<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Organization;
use App\Models\Announcement;
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
        $this->validate($request, [
            's_number' => 'required|unique',
            'issue_date' => 'required|date',
            'type' => 'required',
            'price' => 'required:max:20',
            'offer_date' => 'required|date',
            'close_date' => 'required|date',
            'offer_price' => 'required|max:20',
            'project_price' => 'required|max:20',
            'announce_id' => 'required',
            'organization_id' => 'required',
            'title' => 'required|min:3',
            'issue_address' => 'required|min:3',
            'source_address' => 'required|min:3',
            // 'img' => '',
            // 'auth_number' => '',
            // 'duration' => '',
            // 'status' => '',
            // 'progress' => ''

        ]);
        // return Project::max('s_number') + 1; 
        $request['s_number'] = Project::withTrashed()->max('s_number') + 1;
        return Project::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $project;
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
        if ($project->update($request->all())) {
            return $project;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return $project->delete();
    }
    
    public function latest(){
        return Project::withTrashed()->max('s_number') + 1;
    }
}
