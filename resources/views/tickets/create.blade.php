<x-app-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('ticket.store') }}">
            @csrf

            <div>
                <x-jet-label for="title" value="{{ __('Título') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descrição') }}" />
                <textarea id="description" class="block mt-1 rounded-lg w-full" type="description" name="description" required>{{old('description')}}</textarea>
            </div>

            @can('edit_ticket')
                <div class="mt-4">
                    <x-jet-label for="due" value="{{ __('Prazo') }}" />
                    <x-jet-input id="due" class="block mt-1 w-full" type="date" name="due" :value="old('due')" autofocus />
                </div>
            @endcan

            <div class="mt-4">
                <x-jet-label for="gut" value="{{ __('Gravidade, Urgência e Tendência') }}" />
                <div class="flex items-center justify-end mt-2">
                    <?php $name = ['gravity', 'urgency', 'tendency']?>
                    <x-gut-dropdown class="flex-1" :name="$name[0]">Gravidade</x-gut-dropdown>
                    <x-gut-dropdown class="flex-1" :name="$name[1]">Urgência</x-gut-dropdown>
                    <x-gut-dropdown class="flex-1" :name="$name[2]">Tendência</x-gut-dropdown>
                </div>
            </div>

            @can('edit_responsibility')
                <div class="mt-4">
                    <x-jet-label for="gut" value="{{ __('Usuário Responsável') }}" />
                    <div class="flex items-center justify-end mt-2">
                        <x-user-dropdown class="flex-1" />
                    </div>
                </div>
            @endcan

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Criar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
