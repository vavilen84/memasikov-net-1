$(document).ready(function () {
    var AddImageView = Backbone.View.extend({

        el: '.container',

        events: {
            'click .tag': 'addTag'
        },

        initialize: function () {

        },

        addTag: function (e) {
            e.preventDefault();
            var tag = $(e.currentTarget).text();
            var tagField = $('#addimageurlform-tags');
            var existingTags = tagField.val();
            existingTags = existingTags ? existingTags : '';
            var result = existingTags ? existingTags + ', ' + tag : tag;
            tagField.val(result);
        }


    });
    new AddImageView();
});

