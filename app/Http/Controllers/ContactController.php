<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private Setting $setting;

    public function __construct(){
        $this->setting = new Setting();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        if (Auth::check()) {
            $request->request->add(['user_id' => Auth::id()]);
        }
        $result = Contact::create($request->all());
        if ($result) {
            \request()->session()->flash('success', 'Message Sent Successfully');
        } else {
            \request()->session()->flash('error', 'Message Sent Failed');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
