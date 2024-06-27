@extends('layouts.vertical', ['title' => 'Dashboard', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['sub_title' => 'Menu', 'page_title' => 'Dashboard'])

    <div class="row">
        <div class="col-xxl-6 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-home-6-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Locação</h6>
                    <h2 class="my-2">{!! $allProperties->where('type_rent', 1)->count() !!}</h2>
                    <p class="mb-0 d-none">
                        <span class="badge bg-white bg-opacity-10 me-1">2.97%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-6 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-home-6-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Venda</h6>
                    <h2 class="my-2">{!! $allProperties->where('type_buy', 1)->count() !!}</h2>
                    <p class="mb-0 d-none">
                        <span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6 d-none">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Contatos</h6>
                    <h2 class="my-2">753</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6 d-none">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-group-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                    <h2 class="my-2">63,154</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1">8.21%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-uppercase">
                    <th><strong>COD</strong></th>
                    <th><strong>Título</strong></th>
                    <th><strong>Localização</strong></th>
                    <th><strong>Corretor</strong></th>
                    <th><strong>Venda/Locação</strong></th>
                </thead>
                <tbody>
                    @forelse ($allProperties as $item)
                        <tr>
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->title !!}</td>
                            <td>{!! $item->city->name !!}/{!! $item->state->initials !!}</td>
                            <td>{!! $item->user->name !!}</td>
                            <td>
                                @if ($item->type_buy)
                                    Venda
                                @endif

                                @if ($item->type_buy && $item->type_rent)
                                    &
                                @endif
                                @if ($item->type_rent)
                                    Locação
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center"><strong>Não possui Registro</strong></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
