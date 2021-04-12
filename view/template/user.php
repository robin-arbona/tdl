<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="on To Do List, plan your work in an efficient way. Try free plan now !">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <title>(tdl) plan you work today</title>
</head>

<body>

    <div class='page_content'>
        <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="">
                    (tdl)
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true">1</span>
                    <span aria-hidden="true">2</span>
                    <span aria-hidden="true">3</span>
                </a>
            </div>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="navbar-item button-privilege">
                            Privilege
                        </a>
                    <?php endif; ?>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <a href="user/logout" class="button is-light">
                                    Log out
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?= $content ?>
    </div>
    <div class="script">
    </div>
</body>

</html>