<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminUserController 
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
        if(!auth()->user()->hasPermission('manage_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        $searchQuery = $request->input('search');
        $results                      = Admin::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all user using Eloquent ORM
        // $results                      = Admin::where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.admin_user.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        if(!auth()->user()->hasPermission('create_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        
        $roles                          = Role::all();
        return view('admin.admin_user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'role_id' => 'required'
        ]);
        $uname                          = explode("@",$all['email']);
        $all['name']                    = ucfirst($all['name']);
        $all['email']                   = strtolower($all['email']);
        $all['username']                = $uname[0];
        $all['password']                = Hash::make($all['password']);
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        Admin::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('admin_user.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = Admin::findOrFail($id);
        return view('admin.admin_user.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = Admin::findOrFail($id);
        $roles                          = Role::all();
        return view('admin.admin_user.edit', compact('results', 'roles'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_users'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'username' => 'required'
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = Admin::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('admin_user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Admin $user)
    {
        if(!auth()->user()->hasPermission('delete_users'))
        {
            abort(404, 'You are not Authorised...');
        }

        $user->delete();
        return redirect()->route('admin_user.index')->with('success', 'User deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Admin::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_active = ($results->is_active === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('admin_user.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
