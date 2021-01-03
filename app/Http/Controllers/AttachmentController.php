<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AttachmentController extends Controller
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
     * @param int $id
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function create(int $id, string $type)
    {
        return view('attachments.create', ['id' => $id, 'type' => $type]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $valid = $request->validate([
                'id' => 'required|int',
                'type' => 'required',
            ]);
            foreach ($request->file as $file) {
                if ($file->isValid()) {
                    $validator = Validator::make($request->file, [
                        'file' => 'mimes:png,jpg,pdf,docx,pptx,txt|max:1014',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors('File validation failed.');
                    }
                    $filename = $file->getClientOriginalName();
                    $file->storeAs('files', $filename, 'public');


                    $prefix = "App\\";
                    $a = new Attachment;
                    $a->file = $filename;
                    $a->attachmentable_type = $prefix.$valid['type'];
                    $a->attachmentable_id = $valid['id'];
                    $a->save();
                }
            }
        }

        return redirect()->route('posts.index')->with('message', 'Attachments added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        return response()->download('storage/files/'.$attachment->file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param string $type
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, string $type, Attachment $attachment)
    {
        if (Storage::exists('/public/files/'.$attachment->file)) {
            if ($attachment->attachmentable->count() > 1) {
                ("App\\".$type)::find($id)->attachments->find($attachment->id)->delete();
            } else {
                Storage::delete('/public/files/'.$attachment->file); 
            }
        } else {
            return redirect()->back()->withErrors('File does not exist.');
        }

        return redirect()->back()->with('message', 'Attachment deleted.');
    }
}
