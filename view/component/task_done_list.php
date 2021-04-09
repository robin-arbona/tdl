<table class="table">
    <thead>
        <tr>
            <th>Done</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasksDone as $task) : ?>
            <tr>
                <td>
                    <form method="POST" action="Task/update">
                        <input type="hidden" name="checked" value="true">
                        <input class="task" checked type="checkbox"><input type="hidden" name="task" value="<?= $task->id ?>">
                    </form>
                </td>
                <td>
                    <?= $task->name ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>