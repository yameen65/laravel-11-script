@include('layouts.auth.links')

<x-auth.sidebar />

<div class="main">
    @include('layouts.auth.header')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <main class="content">
        @if (isset($sideButton))
            <div class="row mb-3">
                <div class="col-md-12">
                    <div style="float:right;">
                        {{ $sideButton }}
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    @include('layouts.auth.footer')
</div>

@include('layouts.auth.scripts')
