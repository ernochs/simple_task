<!-- Modal -->
<div class="modal fade" id="editTask{{$task->id}}" tabindex="-1" aria-labelledby="editTaskLabel{{$task->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTaskLabel{{$task->id}}">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Task Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Task Name" value="{{ old('name', $task->name) }}" required>
                    </div>

                    <!-- Priority -->
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" name="priority" required>
                            <option disabled>Select Priority</option>
                            <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
                            <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
                            <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>

                    <!-- Project -->
                    <div class="mb-3">
                        <label for="project_id" class="form-label">Project</label>
                        <select class="form-select" name="project_id" required>
                            <option disabled>Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $task->start_date) }}" readonly>
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $task->end_date) }}" readonly>
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Task Status</label>
                        <select class="form-select" name="status" required>
                            <option disabled>Select status</option>
                            <option value="NOT STARTED" {{ $task->status == "NOT STARTED" ? 'selected' : '' }}>NOT STARTED</option>
                            <option value="PENDING" {{ $task->status == "PENDING" ? 'selected' : '' }}>PENDING</option>
                            <option value="ONGOING" {{ $task->status == "ONGOING" ? 'selected' : '' }}>ONGOING</option>
                            <option value="COMPLETED" {{ $task->status == "COMPLETED" ? 'selected' : '' }}>COMPLETED</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
