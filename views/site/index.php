<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <form class="form-inline">
        <div id="write_email">
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Email</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
            </div>
            <button type="button" id="login_email" data-knopka="bt_email" class="btn btn-primary">Получить пароль</button>
        </div>
        <div id="write_kod" style="display: none">
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Kod</label>
                <div class="input-group">
                    <div class="input-group-addon">Код :</div>
                    <input type="text" class="form-control" name="kod" id="kod">
                </div>
            </div>
            <button type="button" id="login_kod" class="btn btn-primary">Вход</button>
        </div>
    </form>
</div>
