@props([ 'name','value'=>data_get(Form::getModel(),$name,null), 'label'=>''])
@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
@endphp
<div class="form-group row no-gutters">

    <label
            class="col-sm-12 col-form-label text-left {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
        {{ $label }}
    </label>

    <div class="col-sm-12">

        <div class="image-input image-input-outline @if(blank($value)) image-input-empty @endif" data-kt-image-input="true"
             style="background-image: url('{{ asset('vendor/hsmfawaz/ui/metronic/assets/media/avatars/blank.png') }}')">
            <!--begin::Preview existing avatar-->
            <div class="image-input-wrapper w-125px h-125px"
                 style="background-image:  @if(filled($value)) url('{{ $value }}') @else none  @endif;"></div>
            <!--end::Preview existing avatar-->
            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change {{ $label }}">
                <i class="bi bi-pencil-fill fs-7" style="margin-left: 30px;"></i>
                <!--begin::Inputs-->
                <input
                        type="file"
                        class="form-control"
                        x-ref="input"
                        accept=".png, .jpg, .jpeg"
                        name="{{ $name }}"
                >
                <input type="hidden" name="avatar_remove"/>
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
            <!--begin::Cancel-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel {{ $label }}">
																				<i class="bi bi-x fs-2"></i>
			</span>
            <!--end::Cancel-->
            <!--begin::Remove-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove {{ $label }}">
																				<i class="bi bi-x fs-2"></i>
																			</span>
            <!--end::Remove-->
        </div>
        @error(dotted_string($name))
        <div class="text-danger mt-3">{{ $message }}</div>
        @enderror
    </div>
</div>
