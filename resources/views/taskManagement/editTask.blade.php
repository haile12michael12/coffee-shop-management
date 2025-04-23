<x-layout>
<x-task-management.task-form-css />
<div class="task-form">
    <h2>Edit Task</h2>
    <form class="taskForm" id="taskForm" action="{{ route('taskManagement.updateTask', $task)}}" method="post"> 
    @method('PATCH')
        <x-task-management.form :task="$task"/>
    </form>
</div>
</x-layout>