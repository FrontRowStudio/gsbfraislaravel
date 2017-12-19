@extends('layouts.master')
@section('content')

{!! Form::open(['url' => 'SuivreFrais']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
    <h3><b>Visiteurs ayant des fiches validées ou remboursés pour les 12 derniers mois:</b></h3></br>
    <div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">ID</th>
                    <th style="width:20%">Prenom</th>
                    <th style="width:20%">Nom</th>
                    <th style="width:40%; text-align:center;">Accès aux informations</th>
                </tr>
            </thead>
            @foreach($vis as $Frais)
            <tr>    
                <td> {{ $Frais->id }} </td>
                <td> {{ $Frais->prenom }} </td>
                <td> {{ $Frais->nom }} </td>
                <td style="text-align:center;"><a href="{{ url('/SuivreFrais_2') }}/{{ $Frais->id }}">Cliquez ici pour accéder aux informations du visteur</a>
            </tr>
            @endforeach
        </table>
    </div>
</div>
{!! Form::close() !!}
@stop