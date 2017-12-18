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
                if(empty($FicheFraisCloturer))
                    {
                        $erreur = "Aucune fiche de frais à valider";
                    
                    }                
                return view('ValiderFicheFrais', compact('FicheFraisCloturer','erreur'));
            }
            
        public function DetailsFrais($id,$mois)
            {
                $gsbFrais = new GsbFrais();
                $lesFraisForfait = $gsbFrais->getLesFraisForfait($id, $mois);
                $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($id, $mois);
                $InfoClient = $gsbFrais->getVisiteurSelectFicheCloturer($id,$mois);               
                $montantTotal = 0;
                foreach ($lesFraisHorsForfait as $fhf){
                      $montantTotal = $montantTotal + $fhf->montant;
                }
                $titreVue = "Détail de la fiche de frais du mois ".$mois;
                $erreur = "";
                return view('ModifFiche', compact('lesFraisForfait','erreur', 'lesFraisHorsForfait','InfoClient', 'montantTotal'));
            }              
            
            public function TerminerFicheFrais($id,$mois,$Montant)
                {
                    $gsbFrais = new GsbFrais();
                    $gsbFrais->TerminerFicheFraisVisiteur($id,$mois,$Montant);
                    $FicheFraisCloturer = $gsbFrais->getVisiteurFicheCloturer();
                    $Complet = "La fiche a bien été cloturée !";
                    $erreur = "";
                    return view('ValiderFicheFrais', compact('FicheFraisCloturer','erreur','Complet'));
                }
}
?>