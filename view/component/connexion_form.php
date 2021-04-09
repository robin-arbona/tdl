    <h3 class="title">Log-in</h3>
    <p class="subtitle">Start efficient <strong>plannficiation</strong> now!</p>
    <div class="columns">
        <form class="column is-half is-offset-one-quarter" action="user/inscription" method="post">
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="login" placeholder="Login">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" name="password" placeholder="Password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button is-success input" id="submit" type="submit" value="connexion">
                        Login
                    </button>
                </p>
            </div>
            <a target="inscription_form" href="#inscription">Havn't sign-in yet ?</a>
        </form>
    </div>