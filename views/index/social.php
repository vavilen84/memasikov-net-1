<script>
    Share = {
        vkontakte: function() {
            url  = 'http://vkontakte.ru/share.php?';
            url += 'url='          + encodeURIComponent(Global.targetUrl);
            url += '&title='       + encodeURIComponent(Global.title);
            url += '&description=' + encodeURIComponent(Global.description);
            url += '&image='       + encodeURIComponent(Global.currentImage);
            url += '&noparse=true';
            Share.popup(url);
        },
        facebook: function() {
            url  = 'http://www.facebook.com/sharer.php?s=100';
            url += '&p[title]='     + encodeURIComponent(Global.title);
            url += '&p[summary]='   + encodeURIComponent(Global.description);
            url += '&p[url]='       + encodeURIComponent(Global.targetUrl);
            url += '&p[images][0]=' + encodeURIComponent(Global.currentImage);
            Share.popup(url);
        },
        popup: function(url) {
            window.open(url,'','toolbar=0,status=0,width=626,height=436');
        }
    };
</script>
<!--<a class="btn btn-primary" onclick="Share.vkontakte()">Поделиться Vkontakte</a>-->
<!--<a class="btn btn-primary" onclick="Share.facebook()">Поделиться Facebook</a>-->
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Поделиться</a></div>