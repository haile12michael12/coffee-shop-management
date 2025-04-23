 
@csrf
   <div class="label">
     <label for="task_name">Task Title</label>
     <input type="text" id="task_name" name="task_name" placeholder="Ex: Design Dashboard"  value="{{ old('task_name', $task->task_name ?? '') }}">
   </div>
   <div class="label">
     <label for="priority">Task Priority</label>
     <select id="priority" name="priority" >
       <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>Low</option>
       <option value="medium" {{ old('priority', $task->priority ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
       <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>High</option>
     </select>
   </div>
   <div class="label">
     <label for="status">Status</label>
     <select id="status" name="status"> 
        <option value="pending" {{ old('status', $task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ old('status', $task->status ?? '') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
   </div>
 @if(!isset($task))
   <div class="label">
     <label for="start_date">Start date</label>
     <input type="date" id="start_date" name="start_date">
   </div>
   <div class="label">
     <label for="deadline">Due date</label>
     <input type="date" id="deadline" name="deadline">
   </div>
 @endif
   <button class="form-btn">Save Task</button>
        