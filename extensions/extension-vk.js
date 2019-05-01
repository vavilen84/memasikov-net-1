$(document).ready(function () {
    var url = 'https://memasikov.net/upload-vk';
    var wrapArea = $('.no_select.pv_left_wrap');
    var buttonClasses = 'flat_button secondary';
    var tagsList = [
        'баяны',
        'день рождения',
        'живопись',
        'задумчивое',
        'история',
        'картинки',
        'котики',
        'металл',
        'мемасики',
        'мимишечки',
        'многабукав',
        'мотивация',
        'мудрые мысли',
        'музыка',
        'новый год',
        'природа',
        'программисты',
        'сказочное',
        'спорт',
        'средние века',
        'фото',
        'FFFFUUUUUUU',
    ];
    var i, j, temparray = [], chunk = 2;
    for (i = 0, j = tagsList.length; i < j; i += chunk) {
        temparray.push(tagsList.slice(i, i + chunk));
    }
    tagsList = temparray;
    var uploadButton = '<a class="upload-button ' + buttonClasses + '" style="position:relative;z-index:1000000">Upload</a>';
    var html = '<div id="mn-wrapper">';
    html += uploadButton + '<br>';
    for (i in tagsList) {
        html += '<span>';
        html += '<a class="mn-tag ' + buttonClasses + '">' + tagsList[i][0] + '</a>';
        html += '<a class="mn-tag ' + buttonClasses + '">' + tagsList[i][1] + '</a>';
        html += '</span><br>';
    }
    html += '<input type="text" value="" id="mn-tags" style="width:350px;"><br>';
    html += uploadButton;
    html += '<a id="clear-tags" class="' + buttonClasses + '">Очистить</a><br>';

    html += '<a class="mn-tag ' + buttonClasses + '">мемасики, баяны</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">мемасики, котики</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">мемасики, котики, баяны</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">мемасики, FFFFUUUUUUU, баяны</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">мемасики, металл, баяны, музыка</a><br>';


    html += '<a class="mn-tag ' + buttonClasses + '">живопись, природа</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">фото, природа</a><br>';
    html += '<a class="mn-tag ' + buttonClasses + '">картинки, природа</a><br>';

    html += '</div>';
    wrapArea.append(html);

    $('#mn-wrapper').attr('style', 'display:inline-block;position:fixed;z-index:1000000;top:0;right:0;');

    var tagButton = $('a.mn-tag');
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
        var imageUrl = $('#pv_photo').find('img').attr('src');
        var tags = $('#mn-tags').val().trim();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'hash': 'sdvhР45rtG9.=H,',
                'imageUrl': imageUrl,
                'tags': tags
            },
            success: function () {

            }
        });
    });
});

