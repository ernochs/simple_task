<!-- Modal -->
<div class="modal fade" id="deleteTask{{$task->id}}" tabindex="-1" aria-labelledby="editTaskLabel{{$task->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTaskLabel{{$task->id}}">Delete Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this task, <br>
                        <span class="fw-bolder text-danger">{{$task->name}}</span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
