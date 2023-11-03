<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Hash;
use Intervention\Image\Facades\Image;
// use Image;

class UserController extends Controller
{
    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user =  User::all();
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
        }

        $users = User::get();

        return view('user.user', compact('data_user'));
    }
    public function destroy(User $user) : RedirectResponse
    {
        if ($user->photo) {
            $photoPath = public_path('photos/' . $user->photo);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
            $user->photo = null;
            $user->save();
        }
    
        return redirect()->route('users')->with('success', 'User photo is deleted successfully.');
    }

    public function edit(User $user)
    {
    return view('user.edit', compact('user'));}

    public function update(Request $request, User $user)
    {
        // User ::create($request->all());
        $request->validate([
            'name' => 'required|string|max:250',
            'photo' => 'image|nullable|max:1999',
        ]);

        $user->name = $request->input('name');
        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs($filenameSimpan);
            if ($user->photo) {
                $photoPath = public_path('photos/original/'. $user->photo);
                if (File::exists($photoPath)) {
                    File::delete($photoPath);
                }
            }

            $user->photo = $path;
            $user->save();
        } else {
        }

        return redirect()->route('users')
            ->with('success', 'User photo is updated successfully.');
    }



    public function resizeForm(User $user)
    {
    return view('user.resize', compact('user'));}


    public function resizeImage(Request $request, User $user)
    {
        $this->validate($request, [
            'size' => 'required|in:thumbnail,square',
            'photo' => 'required|string',
        ]);

        $size = $request->input('size');
        $photo = $request->input('photo');

        $originalPath = public_path('storage/photos/original/' . $photo);
        $resizedPath = public_path('storage/photos/resizedPath'.$photo);
        $thumbnailPath = public_path('storage/photos/resizePhotos/thumbnail'. $photo); 
        $squarePath = public_path('storage/photos/resizePhotos/square'. $photo); 


        if ($size === 'thumbnail') {
            // Resize to thumbnail size (160 x 90)
            // $image = $user->photo::make($originalPath);
            Image::make($image)->save($originalPath);
            Image::make($image)
            ->fit(100, 100)
            ->save($thumbnailPath);
        } elseif ($size === 'square') {
            // Resize to square size (90 x 80)
            // $image = $user->photo::make($originalPath);
            $image = Image::make($originalPath);
            $image->fit(90, 90);
            $image->save($resizedPath);
        }
        // Redirect kembali ke halaman user.blade.php
        return redirect()->route('user.resize')->with('success', 'User photo is resize successfully.');
    }

}