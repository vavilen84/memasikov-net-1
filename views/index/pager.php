<?php
use yii\widgets\LinkPager;

echo LinkPager::widget(
    [
        'pagination' => $pages,
        'nextPageLabel' => 'Следующая',
        'prevPageLabel' => 'Предыдущая',
        'firstPageLabel' => 1,
        'lastPageLabel' => $lastPageNumber
    ]
);
