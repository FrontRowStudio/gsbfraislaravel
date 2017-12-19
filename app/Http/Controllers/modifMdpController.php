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
        $pwd = md5($pwd);
        $gsbFrais = new GsbFrais();
        $res = $gsbFrais->getInfosVisiteur($login,$pwd);
        if(empty($res))
            {
                $erreur = "mot de passe inconnu !";
                return view('formModifMdp', compact('erreur'));
             }
        
                
         $npwd = $request->input('npwd');
         $npwd = md5($npwd);
         $n2pwd = $request->input('n2pwd'); 
         $n2pwd = md5($n2pwd);
          
          if($npwd == $n2pwd)
          {
              $gsbFrais->MiseajourBDD($login,$npwd);
              
              $succes = "Mis à jour avec succés !";
               return view('formModifMdp', compact('erreur','succes'));
          }
           else
           {
                   $erreur = "Mis à jour impossible";
                   return view('formModifMdp', compact('erreur'));
           }
       
       
        }
    }


