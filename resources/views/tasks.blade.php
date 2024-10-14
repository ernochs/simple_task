<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addTask">Add Tasks</button>
            </div>
            <form method="GET" action="{{ route('tasks') }}">
                <div class="mb-3">
                    <select name="project_id" class="form-select" onchange="this.form.submit()">
                        <option value="" disabled selected>Select a project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            @include('modals.addTask')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <table class="table-auto w-full border-collapse border border-gray-200 text-center">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">#</th>
                                <th class="border border-gray-300 px-4 py-2">TASK NAME</th>
                                <th class="border border-gray-300 px-4 py-2">PRIORITY</th>
                                <th class="border border-gray-300 px-4 py-2">START DATE</th>
                                <th class="border border-gray-300 px-4 py-2">END DATE</th>
                                <th class="border border-gray-300 px-4 py-2">STATUS</th>
                                <th class="border border-gray-300 px-4 py-2">DATE CREATED</th>
                                <th class="border border-gray-300 px-4 py-2">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-tasks">
                            @forelse ($tasks as $task)
                            <tr data-id="{{$task->id}}">
                                <td class="border border-gray-300 px-4 py-2 handle" style="cursor: grab;">
                                    <i class="fas fa-arrows-alt"></i> <!-- Example drag icon -->
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{$task->name}}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($task->priority == "1")
                                        <span class="inline-block bg-red-500 text-white px-2 py-1 rounded-full text-xs">High</span>
                                    @elseif($task->priority == "2")
                                        <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">Medium</span>
                                    @elseif($task->priority == "3")
                                        <span class="inline-block bg-green-500 text-white px-2 py-1 rounded-full text-xs">Low</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{date("d-m-Y", strtotime($task->start_date))}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{date("d-m-Y", strtotime($task->end_date))}}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($task->status == "NOT STARTED")
                                        <span class="inline-block bg-red-500 text-white px-2 py-1 rounded-full text-xs">NOT STARTED</span>
                                    @elseif($task->status == "PENDING")
                                        <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">PENDING</span>
                                    @elseif($task->status == "COMPLETED")
                                        <span class="inline-block bg-green-500 text-white px-2 py-1 rounded-full text-xs">COMPLETED</span>
                                    @elseif($task->status == "ONGOING")
                                        <span class="inline-block bg-yellow-900 text-white px-2 py-1 rounded-full text-xs">ONGOING</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{date("d-m-Y", strtotime($task->created_at))}}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editTask{{$task->id}}"><i class="fas fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTask{{$task->id}}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @include('modals.editTask')
                            @include('modals.deleteTask')
                            @empty
                                <tr>
                                    <td colspan="8">No Tasks Created Yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
