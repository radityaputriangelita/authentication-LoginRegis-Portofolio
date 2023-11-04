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
        $request->validate([
            'name' => 'required|string|max:250',
            'photo' => 'image|nullable|max:1999',
        ]);

        $user->name = $request->input('name');
        if ($request->hasFile('photo')) {
            $photoPath = public_path('photos/original'. $user->photo);
            if (File::exists($photoPath)) 
            {
                File::delete($photoPath);
            }
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('photo/original',$filenameSimpan);

            $user->photo = $filenameSimpan;
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
        
        if (Storage::exists('photo/original/' . $user->photo)) {
            $originalImagePath = public_path('storage/photo/original/' . $user->photo);
        
            if ($size === 'thumbnail') {
                $resizedImage = Image::make($originalImagePath);
                $resizedImage->fit(160, 90);
                $resizedImage->save(public_path('storage/photo/thumbnail/' . $user->photo));
            } elseif ($size === 'square') {
                $resizedImage = Image::make($originalImagePath);
                $resizedImage->fit(100, 100);
                $resizedImage->save(public_path('storage/photo/square/' . $user->photo));
            }
        }
        return view('user.resize', compact('user'))->with('success', 'User photo is resized successfully.');
    }

}