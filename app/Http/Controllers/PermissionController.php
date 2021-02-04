<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userPrivilagesId = $this->userPrivilages($request['id'])->pluck('id')->toArray();
        $systemPrivilages = Permission::all();
        foreach ($systemPrivilages as $key => &$sPri) {
            if (in_array($sPri->id, $userPrivilagesId)) {
                $sPri['assign'] = true;
            } else {
                $sPri['assign'] = false;
            }
        }
        return $systemPrivilages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userPrivilages($id)
    {
        $user = User::find($id);
        $permissions = $user->permissions;
        return $permissions;
    }
    public function userPermissionAssign(Request $request)
    {

        $user = User::find(3);
        $user->givePermissionTo([]);
    }

    public function createPermissions()
    {
        $privilages = [
            ['name' => 'مدیریت تانک تیل ها'],
            ['name' => 'مدیریت اجناس و محصولات'],
            ['name' => 'مدیریت گدام ها'],
            ['name' => 'مدیریت انتقالات'],
            ['name' => 'مدیریت راپورها'],
            ['name' => 'مدیریت مصارف'],
            ['name' => 'مدیریت کاربران'],
            ['name' => 'مدیریت قراردادها'],
            ['name' => 'مدیریت آفرها'],
            ['name' => 'مدیریت فروشات'],
            ['name' => 'مدیریت حساب ها'],
            ['name' => 'مدیریت معاملات تجارتی'],
            ['name' => 'مدیریت ذخایر'],
            ['name' => 'مدیریت خریداری ها'],
            ['name' => 'مدیریت آرشیف'],
            ['name' => 'تنظیمات سیستم'],
            ['name' => 'تنظیمات مشتریان'],
            ['name' => 'تنظیمات فروشندگان'],
        ];
        // $role = Role::create(['name' => 'writer']);
        foreach ($privilages as $key => $value) {
            $permission = Permission::create($value);
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
        $user = User::find($request[0]);
        $userPrivilagesId = array_column($request[1], 'id');
        $systemPrivilages = Permission::all();
        foreach ($systemPrivilages as $key => &$sPri) {
            if (in_array($sPri->id, $userPrivilagesId)) {
                $user->givePermissionTo($sPri->id);
            } else {
                $user->revokePermissionTo($sPri->id);
            }
        }
        return $systemPrivilages;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $serialNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $serialNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $serialNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $serialNumber)
    {
        //
    }

    public function latest(Request $request)
    {
        if ($resp = Permission::where('type', $request->type)->latest()->first()) {
            return $resp->value + 1;
        } else {
            return 101;
        }
    }
}
