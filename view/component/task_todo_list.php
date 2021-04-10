<div class="table-container" style="max-height:500px;overflow-y:auto">
    <table class="table">
        <thead>
            <tr>
                <th>Todo</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start</th>
                <th>End</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasksToDo as $task) : ?>
                <tr>
                    <td>
                        <form method="POST" action="Task/update">
                            <input type="hidden" name="checked" value="false">
                            <input class="task" type="checkbox" name="task" value="<?= $task->id ?>">
                        </form>
                    </td>
                    <td>
                        <?= $task->name ?>
                    </td>
                    <td>
                        <?= $task->description ?>
                    </td>
                    <td>
                        <?= substr($task->start_date, 0, 11) ?>
                    </td>
                    <td>
                        <?= substr($task->end_date, 0, 11) ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>