@inject('level', 'App\Enums\Level')
@inject('status', 'App\Enums\Status')
<x-app-layout>
    @include('layouts.partials.success')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="table w-full p-2">
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Id
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Título
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Gravidade
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Urgência
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Tendência
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Status
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Detalhes
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="bg-gray-100 border-b text-sm text-gray-600">
                                    <td class="p-2 border-r">{{$ticket->id}}</td>
                                    <td class="p-2 border-r">{{$ticket->title}}</td>
                                    <td class="p-2 border-r">{{$level->informationLevel($ticket->gravity)}}</td>
                                    <td class="p-2 border-r">{{$level->informationLevel($ticket->urgency)}}</td>
                                    <td class="p-2 border-r">{{$level->informationLevel($ticket->tendency)}}</td>
                                    <td class="p-2 border-r">{{$status->getStatus($ticket->status)}}</td>
                                    <td class="bg-blue-400 p-2 text-white text-center hover:shadow-lg text-xs font-thin">
                                        <a href={{route('ticket.show', $ticket)}}>Ver detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <input type="hidden" name="test" value="test">
                {{$tickets->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
