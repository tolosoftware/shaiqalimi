<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Helper\Helper;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Helper::currency_notif();

        // auth()->guard('api')->user()->id
        $ndata = Notification::with(['user_notification' => function ($q) {
            $q->where('user_id', '=', 3);
        }])
        ->has('user_notification')
        ->get()->sortByDesc('user_notification.pin')->toArray();
        $x = array_values($ndata);
        return array_filter($x, fn($value) => !is_null($value['user_notification']) && $value['user_notification'] !== '');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->type = "normal";
        $notification->save();
        return response(['status' => 'changed']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

}
