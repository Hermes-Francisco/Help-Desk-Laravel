@props(['roles'])
<div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
    <select name="role" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
        <option value="category" disabled selected>Tipo de usuário
        </option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>
