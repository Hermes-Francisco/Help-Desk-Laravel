@isset(request()->query()['author'])
    <input type="hidden" name="author" value="{{request()->query()['author']}}">
@endisset
@isset(request()->query()['status'])
    <input type="hidden" name="status" value="{{request()->query()['status']}}">
@endisset
@isset(request()->query()['responsible'])
    <input type="hidden" name="responsible" value="{{request()->query()['responsible']}}">
@endisset
