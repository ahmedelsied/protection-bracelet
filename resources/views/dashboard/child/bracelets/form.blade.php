<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs">
    <x-ui::form.input name="child_name" :label="__('Child name')"/>
    <x-ui::form.input name="code" :disabled="!is_null($model)" :label="__('Bracelet code')"/>
</x-ui::form>