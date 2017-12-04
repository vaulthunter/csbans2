{use class='yii\bootstrap\ActiveForm' type='block'}
{title}{t category='profile/auth/login' message='VIEW_PAGE_TITLE'}{/title}
{breadcrumbs links=[
    {t category='profile/auth/login' message='VIEW_BREADCRUMBS_LAST'}
]}
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{t category='profile/auth/login' message='VIEW_MENU_CAPTION'}</strong>
                </div>
                <div class="list-group">
                    <span class="list-group-item active">{t category='profile/auth/login' message='VIEW_MENU_LINK_LOGIN'}</span>
                    <a href="{url route='recovery'}" class="list-group-item">{t category='profile/auth/login' message='VIEW_MENU_LINK_RECOVERY'}</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h1>{t category='profile/auth/login' message='VIEW_TITLE'}</h1>
            {ActiveForm
                assign="form"
                enableAjaxValidation=true
                id='login-form'
                layout='horizontal'
            }
                {$form->field($model, 'login')}
                {$form->field($model, 'password')->passwordInput()}
                {$form->field($model, 'remember')->widget('kartik\checkbox\CheckboxX', [
                    'autoLabel'=>true,
                    'pluginOptions' => [
                        'threeState'=>false
                    ]
                ])->label(false)}
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <button type="submit" class="btn btn-primary">{t category='profile/auth/login' message='VIEW_FORM_SUBMIT_BUTTON'}</button>
                    </div>
                </div>
            {/ActiveForm}
        </div>
    </div>
</div>