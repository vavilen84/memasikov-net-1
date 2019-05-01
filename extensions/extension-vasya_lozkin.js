$(document).ready(function () {
    var url = 'https://memasikov.net/upload-vasya-lozkin';
    var wrapArea = $('.wrapper');
    var buttonClasses = 'btn_red';
    var tagsList = [
        'живопись',
        'котики',
        'мимишечки',
        'мотивация',
        'мудрые мысли',
        'музыка',
        'сказочное',
        'спорт',
    ];
    var i, j, temparray = [], chunk = 2;
    for (i = 0, j = tagsList.length; i < j; i += chunk) {
        temparray.push(tagsList.slice(i, i + chunk));
    }
    tagsList = temparray;
    var uploadButton = '<button class="upload-button ' + buttonClasses + '" style="position:relative;z-index:1000000">Upload</button>';
    var html = '<div id="mn-wrapper">';
    html += uploadButton + '<br>';
    for (i in tagsList) {
        html += '<span>';
        html += '<button class="mn-tag ' + buttonClasses + '">' + tagsList[i][0] + '</button>';
        html += '<button class="mn-tag ' + buttonClasses + '">' + tagsList[i][1] + '</button>';
        html += '</span><br>';
    }
    html += '<input type="text" value="" id="mn-tags" style="width:350px;"><br>';
    html += uploadButton;
    html += '<button id="clear-tags" class="' + buttonClasses + '">Очистить</button><br>';

    html += '<button class="mn-tag ' + buttonClasses + '">живопись</button><br>';
    html += '<button class="mn-tag ' + buttonClasses + '">котики, котики</button><br>';
    html += '<button class="mn-tag ' + buttonClasses + '">живопись, котики, мимишечки</button><br>';

    html += '</div>';
    wrapArea.append(html);

    $('#mn-wrapper').attr('style', 'display:inline-block;position:fixed;z-index:1000000;top:0;right:0;');

    var tagButton = $('button.mn-tag');
    $('button').css('color', 'black');
    $('#mn-tags').css('color', 'black');
    tagButton.on('click', function (e) {
        e.preventDefault();
        var tag = $(e.currentTarget).text();
        var tagField = $('#mn-tags');
        var existingTags = tagField.val();
        existingTags = existingTags ? existingTags : '';
        var result = existingTags ? existingTags + ', ' + tag : tag;
        tagField.val(result);
    });
    $('#clear-tags').on('click', function (e) {
        e.preventDefault();
        $('#mn-tags').val('');
    });

    $('.upload-button').on('click', function (e) {
        e.preventDefault();
        var imageUrl = $('.img-wrap').find('img').attr('src');
        var tags = $('#mn-tags').val().trim();
        var title = $('h1');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'hash': 'sdvhР45rtG9.=H,',
                'imageUrl': imageUrl,
                'pageUrl': window.location.pathname,
                'tags': tags,
                'title': title.text(),
                'created': title.next('p').text()
            },
            success: function () {

            }
        });
    });
});

