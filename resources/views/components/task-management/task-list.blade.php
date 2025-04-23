@props(['tasks' => []]) <!-- Optional: Provide a default value -->
<h2>Task List</h2> 
<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>Task Name</th>
        <th>Priority</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
    <tr>
        <td>{{ $task->task_name }}</td>
        <td><span class="priority {{ $task->priority }}">{{ $task->priority }}</span></td>
        <td>{{ $task->start_date }}</td>
        <td>{{ $task->end_date }}</td>
        <td>{{ $task->deadline }}</td>
        <td><span class="st status_{{ ($task->isOverdue())?'overdue':$task->status }}">{{ ($task->isOverdue())?'overdue':$task->status }}</span></td>
        <td class="actions">
          <a href="{{ route('taskManagement.editTask', $task->id) }}">Edit</a> 
          <form action="{{ route('taskManagement.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>