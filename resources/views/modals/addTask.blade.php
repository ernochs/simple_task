<!-- Modal -->
<div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('tasks.create')}}" method="POST">
                @csrf
            <div class="modal-body">
                {{-- task name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Task Name" value="{{old('name')}}">
                </div>

                {{-- priority --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Priority</label>
                    <select class="form-select" name="priority">
                        <option selected>Select Priority</option>
                        <option value="1">High</option>
                        <option value="2">Medium</option>
                        <option value="3">Low</option>
                      </select>
                </div>

                {{-- project --}}
                <div class="mb-3">
                    <label for="project_id" class="form-label">Project</label>
                    <select class="form-select" name="project_id" required>
                        <option disabled>Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $project->name }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- start Date --}}
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{old('start_date')}}">
                </div>

                {{-- End Date --}}
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{old('end_date')}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Create Task</button>
            </div>
            </form>
        </div>
    </div>
</div>
