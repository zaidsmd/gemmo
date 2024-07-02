<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Exercice;
use App\Services\LimiteService;
use App\services\LocaleService;
use App\Services\ReferenceService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Tenant;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function se_connecter()
    {
        if (Auth::check())
            return redirect('/');
        return view('auth.se_connecter');
    }


    public function authentifier(Request $request): RedirectResponse
    {
        $request->validate([
            'i_email' => ['required', 'email'],
            'i_password' => ['required'],
        ]);
        $credentials = [
            'email'=> $request->get('i_email'),
            'password'=> $request->get('i_password'),
        ];
        $remember = $request->get('i_souviens')==='on';
        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();
            LocaleService::getLocale();
            LocaleService::setSessionLocales();
            return redirect()->to('/');
        }
        return redirect()->route('auth.se-connecter')->withInput($request->only('i_email'))->withErrors(['i_email' => "Les informations d'identification fournies ne correspondent pas."]);
    }

    public function se_deconnecter()
    {
        Auth::logout();
        return redirect('/');
    }

    public function modifier_mot_de_passe(){
        $user =auth()->user();
        $email = $user->email;
        $results = DB::table('authentication_log')
            ->select('authentication_log.*', 'users.name as user_name')
            ->join('users', 'authentication_log.authenticatable_id', '=', 'users.id')
            ->orderBy('authentication_log.login_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($row) {
                $location = json_decode($row->location, true);
                $row->location = $location['city'] . ', ' . $location['country'];
                return $row;
            });
        return view('auth.modifier_mot_de_passe' , compact('email', 'results'));
    }

    public function sauvegarder(Request $request){

        try {

            $validator = Validator::make($request->all(), [
                'i_ancien_mot_de_passe' => 'required',
                'i_nouveau_mot_de_passe' => 'required|min:8|different:i_ancien_mot_de_passe',
                'i_confirmer_mot_de_passe' => 'required|same:i_nouveau_mot_de_passe',
            ], [
                'i_nouveau_mot_de_passe.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
                'i_nouveau_mot_de_passe.different' => 'Le nouveau mot de passe ne peut pas être identique à l\'ancien.',
                'i_confirmer_mot_de_passe.same' => 'La confirmation du mot de passe ne correspond pas.',
            ]);

            $user = auth()->user();
            if (!Hash::check($request->i_ancien_mot_de_passe, $user->password)) {
                return redirect()->back()->withErrors(['i_ancien_mot_de_passe' => 'L\'ancien mot de passe est incorrect.'])->withInput();
            }
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->password = Hash::make($request->i_nouveau_mot_de_passe);
            $user->save();

            return redirect()->back()->with('success','Mot de passe mis à jour avec succès');

        }catch(\Exception $e) {
            return redirect()->back()->with('erreur','Une erreur est survenue lors de la mise à jour du mot de passe.');
        }

    }

    public function sauvegarder_email(Request $request){

        try {
            $user = auth()->user();
            $validator = Validator::make($request->all(), [
                'email'=>['required','email',Rule::unique('users','email')->ignore($user->id)] ,
                'mot_de_passe'=>'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if(!Hash::check($request->get('mot_de_passe') , $user->password)){
                return redirect()->back()->withErrors(['mot_de_passe' => 'Le mot de passe est incorrect.'])->withInput();

            }

            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with('success','Email mis à jour avec succès');
        }catch (\Exception $e){
            return redirect()->back()->with('erreur','Une erreur est survenue lors de la mise à jour de l\'email.');
        }

    }



}
