<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
//use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    //
    public function searchableIndex(Request $request){
         if ($request->ajax()) {
            $query =// User::with('roles')->get();
            DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'roles.name as role'
            );
            $dataTable= DataTables::of($query)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !is_null($request->input('search')['value'])) {
                        $search = $request->input('search')['value'];
                        $query->where('users.name', 'like', "%{$search}%");
                        // Add more columns to search as needed
                    }
                })
                 
                ->make(true);
                return $dataTable;
        }return view('user_roles.index');

    }
    public function index(Request $request)
    {
        
        $users = User::with('roles')->paginate(1); // Change 10 to the desired number of users per page
        $roles = Role::all();
        
        return view('user_roles.index', compact('users', 'roles'));
    }

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Validate the request
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Assign the role to the user
        $user->assignRole($request->input('role'));

        return redirect()->route('user-roles.index')->with('success', 'Role assigned successfully');
    }

    public function removeRole(Request $request, $userId, $roleName)
    {
        $user = User::findOrFail($userId);

        // Remove the role from the user
        $user->removeRole($roleName);

        return redirect()->route('user-roles.index')->with('success', 'Role removed successfully');
    }
    public function get_roles(){
        $roles = Role::all();
        return $roles;
    }

}
