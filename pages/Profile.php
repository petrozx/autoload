<?php

class Profile
{

    public function index() {
        return "
        <form id='profile' class='h-100 p-5 card text-danger border-danger rounded-3'>
        <div class='card-header'>Редактировать профиль</div>
        <label for='name' class='form-label'>Логин</label>
        <input name='name' class='form-control' value={$_SESSION['auth']['name']}>
        <label for='password' class='form-label'>Новый пароль</label>
        <input name='password' class='form-control'>
        <label for='repeat' class='form-label'>Повторите пароль</label>
        <input name='repeat' class='form-control'>
        </form>
        ";
    }

}