<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\throwException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    public function edit(){
        return view('member.update');
    }
    public function update(Request $request){
        $request->validate([
            'user_image' => 'required|image|file',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);
        $name = $request->file('user_image')->getClientOriginalName();
        $request->file('user_image')->storeAs('public/images/', $name);
        // $user = Auth::user();
        // $image = '/storage/images/' . $user->user_image;
        // $path = str_replace('\\', '/', public_path());
        // unlink($path . $image);
        // $name = $request->file('user_image')->getClientOriginalName();
        // $request->file('item_image')->storeAs('public/images', $name);
            auth()->user()->update([
                'user_image' => $name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        return redirect('/home')->with('status','Profile Berhasil Diupdate');
    }
    public function editPassword(){
        return view('member.update-password');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'confirmed',
             Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
        ]);
        if(Hash::check($request->current_password, auth()->user()->password)){
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }else{
            return redirect('/edit-password')->with('status','Current Password is Wrong');
        }

        return redirect('/home')->with('status','Password Berhasil Diupdate');
    }
}
