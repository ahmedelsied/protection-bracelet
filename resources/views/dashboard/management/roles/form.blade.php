<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs">
    <x-ui::form.input name="name" :label="__('Name')"/>
    <div class="fv-row mt-5 px-2">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <tbody class="text-gray-600 fw-bold">
                <tr>
                    <td class="text-gray-800">{{ __('Administrator Access') }}
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                           data-bs-original-title="{{ __('Allows a full access to the system') }}"></i>
                    </td>
                    <td>
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                            <input class="form-check-input" type="checkbox"
                                   value=""
                                   id="kt_roles_select_all">
                            <span class="form-check-label"
                                  for="kt_roles_select_all">{{ __('Select all') }}</span>
                        </label>
                    </td>
                </tr>
                @foreach($permissions as $permission => $actions)
                    <tr>
                        <td class="text-gray-800"> {{ __((string)Str::of($permission)->headline()) }}</td>
                        <td>
                            <div class="d-flex">
                                @foreach($actions as $action)
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{ $action['value'] }}"
                                                name="permissions[]"
                                                @checked(in_array($action['value'], $selectedPermissions))
                                        >
                                        <span class="form-check-label">{{ __(Str::headline($action['name'])) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <!--end::Wrapper-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            $(document).ready(function () {
                $("#kt_roles_select_all").click(function () {
                    const val = $(this).prop('checked')
                    $('input[name="permissions[]"]').each(function () {
                        $(this).prop('checked', val)
                    })
                })
            });
        </script>
    </x-slot:scripts>
</x-ui::form>
