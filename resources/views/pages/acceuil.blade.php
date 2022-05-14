@extends('template')
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
                                   10
                                    <span class="text-success text-sm font-weight-bolder">6 lu(s)</span>
                                    <span class="text-danger text-sm font-weight-bolder">4 non-lu(s)</span>
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
                                    2
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
                                <h5 class="font-weight-bolder mb-0">5</h5>
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
                                <h5 class="font-weight-bolder mb-0">3</h5>
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
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Oliver Liam</h6>
                                <span class="mb-2 text-xs">Contact: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>

                                <span class="mb-2 text-xs">Messages:
                                    <span class="text-dark font-weight-bold ms-sm-2">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non ultrices nisi,eu
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">Email:
                                    <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span>
                                </span>
                                <span class="text-xs">VAT Number:
                                    <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span>
                                </span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-primary px-3 mb-0" href="blog/voir"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Modifier</a>
                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
