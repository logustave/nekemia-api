@extends('layouts.template')
@section('body')
    <div class="row my-4">
        <div class="col-md-8">
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
                        @foreach($object as $q)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg element">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold "><img src="{{$q['cover_path']}}" width="70" height="70"> {{$q['title']}}</h6>
                            </div>
                            <div class="d-flex align-items-center text-sm ">
                                <small class="mx-1">Auteur le {{date('d-m-Y',strtotime($q['created_at']))}}</small>
                                <a class="px-3 mb-0 btn btn-outline-primary" href="{{route("seeBlog",['slug'=>$q['slug']])}}"
                                   type="button">Voir</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header text-center pt-4">
                    <a type="button" href="{{route("pageAddBlog")}}" class="btn bg-warning text-white w-50 my-4 mb-2">Ajouter</a>
                </div>
            </div>
        </div>
    </div>

@endsection
