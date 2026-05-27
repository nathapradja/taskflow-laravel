<x-app-layout>

    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Edit Task
        </h1>

        <form action="{{ route('projects.tasks.update', [$project, $task]) }}"
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
                       value="{{ $task->title }}"
                       class="w-full border rounded p-2">

            </div>

            <div>

                <label class="block mb-1">
                    Description
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border rounded p-2">{{ $task->description }}</textarea>

            </div>

            <div>

                <label class="block mb-1">
                    Status
                </label>

                <select name="status"
                        class="w-full border rounded p-2">

                    <option value="todo" @selected($task->status == 'todo')>Todo</option>
                    <option value="progress" @selected($task->status == 'progress')>Progress</option>
                    <option value="done" @selected($task->status == 'done')>Done</option>

                </select>

            </div>

            <div>

                <label class="block mb-1">
                    Priority
                </label>

                <select name="priority"
                        class="w-full border rounded p-2">

                    <option value="low" @selected($task->priority == 'low')>Low</option>
                    <option value="medium" @selected($task->priority == 'medium')>Medium</option>
                    <option value="high" @selected($task->priority == 'high')>High</option>

                </select>

            </div>

            <div>

                <label class="block mb-1">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       value="{{ $task->due_date }}"
                       class="w-full border rounded p-2">

            </div>

            <div>
                <label class="block mb-1">
                    Attachment
                </label>

                    <input type="file"
                        name="attachment"
                        class="w-full border rounded p-2">

                @if($task->attachment)

                <a href="{{ asset('storage/' . $task->attachment) }}"
                   target="_blank"
                   class="text-blue-500 text-sm mt-2 inline-block">
                    View Current Attachment
                </a>

                @endif

            </div>

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update Task
            </button>

        </form>

    </div>

</x-app-layout>