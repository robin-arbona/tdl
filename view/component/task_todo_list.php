<ul class="task_todo">
    <?php foreach ($tasksToDo as $task) : ?>
        <li><input type="checkbox" name="" id=""><?= $task->name ?><button>Delete</button></li>
    <?php endforeach; ?>
</ul>