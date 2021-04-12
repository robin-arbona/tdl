<form class="task_update is-flex is-flex-direction-column" action="Task/update" method="post">

    <h3 class="title">Update task form</h3>
    <input type="hidden" name="id" value="<?= $task->id ?>">
    <div class=" field">
        <label class="label">Task name</label>
        <p class="control">
            <input type="text" name="name" placeholder="Task name" value="<?= $task->name ?>">
        </p>
    </div>

    <div class="field">
        <p class="control">
            <input type="checkbox" name="done" <?= $task->done ? 'checked' : '' ?>>
        </p>
    </div>

    <div class="field">
        <label class="label">Who's job</label>
        <p class="control">
            <select name="owner_id" placeholder="who's job">
                <option <?= $task->owner_id == $user->id ? 'selected' : ''; ?> value="<?= $user->id ?>">Me</option>
                <?php foreach ($user->getOnWhoPrivilegeList() as $user) : ?>
                    <option <?= $task->owner_id == $user->id ? 'selected' : ''; ?> value="<?= $user->id ?>"><?= $user->login ?></option>
                <?php endforeach ?>
            </select>
        </p>
    </div>

    <div class="field">
        <label class="label">Task description</label>
        <p class="control">
            <textarea class="textarea" name="description" cols="30" rows="5" placeholder="Task description"><?= $task->description ?></textarea>
        </p>
    </div>
    <div class="field">
        <label class="label">Start date</label>
        <p class="control">
            <input type="datetime-local" name="start_date" placeholder="Start date" value="<?= $task->start_date ?>">
        </p>
    </div>

    <div class="field">
        <label class="label">End date</label>
        <p class="control">
            <input type="datetime-local" name="end_date" placeholder="End date" value="<?= $task->start_date ?>"">
        </p>
    </div>
    <div class=" field">
        <p class="control">
            <input class="button is-primary" type="submit" value="Save">
        </p>
    </div>

    <div class="field">
        <p class="control">
            <input class="button is-danger" type="submit" value="Remove">
        </p>
    </div>



</form>