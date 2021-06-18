<x-app-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('ticket.update', $ticket) }}">
            @csrf
            @method('PUT')

            <div>
                <x-jet-label for="title" value="{{ __('Título') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$ticket->title" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descrição') }}" />
                <textarea id="description" class="block mt-1 rounded-lg w-full" type="description" name="description" required>{{$ticket->description}}</textarea>
            </div>

            <div class="mt-4">
                <x-jet-label for="due" value="{{ __('Prazo') }}" />
                <x-jet-input id="due" class="block mt-1 w-full" type="date" name="due" :value="$ticket->due" autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="gut" value="{{ __('Gravidade, Urgência e Tendência') }}" />
                <div class="flex items-center justify-end mt-2" id="gut" name="gut">
                    <?php $name = ['gravity', 'urgency', 'tendency']?>
                    <x-gut-dropdown class="flex-1" :name="$name[0]" :value="$ticket->gravity">Gravidade</x-gut-dropdown>
                    <x-gut-dropdown class="flex-1" :name="$name[1]" :value="$ticket->urgency">Urgência</x-gut-dropdown>
                    <x-gut-dropdown class="flex-1" :name="$name[2]" :value="$ticket->tendency">Tendência</x-gut-dropdown>
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <div class="flex-1">
                    <x-jet-label value="{{ __('Status') }}" />
                    <x-status-dropdown :value="$ticket->status" class="mt-2"/>
                </div>
                @if (isset($ticket->responsible)|| request()->user()->capable('edit_responsibility'))
                    <div class="flex-1 ml-2">
                        <x-jet-label for="responsible" value="{{ __('Usuário Responsável') }}" />
                        <div class="w-full items-center justify-end mt-2">
                            @can('edit_responsibility')
                                <x-user-dropdown class="w-full">
                                    {{isset($ticket->responsible)? $ticket->responsible->name : ''}}
                                </x-user-dropdown>
                            @else
                                <h4 class="ml-4 w-full">{{isset($ticket->responsible)? $ticket->responsible->name : ''}}</h4>
                            @endcan
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Salvar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
