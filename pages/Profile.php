<?php

class Profile
{

    public function index() {
        return "
        <div class='card-header'>Редактировать данные</div>
        <form id='profile' class='h-100 p-5 mb-3 card border-light rounded-3'>
            <label for='name' class='form-label'>Логин</label>
            <input name='name' class='form-control mb-3' value=".$_SESSION['auth']['name'].">
            <label for='password' class='form-label'>Новый пароль</label>
            <input name='password' type='password' class='form-control mb-3'>
            <label for='repeat' class='form-label'>Повторите пароль</label>
            <input name='repeat' type='password' class='form-control mb-5'>
            <div class='btn-group' role='group' aria-label='Подтведите действия'>
                <button type='button' id='save' class='btn btn-warning'>Сохранить</button>
                <button type='button' id='cancel' class='btn btn-success'>Отменить</button>
            </div>
        </form>
        ";
    }
}