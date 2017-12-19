@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'ValiderFicheFrais']) !!}  
@if($erreur == "")
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">Nom</th> 
                    <th style="width:20%">Prénom</th> 
                    <th style="width:20%">Mois Clôturés</th>
                    <th style="width:20%">Montant Valide</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($FicheFraisCloturer as $uneFicheFrais)
            <tr>   
                <td> {{ $uneFicheFrais->nom }} </td> 
                <td> {{ $uneFicheFrais->prenom }} </td> 
                <td> {{ $uneFicheFrais->mois }} </td> 
                <td> {{ $uneFicheFrais->montantValide }} </td> 
                                <td style="text-align:center;"><a href="{{ url('/ValiderFicheFrais') }}/{{ $uneFicheFrais->id }}/{{$uneFicheFrais->mois}}">
                        <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Voir"></span></a></td>
            </tr>
            @endforeach
            @if(isset($Complet))
            
        <div class="alert alert-success">
            <p> {{$Complet}}</p>
        </div>            
            @endif            
        </table>
@else
<div class="alert alert-info"
     <p><span class="glyphicon glyphicon-exclamation-sign"></span> {{$erreur}}</p>
</div>

@endif
{!! Form::close() !!}
@stop
