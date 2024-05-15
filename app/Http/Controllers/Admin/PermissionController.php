<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class PermissionController 
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
        if(!auth()->user()->hasPermission('manage_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all user using Eloquent ORM
        $results                      = Permission::where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.permission.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required'
        ]);
        
        $all['name']                    = str_replace(' ', '_', strtolower($all['name']));
        $all['name_slug']               = Str::slug($all['name']);
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        Permission::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = Permission::findOrFail($id);
        return view('admin.permission.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
        ]);

        $all['name']                    = str_replace(' ', '_', strtolower($all['name']));
        $all['name_slug']               = Str::slug($all['name']);
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = Permission::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        if(!auth()->user()->hasPermission('delete_permissions'))
        {
            abort(404, 'You are not Authorised...');
        }

        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Permission::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_active = ($results->is_active === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('permission.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
