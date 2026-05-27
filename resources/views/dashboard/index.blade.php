<x-app-layout>

    <div class="p-6 lg:p-10">

        <div class="mb-8">

            <h1 class="text-4xl font-bold text-slate-800">
                Dashboard
            </h1>

            <p class="text-slate-500 mt-2">
                Welcome back to TaskFlow
            </p>

        </div>

        <!-- Statistics -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <p class="text-slate-500 text-sm">
                    Total Projects
                </p>

                <h2 class="text-4xl font-bold mt-3 text-slate-800">
                    {{ $totalProjects }}
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <p class="text-slate-500 text-sm">
                    Total Tasks
                </p>

                <h2 class="text-4xl font-bold mt-3 text-slate-800">
                    {{ $totalTasks }}
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <p class="text-slate-500 text-sm">
                    Completed Tasks
                </p>

                <h2 class="text-4xl font-bold mt-3 text-green-600">
                    {{ $completedTasks }}
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <p class="text-slate-500 text-sm">
                    Overdue Tasks
                </p>

                <h2 class="text-4xl font-bold mt-3 text-red-500">
                    {{ $overdueTasks }}
                </h2>

            </div>

        </div>

        <!-- Progress -->

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mt-8">

            <div class="flex justify-between items-center mb-4">

                <h2 class="text-xl font-semibold text-slate-800">
                    Task Progress
                </h2>

                <span class="text-sm text-slate-500">
                    {{ $progressPercentage }}%
                </span>

            </div>

            <div class="w-full bg-slate-200 rounded-full h-3">

                <div class="bg-blue-500 h-3 rounded-full transition-all duration-300"
                     style="width: {{ $progressPercentage }}%">

                </div>

            </div>

        </div>

        <!-- Recent Section -->

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

            <!-- Recent Projects -->

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <div class="flex justify-between items-center mb-5">

                    <h2 class="text-xl font-semibold text-slate-800">
                        Recent Projects
                    </h2>

                    <a href="{{ route('projects.index') }}"
                       class="text-blue-500 text-sm font-medium">

                        View All

                    </a>

                </div>

                <div class="space-y-4">

                    @forelse($recentProjects as $project)

                        <div class="border border-slate-200 rounded-xl p-4">

                            <h3 class="font-semibold text-slate-800">
                                {{ $project->title }}
                            </h3>

                            <p class="text-sm text-slate-500 mt-2">
                                Deadline:
                                {{ $project->deadline ?? 'No deadline' }}
                            </p>

                        </div>

                    @empty

                        <p class="text-slate-500">
                            No projects found.
                        </p>

                    @endforelse

                </div>

            </div>

            <!-- Recent Tasks -->

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">

                <h2 class="text-xl font-semibold text-slate-800 mb-5">
                    Recent Tasks
                </h2>

                <div class="space-y-4">

                    @forelse($recentTasks as $task)

                        <div class="border border-slate-200 rounded-xl p-4">

                            <div class="flex justify-between items-center">

                                <h3 class="font-semibold text-slate-800">
                                    {{ $task->title }}
                                </h3>

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

                            </div>

                            <p class="text-sm text-slate-500 mt-3">
                                Priority:
                                {{ ucfirst($task->priority) }}
                            </p>

                        </div>

                    @empty

                        <p class="text-slate-500">
                            No tasks found.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>