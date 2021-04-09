<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-three-quarters is-flex is-flex-direction-column is-align-items-center">
                <div class="task_todo box block"><?= $component__task_todo_list ?></div>
                <button class="button is-primary is-rounded box" style='margin-top:-2.5rem;width:3.5rem'>+</button>
            </div>
            <div class="column is-one-quarter">
                <div class="task_done box block"><?= $component__task_done_list ?></div>
            </div>
        </div>
        <div class="server_msg block"></div>
    </div>
    <div class="modal is-clipped">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box"><?= $component__task_add_form ?></div>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
    <a href="user/logout">logout</a>
    <script src="<?= BASE_URL ?>/public/js/page.todolist.js"></script>
</section>