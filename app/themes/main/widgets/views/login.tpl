{use class='yii\widgets\ActiveForm' type='block'}
<div class="modal fade" id="login-widget-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="popup-modal">
                <h2>{t category='theme/login' message='LOGIN_WIDGET_WELCOME'}</h2>
                <p>{t category='theme/login' message='LOGIN_WIDGET_WELCOME2'}</p>
                {ActiveForm
                    assign="form"
                    action=['/profile/auth/login']
                    enableAjaxValidation=true
                    enableClientValidation=true
                    id='login-form'
                }
                    {$form->field($model, 'login', ['options' => ['class' => 'popup-form__row']])->textInput(['class' => ''])}
                    {$form->field($model, 'password', ['options' => ['class' => 'popup-form__row']])->passwordInput()}
                    {$form->field($model, 'remember')->checkbox()}
                    <button type="submit">{t category='theme/login' message='LOGIN_WIDGET_SUBMIT_BUTTON'}</button>
                {/ActiveForm}
                <a href="#" class="popup__close" data-dismiss="modal">{t category='theme/login' message='LOGIN_WIDGET_SUBMIT_MODAL_CLOSE'}</a>
            </div>
        </div>
    </div>
</div>