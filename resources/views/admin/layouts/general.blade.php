@include('admin.layouts.header')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            @yield('content')
        </div>
    </div>
    @include('admin.layouts.footer')
</div>

