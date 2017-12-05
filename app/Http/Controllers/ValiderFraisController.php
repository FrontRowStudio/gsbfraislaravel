<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\metier\GsbFrais;
  
class ValiderFraisController extends Controller
{
          public function ValiderFrais()
            {
                $erreur="";
                $gsbFrais = new GsbFrais();
                $FicheFraisCloturer = $gsbFrais->getVisiteurFicheCloturer();
                return view('ValiderFicheFrais', compact('FicheFraisCloturer','erreur'));
            }
            
        public function DetailsFrais($id,$mois)
            {
                $gsbFrais = new GsbFrais();
                $lesFraisForfait = $gsbFrais->getLesFraisForfait($id, $mois);
                $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($id, $mois);
                $montantTotal = 0;
                foreach ($lesFraisHorsForfait as $fhf){
                      $montantTotal = $montantTotal + $fhf->montant;
                }
                $titreVue = "Détail de la fiche de frais du mois ".$mois;
                $erreur = "";
                return view('listeDetailFiche', compact('lesFraisForfait', 'lesFraisHorsForfait', 'mois', 'erreur', 'titreVue','montantTotal'));
            }                   
}
?>