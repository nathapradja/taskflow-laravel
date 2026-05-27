<x-app-layout>

    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Create Project
        </h1>

        <form action="{{ route('projects.store') }}"
              method="POST"
              class="space-y-4">

            @csrf

            <div>

                <label class="block mb-1">
                    Title
                </label>

                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full border rounded p-2">

                @error('title')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            <div>

                <label class="block mb-1">
                    Description
                </label>

                <textarea name="description"
                          class="w-full border rounded p-2"
                          rows="5">{{ old('description') }}</textarea>

            </div>

            <div>

                <label class="block mb-1">
                    Deadline
                </label>

                <input type="date"
                       name="deadline"
                       value="{{ old('deadline') }}"
                       class="w-full border rounded p-2">

            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save Project
            </button>

        </form>

    </div>

</x-app-layout>