<form class="task_add is-flex is-flex-direction-column" action="Task/update" method="post">

    <h3 class="title">Add form</h3>
    <div class="field">
        <p class="control">
            <input type="text" name="name" placeholder="Task name">
        </p>
    </div>

    <div class="field">
        <p class="control">
            <select name="owner_id" placeholder="who's job">
                <option value="<?= $user->id ?>">Me</option>
                <?php foreach ($user->getOnWhoPrivilegeList() as $user) : ?>
                    <option value="<?= $user->id ?>"><?= $user->login ?></option>
                <?php endforeach ?>
            </select>
        </p>
    </div>

    <div class="field">
        <p class="control">
            <textarea name="description" id="" cols="30" rows="5" placeholder="Task description"></textarea>
        </p>
    </div>

    <div class="field">
        <p class="control">
            <input type="datetime-local" name="end_date" placeholder="End date">
        </p>
    </div>

    <div class="field">
        <p class="control">
            <input type="submit" value="Save">
        </p>
    </div>


</form>