<script src="/js/memCreate.js?v=<?php echo time(); ?>"></script>
<script src="/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="/js/spectrum.js"></script>
<script type="text/javascript" src="/js/memgenerator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/memgenerator.css">
<link rel="stylesheet" type="text/css" href="/css/spectrum.css">
<link rel="stylesheet" type="text/css" href="/libs/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css">
<a target="_blank" class="github-link" href="https://github.com/MakG10/jquery-meme-generator">Авторская страничка на github`е</a>
<div id="photo">
    <?php echo Yii::$app->base->getBaseImageHtml($baseImageContainer); ?>
</div>
<div id="toolbar"></div>
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-success upload-mem">Сохранить</a>
    </div>
</div>
