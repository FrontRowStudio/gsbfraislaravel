<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class modifMdpController extends Controller
{
      public function affFormModifMdp(){
        $erreur="";
        return view('formModifMdp', compact('erreur'));
        
    }
    
    public function verifMdp(Request $request){
         $erreur="";
        $login = Session::get('login');
        $pwd = $request->input('pwd');   
        $gsbFrais = new GsbFrais();
        $res = $gsbFrais->getInfosVisiteur($login,$pwd);
        if(empty($res))
            {
                $erreur = "mot de passe inconnu !";
                return view('formModifMdp', compact('erreur'));
             }
        
                
         $npwd = $request->input('npwd');   
         $n2pwd = $request->input('n2pwd'); 
          
          if($npwd == $n2pwd)
          {
              $gsbFrais->MiseajourBDD($login,$npwd);
               return redirect()->back()->with('status', 'Mise à jour effectuée!');
          }
           else
           {
                   $erreur = "Mis à jour impossible";
                   return view('formModifMdp', compact('erreur'));
           }
       
       
        }
    }


