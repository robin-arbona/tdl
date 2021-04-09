<form class="task_add" action="Task/add" method="post">
    <h3 class="title">Add form</h3>
    <input type="text" name="name" placeholder="Task name">
    <select name="owner_id" placeholder="who's job">
        <option value="<?= $user->id ?>">Me</option>
    </select>
    <textarea name="description" id="" cols="30" rows="5" placeholder="Task description"></textarea>
    <input type="datetime-local" name="end_date" placeholder="End date">
    <input type="submit" value="Save">
</form>