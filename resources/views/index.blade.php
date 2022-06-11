@extends('layouts.template')
@section('body')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">messages Blog</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{$nbr_blog}}
{{--                                    <span class="text-success text-sm font-weight-bolder">6 lu(s)</span>--}}
{{--                                    <span class="text-danger text-sm font-weight-bolder">4 non-lu(s)</span>--}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Categories crées</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{$nbr_category}}

                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Questions faq</p>
                                <h5 class="font-weight-bolder mb-0">{{$nbr_faq}}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Comptes admin</p>
                                <h5 class="font-weight-bolder mb-0">{{$nbr_faq}}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Blog</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">5</span> Derniers messages
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0 cardBodyElement">
                    <ul class="list-group listElement">
                        @foreach($last_blog as $q)
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

    </div>
@endsection
