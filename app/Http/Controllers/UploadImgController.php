<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadImgController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'btn_file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = $request->user();

        if($user->avatar){
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('btn_file')->store('avatars', 'public');
        $user->update(['avatar'=>$path]);

        return back()->with('success', 'Avatar uploaded successfully');
    }
}
