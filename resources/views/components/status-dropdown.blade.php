@props(['value'])
<div {{ $attributes->merge(['class' =>"relative flex items-center bg-gray-100"]) }}>
    <select class="appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold w-full rounded-lg" name="status">
        </option>
        <option value="to do" {{ ($value == "to do")? 'selected' : ''}}>A fazer</option>
        <option value="in progress" {{ ($value == "in progress")? 'selected' : ''}}>Em progresso</option>
        <option value="delayed" {{ ($value == "delayed")? 'selected' : ''}}>Atrazado</option>
        <option value="done" {{ ($value == "done")? 'selected' : ''}}>Feito</option>
    </select>
</div>
