@extends('layouts.template')
@section('body')
    <div class="row my-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Faq</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body p-3 pb-0 cardBodyElement">
                    <ul class="list-group listElement">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg element">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold ">Question ?</h6>
                                <span class="text-xs">reponse mettre un sub str apres 200 carracteres </span>
                            </div>
                            <div class="d-flex align-items-center text-sm ">
                                <small class="mx-1">01/01/2022</small>
                                <a class="px-3 mb-0 btn btn-outline-primary" href="faq/information/1"
                                   type="button">Voir</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 mx-auto formSave">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Enregistrer une Question</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left">
                        <div class="mb-3">
                            <input type="text" name="question" class="form-control" placeholder="question ?" aria-label="Name"
                                   >
                        </div>
                        <div class="mb-3">
                            <textarea name="answer" class="form-control" placeholder="Reponse"
                                      style="resize: none" rows="5"></textarea>
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
