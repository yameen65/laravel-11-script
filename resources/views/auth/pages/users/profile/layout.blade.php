<x-layouts.auth page-title="{{ $title }}" sub-title="{{ $subTitle }}">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <x-auth.card card-header="Profile Setting" extra-body-class="p-0">
                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'myprofile' ? 'active' : '' }}"
                        href="{{ route('myprofile') }}">
                        Account
                    </a>
                    <a class="list-group-item list-group-item-action {{ request()->route()->getName() == 'change_password' ? 'active' : '' }}"
                        href="{{ route('change_password') }}">
                        Password
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Privacy and safety
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Email notifications
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Web notifications
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Widgets
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Your data
                    </a>
                    <a class="list-group-item list-group-item-action" href="#">
                        Delete account
                    </a>
                </div>
            </x-auth.card>
        </div>

        <div class="col-md-8 col-xl-9">
            {{ $slot }}
        </div>
    </div>
</x-layouts.auth>
