@extends('app')

@section('content')
<h1 class="page-header">{{ trans('misc.netblocks') }}</h1>
<div class="row">
    <div  class="col-md-3 col-md-offset-9 text-right">
        {!! link_to_route('admin.netblocks.create', trans('netblocks.button.new_netblock'), [], ['class' => 'btn btn-info']) !!}
        {!! link_to_route('admin.netblocks.export', trans('misc.button.csv_export'), ['format' => 'csv'], ['class' => 'btn btn-info']) !!}
    </div>
</div>
<table class="table table-striped" id="netblocks-table">
    <thead>
    <tr>
        <th>{{ trans('netblocks.first_ip') }}</th>
        <th>{{ trans('netblocks.last_ip') }}</th>
        <th>{{ trans('misc.contact') }}</th>
        <th class="text-right">{{ trans('misc.action') }}</th>
    </tr>
    </thead>
</table>
@endsection

@section('extrajs')
<script>
     $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#netblocks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.netblocks.search') .'/query/' !!}',
            columnDefs: [{
                targets: -1,
                data: null,
                defaultContent: ''
            }],
            language: {
                url: '{{ asset("/i18n/$auth_user->locale.json") }}'
            },
            columns: [
                { data: 'first_ip', name: 'first_ip' },
                { data: 'last_ip', name: 'last_ip' },
                { data: 'contacts_name', name: 'contacts.name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, class: "text-right" },
            ]
        });
    });
</script>
@endsection
