<form class="user_update is-flex is-flex-direction-column" action="User/update" method="post">

    <h3 class="title">Update user privilege</h3>
    <input type="hidden" name="id" value="<?= $user->id ?>">

    <div class="field">
        <label class="label">Search for an other user login:</label>

        <p class="control">
            <input type="search" name="search" placeholder="User login" value="">
            <input type="submit" name="submit" value="Search">
        </p>
    </div>



    <?php if (!empty($results)) : ?>
        <p>Research result: <br /><small>click on user login to give him plannification habilities on your account (add task only).</small> </p>
    <?php endif; ?>
    <div class="privilege2add">
        <?php foreach ($results as $result) : ?>
            <button class="privilege button is-info" id="user-<?= $result->id ?>"><?= $result->login ?></button>
        <?php endforeach ?>
    </div>

    <div class="privilege2remove">
        <p>Actual account which can add you task: <br /><small>click on user login to remove plannification habilities on your account.</small></p>
        <?php foreach ($user->getPrivilegeList() as $user) : ?>
            <button class="privilege button is-warning" id="user-<?= $user->id ?>"><?= $user->login ?></button>
        <?php endforeach ?>
    </div>




</form>