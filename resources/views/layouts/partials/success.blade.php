@if(session('success'))
    <div id="alerta_sucesso" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">
            {{ session('success') }}
        </div>
    </div>
    <script>
        setTimeout(() => { $("#alerta_sucesso").hide() }, 5000);
    </script>
@endif
