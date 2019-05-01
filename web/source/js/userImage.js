$(document).ready(function () {
    var UserImageView = Backbone.View.extend({

        el: '.container',
        imageSelector: '#user-image img',
        json: null,

        events: {
            'click #download': 'downloadImage',
            'click .copy-image-link': 'copyImageLink',
        },

        initialize: function () {
            this.deserializeUserImageJson();
        },

        downloadImage: function (e) {
            e.preventDefault();
            var self = this;
            $(self.imageSelector).memeGenerator("download");
        },

        copyImageLink: function () {
            var copyText = document.getElementById("image-link");
            copyText.select();
            document.execCommand("Copy");
            var defaultText = 'Скопировать ссылку на картинку';
            var successText = 'Скопировано!';
            var copyLinkButton = $('#copy-link-button');
            copyLinkButton
                .text(successText)
                .removeClass('btn-primary')
                .addClass('btn-success');
            setTimeout(function () {
                copyLinkButton
                    .removeClass('btn-success')
                    .addClass('btn-primary')
                    .text(defaultText);
            }, 1000);
        },

        deserializeUserImageJson: function () {
            var self = this;
            self.json = $('#json').val();
            $(self.imageSelector).memeGenerator({
                drawingAboveText: false,
                showAdvancedSettings: false,
                dragResizeEnabled: false,
                previewMode: 'css',
                onInit: function () {
                    this.deserialize(self.json);
                }
            });
        }

    });
    new UserImageView();
});

