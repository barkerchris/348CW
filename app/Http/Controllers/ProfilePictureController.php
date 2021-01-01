<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ProfilePicture;

class ProfilePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ProfilePicture  $profilePicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilePicture $profilePicture)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validatedData = $request->validate([
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);
                $filename = $validatedData['image']->getClientOriginalName();
                $validatedData['image']->storeAs('images', $filename, 'public');
                if ($profilePicture->avatar != 'default.jpg') {
                    Storage::delete('/public/images/'.$profilePicture->avatar);
                }
                $profilePicture->avatar = $filename;
            }
        }

        $validatedData2 = $request->validate([
            'description' => 'required|max:255',
        ]);
        $profilePicture->description = $validatedData2['description'];

        $profilePicture->save();

        return redirect()->back()->with('message', 'Image was edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
