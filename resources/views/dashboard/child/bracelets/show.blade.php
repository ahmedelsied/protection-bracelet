<x-ui::layout :title="__('Bracelet: :title',['title'=>$bracelet->child_name])" :breadcrumbs="[$bracelet->code,$bracelet->child_name]">
    <x-slot:actions>
    </x-slot:actions>
    <x-slot:scripts>
        @customvite('src/index.ts','vendor/bracelet/statistics')
    </x-slot:scripts>

</x-ui::layout>
