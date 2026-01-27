<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateRequest;
use App\Http\Requests\Web\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(5);
        return view('admin.home.welcome', compact('users'));
    }
    public function create(){
        return view('admin.home.create');
    }
    public function store(CreateRequest $request){
        $data = $request->validated();
        User::query()->create($data);
        return redirect()->route('home');
    }

    public function edituser(User $user)
    {
        return view('admin.home.edit.edit', compact('user'));
    }

    public function update(EditRequest $request, User $user)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        if (isset($data['mobile']) && $data['mobile'] === $user->mobile) {
            unset($data['mobile']);
        }

        $user->update($data);
        return redirect()->route('edituser', $user->id)->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home')->with('success', 'User deleted successfully');
    }
}
