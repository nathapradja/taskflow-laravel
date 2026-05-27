@if(session('success'))

    <div class="bg-green-100 border border-green-200 text-green-700 p-4 rounded-2xl mb-6">

        {{ session('success') }}

    </div>

@endif