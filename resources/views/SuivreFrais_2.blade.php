@extends('layouts.master')
@section('content')

{!! Form::open(['url' => 'SuivreFrais_2']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
    <div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:10%">id</th>
                    <th style="width:16%">Mois</th>
                    <th style="width:16%">Date de modification</th>
                    <th style="width:16%">Etat</th>
                    <th style="width:19%">Montant validé ou remboursé</th>
                    <th style="width:19%">Voir détails</th>
                </tr>
            </thead>
            @foreach($Info as $Frais)
            <tr>
                <td> {{ $Frais->idVisiteur }} </td>
                <td> {{ $Frais->mois }} </td>
                <td> {{ $Frais->dateModif}} </td>
                <td> {{ $Frais->idEtat }} </td>
                <td> {{ $Frais->montantValide }} </td>
                <td style="text-align:center;"><a href="{{ url('/SuivreFrais_Detail') }}/{{$Frais->mois}}/{{$Frais->idVisiteur}}">
                        <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Voir"></span></a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
{!! Form::close() !!}
@stop