<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Client;
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
        return Client::with('pro_date')->get();
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
            'address' => 'required',
            'logo' => 'required'
        ]);
        // $accountType = AccountType::create([
        //     'title' => 'خریداران',
        //     'type_id' => 0,
        //     'system' => 0,
        // ]);
        // if ($accountType) {
        // $lastAccountType = AccountType::latest()->first();
        $account = Account::create([
            'user_id' => 4,
            'type_id' => 2,
            'name' => $request['name'],
            'ref_code' => 1223,
            'status' => 1,
            'description' => $request['name'],
            'system' => 1
        ]);

        if ($account) {
            // upload the logo
            $photoname = time() . '.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            \Image::make($request->logo)->save(public_path('images/img/') . $photoname);
            $request->merge(['logo' => $photoname]);
            // find the last ID of account

            $lastAccount = Account::latest()->first();
            return Client::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'website' => $request['website'],
                'address' => $request['address'],
                'logo' => $photoname,
                'account_id' => $lastAccount->id
            ]);
            // }
        } else {
            return response("status", 'Not seet');
        }


        // return Client::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'phone' => $request['phone'],
        //     'website' => $request['website'],
        //     'address' => $request['address'],
        //     'logo' => $photoname,
        //     'account_id' => 1
        // ]);

        // return Client::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'website' => 'required',
            'address' => 'required',
        ]);
        $client = Client::findOrFail($client->id);
        if (!($client->logo == $request->logo)) {
            if (file_exists(public_path('images/img/') . $client->logo)) {
                unlink(public_path('images/img/') . $client->logo);
            }
            $photoname = time() . '.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            \Image::make($request->logo)->save(public_path('images/img/') . $photoname);
            $request->merge(['logo' => $photoname]);

            $client->logo = $photoname;
        }

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->website = $request->website;
        $client->address = $request->address;
        $client->account_id = 1;
        $client->save();

        // return $client->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
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
        $client->delete();
        $relatedAccount = Account::Where('id', $client->account_id)->first();
        $relatedAccount->delete();
    }
}
