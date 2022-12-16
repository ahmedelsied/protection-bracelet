@props(['title'=>'','route','breadcrumbs'=>[],'datatable','noActions'=>false,'parameters'=>[],'permission'=>null])
<x-ui::layout :title="$title" :breadcrumbs="$breadcrumbs">

    {{ $prepend ?? '' }}

    <div class="card">
        <div class="card-body overflow-auto">
            {{$datatable->table(['class'=>'table dataTable table-row-bordered gy-5'])}}
        </div>
    </div>

    {{ $append ?? '' }}

    @if(!$noActions)
        <x-slot:actions>
            @isset($actions)
                {{ $actions }}
            @else
                @if($permission === null || $permission->can('create'))
                    <a href="{{route("{$route}.create",$parameters)}}"
                       class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create') }}
                    </a>
                @endif
            @endif
        </x-slot:actions>
    @endif
    <x-slot:header>
        <style>
            .buttons-print {
                margin: 0 5px;
                padding: 5px 20px !important;
            }
        </style>
        {{ $header ?? '' }}
    </x-slot:header>
    <x-slot:scripts>
        <script src="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"
                type="text/javascript"></script>
        {{ $datatable->scripts() }}
        <script>
            window.helper_trans = {
                title: '{{ __("Are you sure ?") }}',
                body: '{{ __("You wont be able to restore it again") }}',
                confirm: '{{ __("Yes, delete") }}',
                cancel: '{{ __("No, cancel") }}'
            }

            function deleteRow(ts) {
                let url = $(ts).data('href');
                Swal.fire({
                    title: window.helper_trans.title,
                    text: window.helper_trans.body,
                    showCancelButton: true,
                    confirmButtonText: window.helper_trans.confirm,
                    cancelButtonText: window.helper_trans.cancel,
                    timer: undefined
                }).then((isConfirm) => {
                    if (isConfirm.value) {
                        $.post(url, {_method: 'DELETE'}).done(function (response) {
                            if (response.status) {
                                $('.dataTable').DataTable().ajax.reload();
                                Swal.fire("Good Job", response.data, "success");
                            } else {
                                Swal.fire("Failed!", 'Unexpected error occurred', "error");
                                console.log(response);
                            }
                        })
                    }
                });
            }
        </script>
        {{ $scripts ?? '' }}
    </x-slot:scripts>
</x-ui::layout>

