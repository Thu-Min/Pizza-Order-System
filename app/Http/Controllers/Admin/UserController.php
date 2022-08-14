<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // user page
    public function userList()
    {
        $userData = User::where('role', 'user')->paginate(5);

        return view('admin.user.userList')->with(['user' => $userData]);
    }

    // admin page
    public function adminList()
    {
        $userData = User::where('role', 'admin')->paginate(5);

        return view('admin.user.adminList')->with(['user' => $userData]);
    }

    // user search
    public function userSearch(Request $request)
    {
        $response = $this->search($request->searchData, 'user', $request);

        return view('admin.user.userList')->with(['user' => $response]);

    }

    // delete user / admin
    public function userDelete($id)
    {
        User::where('id', $id)->delete();

        return back()->with(['deleted' => 'Account Deleted!']);
    }

    // admin search
    public function adminSearch(Request $request)
    {

        $response = $this->search($request->searchData, 'admin', $request);

        return view('admin.user.adminList')->with(['user' => $response]);
    }

    // data searching
    private function search($key, $role, $request)
    {
        $searchData = User::where('role', $role)
            ->where(function ($query) use ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%')
                    ->orWhere('email', 'like', '%' . $key . '%')
                    ->orWhere('phone', 'like', '%' . $key . '%')
                    ->orWhere('address', 'like', '%' . $key . '%');
            })
            ->paginate(5);
        $searchData->appends($request->all());
        return $searchData;
    }

}
