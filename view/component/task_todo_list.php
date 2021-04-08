<h2>Todo</h2>
<ul>
    <?php foreach ($tasksToDo as $task) : ?>
        <li>
            <form method="POST" action="Task/update">
                <input type="hidden" name="checked" value="false">
                <input class="task" type="checkbox" name="task" value="<?= $task->id ?>"><?= $task->name ?><button>Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>