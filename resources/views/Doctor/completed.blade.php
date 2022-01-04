@extends('website.layouts.app')

@section('website')
<div class="container">
    <div class="pending-radiology card">
        <div class="card-heading">
            <h1>@lang('Completed Radiology')</h1>
        </div>
        @if ($radiology->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Patient Name')</th>
                            <th scope="col">@lang('Center Name')</th>
                            <th scope="col">@lang('Show')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($radiology as $key=>$rad)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $rad->patient->user->getFullNameAttribute() }}</td>
                                <td>
                                    @isset($rad->center->user)
                                    {{ $rad->center->user->getFullNameAttribute() }}
                                    @endisset
                                </td>
                                <td>
                                    <button class="btn btn-primary">
                                        <a href="#">
                                            @lang('Show') <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $radiology->links("pagination::bootstrap-4") }}
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <h6>@lang('There is no completed radiology yet')</h6>
            </div>
        @endif
    </div>
</div>
@endsection
