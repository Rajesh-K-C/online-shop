<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public string $model_name = 'Role';
    public string $base_route = 'backend.role.';
    public string $base_view_folder = 'backend.role.';
    public string $base_image_folder = 'assets/images/role';

    public Role $model;

    public function __construct()
    {
        $this->model = new Role();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = $this->model->all();
        return view($this->base_view_folder . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['records'] = Permission::all();
        return view($this->base_view_folder . 'create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
//        $request->request->add(['created_by' => Auth::user()->id]);
//        if ($request->hasFile('logo_file')) {
//            $logo_file = $request->file('logo_file');
//            $filename = time() . '_logo.' . $logo_file->getClientOriginalExtension();
//            $logo_file->move($this->base_image_folder, $filename);
//            $request->request->add(['logo' => $filename]);
//        }
//        if($request->input())
//        dd($request->all());
        $record = $this->model->create($request->all());
        if ($record) {
            if ($record->syncPermissions($request->permission)) {
                $request->session()->flash('success', $this->model_name . ' Created Successfully');
                return redirect(route($this->base_route . 'index'));
            }
            $record->delete();
        }
        $request->session()->flash('error', $this->model_name . ' Creation Failed');
        return redirect(route($this->base_route . 'create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        $data['record'] = $this->model->find($id);
//        if ($data['record'] == null) {
////            abort(404);
//            \request()->session()->flash('error', $this->model_name . ' Not Found');
//            return redirect(route($this->base_route . 'index'));
//        }
//        return view($this->base_view_folder . 'show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['record'] = $this->model->with('permissions')->find($id);
        $data['permissions'] = Permission::all();
        $data['permissionIds'] = $data['record']->permissions->pluck('id');
//        dd($data);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        return view($this->base_view_folder . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
//        if ($request->hasFile('logo_file')) {
//            $logo_file = $request->file('logo_file');
//            $filename = time() . '_logo.' . $logo_file->getClientOriginalExtension();
//            $logo_file->move($this->base_image_folder, $filename);
//            $request->request->add(['logo' => $filename]);
//            if ($data['record']->logo !== null && file_exists($this->base_image_folder . "/" . $data['record']->logo)) {
//                unlink(public_path($this->base_image_folder . '/' . $data['record']->logo));
//            }
//        }
//
//        $request->request->add(['updated_by' => auth()->user()->id]);
//        dd($request->permission);
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
            $record = $data['record']->update(['permission' => $request->permission]);
        } else {
            $record = $data['record']->update($request->all());
        }
        if ($record) {
            if ($data['record']->syncPermissions($request->permission)) {
                $request->session()->flash('success', $this->model_name . ' Update Successfully');
                return redirect(route($this->base_route . 'index'));
            }
            $request->session()->flash('error', 'Permissions Update Failed');
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
        }
        return redirect(route($this->base_route . 'edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        } else {
            if ($data['record']->delete()) {
                \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
            } else {
                request()->session()->flash('error', $this->model_name . ' Deletion Failed');
            }
            return redirect()->route($this->base_route . 'index');
        }
    }

    public function trash()
    {
//        $data['records'] = $this->model->onlyTrashed()->get();
//        return view($this->base_view_folder . 'trash', compact('data'));
    }

    public function restore($id)
    {
//        $data['record'] = $this->>$this->model->onlyTrashed()->find($id);
//        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
//        if ($data['record']->restore()) {
//            \request()->session()->flash('success', $this->model_name . ' Restored Successfully');
//        } else {
//            \request()->session()->flash('error', $this->model_name . ' Restore Failed');
//        }
//        return redirect()->route($this->base_route . 'trash');
    }

    public function remove($id)
    {
//        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
//        if ($data['record']->forceDelete()) {
//            \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
//            if ($data['record']->thumbnail && file_exists($this->base_image_folder . '/' . $data['record']->thumbnail)) {
//                unlink(public_path($this->base_image_folder . '/' . $data['record']->thumbnail));
//            }
//        } else {
//            \request()->session()->flash('error', $this->model_name . ' Deletion Failed');
//        }
//
//        return redirect()->route($this->base_route . 'trash');
    }

    public function givePermission($id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        return view($this->base_view_folder . 'add_permission', compact('data'));
    }
}
