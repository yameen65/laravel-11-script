@include('layouts.guest.links')

@include('layouts.guest.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="d-flex flex-column justify-content-center mastercolumndiv">
                <div class="text-center mt-4 mt-mb-0 mb-md-2">
                    <h3> {{ $pageTitle }} </h3>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@include('layouts.guest.footer')
