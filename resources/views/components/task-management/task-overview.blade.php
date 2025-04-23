@props(['tasksOverview' => []]) <!-- Optional: Provide a default value -->
<div class="task-overview"> 
    <div class="card totalTasks">
        <div>
          <p>{{ $tasksOverview['totalTasks'] }}</p>
          <h3>Total Tasks</h3>
        </div>
        <i class="ri-list-check-3"></i>
    </div>
    <div class="card completed">
        <div>
          <p>{{ $tasksOverview['completedTasks'] }}</p>
          <h3>Completed</h3>
        </div>
        <i class="ri-checkbox-circle-line"></i>
    </div>
    <div class="card pending">
        <div>
          <p>{{ $tasksOverview['pendingTasks'] }}</p>
          <h3>Pending</h3>
        </div>
        <i class="ri-hourglass-fill"></i>
    </div>
    <div class="card in_progress">
        <div>
          <p>{{ $tasksOverview['inProgressTasks'] }}</p>
          <h3>In Progress</h3>
        </div>
        <i class="ri-progress-5-line"></i>
    </div>
    <div class="card overdue">
        <div>
          <p>{{ $tasksOverview['overdueTasks'] }}</p>
          <h3>Overdue</h3>
        </div>
        <i class="ri-error-warning-line"></i>
    </div>
</div>