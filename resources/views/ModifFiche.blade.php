@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>{{$titreVue or ''}}</h1>
        </div>
        
<table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:10%">Nom</th> 
                    <th style="width:12%">Prénom</th> 
                    <th style="width:15%">Mois Clôturés</th>
                    <th style="width:20%">Montant Validé</th>
                     <th style="width:16%">NbJustificatifs</th>
                      <th style="width:30%">Date Derniére modification</th>
                </tr>
            </thead>
            @foreach($InfoClient as $uneFicheFrais)
            <tr>   
                <td> {{ $uneFicheFrais->nom }} </td> 
                <td> {{ $uneFicheFrais->prenom }} </td> 
                <td> {{ $uneFicheFrais->mois }} </td> 
                <td> {{ $uneFicheFrais->montantValide }} </td> 
                <td> {{ $uneFicheFrais->nbJustificatifs }} </td> 
                <td> {{ $uneFicheFrais->dateModif }} </td>
            </tr>
            @endforeach
        </table>
        
        <h3>Liste des frais forfait</h3>        
            <form action ="#">
                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>id</th> 
                            <th>Quantité</th>                     
                        </tr>
                    </thead>
            @foreach($lesFraisForfait as $unFF)
            <tr>   
                <td> {{ $unFF->idfrais }} </td> 
                <td> <input type="text" name ="{{$unFF->quantite}}" value="{{$unFF->quantite}}"> </td>>            
            </tr>
            @endforeach
            </table>       
            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Mettre à jour la liste</button>                
        </form>

        <h3>Liste des frais hors forfait</h3>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Libellé</th> 
                    <th>Date</th> 
                    <th>Montant</th>  
                </tr>
            </thead>
            @foreach($lesFraisHorsForfait as $unFHF)
            <tr>   
                <td> {{ $unFHF->libelle }} </td> 
                <td> {{ $unFHF->date }} </td> 
                <td> {{ $unFHF->montant }} </td>                 
            </tr>
            @endforeach
            <tr>
                <td style="text-align: right"> Montant total :</td>
                <td>{{$montantTotal}}</td>
            </tr>
        </table>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href="{{ url('/TerminerFrais')}}/{{ $uneFicheFrais->id }}/{{$uneFicheFrais->mois}}/{{$montantTotal}}" ><button type="button" class="btn btn-default btn-primary" >Cloturer la fiche de frais</button></a>
                <a href="{{ url('/ValiderFicheFrais')}}" ><button type="button" class="btn btn-default btn-primary" >Retour</button></a>                    
            </div>           
        </div>  
        @include('error')
    </div>
</div>
@stop
