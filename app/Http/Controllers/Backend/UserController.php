<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public string $model_name = 'User';
    public string $base_route = 'backend.user.';
    public string $base_view_folder = 'backend.user.';
    public string $base_image_folder = 'assets/images/user';

    public User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $users = $this->model->all();
        return view($this->base_view_folder.'index', compact('users'));
    }

    public function search($query)
    {
        dd($query);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->model->findOrFail($id);
        return view($this->base_view_folder.'show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        if ($data['record']->getRoleNames()[0] == 'admin') {
            \request()->session()->flash('error', 'This '.$this->model_name . ' is not editable');
            return redirect(route($this->base_route . 'index'));
        }
        $data['roles'] = Role::all();
        $data['roles']->shift();
//        dd($data['roles']);
        return view($this->base_view_folder . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }

        if ($data['record']->update(['status'=> $request->status])) {
            $data['record']->syncRoles($request->role);
            \request()->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route($this->base_route .'edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
