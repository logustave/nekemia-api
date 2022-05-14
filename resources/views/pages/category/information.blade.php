@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left">
                        <div class="mb-3">
                            <input type="text" name="label" value="categorie" class="form-control" placeholder="label"
                                   aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" placeholder="Description"
                                      style="resize: none" rows="5">lorem ipsum</textarea>
                        </div>


                        <div class="text-center">
                            <button type="button" class="btn bg-success text-white w-50 my-4 mb-2">Modifier</button>
                            <div class="mt-2 position-relative text-center">
                                <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                    ou
                                </p>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn bg-gradient-danger w-100">Supprimer</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
