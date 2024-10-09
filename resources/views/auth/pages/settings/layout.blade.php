<x-layouts.auth page-title="{{ $title }}" sub-title="{{ $subTitle }}">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <x-auth.card card-header="Site Configuration" extra-body-class="p-0">
                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'basic-info' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'basic-info') }}">
                        General
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'smtp' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'smtp') }}">
                        SMTP
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'social-logins' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'social-logins') }}">
                        Social Logins
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'payment-methods' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'payment-methods') }}">
                        Payment Methods
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'registration' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'registration') }}">
                        Registration
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'languages' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'languages') }}">
                        Languages
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'activation' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'activation') }}">
                        Activation
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'upgrade' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'upgrade') }}">
                        Upgrade Software
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'site-health' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'site-health') }}">
                        Site Health
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->blade == 'cache' ? 'active' : '' }}"
                        href="{{ route('settings.index', 'cache') }}">
                        Clear Cache
                    </a>
                </div>
            </x-auth.card>
        </div>

        <div class="col-md-8 col-xl-9">
            {{ $slot }}
        </div>
    </div>
</x-layouts.auth>
