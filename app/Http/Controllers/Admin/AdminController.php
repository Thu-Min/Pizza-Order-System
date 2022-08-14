<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // profile page
    public function profile()
    {
        $id = auth()->user()->id;

        $data = User::where('id', $id)->first();

        return view('admin.profile.index')->with(['userData' => $data]);
    }

    // update profile
    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->requestUserData($request);
        User::where('id', $id)->update($updateData);

        return back()->with(['updateSuccess' => "User Information Updated!"]);
    }

    // change password page
    public function changePasswordPage($id)
    {
        return view('admin.profile.changePasswordPage');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $oldPass = $request->oldPassword;
        $newPass = $request->newPassword;
        $confirmPass = $request->confirmPassword;

        $dbPassword = User::select('password')->where('id', $id)->first();
        $dbHashPassword = $dbPassword['password'];

        if (Hash::check($oldPass, $dbHashPassword)) {
            if ($newPass != $confirmPass) {
                return back()->with(['notSame' => 'New Passwords must be the same']);
            } else {
                if (strlen($newPass) <= 6 && strlen($confirmPass) <= 6) {
                    return back()->with(['lengthError' => 'Password Must Longer Than 6 Character']);
                } else {
                    $hash = Hash::make($newPass);
                    User::where('id', $id)->update([
                        'password' => $hash,
                    ]);
                    return redirect()->route('admin#profile')->with(['success' => 'Password Changed!']);
                }
            }
        } else {
            return back()->with(['notMatch' => 'Password do not match try again!']);
        }
    }

    private function requestUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}
