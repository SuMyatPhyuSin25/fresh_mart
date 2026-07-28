<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //

    public function passwordChange(){

      return view('admin.profile.changePasswordPage');
    }

    public function editProfile(){

        return view('admin.profile.editProfilePage');
    }


    public function updateProfile(Request $request){

        $this->checkProfileValidation($request);
        $data = $this->getProfileData($request);

          if($request->hasFile('image')){

            //for not first user image upload

          if(Auth::user()->profile!==null){

            if(file_exists(public_path('/profile/' . Auth::user()->profile) )){

                unlink(public_path('/profile/'. Auth::user()->profile));
            }


        }
      
        //for first user image upload
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path(). '/profile/' , $fileName);
        $data['profile'] = $fileName;
        
    }else{

        $data['profile'] = Auth::user()->profile;
    }
    
    User::where('id', Auth::user()->id)->update($data);

    Alert::success('Success', 'Profile updated successfully.');

    return back();




    }

      private function getProfileData($request){

        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address
        ];
    }

    private function checkProfileValidation($request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'address'=>'max:200',
            'image'=>'file|mimes:jpg,jpeg,png,svg,avif'
        ]);


    }

    public function changePassword( Request $request){

      $adminPassword = Auth::user()->password;//db value


                        //plain text        //hash value
      if(Hash::check($request->oldPassword, $adminPassword)){
            
            $this->changePasswordValidation($request);

            User::where('id',Auth::user()->id)->update([

                'password'=>Hash::make($request->confirmPassword)//change into hash value

            ]);

            Alert::Success("Success", 'Password is changed successfully!');
            return back();





      }else{

      Alert::error('Process fail', "Old password does not match from our record!");

            return back();
      }
    }

    private function changePasswordValidation($request){

        $request->validate([
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6|max:12',
            'confirmPassword'=>'required|min:6|max:12|same:newPassword'
        ]);
    }
}
