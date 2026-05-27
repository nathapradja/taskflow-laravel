<x-app-layout>

    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Edit Project
        </h1>

        <form action="{{ route('projects.update', $project) }}"
              method="POST"
              class="space-y-4">

            @csrf
            @method('PUT')

            <div>

                <label class="block mb-1">
                    Title
                </label>

                <input type="text"
                       name="title"
                       value="{{ $project->title }}"
                       class="w-full border rounded p-2">

            </div>

            <div>

                <label class="block mb-1">
                    Description
                </label>

                <textarea name="description"
                          class="w-full border rounded p-2"
                          rows="5">{{ $project->description }}</textarea>

            </div>

            <div>

                <label class="block mb-1">
                    Deadline
                </label>

                <input type="date"
                       name="deadline"
                       value="{{ $project->deadline }}"
                       class="w-full border rounded p-2">

            </div>

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update Project
            </button>

        </form>

    </div>

</x-app-layout>