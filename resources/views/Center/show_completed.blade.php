@extends('website.layouts.app')

@section('website')
{{-- {{ dd($errors) }} --}}
<div class="container">
    <div class="card doctor-feedback">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h6><span>@lang('Patient Name')</span>: <span class="patient-name">{{ $radiology->patient->user->getFullNameAttribute() }}</span></h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">@lang('Patient brief description about the radiology condition')</label>
                        <textarea class="form-control" disabled>{{ $radiology->desc }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($radiology->files as $key=>$file)
                            <div class="col-md-4">
                                <div class="from-group">
                                    <p><span>@lang('File') {{ $key+1 }}</span></p>
                                    @php
                                        $file_path = public_path() .$file->image->base.$file->image->name;
                                    @endphp
                                    @if (file_exists($file_path))
                                        <a class="btn btn-primary" href="{{ route('center.downloadfile',['id'=>$file->image_id,'radiology_id' => $radiology->id]) }}" target="_blank">
                                            @lang('Download File') {{ $file->image->name }}
                                        </a>
                                    @else
                                        <p><strong>@lang('File not found')</strong></p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="mt-20" for="">@lang('Your report')</label>
                    <div class="form-group">
                        <textarea  class="form-control" disabled>{{ $feedback->desc }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="from-group">
                        <p><span>@lang('Your File')</span></p>
                        @if ($feedback->pdf_report)
                            @php
                                $file_path = storage_path('app') .App\Models\DoctorFeedback::Files.$feedback->pdf_report;
                            @endphp
                            @if (file_exists($file_path))
                                <a class="btn btn-primary" href="{{ route('center.download.report',['id'=>$feedback->id,'rad'=>$feedback->radiology_id]) }}" target="_blank">
                                    @lang('Download File')
                                </a>
                            @else
                                <p><strong>@lang('File not found')</strong></p>
                            @endif
                        @else
                            <p><strong>@lang('File not found')</strong></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
