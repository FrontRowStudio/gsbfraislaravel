<?php
namespace App\metier;

use Illuminate\Support\Facades\DB;

/** 
 * Classe d'accès aux données. 
 */
class GsbFrais{   		
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un objet 
*/
public function getInfosVisiteur($login, $mdp){
        $req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, visiteur.Statut as Statut from visiteur 
        where visiteur.login=:login and visiteur.mdp=:mdp";
        $ligne = DB::select($req, ['login'=>$login, 'mdp'=>$mdp]);
        return $ligne;
}


/**
 * Retourne sous forme d'un tableau d'objets toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet avec tous les champs des lignes de frais hors forfait 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur =:idVisiteur 
		and lignefraishorsforfait.mois = :mois and Supprimé = 0";	
            $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
//            for ($i=0; $i<$nbLignes; $i++){
//                    $date = $lesLignes[$i]['date'];
//                    $lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
//            }
            return $lesLignes; 
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet contenant les frais forfait du mois
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, ligneFraisForfait.mois as mois,
		lignefraisforfait.quantite as quantite, fraisforfait.montant as MontantUnit from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois=:mois
		order by lignefraisforfait.idfraisforfait";	
//                echo $req;
                $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
		return $lesLignes; 
	}
        
/**
 * Calcul le montant total des frais forfait et hors forfait
 
 * @param $FraisHorsForfait 
 * @param $FraisForfait
 * @return le total du montant calculé
*/
	public function CalculMontantTotal($FraisHorsForfait, $FraisForfait)
                {
                        $montantTotal = 0;

                        foreach ($FraisHorsForfait as $fhf)
                        {
                            $montantTotal +=$fhf->montant;
                        }

                        foreach ($FraisForfait as $ff)
                        {
                            $montantTotal += $ff->quantite * $ff->MontantUnit;                  
                        }
                        return $montantTotal;
	}        
        
	public function MAJFrais($ETP, $KM,$NUI,$REP,$Id,$Mois)
                    {
                        $req =   "UPDATE lignefraisforfait SET quantite = ". $ETP ." WHERE lignefraisforfait.idVisiteur = '". $Id ."' AND lignefraisforfait.mois = '". $Mois ."' AND lignefraisforfait.idFraisForfait = 'ETP';";
                        DB::update($req);                        
                        $req =  "UPDATE lignefraisforfait SET quantite = ". $KM ." WHERE lignefraisforfait.idVisiteur = '". $Id ."' AND lignefraisforfait.mois = '". $Mois ."' AND lignefraisforfait.idFraisForfait = 'KM';";
                        DB::update($req);
                        $req =  "UPDATE lignefraisforfait SET quantite = ". $NUI ." WHERE lignefraisforfait.idVisiteur = '". $Id ."' AND lignefraisforfait.mois = '". $Mois ."' AND lignefraisforfait.idFraisForfait = 'NUI';";
                        DB::update($req);            
                        $req = "UPDATE lignefraisforfait SET quantite = ". $REP ." WHERE lignefraisforfait.idVisiteur = '". $Id ."' AND lignefraisforfait.mois = '". $Mois ."' AND lignefraisforfait.idFraisForfait = 'REP';";
                        DB::update($req);

                    }        
                    
                    public function SupprimerLigneFHForfait($id,$mois,$libelle,$montant,$motif)
                            {
                                $req = "UPDATE lignefraishorsforfait SET `Supprimé` = 1,Motif = '".$motif."' WHERE idVisiteur = '".$id."' and mois = '".$mois."' and libelle = '".$libelle."' and montant = '".$montant."'";
                                DB::update($req);
                            }
        
/**
 * Retourne tous les id de la table FraisForfait
 * @return un objet avec les données de la table frais forfait
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$lesLignes = DB::select($req);
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
    //            print_r($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = :qte
			where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois = :mois
			and lignefraisforfait.idfraisforfait = :unIdFrais";
                        DB::update($req, ['qte'=>$qte, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'unIdFrais'=>$unIdFrais]);
		}
		
	}
        
        /**
         * 
         * 
         */
	public function getVisiteurFicheCloturer()
                {
		$req = "SELECT id,nom,prenom,fichefrais.mois,fichefrais.montantValide FROM `visiteur` INNER JOIN fichefrais on visiteur.id = fichefrais.idVisiteur where fichefrais.idEtat = 'CL' ORDER BY prenom ASC";
		$lesLignes = DB::select($req);
		return $lesLignes;
	}
        
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
         * 
         * 
         */
	public function getVisiteurSelectFicheCloturer($uneID,$unMois)
                    {
		$req = "SELECT id,nom,prenom,fichefrais.mois,fichefrais.montantValide,nbJustificatifs,dateModif FROM `visiteur` INNER JOIN fichefrais on visiteur.id = fichefrais.idVisiteur where fichefrais.idEtat = 'CL' AND id = '". $uneID ."' AND fichefrais.mois = '" . $unMois . "' ORDER BY prenom ASC";
		$lesLignes = DB::select($req);
		return $lesLignes;
                    }
                    
