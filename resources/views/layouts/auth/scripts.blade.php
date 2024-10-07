</div>

<script src="{{ asset('assets/js/app.js') }}"></script>
@yield('auth_scripts')

<script>
    function showToaster(type, message, title) {
        toastr.options.closeButton = true;
        toastr.options.showMethod = 'slideDown';
        toastr.options.closeEasing = 'swing';
        toastr.options.progressBar = true;
        toastr.options.timeOut = 2500;
        toastr.options.positionClass = "toast-bottom-right";

        toastr[type](message, title);
    }

    @if (session('success'))
        showToaster('success', '{{ session('success') }}', 'Success');
    @elseif (session('error'))
        showToaster('error', '{{ session('error') }}', 'Error');
    @elseif (session('info'))
        showToaster('info', '{{ session('info') }}', 'Info');
    @elseif (session('warning'))
        showToaster('warning', '{{ session('warning') }}', 'Warning');
    @endif
</script>

</body>

</html>
