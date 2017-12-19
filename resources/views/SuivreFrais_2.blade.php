@extends('layouts.master')
@section('content')

{!! Form::open(['url' => 'SuivreFrais_2']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
    <div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">id</th>
                    <th style="width:20%">Mois</th>
                    <th style="width:20%">Date de modification</th>
                    <th style="width:20%">Etat</th>
                    <th style="width:20%">Montant validé ou remboursé</th>
                </tr>
            </thead>
            @foreach($Info as $Frais)
            <tr>
                <td> {{ $Frais->idVisiteur }} </td>
                <td> {{ $Frais->mois }} </td>
                <td> {{ $Frais->dateModif}} </td>
                <td> {{ $Frais->idEtat }} </td>
                <td> {{ $Frais->montantValide }} </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
{!! Form::close() !!}
@stop