
@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label>nom de l'auteur:</label>
                        nom
                    </div>
                    <div class="mb-3">
                        <label>Titre:</label>
                        lorem
                    </div>
                    <div class="mb-3">
                        <label>Image:</label>
                        <a href="#">Voir</a>
                    </div>
                    <div class="mb-3">
                        <label>Description:</label>
                    </div>

                    <div class="row text-center">
                        <div class="text-center col-md-6">
                            <a  href="/blog/modifier/1" class="btn bg-gradient-success text-white">Modifier</a>
                        </div>

                        <div class="text-center col-md-6">
                            <a href="#"  class="btn bg-gradient-danger">Supprimer</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
