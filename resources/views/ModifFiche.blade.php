@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'MAJFrais']) !!}  
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
@if($Maj != "")
<div class="alert alert-info"
<p><span class="glyphicon glyphicon-info-sign"></span> {{$Maj}}</p>
</div>
@endif
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
                <td> <input type="text" name ="{{$unFF->idfrais}}" value="{{$unFF->quantite}}"> </td>   
            </tr>
            @endforeach
            </table>       
                <input type="hidden" name = "ID" value = "{{$uneFicheFrais->id}}">
                <input type="hidden" name = "Mois" value="{{$uneFicheFrais->mois}}">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Mettre à jour la liste</button>       
        </form>
{!! Form::close() !!}
{!! Form::open(['url' => 'SupprimerFraisHForfait']) !!}  
        <h3>Liste des frais hors forfait</h3>
        @if(isset($suppr))
        <div class="alert alert-info"
        <p><span class="glyphicon glyphicon-info-sign"></span> {{$suppr}}</p>
        </div>
        @endif        
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            @foreach($lesFraisHorsForfait as $unFHF)
            <tr>
            <form>                
                <td><label> {{ $unFHF->libelle }} </label></td>
                <td><label>  {{ $unFHF->date }} </label></td>
                <td><label> {{ $unFHF->montant }} </label></td>
                <td><a class="glyphicon glyphicon-remove" href="{{ url('/ValiderSupprimerFraisHForfait')}}/{{ $uneFicheFrais->id }}/{{$uneFicheFrais->mois}}/{{$unFHF->id}}" ></a></td>
           </form>
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
