@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'formCreerVisiteur']) !!}  
<div class="col-md-12 col-sm-12 well well-md  well-sm">
     <center><h1>Créer un nouvel utilisateur</h1></center>
    <div class="form-horizontal">    
        <div class="form-group">
            <label class="col-md-2 control-label">Nom : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="nom" ng-model="nom" class="form-control" value="Votre Nom" required>
            </div>
            
            <div class="form-group">
            <label class="col-md-1 control-label">Prénom : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="prenom" ng-model="prenom" class="form-control" placeholder="Votre Prénom" required>
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
                <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="Votre Code Postal" required>
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
                <input type="text" name="mail" ng-model="mail" class="form-control" placeholder="Votre adresse mail" required>
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
                <input type="text" name="id" ng-model="id" class="form-control" placeholder="ID" required>
            </div>
            
            
           
        </div>
        
        
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                 <button type="reset" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Annuler</button>
            </div>
            
           
        </div>
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
   
</div>
{!! Form::close() !!}
@stop
