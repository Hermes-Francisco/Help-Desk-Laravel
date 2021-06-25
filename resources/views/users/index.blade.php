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
                                        Nome
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Email
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Perfil
                                    </div>
                                </th>
                                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                    <div class="flex">
                                        Ação
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-gray-100 border-b text-sm text-gray-600">
                                    <td class="p-2 border-r">{{$user->name}}</td>
                                    <td class="p-2 border-r">{{$user->email}}</td>
                                    <td class="p-2 border-r">{{$user->role->name}}</td>
                                    <td class="bg-blue-400 p-2 text-white text-center hover:shadow-lg text-xs font-thin">
                                        <a href={{($user->id == request()->user()->id)? route('profile.show') : route('users.edit', $user)}}>Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{$users->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
