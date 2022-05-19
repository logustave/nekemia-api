
@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="">
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
                        <label>Categorie:</label>
                        <a href="{{route("seeCategory",['id'=>$categorie['id']])}}">{{$categorie['label']}}</a>
                    </div>
                    <div class="mb-3">
                        <label>Titre:</label>
                        {{$object['title']}}
                    </div>
                    <div class="mb-3">
                        <label>Image:</label>
                        <a href="{{$object['cover_path']}}">Voir</a>
                    </div>
                    <div class="mb-3">
                        <label>Description:</label>
                        {!! $object['content'] !!}
                    </div>

                    <div class="row text-center">
                        <div class="text-center">
                            <a  href="{{route("pageEditBlog",['slug'=>$object['slug']])}}" class="btn bg-gradient-success text-white">Modifier</a>
                            <a href="{{route("deleteBlog",['id'=>$object['id']])}}" class="btn bg-gradient-danger">Supprimer</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
