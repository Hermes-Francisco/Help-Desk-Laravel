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
                <textarea id="description" class="block mt-1 rounded-lg w-full" type="description" name="description" :value="old('description')" required> </textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
