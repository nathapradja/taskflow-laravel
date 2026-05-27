<x-app-layout>

    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Create Task
        </h1>

        <form action="{{ route('projects.tasks.store', $project) }}"
              method="POST"
              enctype="multipart/form-data"
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
                          rows="5"
                          class="w-full border rounded p-2">{{ old('description') }}</textarea>

            </div>

            <div>

                <label class="block mb-1">
                    Status
                </label>

                <select name="status"
                        class="w-full border rounded p-2">

                    <option value="todo">Todo</option>
                    <option value="progress">Progress</option>
                    <option value="done">Done</option>

                </select>

            </div>

            <div>

                <label class="block mb-1">
                    Priority
                </label>

                <select name="priority"
                        class="w-full border rounded p-2">

                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>

                </select>

            </div>

            <div>

                <label class="block mb-1">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       value="{{ old('due_date') }}"
                       class="w-full border rounded p-2">

            </div>

            <div>
                <label class="block mb-1">
                    Attachment
                </label>

                <input type="file"
                       name="attachment"
                       class="w-full border rounded p-2">
                
                @error('attachment')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save Task
            </button>

        </form>

    </div>

</x-app-layout>