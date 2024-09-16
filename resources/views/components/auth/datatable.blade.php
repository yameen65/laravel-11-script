@section('auth_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endsection

<table id="myTable" class="table table-striped table-bordered">
    {{ $slot }}
</table>

@section('auth_scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endsection
