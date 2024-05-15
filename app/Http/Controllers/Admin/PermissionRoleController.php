<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class PermissionRoleController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all user using Eloquent ORM
        $results                      = PermissionRole::where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.permission_role.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        $roles                      = Role::where('status', 1)->orderBy('id', 'DESC')->get(); 
        return view('admin.permission_role.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_roles'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();

        $roleId                         = $all['role_id'];
        $permission                     = $all['permission'];

        // Use the where clause to get all records with the specific roleId
        $recordsToDelete                = PermissionRole::where('role_id', $roleId)->get();

        // Perform permanent delete on each record
        if(count($recordsToDelete) > 0)
        {
            foreach ($recordsToDelete as $record) {
                $record->delete();
            }
        }

        $records = [];

        foreach ($permission as $item) {
            // Validate the data as needed
            // For example: if (!$this->validateData($item)) { return redirect()->back()->with('error', 'Invalid data.'); }

           

            $record = [
                'role_id' => $roleId,
                'permission_id' => $item,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                // Add more fields as needed
            ];

            $records[] = $record;
        }

        PermissionRole::insert($records);


        // Redirect to the index page with a success message
        return redirect()->route('permission_role.index')->with('success', 'Role permission created successfully.');
    }

    public function getAllPermissions($roleId)
    {
        $permissions = Permission::with(['permissionRoles' => function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        }])->where('status', 1)->get()->toArray();

        $permissionRoles = [];
        $i=0;
        foreach ($permissions as $key => $permission) {
          
            if($permission['permission_roles'])
            {
                $permissionRoles[$i]['id'] = $permission['id'];
                $permissionRoles[$i]['name'] = getPermissionNamebyId($permission['permission_roles'][0]['permission_id'])->toArray();
                $permissionRoles[$i]['role_permission'] = $permission['permission_roles'];
            }
            else
            {
                $permissionRoles[$i]['id'] = $permission['id'];
                $permissionRoles[$i]['name']['name'] = $permission['name'];
                $permissionRoles[$i]['role_permission'] = [];
            }
            $i++;
        }        
        return response()->json($permissionRoles);
    }

    
    
    
}
