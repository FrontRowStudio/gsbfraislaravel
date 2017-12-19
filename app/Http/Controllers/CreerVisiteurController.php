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
        $gsbFrais = new GsbFrais();
        $id =  $request->input('id');
        $nom = $request->input('nom');   
        $prenom = $request->input('prenom');  
        $j =  substr($prenom, 0, 1);
        $jstr = strtolower($j);
        $login = $jstr.strtolower($nom);  
        $mdpnonhasher = $gsbFrais->Genere_Password(4);
        $mdp = md5($mdpnonhasher);  
        $adresse = $request->input('adresse');   
        $telephone = $request->input('telephone'); 
        $adresseMail = $request->input('mail'); 
        $cp = $request->input('cp'); 
        $ville = $request->input('ville'); 
        $dateEmbauche = $request->input('date'); 
        $statut = 'V';
        
        
        
       
        $test = $gsbFrais->CompareTo($nom, $prenom);
           if(empty($test))
           {
                $retour =  "Votre login : " . $login . " Votre mot de passe : ". $mdpnonhasher;
                $gsbFrais->InsertVisiteur($id, $nom, $prenom, $login, $mdp, $adresse, $telephone, $adresseMail, $cp, $ville, $dateEmbauche,$statut);
                return view('formCreerVisiteur', compact('erreur','retour'));
               
           }
           else
           {
                $retour =  "Ce visiteur est déjà créer";
                return view('formCreerVisiteur', compact('erreur','retour'));
           }
                
             
             
     
          
        }
        
        
       
    
}

