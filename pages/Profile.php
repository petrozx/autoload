<?php

class Profile
{

    public function index() {
        return "<label for='name' class='form-label'>Логин</label>
                <input name='name' class='form-control' value={$_SESSION['auth']['name']}>";
    }

}