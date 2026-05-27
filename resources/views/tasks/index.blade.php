<x-app-layout>

    <div class="p-6 lg:p-10">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

            <div>

                <h1 class="text-4xl font-bold text-slate-800">
                    {{ $project->title }}
                </h1>

                <p class="text-slate-500 mt-2">
                    Task Management
                </p>

            </div>

            <a href="{{ route('projects.tasks.create', $project) }}"
               class="bg-blue-500 hover:bg-blue-600 transition text-white px-5 py-3 rounded-2xl font-medium">

                Create Task

            </a>

        </div>

        <form method="GET"
              action="{{ route('projects.tasks.index', $project) }}"
              class="mb-6">

            <div class="flex gap-3">

                <select name="status"
                        class="border border-slate-300 rounded-2xl px-4 py-3 pr-10 bg-white">

                    <option value="">
                        All Status
                    </option>

                    <option value="todo"
                        {{ request('status') == 'todo' ? 'selected' : '' }}>

                        Todo

                    </option>

                    <option value="progress"
                        {{ request('status') == 'progress' ? 'selected' : '' }}>

                        Progress

                    </option>

                    <option value="done"
                        {{ request('status') == 'done' ? 'selected' : '' }}>

                        Done

                    </option>

                </select>

                <button class="bg-blue-500 hover:bg-blue-600 transition text-white px-5 rounded-2xl">

                    Filter

                </button>

            </div>

        </form>

        <x-alert-success />

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Title
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Priority
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Deadline
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Attachment
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($tasks as $task)

                            <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                                <td class="p-4">

                                    <h3 class="font-semibold text-slate-800">
                                        {{ $task->title }}
                                    </h3>

                                </td>

                                <td class="p-4">

                                    @if($task->status == 'done')

                                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                            Done
                                        </span>

                                    @elseif($task->status == 'progress')

                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                                            Progress
                                        </span>

                                    @else

                                        <span class="bg-slate-100 text-slate-700 text-xs px-3 py-1 rounded-full">
                                            Todo
                                        </span>

                                    @endif

                                </td>

                                <td class="p-4 text-slate-600">

                                    {{ ucfirst($task->priority) }}

                                </td>

                                <td class="p-4 text-slate-600">

                                    {{ $task->due_date ?? '-' }}

                                </td>

                                <td class="p-4">

                                    @if($task->attachment)

                                        <a href="{{ asset('storage/' . $task->attachment) }}"
                                           target="_blank"
                                           class="text-blue-500 underline">

                                            View File

                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                                <td class="p-4">

                                    <div class="flex flex-wrap gap-2">

                                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-3 py-2 rounded-xl text-sm">

                                            Edit

                                        </a>

                                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus task ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-500 hover:bg-red-600 transition text-white px-3 py-2 rounded-xl text-sm">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="p-8 text-center text-slate-500">

                                    No tasks available yet.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-4">

                {{ $tasks->links() }}

            </div>

        </div>

    </div>

</x-app-layout>