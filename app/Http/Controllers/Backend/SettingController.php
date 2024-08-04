<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
class SettingController extends Controller
{
    public string $model_name = 'Setting';
    public string $base_route = 'backend.setting.';
    public string $base_view_folder = 'backend.setting.';
    public string $base_image_folder = 'assets/images/setting';

    public Setting $model;

    public function __construct()
    {
        $this->model = new Setting();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data['records'] = $this->model->all();
        return view($this->base_view_folder . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view($this->base_view_folder . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
        if ($request->hasFile('logo_file')) {
            $logo_file = $request->file('logo_file');
            $filename = time() . '_logo.' . $logo_file->getClientOriginalExtension();
            $logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['logo' => $filename]);
        }
        if ($request->hasFile('favicon_file')) {
            $favicon_file = $request->file('favicon_file');
            $filename = time() . '_favicon.' . $favicon_file->getClientOriginalExtension();
            $favicon_file->move($this->base_image_folder, $filename);
            $request->request->add(['favicon' => $filename]);
        }
        if ($request->hasFile('header_logo_file')) {
            $header_logo_file = $request->file('header_logo_file');
            $filename = time() . '_header_logo.' . $header_logo_file->getClientOriginalExtension();
            $header_logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['header_logo' => $filename]);
        }
        if ($request->hasFile('footer_logo_file')) {
            $footer_logo_file = $request->file('footer_logo_file');
            $filename = time() . '_footer_logo.' . $footer_logo_file->getClientOriginalExtension();
            $footer_logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['footer_logo' => $filename]);
        }
//        if($request->input())
        $record = $this->model->create($request->all());
        if ($record) {
            $request->session()->flash('success', $this->model_name . ' Created Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Creation Failed');
            return redirect(route($this->base_route . 'create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
//            abort(404);
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        return view($this->base_view_folder . 'show', compact('data'));
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
        return view($this->base_view_folder . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        if ($request->hasFile('logo_file')) {
            $logo_file = $request->file('logo_file');
            $filename = time() . '_logo.' . $logo_file->getClientOriginalExtension();
            $logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['logo' => $filename]);
            if ($data['record']->logo !== null && file_exists($this->base_image_folder . "/" . $data['record']->logo)) {
                unlink(public_path($this->base_image_folder . '/' . $data['record']->logo));
            }
        }
        if ($request->hasFile('favicon_file')) {
            $favicon_file = $request->file('favicon_file');
            $filename = time() . '_favicon.' . $favicon_file->getClientOriginalExtension();
            $favicon_file->move($this->base_image_folder, $filename);
            $request->request->add(['favicon' => $filename]);
            if ($data['record']->favicon !== null && file_exists($this->base_image_folder . "/" . $data['record']->favicon)) {
               unlink(public_path($this->base_image_folder . '/' . $data['record']->favicon));
            }
        }
        if ($request->hasFile('header_logo_file')) {
            $header_logo_file = $request->file('header_logo_file');
            $filename = time() . '_header_logo.' . $header_logo_file->getClientOriginalExtension();
            $header_logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['header_logo' => $filename]);
            unlink(public_path($this->base_image_folder . '/' . $data['record']->header_logo));
        }
        if ($request->hasFile('footer_logo_file')) {
            $footer_logo_file = $request->file('footer_logo_file');
            $filename = time() . '_footer_logo.' . $footer_logo_file->getClientOriginalExtension();
            $footer_logo_file->move($this->base_image_folder, $filename);
            $request->request->add(['footer_logo' => $filename]);
            unlink(public_path($this->base_image_folder . '/' . $data['record']->footer_logo));
        }

        $request->request->add(['updated_by' => auth()->user()->id]);

        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route($this->base_route . 'edit'));
        }
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
        $data['records'] = $this->model->onlyTrashed()->get();
        return view($this->base_view_folder . 'trash', compact('data'));
    }

    public function restore($id)
    {
//        $data['record'] = $this->>$this->model->onlyTrashed()->find($id);
        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
        if ($data['record']->restore()) {
            \request()->session()->flash('success', $this->model_name . ' Restored Successfully');
        } else {
            \request()->session()->flash('error', $this->model_name . ' Restore Failed');
        }
        return redirect()->route($this->base_route . 'trash');
    }

    public function remove($id)
    {
        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
        if ($data['record']->forceDelete()) {
            \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
            if ($data['record']->thumbnail && file_exists($this->base_image_folder . '/' . $data['record']->thumbnail)) {
                unlink(public_path($this->base_image_folder . '/' . $data['record']->thumbnail));
            }
        } else {
            \request()->session()->flash('error', $this->model_name . ' Deletion Failed');
        }
        return redirect()->route($this->base_route . 'trash');
    }
}