        /**
         * 
         * 
         */
	public function TerminerFicheFraisVisiteur($ID,$Mois,$Montant)
                    {
		$req = "UPDATE fichefrais
                                    SET `montantValide` = '". $Montant . "', `dateModif` = DATE( NOW() ), `idEtat` = 'VA'
                                    WHERE idVisiteur like '" . $ID . "' and mois like ". $Mois;
		$lesLignes = DB::select($req);
		return $lesLignes;
                    }                    
        
/** 
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = :nbJustificatifs 
		where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		DB::update($req, ['nbJustificatifs'=>$nbJustificatifs, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois]);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = :mois and fichefrais.idvisiteur = :idVisiteur";
		$laLigne = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
                $nb = $laLigne[0]->nblignesfrais;
		if($nb == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = :idVisiteur";
		$laLigne = DB::select($req, ['idVisiteur'=>$idVisiteur]);
                $dernierMois = $laLigne[0]->dernierMois;
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche->idEtat=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values(:idVisiteur,:mois,0,0,now(),'CR')";
		DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais->idfrais;
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values(:idVisiteur,:mois,:unIdFrais,0)";
			DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'unIdFrais'=>$unIdFrais]);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
//		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait(idVisiteur, mois, libelle, date, montant) 
		values(:idVisiteur,:mois,:libelle,:date,:montant)";
		DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'libelle'=>$libelle,'date'=>$date,'montant'=>$montant]);
	}

/**
 * Récupère le frais hors forfait dont l'id est passé en argument
 * @param $idFrais 
 * @return un objet avec les données du frais hors forfait
*/
	public function getUnFraisHorsForfait($idFrais){
		$req = "select * from lignefraishorsforfait where lignefraishorsforfait.id = :idFrais ";
		$fraisHF = DB::select($req, ['idFrais'=>$idFrais]);
//                print_r($unfraisHF);
                $unFraisHF = $fraisHF[0];
                return $unFraisHF;
	}
/**
 * Modifie frais hors forfait à partir de son id
 * à partir des informations fournies en paramètre
 * @param $id 
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function modifierFraisHorsForfait($id, $libelle,$date,$montant){
//		$dateFr = dateFrancaisVersAnglais($date);
		$req = "update lignefraishorsforfait set libelle = :libelle, date = :date, montant = :montant
		where id = :id";
		DB::update($req, ['libelle'=>$libelle,'date'=>$date,'montant'=>$montant, 'id'=>$id]);
	}
        
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id = :idFrais ";
		DB::delete($req, ['idFrais'=>$idFrais]);
	}
/**
 * Retourne les fiches de frais d'un visiteur à partir d'un certain mois
 * @param $idVisiteur 
 * @param $mois mois début
 * @return un objet avec les fiches de frais de la dernière année
*/
	public function getLesFrais($idVisiteur, $mois)
                {
		$req = "select * from  fichefrais where idvisiteur = :idVisiteur
                and  mois >= :mois   
		order by fichefrais.mois desc ";
                $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
                return $lesLignes;
	}
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		$lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);			
		return $lesLignes[0];
	}
/** 
 * Modifie l'état et la date de modification d'une fiche de frais
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = :etat, dateModif = now() 
		where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		DB::update($req, ['etat'=>$etat, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
	}
        
        public function MiseajourBDD($login, $newmdp)
{
         $req = "UPDATE visiteur set mdp= :newmdp where login = :login ";
        DB::update($req, ['newmdp'=>$newmdp ,'login'=>$login]);
    
}

// Fabien

        public function Aff_Visiteurs()
        {
            $dateJour = date('Y-m-d');
            echo $dateJour;
            $req = "SELECT DISTINCT id, prenom, nom FROM visiteur INNER JOIN fichefrais ON id = idVisiteur WHERE mois > 201612 AND (idEtat = 'RB' OR idEtat = 'VA')";
            $Aff_Vis = DB::select($req);
            return $Aff_Vis;
        }
        
        public function Aff_Info_Visiteurs($id)
        {
            $dateJour = date('Y-m-d');
            $req = "SELECT idVisiteur, mois, dateModif, idEtat, montantValide FROM fichefrais WHERE mois > 201612 AND idVisiteur = :id_Vis";
            $Aff_Info = DB::select($req, ['id_Vis'=>$id]);
            return $Aff_Info;
        }
        
    public function InsertVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$telephone,$adresseMail,$cp,$ville,$dateEmbauche,$statut)
    {
            $req ="INSERT INTO visiteur values(:id,:nom,:prenom,:login,:mdp,:adresse,:telephone,:adresseMail,:cp,:ville,:dateEmbauche,:statut)";
            DB::insert($req,['id'=>$id,'nom'=>$nom,'prenom'=>$prenom,'login'=>$login,'mdp'=>$mdp,'adresse'=>$adresse,'telephone'=>$telephone,'adresseMail'=>$adresseMail,'cp'=>$cp,'ville'=>$ville,'dateEmbauche'=>$dateEmbauche,':statut'=>$statut]);
    }
    function Genere_Password($size)
{
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $password = 0;
    for($i=0;$i<$size;$i++)
    {
        $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return strtolower($password);
}

    function CompareTo($nom ,$prenom)
    {
        $req="SELECT id , nom FROM visiteur where nom = :nom and prenom = :prenom";
        $ligne = DB::select($req,['nom'=>$nom,'prenom'=>$prenom]);     
        return $ligne;
        
    }
    
    function AfficherInfoModif($id)
    {
        $req="SELECT adresse,cp,ville ,adresseMail,telephone FROM visiteur where id = :id";
        $ligne = DB::select($req,['id'=>$id]);     
        return $ligne;
        
    }
    
    function MAJ_InfoPerso($id,$adresse,$cp,$ville,$adressemail,$telephone)
    {
        $req="UPDATE visiteur set adresse = :adresse , cp = :cp ,ville = :ville, adresseMail = :adressemail , telephone = :telephone where id = :id";
        DB::update($req,['id'=>$id , 'adresse'=>$adresse,'cp'=>$cp,'ville'=>$ville,'adressemail'=>$adressemail,'telephone'=>$telephone]);     
    }
}
