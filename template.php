<?php
function createLoginForm($action)
{
    echo '<br><br>
<form id="connexion" action="'. $action .'" method="GET">
<input placeholder="Identifiant" type="text" name="login" required/><br>
<input placeholder="Mot-de-passe" type="password" name="password" required/>
<input class="button button1" type="submit" value="Se connecter"/>
</form>';
}

?> 