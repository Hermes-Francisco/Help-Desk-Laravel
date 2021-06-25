@inject('level', 'App\Enums\Level')
@inject('status', 'App\Enums\Status')
<x-app-layout>
    @include('layouts.partials.success')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex flex-row justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('fields.ticket.information') }}
                    </h3>

                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ __('fields.ticket.details') }}
                    </p>
                </div>

                @can('edit_ticket')
                    <div>
                        <a href="{{ route('ticket.edit', $ticket) }}" class=" bg-blue-500 text-sm text-white px-5 py-2 rounded font-medium hover:bg-blue-600 transition duration-200">
                            {{ __('fields.buttons.edit') }}
                        </a>
                    </div>
                @endcan
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.title') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>{{ $ticket->title }}</p>
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.author') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>{{ isset($ticket->user->name)? $ticket->user->name : 'Usuário deletado' }}</p>
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Responsável') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>{{ isset($ticket->responsible->name)? $ticket->responsible->name : 'Sem responsável' }}</p>
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.due') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ date_br($ticket->due) }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Status') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $status->getStatus($ticket->status) }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $ticket->description }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.gravity') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $level->informationLevel($ticket->gravity) }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.urgency') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $level->informationLevel($ticket->urgency) }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('fields.ticket.tendency') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $level->informationLevel($ticket->tendency) }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-guest-layout>
