<ul class='task_done'>
    <?php foreach ($tasksDone as $task) : ?>
        <li><input type="checkbox" name="" id=""><?= $task->name ?><button>Delete</button></li>
    <?php endforeach; ?>
</ul>