$(document).ready(function () {
    var MemCreateView = Backbone.View.extend({

        el: '.container',
        imageSelector: '#photo img',
        json: null,

        events: {
            'click .upload-mem': 'saveMem'
        },

        initialize: function () {
            this.initMemGenerator();
        },

        saveMem: function (e) {
            e.preventDefault();
            var self = this;
            var url = Global.homeUrl + Global.createMemUrl;
            var image = $(self.imageSelector);
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    json: image.memeGenerator("serialize"),
                    baseImageId: image.attr('data-base_image_id'),
                    hash: Global.hash
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status == 'success') {
                        window.location.href = Global.homeUrl + Global.userImageUrl + response.uid;
                    } else {
                        alert(response.errorMessage);
                    }
                }
            });
        },

        initMemGenerator: function () {
            var self = this;
            $(self.imageSelector).memeGenerator({
                useBootstrap: true,
            });
        }

    });
    new MemCreateView();
});

