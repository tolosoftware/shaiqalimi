<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAssignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function user(Request $request){
        return $request->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
  
        //  return User::select('lastName','firstName')->get();
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
        // $this->validate($request,[
        //     'name' => 'required|string|max:191',
        //     'email' => 'required|string|email|max:191|unique:users',
        //     'password' => 'required|string|min:6'
        // ]);

        DB::beginTransaction();
        try {

            $photoname = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('img/user/').$photoname);
            $request->merge(['photo' => $photoname]);

            $user = User::create([
                'firstName' => $request['firstName'],
                'lastName' => $request['lastName'],
                'user_type' =>$request['user_type']['value'],
                'position' => $request['position'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => Hash::make($request['password']),
                'image' => $photoname,
            ]);

            if($request->userleaders != null){
                foreach ($request->userleaders as $key => $val) {
                    UserAssignment::create(['lead_user_id' => $val['id'], 'user_id'=> $user->id]);
                }
            }

        DB::commit();
        return ['msg' => 'user successfully inserted'];
    } catch (Exception $e) {
        DB::rollback();
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // $user['userleaders'] = UserAssignment::where('lead_user_id', $id)->get();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photoname = NULL;
        if($request->image != null){
            if (strpos($request->image, 'base64')) {
                $photoname = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
                \Image::make($request->image)->save(public_path('img/user/').$photoname);
                $request->merge(['photo' => $photoname]);
            }else
            {
                $photoname = $request->image;
            }
        }
       

        $user = User::findOrFail($id);
        $request['password'] =  Hash::make($request['password']);
        $request['image'] =  ($photoname) ? $photoname : '';
        $user->update($request->all());
        // if($request->userleaders != null){
        //     foreach ($request->userleaders as $key => $val) {
        //         if(!UserAssignment::where(['lead_user_id' => $val['id'], 'user_id'=> $id])->get()){
        //             UserAssignment::create(['lead_user_id' => $val['id'], 'user_id'=> $id]);
        //         }
        //     }
        // }
        return ["message"=>"موفقانه معلومات اصلاح شد"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User Deleted'];
    }
}
