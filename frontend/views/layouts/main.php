<?php
use common\models\StatusReports;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$isNewReport = false;
if (!Yii::$app->user->isGuest) {
    $objLastReport = StatusReports::findOneLast();
    $isNewReport = ($objLastReport && $objLastReport->user_id!=\Yii::$app->user->id && $objLastReport->id>\Yii::$app->session->get('last_report'));
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
    <script src="http://code.jquery.com/qunit/qunit-1.10.0.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/main.js"></script>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Status Report Borodutch',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => ($isNewReport) ? 'Лента (есть новые)':'Лента', 'url' => ['/site/lenta']],
                ['label' => 'Все пользователи', 'url' => ['/site/users']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                if (\Yii::$app->user->can('admin')) {
                    $menuItems[] = ['label' => 'Зарегить пользователя', 'url' => ['/site/signup']];
                    $menuItems[] = ['label' => 'Пользователи', 'url' => ['/user'], 'role'=>['admin']];
                } elseif (\Yii::$app->user->can('manager'))  {

                } else {
                    $menuItems[] = ['label' => 'Профиль', 'url' => ['/site/profile']];
                }
                $menuItems[] = [
                    'label' => 'Выход (' . Html::encode(Yii::$app->user->identity->username). ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
