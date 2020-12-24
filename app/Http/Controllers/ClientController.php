<?php

namespace App\Http\Controllers;

use App\models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
>>>>>>> 140a709790b5fe1ee4a473a85a82316112711836
        return Client::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:clients',
            'phone' => 'required',
            'website' => 'required|unique:clients',
            'address' => 'required'

        ]);
        $photoname = time() . '.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
        \Image::make($request->logo)->save(public_path('images/img/') . $photoname);
        $request->merge(['logo' => $photoname]);

        return Client::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'website' => $request['website'],
            'address' => $request['address'],
            'logo' => $photoname,
            'account_id' => 1
        ]);

        return Client::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client = Client::findOrFail($client->id);
        if ($client->logo != 0) {
            if (file_exists(public_path('images/img/') . $client->logo)) {
                unlink(public_path('images/img/') . $client->logo);
            }
        }
        return $client->delete();
    }
}
