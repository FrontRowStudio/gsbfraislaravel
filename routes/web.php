<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Afficher le formulaire d'authentification 
Route::get('/getLogin', 'ConnexionController@getLogin');

// Authentifie le visiteur à partir du login et mdp saisis
Route::post('/login', 'ConnexionController@logIn');

// Déloguer le visiteur
Route::get('/Logout', 'ConnexionController@logOut');

//saisirFrais
Route::get('/saisirFraisForfait', 'FraisForfaitController@saisirFraisForfait');

//saisirFrais
Route::post('/saisirFraisForfait', 'FraisForfaitController@validerFraisForfait');

// Afficher la liste des fiches de Frais du visiteur connecté
Route::get('/getListeFrais', 'VoirFraisController@getFraisVisiteur');

// Afficher le détail de la fiche de frais pour le mois sélectionné
Route::get('/voirDetailFrais/{mois}', 'VoirFraisController@voirDetailFrais');

// Afficher la liste des frais hors forfait d'une fiche de Frais
Route::get('/getListeFraisHorsForfait/{mois}', 'FraisHorsForfaitController@getFraisHorsForfait');

// Afficher le formulaire d'un Frais Hors Forfait pour une modification
Route::get('/modifierFraisHorsForfait/{idFrais}', 'FraisHorsForfaitController@modifierFraisHorsForfait');

// Afficher le formulaire d'un Frais Hors Forfait pour un ajout
Route::get('/ajouterFraisHorsForfait/{mois}', 'FraisHorsForfaitController@saisirFraisHorsForfait');

// Enregistrer une modification ou un ajout d'un Frais Hors Forfait
Route::post('/validerFraisHorsForfait', 'FraisHorsForfaitController@validerFraisHorsForfait');

// Supprimer un Frais Hors Forfait
Route::get('/supprimerFraisHorsForfait/{idFrais}', 'FraisHorsForfaitController@supprimmerFraisHorsForfait');

// Valider une fiche de frais
Route::get('/ValiderFicheFrais','ValiderFraisController@ValiderFrais');

// Voir le détail de la fiche de frais pour un visiteur
Route::get('/ValiderFicheFrais/{id}/{mois}','ValiderFraisController@DetailsFrais');

Route::get('TerminerFrais/{id}/{mois}/{Montant}','ValiderFraisController@TerminerFicheFrais');

//Suivre Frais
Route::get('/SuivreFrais', 'SuivreFraisController@GetSuivreFrais');

//Suivre Frais 2, affichage des visiteurs (accès aux informations d'un visiteur sélectionné)
Route::get('/SuivreFrais_2/{id}', 'SuivreFraisController@GetSuivreFrais_2');

//Suivre Frais Detail, affichage des détails des fiches
Route::get('/SuivreFrais_Detail/{mois}/{idVisiteur}', 'SuivreFraisController@GetSuivreFrais_Detail');

//Mettre a jour les frais
Route::post('/MAJFrais', 'ValiderFraisController@MAJFrais');

//Supprimer une ligne hors Forfait
Route::get('/ValiderSupprimerFraisHForfait/{idVisiteur}/{mois}/{id}','ValiderFraisController@ValiderSupprFHF');

Route::post('/SupprimerFraisHForfait','ValiderFraisController@SupprimerFHForfait');

// Affiche Formulaire Créer Visiteur
Route::get('/formCreerVisiteur', 'CreerVisiteurController@AffFormCreerVisiteur');

Route::post('/formCreerVisiteur', 'CreerVisiteurController@InsertVisiteur');

// Modifier Les Informations Personnelles

Route::get('/formModifInfo', 'CreerModifInfoController@affFormModifInfo');

Route::post('/formModifInfo', 'CreerModifInfoController@ModifVisiteur');

//afficher formulaire modif mdp
/*Route::get('/modifMdp', function (){
    return view('formModifMdp');
});*/
Route::get('/modifMdp', 'modifMdpController@affFormModifMdp');
//modifier mdp controller
Route::post('/modifMdp', 'modifMdpController@verifMdp');

// Retourner à une vue dont on passe le nom en paramètre
Route::get('getRetour/{retour}', function($retour){
    return redirect("/".$retour);
});

