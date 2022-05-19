@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" action="{{route("editBLog")}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>nom de l'auteur:</label>
                            <input type="text" name="full_name" value="nom" class="form-control" placeholder="John Doe" aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Categorie:</label>
                            <a href="{{route("seeCategory",['id'=>$categorie['id']])}}">{{$categorie['label']}}</a>
                            <select name="category_id">
                                @foreach($allCategorie as $q)
                                    <option value="{{$q['id']}}">{{$q['label']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Titre:</label>
                            <input type="text" name="title" value="{{$object['title']}}" class="form-control" placeholder="titre.." aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Image:</label>
                            <input type="file" name="cover_path" value="{{$object['cover_path']}}" class="form-control" aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Description:</label>
                            <textarea name="content"  class="form-control" id="summernote" placeholder="description..."
                                      style="resize: none" rows="8">{{$object['content']}}</textarea>
                        </div>
                        <div class="row text-center">
                            <div class="text-center col-md-6">
                                <button type="submit"  class="btn bg-success text-white">Modifier</button>
                            </div>

                            <div class="text-center col-md-6">
                                <a type="button" class="btn bg-gradient-danger" href="{{url()->previous()}}">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
