<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct(){
        //This will use the middleware of authentication to ensure that the staff is login (for very basic one) or we can do the customization for afterwards if any (like the user must be verify)
        $this->middleware(['auth']);
    }

    public function edit(Request $request){
        return view('profiles.edit')->with([
            //$request->user() OR Auth::user() would return the current user
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileRequest $request){
        $user = $request->user();

        //Array_filter method will filter out any fields that is null
        //This fill method will call the setpasswordattribute in the user model php file automatically
        //$request->validated() would return the array that has been validated or if no, error will be returned
        $user->fill(array_filter($request->validated()));

        //isDirty method will determine that whether the email has changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            //Send the email verification again to the user
            $user->sendEmailVerificationNotification();
        }

        //Save the current user details to the database
        $user->save();

        //hasFile is mainly used for checking any file is uploaded
        if($request->hasFile('image')){

            if($user->image != null){
                //Since we are registering the new user, all their profile image uploaded will be stored to the storage
                Storage::disk('images')->delete($user->image->path);
                $user->image->delete();
            }

            $user->image()->create([
                //This line will return the path to the uploaded image by the user inside the (users) subfolder in the images disk path as defined in the filesystems.php
                //there must be a images/xx infront of the attribute (in this case is users)
                'path' =>  $request->image->store('users', 'images'),
            ]);
            
        }

        return redirect()->route('profile.edit')->withSuccess('Profile edited');
    }
}
