<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs" :files="true">
    <div class="row">
        <div class="col-md-4">
            <x-ui::form.input name="name" :label="__('Name')" required/>
        </div>
        <div class="col-md-4">
            <x-ui::form.input name="phone" :label="__('Phone')" required/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <x-ui::form.input name="password" type="password" :label="__('Password')"/>
        </div>
        <div class="col-md-6">
            <x-ui::form.input name="password_confirmation" type="password"
                              :label="__('Password Confirmation')"/>
        </div>
    </div>
    <x-ui::form.select name="roles[]" :options="$roles" multiple data-control="select2"
                       :selected="$selected " :label="__('Roles')"/>
    <x-ui::form.image name="avatar" :label="__('Avatar')"/>
</x-ui::form>
