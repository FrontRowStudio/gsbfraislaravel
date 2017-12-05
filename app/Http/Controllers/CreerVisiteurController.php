<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;
  
class CreerVisiteurController extends Controller
{
         public function AffFormCreerVisiteur(){
        $erreur="";
        return view('formCreerVisiteur', compact('erreur'));
        
    }
    
        public function InsertVisiteur(Request $request){
        $erreur="";
        $id =  $request->input('id');
        $nom = $request->input('nom');   
        $prenom = $request->input('prenom');   
        $login = null;  
        $mdp = null;   
        $adresse = $request->input('adresse');   
        $telephone = $request->input('telephone'); 
        $adresseMail = $request->input('mail'); 
        $cp = $request->input('cp'); 
        $ville = $request->input('ville'); 
        $dateEmbauche = $request->input('date'); 
        $statut = 'V';
        
        $gsbFrais = new GsbFrais();
        $res = $gsbFrais->InsertVisiteur($id, $nom, $prenom, $login, $mdp, $adresse, $telephone, $adresseMail, $cp, $ville, $dateEmbauche,$statut);
        if(empty($res))
            {
                $erreur = "Ajout Impossible";
                return view('formCreerVisiteur', compact('erreur'));
             }
        
       
        }
    
}
?>
