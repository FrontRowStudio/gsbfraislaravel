@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'formCreerVisiteur']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
     <center><h1>Créer un nouvel utilisateur</h1></center>
    <div class="form-horizontal">    
        <div class="form-group">
            <label class="col-md-2 control-label">Nom : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="nom" ng-model="nom" class="form-control" placeholder="Votre Nom" pattern="[a-zA-Z]{0,}" title="Saisir un nom composé de caractère alphabétique" required>
            </div>
            
            <div class="form-group">
            <label class="col-md-1 control-label">Prénom : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="prenom" ng-model="prenom" class="form-control" placeholder="Votre Prénom" pattern="[A-Za-z]{0,}" title="Saisir un prenom composé de caractère alphabétique" required >
            </div>
        </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Adresse : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="adresse" ng-model="adresse" class="form-control" placeholder="Votre Adresse Postal" required>
            </div>
            
            <div class="form-group">
            <label class="col-md-1 control-label">CP: </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="Votre Code Postal" pattern="[0-9]{5}" title="Saisir un code postal composé de 5 chiffres" required >
            </div>
        </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Ville : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" ng-model="ville" class="form-control" placeholder="Votre Ville" required>
            </div>
            
            
            <label class="col-md-1 control-label">Adresse Mail : </label>
            <div class="col-md-6 col-md-3">
                <input type="mail" name="mail" ng-model="mail" class="form-control" placeholder="Votre adresse mail"  required>
            </div>
        </div>
             <div class="form-group">
            <label class="col-md-2 control-label">Téléphone : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="telephone" ng-model="telephone" class="form-control" placeholder="Votre Téléphone" required>
            </div>
            
            
            <label class="col-md-1 control-label">Date Embauche: </label>
            <div class="col-md-6 col-md-3">
                <input type="date" name="date" ng-model="date" class="form-control" placeholder="Votre adresse mail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">ID : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="id" ng-model="id" class="form-control" placeholder="ID" pattern="[A-Za-z0-9]{4}" title="Saisir un ID de 4 caractères" required>
            </div>
            
            
           
        </div>
        
        
        
        <div class="form-group">
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
