@extends('website.layouts.app')

@section('website')
@if (App::isLocale('ar')){{-- Translate date into arabic --}}
{{ \Carbon\Carbon::setLocale('ar') }}
@endif
<div class="container">
    <div class="pending-radiology card">
        <div class="card-heading">
            <h1>@lang('Pending Radiology')</h1>
            @if(session()->has('created'))
                <div class="alert alert-success  m-4  ">
                    <p>{{ session('created') }}</p>
                </div>
            @endif
        </div>
        @if ($radiology->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Patient Name')</th>
                            <th scope="col">@lang('Doctor Name')</th>
                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('Show')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($radiology as $key=>$rad)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $rad->patient->user->getFullNameAttribute() }}</td>
                                <td>{{ $rad->doctor->user->getFullNameAttribute() }}</td>
                                <td>
                                    <span>{{ $rad->created_at->diffForHumans() }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-success">
                                        <a href="{{ route('center.show.radiology',['id'=>$rad->id]) }}">
                                            @lang('Show radiology') <i class="fa fa-arrow-right"></i>
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
                <h6>@lang('There is no pending radiology yet')</h6>
            </div>
        @endif
    </div>
</div>
@endsection
