<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;
  
class SuivreFraisController extends Controller
{
    public function GetSuivreFrais()
    {
        $erreur="";
        $gsbFrais = new GsbFrais();
        $vis = $gsbFrais->Aff_Visiteurs();
        return view('SuivreFrais', compact('vis'));   
    }
    
    public function GetSuivreFrais_2($id)
    {
        $erreur="";
        $gsbFrais = new GsbFrais();
        $Info = $gsbFrais->Aff_Info_Visiteurs($id);
        return view('SuivreFrais_2', compact('Info'));   
    }
    
    /*public function GetSuivreFrais_Detail()
    {
        $erreur="";
        return view('SuivreFrais_Detail', compact('Info'));
    }*/
    
    public function GetSuivreFrais_Detail($mois, $idVisiteur){
      $gsbFrais = new GsbFrais();
      $lesFraisForfait = $gsbFrais->Aff_DetailForfait($idVisiteur, $mois);
      $lesFraisHorsForfait = $gsbFrais->Aff_Detail_HorsForfait_Comptable($idVisiteur, $mois);
      $montantTotal = 0;
      foreach ($lesFraisHorsForfait as $fhf){
            $montantTotal = $montantTotal + $fhf->montant;
      }
      $titreVue = "Détail de la fiche de frais du mois ".$mois;
      $erreur = "";
      return view('SuivreFrais_Detail', compact('lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
  }
}
?>
