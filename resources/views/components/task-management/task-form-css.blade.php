<style>
    .task-form {
    max-width: 1200px;
    margin-bottom: 2rem;
  }
  #taskForm{ 
    display: grid;
    grid-template-columns: repeat(2,1fr);
  }
  .label{
    width: 100%;
    display: grid;
    gap: .3rem;
    margin: 1rem 0 .3rem;
  }
  .task-form input,
  .task-form select,
  .task-form button {
    padding: 0.5rem;
    margin-right: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  .task-form button {
    background-color: #4a90e2;
    color: white;
    border: none;
    cursor: pointer;
    width: 140px; 
    height: 40px;
    margin: 2.1rem 0 0;
  }
  .task-form button:hover {
    background-color: #357abd;
  }
  .task-list table {
    width: 100%;
    border-collapse: collapse;
  }
  .task-list th,
  .task-list td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  .task-list th {
    background-color: #4a90e2;
    color: white;
  }
  .task-list tr:hover {
    background-color: #f5f5f5;
  }
  .task-list .actions button {
    padding: 0.25rem 0.5rem;
    margin-right: 0.25rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .task-list .actions .edit-btn {
    background-color: #ffcc00;
    color: black;
  }
  .task-list .actions .delete-btn {
    background-color: #ff6b6b;
    color: white;
  }
</style>