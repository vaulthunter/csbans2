{use class='yii\widgets\Menu' type='function'}
{use class="yii\widgets\Breadcrumbs" type="function"}
{rmrevin\yii\fontawesome\AssetBundle::register($this)|void}
{$this->beginPage()|void}
<!DOCTYPE html>
<html lang="{$app->language}">
<head>
    <meta charset="{$app->charset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <title>{$this->title|encode}</title>
    {csrfTags}
    {$this->head()|void}
</head>
<body>
{$this->beginBody()|void}
<div id="wrap">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#main" class="navbar-brand visible-xs">{$app->name|encode}</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
            </div>
            <div class="navbar-collapse collapse opensans">
                {Menu activeCssClass='active-url' options=['class' => 'nav navbar-nav', 'id' => 'navbar-nav'] items=[
                    [
                        'label' => 'ГЛАВНАЯ',
                        'url' => ['/main/default/index']
                    ],
                    [
                        'label' => 'БАНЛИСТ',
                        'url' => ['/main/bans/index']
                    ],
                    [
                        'label' => 'АДМИНЫ',
                        'url' => ['/main/admins/index']
                    ],
                    [
                        'label' => 'СЕРВЕРЫ',
                        'url' => ['/main/servers/index']
                    ]
                ]}
                {if $app->user->isGuest}
                    <div class="pull-right navbar-buttons btn-padding">
                        <button
                            type="button"
                            class="btn btn-csbans"
                            data-toggle="modal"
                            data-target="#login-widget-modal">{t category='layout' message='LAYOUT_LOGIN_BUTTON'}</button>
                    </div>
                {/if}
                {if $app->user->isAdmin}
                    <div class="pull-right navbar-buttons btn-padding">
                        <a href="#enter" class="btn btn-csbans">{t category='layout' message='LAYOUT_ADMIN_BUTTON'}</a>
                    </div>
                {/if}
            </div>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="csbans-logo">
                <img src="{$app->theme->baseUrl}/img/logo.png" />
            </div>
        </div>
    </header>
    <div class="container">
        <div class="content-pathway clearfix">
            <div class="pull-left">
                {if isset($this->params['breadcrumbs'])}
                    {Breadcrumbs links=$this->params['breadcrumbs'] options=['class' => 'pathway']}
                {/if}
            </div>
            <div class="pull-right">
                <a href="#main-site"><span class="soc-icon home"></span></a>
                <a href="#vk"><span class="soc-icon vk"></span></a>
                <a href="#steam"><span class="soc-icon steam"></span></a>
            </div>
        </div>
        <div id="content">
            {$content}
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="footer-top clearfix">
            <div class="pull-left">
                <div style="padding: 5px 0;">
                    <a href="#main">Главная</a>&nbsp;|
                    <a href="#banlist">Банлист</a>&nbsp;|
                    <a href="#admins">Админы</a>&nbsp;|
                    <a href="#servers">Сервер</a>&nbsp;|
                    <a href="#shop">Магазин</a>
                </div>
            </div>
            <div class="pull-right">
                <a href="#">
                    <img src="{$app->theme->baseUrl}/img/top.png" alt="" />
                </a>
            </div>
        </div>
        <div class="copyright clearfix">
            <div class="pull-left">
                <div>СS:BANS 1.3 - Многофункциональная система управления банами на игровых серверах</div>
            </div>
            <div class="pull-right">
                &copy; 2013-2015 CRAFT-SOFT TEAM&nbsp;|&nbsp;Дизайн Василий
            </div>
        </div>
    </div>
</footer>
{themes\main\widgets\LoginWidget::widget()}
{$this->endBody()|void}
</body>
</html>{$this->endPage()|void}