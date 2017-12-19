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
    
}
?>
