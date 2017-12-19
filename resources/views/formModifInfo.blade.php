@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'formModifInfo']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
     <center><h1>Modification des informations personnelles</h1></center>
    <div class="form-horizontal">    
        <div class="form-group">
            <label class="col-md-2 control-label">Adresse : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="adresse" ng-model="adresse" class="form-control" placeholder="Votre Adresse Postal" value="{{$modifinfo[0]->adresse}}" required>
            </div>
            
            <div class="form-group">
            <label class="col-md-1 control-label">CP: </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="Votre Code Postal" pattern="[0-9]{5}" title="Saisir un code postal composé de 5 chiffres"  value="{{$modifinfo[0]->cp}}"  required >
            </div>
        </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Ville : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" ng-model="ville" class="form-control" placeholder="Votre Ville" value ="{{$modifinfo[0]->ville}}" pattern="[A-Za-z-]{0,}" title="Saisir une ville avec des caractères alphabétique. " required>
            </div>
            
             
            <label class="col-md-1 control-label">Adresse Mail : </label>
            <div class="col-md-6 col-md-3">
                <input type="mail" name="mail" ng-model="mail" class="form-control" placeholder="Votre adresse mail"  value = "{{$modifinfo[0]->adresseMail}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  title="Saisir une adresse mail de type : exemple@exemple.com " required>
            </div>
        </div>
             <div class="form-group">
            <label class="col-md-2 control-label">Téléphone : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="telephone" ng-model="telephone" class="form-control" placeholder="Votre Téléphone" value="{{$modifinfo[0]->telephone}}" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="Saisir un numéros de telephone de téléphone de type : +33669899638 , 0658987852 ... " required>
            </div>
                  
        <div class="form-group">
            <br><br>
            <div class="col-md-6 col-md-offset-4">
                <button type="reset" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>            
            </div>
       @if (isset($retour))
        <div class="alert alert-success">
            <br><br>
            {{$retour}}
        </div>
        @endif 
        </div>
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
   
</div>
{!! Form::close() !!}
@stop
