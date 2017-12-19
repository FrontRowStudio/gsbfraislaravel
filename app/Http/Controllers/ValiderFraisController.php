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
        $erreur = "";
        $gsbFrais = new GsbFrais();
        $FicheFraisCloturer = $gsbFrais->getVisiteurFicheCloturer();
        if (empty($FicheFraisCloturer))
        {
            $erreur = "Aucune fiche de frais à valider";
        }
        return view('ValiderFicheFrais', compact('FicheFraisCloturer', 'erreur'));
    }

    public function DetailsFrais($id,$mois)
    {
        $gsbFrais = new GsbFrais();
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($id, $mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($id, $mois);
        $InfoClient = $gsbFrais->getVisiteurSelectFicheCloturer($id,$mois);               
        $montantTotal = $gsbFrais->CalculMontantTotal($lesFraisHorsForfait, $lesFraisForfait);
        $Maj = "";
        $erreur = "";
        return view('ModifFiche', compact('lesFraisForfait', 'erreur', 'lesFraisHorsForfait', 'InfoClient', 'montantTotal', 'Maj'));
    }

    public function TerminerFicheFrais($id,$mois,$Montant)
    {
        $gsbFrais = new GsbFrais();
        $gsbFrais->TerminerFicheFraisVisiteur($id,$mois,$Montant);
        $FicheFraisCloturer = $gsbFrais->getVisiteurFicheCloturer();
        $Complet = "La fiche a bien été cloturée !";
        $erreur = "";
        return view('ValiderFicheFrais', compact('FicheFraisCloturer', 'erreur', 'Complet'));
    }

    public function MAJFrais(Request $request)
    {
        $gsbFrais = new GsbFrais();
        $ETP = $request->input('ETP');
        $KM = $request->input('KM');
        $NUI = $request->input('NUI');
        $REP = $request->input('REP');
        $Id = $request->input('ID');
        $Mois = $request->input('Mois');
        $gsbFrais->MAJFrais($ETP, $KM, $NUI, $REP, $Id, $Mois);
                            
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($Id, $Mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($Id, $Mois);
        $InfoClient = $gsbFrais->getVisiteurSelectFicheCloturer($Id,$Mois);               
        $montantTotal = $gsbFrais->CalculMontantTotal($lesFraisHorsForfait, $lesFraisForfait);
        $erreur = "";
        $Maj = "Montant mit à jour !";
        return view('ModifFiche', compact('lesFraisForfait', 'erreur', 'lesFraisHorsForfait', 'InfoClient', 'montantTotal', 'Maj'));
    }

    public function SupprimerFHForfait(Request $request)
    {
        $gsbFrais = new GsbFrais();
        $Id = $request->input('Id');
        $Mois = $request->input('Mois');
        $Libelle = $request->input('Libelle');
        $Date = $request->input('Date');
        $Montant = $request->input('Montant');
        $Motif = $request->input('Motif');
        $gsbFrais->SupprimerLigneFHForfait($Id, $Mois, $Libelle, $Montant,$Motif);    
        $Maj = "";
        
        $lesFraisForfait = $gsbFrais->getLesFraisForfait($Id, $Mois);
        $lesFraisHorsForfait = $gsbFrais->getLesFraisHorsForfait($Id, $Mois);
        $InfoClient = $gsbFrais->getVisiteurSelectFicheCloturer($Id,$Mois);               
        $montantTotal = $gsbFrais->CalculMontantTotal($lesFraisHorsForfait, $lesFraisForfait);
        $erreur = "";
        $suppr = "Ligne Supprimé !";
        
        return view('ModifFiche', compact('lesFraisForfait', 'erreur', 'lesFraisHorsForfait', 'InfoClient', 'montantTotal', 'Maj','suppr'));
        
    }
    
    public function ValiderSupprFHF($idVisiteur,$mois,$id)
            {               
                $gsbfrais = new GsbFrais();
                $LigneFraisHorsForfait = $gsbfrais->getUnFraisHorsForfait($id);                    
                return view('SupprimerLigneFHF', compact('LigneFraisHorsForfait','mois','idVisiteur'));
            }
}

