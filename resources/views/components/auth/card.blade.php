<style>
    .card_image {
        background-image: url('{{ asset('dashboard/assets/img/promotionBanner.png') }}');
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<div class="card shadow border-0 h-100">
    @if ($cardHeader != null)
        <div class="card-header text-white card_image">

            <div class="hstack gap-3">
                {{ $cardHeader }}

                @if ($headerButton)
                    {{ $headerButton }}
                @endif

            </div>

        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
