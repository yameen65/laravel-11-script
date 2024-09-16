@include('layouts.auth.links')

<x-auth.sidebar />

<div class="main">
    @include('layouts.auth.header')

    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    {{ $pageTitle }}
                </h1>
                <p class="header-subtitle">{{ $subTitle }}</p>
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

    @include('layouts.auth.footer')

</div>

@include('layouts.auth.scripts')
