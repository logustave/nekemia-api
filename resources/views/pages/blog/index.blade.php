@extends('layouts.template')
@section('body')
    <div class="row my-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h3 class="mb-0">Blog</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0 cardBodyElement">
                    <ul class="list-group listElement">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg element">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold ">Titre</h6>
                                <span class="text-xs">reponse mettre un sub str apres 200 carracteres </span>
                            </div>
                            <div class="d-flex align-items-center text-sm ">
                                <small class="mx-1">Auteur le 01/01/2022</small>
                                <a class="px-3 mb-0 btn btn-outline-primary" href="blog/information/1"
                                   type="button">Voir</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mx-auto formSave">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Enregistrer un Blog</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left">
                        <div class="mb-3">
                            <label>nom de l'auteur:</label>

                            <input type="text" name="full_name" class="form-control" placeholder="John Doe" aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Titre:</label>
                            <input type="text" name="title" class="form-control" placeholder="titre.." aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Image:</label>
                            <input type="file" name="cover_path" class="form-control" aria-label="Name">
                        </div>
                        <div class="mb-3">
                            <label>Description:</label>
                            <textarea name="content"  class="form-control" id="summernote" placeholder="description..."
                                      style="resize: none" rows="8"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn bg-success text-white w-50 my-4 mb-2">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
