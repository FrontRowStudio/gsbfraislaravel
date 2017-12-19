@extends('layouts.master')
@section('content')
{!! Form::open(['url' => '/SupprimerFraisHForfait']) !!}  
<div class="col-md-12 well well-md">
    <div class="form-horizontal">    
        <form>
                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Libellé</th> 
                            <th>Date</th>              
                            <th>Montant</th>
                            <th>Motif</th>
                        </tr>
                    </thead>
            <tr>   
                <td><input type="hidden" name="Libelle" value="{{$LigneFraisHorsForfait->libelle}}"> {{ $LigneFraisHorsForfait->libelle}} </td> 
                <td><input type="hidden" name="Date" value="{{$LigneFraisHorsForfait->date}}"> {{ $LigneFraisHorsForfait->date }} </td> 
                <td><input type="hidden" name="Montant" value="{{$LigneFraisHorsForfait->montant}}">{{$LigneFraisHorsForfait->montant}}</td>
                <td><input type = "text" name="Motif" required></td>
           
            <input type ="hidden" name="Id" value="{{$idVisiteur}}">
            <input type ="hidden" name="Mois" value="{{$mois}}">       
            </tr>
            </table>               
            <button type="submit" class="btn btn-default btn-primary" >Valider</button>          
            <a href="{{ url('/ValiderFicheFrais')}}/{{$idVisiteur}}/{{$mois}}" ><button type="button" class="btn btn-default btn-primary" >Retour</button></a>                    
        </form>
    </div>
{!! Form::close() !!}
@stop

