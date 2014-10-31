<?php
use common\models\StatusReports;
use yii\helpers\Html;

/** @var StatusReports[] $attrReports */
$this->title = 'Status Report Borodutch';
$objDate = new \common\libs\Date();
$intReportListId = \Yii::$app->session->get('last_report');
if (!Yii::$app->user->isGuest) {
    $objLastReport = StatusReports::findOneLast();
    if ($objLastReport) {
        \Yii::$app->session->set('last_report', $objLastReport->id);
    }
}
?>

<?php if ($attrReports) { ?>

    <ul class="list-group">
        <?php foreach ($attrReports as $objStatusReport) { ?>
            <li class="list-group-item" <?php if (!Yii::$app->user->isGuest && $objStatusReport->id>$intReportListId && $objStatusReport->user_id!=\Yii::$app->user->id) { ?>style="background-color: #f7f7f9;" <?php } ?>>
                <?= Html::a(Html::encode($objStatusReport->user->username), ['user/reports', 'id'=>$objStatusReport->user_id]) ?>
                <span class="badge"><time><?= $objDate->format($objStatusReport->created_at, 'Y-m-d H:i') ?></time></span>
                <?= Html::img(($objStatusReport->user->avatar) ? $objStatusReport->user->getUrlAvatar() : '/images/no_avatar.jpg') ?>
                <?= Html::encode($objStatusReport->title) ?>
            </li>
        <?php } ?>
    </ul>
<?php } ?>