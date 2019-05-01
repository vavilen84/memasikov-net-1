$(document).ready(function () {
    var IndexPageView = Backbone.View.extend({

        el: '.container',

        events: {
            'click .image-previews img': 'changeImage',
            'click .controls .next': 'setNextImage',
            'click .controls .prev': 'setPrevImage',
            'click .copy-image-link': 'copyImageLink',
            'click .image img': 'setNextImage',
        },

        initialize: function () {
            this.setActivePreviewOnPageLoad();
            this.addFirstLastPreviewClasses();
            this.setGlobalCurrentImage();
            this.bindMouseHoverOnMainImage();
        },

        bindMouseHoverOnMainImage: function () {
            var controlButtons = $('.controls-btn-wrap');
            var controls = $('.controls');
            controlButtons.hover(
                function () {
                    $('.circle').removeClass('active');
                    $(this).find('.circle').addClass('active');
                }, function () {
                    $('.circle').removeClass('active');
                }
            );
        },

        setGlobalCurrentImage: function () {
            Global.currentImage = $('.image-previews').find('img').first().attr('src');
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

        addFirstLastPreviewClasses: function () {
            $('.image-previews').find('img').first().addClass('first');
            $('.image-previews').find('img').last().addClass('last');
        },

        setActivePreviewOnPageLoad: function () {
            var lastImageActive = $('#lastImageActive').val();
            var image = $('.image-previews').find('img');
            if (lastImageActive == 1) {
                var el = image.last();
            } else {
                var el = image.first()
            }
            el.addClass('active');
        },

        setNextImage: function () {
            var self = this;
            var active = $('.image-previews').find('.active').first();
            if (active) {
                if (active.hasClass('last')) {
                    var activePageLink = $('.pagination').find('.active');
                    var nextPageLink = activePageLink.next();
                    if (!$(nextPageLink).hasClass('next')) {
                        var nextPage = $(nextPageLink).find('a').attr('data-page');
                        nextPage = parseInt(nextPage);
                        nextPage++;
                        self.redirectToNewPageOnChangeImage(nextPage, false);
                    }
                    return;
                }
                var next = active.next('.image-previews > img');
                if (next) {
                    $('.image-previews').find('img').removeClass('active');
                    next.addClass('active');
                }
            }
            this.setNewImage();
        },

        setNewImage: function () {
            var activePreview = $(".image-previews").find(".active").first();
            this.setNewImageLinkData(activePreview);
            var newImageSrc = activePreview.attr("src");
            Global.currentImage = newImageSrc;
            this.setDownloadLinkData(newImageSrc);
            var image = $('.image').find('img');
            image.attr('src', newImageSrc);
            if (image.hasClass('author-image')) {
                this.changeAuthorImageData(image, activePreview);
            }
        },

        getCurrentTimestamp: function () {
            var datetime = new Date();
            return datetime.getTime() / 1000;
        },

        setNewImageLinkData: function (activePreview) {
            var newImageNumber = activePreview.attr('data-number');
            if (newImageNumber) {
                var imageNumberParamConcat = window.location.search ? '&' : '?';
                var existingCurrentPageNumber = this.getParameterByName('currentImageNumber');
                if (existingCurrentPageNumber) {
                    var imageLink = this.replaceQueryParamValue('currentImageNumber', newImageNumber);
                } else {
                    var imageLink = window.location.href + imageNumberParamConcat + 'currentImageNumber=' + newImageNumber;
                }
                $('#image-link').val(imageLink);
                Global.targetUrl = imageLink;
                $('#current-image-number').text(newImageNumber)
            }
        },

        setDownloadLinkData: function (newImageSrc) {
            $('.download-link').attr('href', newImageSrc);
        },

        replaceQueryParamValue: function (paramName, value) {
            var url = window.location.href;
            return url.replace(/('+paramName+'=).*?(&)/, '$1' + value + '$2');
        },

        getParameterByName: function (name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        },

        changeAuthorImageData: function (destination, source) {
            this.$el.find('.current-image-title').text(source.attr('data-title'));
            this.$el.find('.current-image-created-text').text(source.attr('data-created_text'));
            $('.author-page-link').attr('href', source.attr('data-author_page_url'));
            var concat = window.location.search ? '&' : '?';
            var uid = this.getParameterByName('image');
            if (uid) {
                var imageLink = this.replaceQueryParamValue('image', source.attr('data-uid'));
            } else {
                var imageLink = window.location.href + concat + 'image=' + source.attr('data-uid');
            }
            $('#image-link').val(imageLink);
            Global.targetUrl = imageLink;
        },

        redirectToNewPageOnChangeImage: function (nextPage, lastImageActive) {
            var url = window.location.origin + window.location.pathname;
            url += '?page=' + nextPage;
            if (lastImageActive) {
                url += '&lastImageActive=1';
            }
            window.location.href = url
        },

        setPrevImage: function () {
            var self = this;
            var active = $('.image-previews').find('.active').first();
            if (active) {
                if (active.hasClass('first')) {
                    var activePageLink = $('.pagination').find('.active');
                    var prevPageLink = activePageLink.prev();
                    if (!$(prevPageLink).hasClass('prev')) {
                        var prevPage = $(prevPageLink).find('a').attr('data-page');
                        prevPage = parseInt(prevPage);
                        prevPage++;
                        self.redirectToNewPageOnChangeImage(prevPage, true);
                    }
                    return;
                }
                var prev = active.prev('.image-previews > img');
                if (prev) {
                    $('.image-previews').find('img').removeClass('active');
                    prev.addClass('active');
                }
            }
            this.setNewImage();
        },

        setActivePreview: function () {
            $('.image-previews').find('img').first().addClass('active');
        },

        changeImage: function (e) {
            this.setActivePreview(e);
            this.setNewImage();
        },

        setActivePreview: function (e) {
            $('.image-previews').find('img').removeClass('active');
            $(e.currentTarget).addClass('active');
        }


    });
    new IndexPageView();
});

