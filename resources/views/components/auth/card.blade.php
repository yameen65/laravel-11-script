<div class="card shadow border-0">
    @if ($cardHeader != null)
        <div class="card-header pb-0">

            @if ($headerButton)
                <div class="card-actions float-end">
                    <a href="javascript::void(0)" class="me-1" onclick="location.reload()">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                    <div class="d-inline-block dropdown show">
                        <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                            <i class="align-middle" data-feather="more-vertical"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
            @endif
            <h5 class="card-title">{{ $cardHeader }}</h5>
        </div>
    @endif

    <div class="card-body {{ $extraBodyClass }}">
        {{ $slot }}
    </div>
</div>
