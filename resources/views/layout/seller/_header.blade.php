{{-- Header --}}
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }}" {{ Metronic::printAttrs('header') }}>

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between">
        @if (config('layout.header.self.display'))

            @php
                $kt_logo_image = 'logo-light.png';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-dark.png' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo-light.png' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if(config('layout.aside.self.display') == false)
                    <div class="header-logo">
                        <a href="{{ url('/seller') }}">
                            <img alt="{{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}"
                            src="{{ find_image(App\Models\Settings::first()->logo,'img/settings/') }}" height="30px" width="40px"/>
                        </a>
                    </div>
                @endif

                <div id="kt_header_menu" class="header-menu header-menu-mobile {{ Metronic::printClasses('header_menu', false) }}" {{ Metronic::printAttrs('header_menu') }}>
                    <ul class="menu-nav {{ Metronic::printClasses('header_menu_nav', false) }}">
                        {{ Menu::renderHorMenu(config('menu_header_seller.items')) }}
                    </ul>
                </div>
            </div>

        @else
            <div></div>
        @endif

        @include('layout.partials.extras._topbar')
    </div>
</div>
