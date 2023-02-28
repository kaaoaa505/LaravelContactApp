<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        // $data = $request->validated();

        // if($request->hasFile('image')){
        //     $image_path = $request->file('image')->store('uploads', 'public');
        //     $data['image'] = $image_path;
        // }

        auth()->user()->update($request->handleRequestWithImageUpload());

        return back()->with('success', 'Profile updated successfully.');
    }
}
