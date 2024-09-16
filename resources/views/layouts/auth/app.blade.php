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
