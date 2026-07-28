<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    //

    public function customerPasswordChange(){

      return view('customer.customerProfile.changePasswordPage');

    }

    public function editProfile(){

        return view('customer.customerProfile.editProfilePage');
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

    // Alert::success('Profile updated successfully.');
    alert()->success('Success Title','Profile updated successfully.');


    return back();


    }

    public function updatePassword(Request $request){

       

        $currentUserPassword = Auth::user()->password;//db value

        if(Hash::check($request->oldPassword, $currentUserPassword)){
             $this->changePasswordValidation($request);

             User::where('id', Auth::user()->id)->update([
                'password'=>Hash::make($request->confirmPassword)

             ]);

                Alert::success('Success Title', 'Password changed successfully.');
                return back();


        }else{
            Alert::error('Error Title', 'Current password is incorrect.');
            return back();
        }


    }

    private function getProfileData($request){

        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
    }

    private function checkProfileValidation($request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'phone'=>'required|min:6|max:12',
            'address'=>'max:200',
            'image'=>'file|mimes:jpg,jpeg,png,webp,svg,avif',
        ]);
    }

    
    private function changePasswordValidation($request){

        $request->validate([
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6|max:12',
            'confirmPassword'=>'required|min:6|max:12|same:newPassword'
        ]);
    }
}
