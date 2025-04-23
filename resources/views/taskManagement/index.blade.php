<x-layout>
<section class="task-container">
    <x-task-management.task-overview :tasksOverview="$tasksOverview"/>
    <div class="Task-Distribution"> 
        <div class="pie-chart">
            <h3 style="padding-bottom: 1rem;">Task Distribution</h3>
            <div class="pie-container">
                <canvas id="taskDistributionChart"></canvas>
            </div>
            <div class="status-container">
                <span class="status status_completed">Comp</span>
                <span class="status status_pending">Pend</span>
                <span class="status status_overdue">Over</span>
                <span class="status status_in_progress">Prog</span>
            </div>
        </div>
    </div>
</section>
<section class="Task-Completion">
  <div class="bar-chart">
    <div class="title">
      <h3>Task Completion Trends</h3>
      <select name="" id="DateRange">
        <option value="2025">2025</option>
        <option value="2024">2024</option>
      </select>
    </div>
    <div class="bar-container">
      <canvas id="taskCompletionChart"></canvas>
    </div>
  </div>
  <div class="line-graph-container">
    <canvas id="taskOverviewLineGraph"></canvas>
  </div>
</section>
<section class="task-list">
  <x-task-management.task-list :tasks="$tasks" />
</section>
    <script>
       window.pieChartData = {!! $pieChart ?? [] !!}; 
    </script>
</x-layout>