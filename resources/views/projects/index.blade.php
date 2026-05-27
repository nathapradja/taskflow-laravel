<x-app-layout>

    <div class="p-6 lg:p-10">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

            <div>

                <h1 class="text-4xl font-bold text-slate-800">
                    Projects
                </h1>

                <p class="text-slate-500 mt-2">
                    Manage all your projects
                </p>

            </div>

            <a href="{{ route('projects.create') }}"
               class="bg-blue-500 hover:bg-blue-600 transition text-white px-5 py-3 rounded-2xl font-medium">

                Create Project

            </a>

        </div>

        <form method="GET"
              action="{{ route('projects.index') }}"
              class="mb-6">

            <div class="flex gap-3">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search project..."
                       class="w-full border border-slate-300 rounded-2xl px-4 py-3">

                <button class="bg-blue-500 hover:bg-blue-600 transition text-white px-5 rounded-2xl">

                    Search

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
                                Deadline
                            </th>

                            <th class="p-4 text-left text-sm font-semibold text-slate-600">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($projects as $project)

                            <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                                <td class="p-4">

                                    <div>

                                        <h3 class="font-semibold text-slate-800">
                                            {{ $project->title }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ Str::limit($project->description, 50) }}
                                        </p>

                                    </div>

                                </td>

                                <td class="p-4 text-slate-600">

                                    {{ $project->deadline ?? 'No deadline' }}

                                </td>

                                <td class="p-4">

                                    <div class="flex flex-wrap gap-2">

                                        <a href="{{ route('projects.tasks.index', $project) }}"
                                           class="bg-blue-500 hover:bg-blue-600 transition text-white px-3 py-2 rounded-xl text-sm">

                                            Tasks

                                        </a>

                                        <a href="{{ route('projects.edit', $project) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-3 py-2 rounded-xl text-sm">

                                            Edit

                                        </a>

                                        <form action="{{ route('projects.destroy', $project) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus project ini?')">

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

                                <td colspan="3"
                                    class="p-8 text-center text-slate-500">

                                    No projects available yet.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-4">

                {{ $projects->links() }}

            </div>

        </div>

    </div>

</x-app-layout>