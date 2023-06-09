<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\History;
class UserController extends Controller
{
    public function viewRegister()
    {
        return view("user.account.register");
    }

    public function viewLogin()
    {
        return view("user.account.login");
    }

    public function viewCash()
    {
        return view("user.account.cash",['user' => Auth::user()]);
    }

    public function viewIndex()
    {
        return view("user.account.index",['user' => Auth::user()]);
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        // Retrieve the user from the database
        $user = User::where('name', $name)->first();
        // Check if the user exists and the password is correct
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);

            Session::reflash();

            session(['aluno_id' => $user->id]);

            return redirect()->route('home');
        }

        // Credenciais inválidas
        return redirect()->back()->with('error', 'Credenciais inválidas.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-user')->with('success', 'Logout realizado com sucesso.');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        Auth::login($user);

        return view('user.account.index',['user' => $user]);
    }

    public function updateCash(Request $request)
    {
        $user = User::find(Auth::id());
        $user->cash += $request->cash;
        $user->save();

        return redirect()->route('user.account.index')->with('message','Saldo Atualizado!');
    }

    public function updateCashInGaming(Request $request)
    {
        try{
            $user = User::find($request->user_id);
            $user->cash = $request->novoSaldo;
            $user->save();

            $history = new History;
            $history->user_id = $request->user_id;
            $history->game_id = $request->game_id;
            $history->won = $request->won;
            $history->new_cash = $request->novoSaldo;
            $history->bet_amount = $request->alteracao_saldo;
            $history->save();

            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }          
    }

}
