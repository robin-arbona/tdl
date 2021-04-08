<h2>Done</h2>
<ul>
    <?php foreach ($tasksDone as $task) : ?>
        <li>
            <form method="POST" action="Task/update">
                <input type="hidden" name="checked" value="true">
                <input class="task" checked type="checkbox"><input type="hidden" name="task" value="<?= $task->id ?>"><?= $task->name ?><button>Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>