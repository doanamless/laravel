<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\vehicule;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }

    public function registerUser(Request $request){
        $request->validate([
            'name' =>['required','min:3','max:50'],
            'email' =>'required |email|unique:users',
            'password' =>['required','min:7','max:200'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if($res){
            return back()->with('success','You have registered successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
    }
    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else {
                return back()->with('fail', 'Password does not match');
            }
        }else{
            return back()->with('fail', 'This email is not registered');
        }
    }

    public function dashboard(){
        return view('auth.dashboard');
    }
//    public function saveData(Request $request){
//        $validateData = $request->validate([
//            'Designation'=>'required|string',
//            'marque'=>'required|string',
//            'prix'=>'required|integer',
//            'date_aquisition'=>'required|date',
//            'prem_km'=>'required|integer',
//            'puissance'=>'required|string',
//            'consommation'=>'required|string',
//            'carburant'=>'required|string',
//            'reference'=>'required|string',
//        ]);
//
//        $data = new Data();
//        $data->designation=$validateData['designation'];
//        $data->maque=$validateData['marque'];
//        $data->prix=$validateData['prix'];
//        $data->date_aquisition=$validateData['date_aquisition'];
//        $data->prem_km=$validateData['prem_km'];
//        $data->puissance=$validateData['puissance'];
//        $data->consommation=$validateData['consommation'];
//        $data->carburant=$validateData['carburant'];
//        $data->reference=$validateData['reference'];
//        $data->save();
//        return response()->json(['message' => 'Data saved successfully']);
//    }

    public function store(Request $request){
        vehicule::create($request->all());
//        $vehiculeId= $request->id;
//        $vehicule = vehicule::updateOrCreate(
//            ['id' =>$vehiculeId],
//            ['designation'=>$request->designation,
//             'marque'=>$request->marque,
//             'prix'=>$request->prix,
//             'date_aquisition'=>$request->date_aquisition,
//             'prem_km'=>$request->prem_km,
//             'puissance'=>$request->puissance,
//             'consommation'=>$request->consommation,
//             'carburant'=>$request->carburant,
//             'reference'=>$request->reference,
//                ]);
////        var_dump($vehicule);
//        return Response()->json($vehicule);
    }
//    public function dashboard(){
//
//        $data = array();
//        if(Session::has('loginId')){
//            $data = User::Where('id','=',Session::has('loginId'))->first();
//        }
//        return view('auth.dashboard',compact('data'));
//    }
//
//    public function logout(){
//        if(Session::has('loginId')){
//            Session::pull('loginId');
//            return redirect('login');
//        }
//    }
}

