<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;
  
class CreerModifInfoController extends Controller
{
        
     public function affFormModifInfo(){
        $erreur="";
        $id = Session::get('id');
        $gsbFrais = new GsbFrais();
        $modifinfo = $gsbFrais->AfficherInfoModif($id);
        return view('formModifInfo', compact('erreur','modifinfo'));
     }
     
        public function ModifVisiteur(Request $request){
        $erreur=""; 
        $id = Session::get('id');
        $adresse = $request->input('adresse');   
        $telephone = $request->input('telephone'); 
        $adressemail = $request->input('mail'); 
        $cp = $request->input('cp'); 
        $ville = $request->input('ville');
        $gsbFrais = new GsbFrais();
        
        
        $gsbFrais->MAJ_InfoPerso($id, $adresse, $cp, $ville, $adressemail, $telephone);
        $modifinfo = $gsbFrais->AfficherInfoModif($id);
        $retour="La modification a réussi";
        return view('formModifInfo', compact('erreur','modifinfo','retour'));        
        }
        
        
       
    
}

