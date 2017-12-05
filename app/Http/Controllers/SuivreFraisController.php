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
    
}
?>
