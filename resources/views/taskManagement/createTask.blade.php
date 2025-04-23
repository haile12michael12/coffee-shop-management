<x-layout>
<x-task-management.task-form-css />
<div class="task-form">
    <h2>Add New Task</h2> 
    <form class="taskForm" id="taskForm" action="{{ route('taskManagement.store')}}" method="post">
        <x-task-management.form />
    </form>
</div>
<section class="task-list">
    <x-task-management.task-list :tasks="$tasks" />
</section>
</x-layout>