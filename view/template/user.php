<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/mystyles.css">
    <title>Document</title>
</head>

<body>

    <div class='page_content'>
        <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="">
                    (tdl)
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
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
                            <?php if (!isset($_SESSION['user'])) : ?>
                                <a class="button is-light">
                                    Log in
                                </a>
                            <?php else : ?>
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