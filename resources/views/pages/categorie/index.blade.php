@extends('layouts.template')
@section('body')
    <div class="row my-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h3 class="mb-0">Listes des Categories</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body p-3 pb-0 cardBodyElement">
                    <ul class="list-group listElement">

                         @foreach($object as $q)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg element">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold ">{{$q['label']}}</h6>

                                    <span class="text-xs">{{$q['description']}} </span>
                                </div>
                                <div class="d-flex align-items-center text-sm ">
                                    <small class="mx-1">{{date('d-m-Y',strtotime($q['created_at']))}}</small>
                                    <a class="px-3 mb-0 btn btn-outline-primary" href="{{route("seeCategory",['id'=>$q['id']])}}"
                                       type="button">Voir</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 mx-auto formSave">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Enregistrer une categorie</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" method="post" action="{{route("createCategory")}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label>nom:</label>

                            <input type="text" name="label" class="form-control" placeholder="label" aria-label="Name"
                                   aria-describedby="email-addon" required>
                        </div>
                        <div class="mb-3">
                            <label>Description:</label>

                            <textarea name="description" class="form-control" placeholder="Description"
                                      style="resize: none" rows="5"></textarea>
                        </div>
                        @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                        @endif

                        <div class="text-center">
                            <button type="submit" class="btn bg-success text-white w-50 my-4 mb-2">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
