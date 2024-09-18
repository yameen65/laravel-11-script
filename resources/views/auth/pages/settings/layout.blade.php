<x-layouts.auth page-title="{{ $title }}" sub-title="{{ $subTitle }}">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <x-auth.card card-header="Site Configuration" extra-body-class="p-0">
                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'settings.index' ? 'active' : '' }}"
                        href="{{ route('settings.index') }}">
                        Basic info
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'settings.smtp' ? 'active' : '' }}"
                        href="{{ route('settings.smtp') }}">
                        Email Setting
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'settings.social_logins' ? 'active' : '' }}"
                        href="{{ route('settings.social_logins') }}">
                        Social Logins
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'settings.payment' ? 'active' : '' }}"
                        href="{{ route('settings.payment') }}">
                        Payment
                    </a>
                </div>
            </x-auth.card>
        </div>

        <div class="col-md-8 col-xl-9">
            {{ $slot }}
        </div>
    </div>
</x-layouts.auth>
