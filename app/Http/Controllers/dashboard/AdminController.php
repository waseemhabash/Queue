<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use App\Models\Role_user;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=User::where("type","admin")->where('id',"!=",auth()->id())->get();
        return view('dashboard.admins.index',compact('admins','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();

        return view('dashboard.admins.add',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin=New User();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->phone=$request->phone;
        $admin->type="admin";
        if($request->password==$request->rePassword){
            $admin->password=bcrypt ($request->password);
        }
        $admin->save();
        
        /*foreach ($request->roles as $role) {
          $role_user = new Role_user();
          $role_user->user_id = $admin->id;
          $role_user->role_id = $role;
          $role_user->save();
      }

      $role_user->save();
*/
      return redirect('dashboard/admins');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {

       $roles=Role::all();

       return view('dashboard.admins.edit',compact('roles','admin'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->phone=$request->phone;
        $admin->type="admin";
        if($request->password){
            if($request->password==$request->rePassword){
                $admin->password=bcrypt ($request->password);
            }
        }

        $admin->update();

        /*foreach ($request->roles as $role) {
          $role_user = new Role_user();
          $role_user->user_id = $admin->id;
          $role_user->role_id = $role;
          $role_user->save();
      }
      $role_user->save();
*/

      return redirect('dashboard/admins');    
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('dashboard/admins');
    }
}
