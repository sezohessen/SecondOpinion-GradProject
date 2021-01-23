<?php
use App\Models\Country;

$properties=json_decode($properties, true);

?>
@if(empty($properties))
    <span class="label label-danger label-pill label-inline mr-2">@lang("Empty")</span>
@else
    @if($subject_type=='App\Models\User')
       <strong> @lang('Email') : </strong>   {{$properties['attributes']['email'] ?? "Undefined"}} <br>
       <strong> @lang("First Name") :</strong>   {{$properties['attributes']['first_name'] ?? "Undefined"}} <br>
       <strong> @lang("Phone Number") : </strong>   {{$properties['attributes']['phone'] ?? "Undefined"}}
    @else
    <?php
    $country=Country::find($properties['attributes']['Country_id'])
    ?>
        <strong> @lang("Phone Number") : </strong>   {{$properties['attributes']['phone'] ?? "Undefined"}} <br>
        <strong> @lang("Country") : </strong>   {{ attr_lang_name($country->name_ar ?? "Undefined",$country->name?? "Undefined") }} <br>
    @endif
@endif
