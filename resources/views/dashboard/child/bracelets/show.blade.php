<x-ui::layout :title="__('Bracelet: :title',['title'=>$bracelet->child_name])" :breadcrumbs="[$bracelet->code,$bracelet->child_name]">
    <x-slot:actions>
    </x-slot:actions>
    <div id="root"></div>
    <x-slot:scripts>
        @customvite('src/main.jsx','vendor/bracelet/child/statistics/')
    </x-slot:scripts>

</x-ui::layout>
