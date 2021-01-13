<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Archive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Archive::all();
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
        // $imageName = time() . rand(11111, 99999);
        // $request->file->move(public_path('images/img/archieves/'), $imageName);
        $imageName = time() . rand(11111, 99999) . '_' . $request->file->getClientOriginalName() . '.' . $request->file->getClientOriginalExtension();
        return response(['status' => $imageName]);

        // $this->validate($request, [
        //     'title' => 'required|min:2',
        //     'refcode' => 'required|unique:archives',
        //     'account_id' => 'required',
        //     'note' => 'required|min:3',
        //     'user_id' => 'required',
        //     'type' => 'required'
        // ]);
        // $archive = Archive::create([
        //     'title' => $request['title'],
        //     'refcode' => $request['refcode'],
        //     'account_id' => $request['account_id'],
        //     'note' => $request['note'],
        //     'user_id' => $request['user_id'],
        //     'type' => $request['type']
        // ]);
        // if ($archive) {
        //     return 1;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }
    public function uploadfile(Request $request)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $archive = Archive::findOrFail($id);
        $archive->delete();
    }
    public function mostresent()
    {
        return Account::first();
    }
}
