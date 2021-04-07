<form class="task_add" action="Task/add" method="post">
    <input type="text" name="name" placeholder="Task name">
    <select name="owner" placeholder="who's job">
        <option value="">Me</option>
    </select>
    <textarea name="description" id="" cols="30" rows="5" placeholder="Task description"></textarea>
    <input type="datetime-local" name="end_date" placeholder="End date">
    <input type="submit" value="Save">
</form>