$(document).ready(function () {
    var InitView = Backbone.View.extend({

        el: '.container',
        animateDuration: 500,
        animateDelay: 500,
        nonClickableClass: 'non-clickable',
        cats: [
            'showLeftCat',
            'showRightCat',
            'showBottomCat'
        ],

        events: {
            'click .non-clickable': 'onClickNonClickable',
            'click #cat a': 'showCat',
            'hover .k2': 'moveBottomCat'
        },

        initialize: function () {
            this.bindBottomCat();
        },

        bindBottomCat: function () {
            $('.k2').hover(
                function () {
                    if ($(this).hasClass('moved')) {
                        $(this).animate({'left': '-=200px'}, 100);
                        $(this).removeClass('moved');
                    } else {
                        $(this).animate({'left': '+=200px'}, 100);
                        $(this).addClass('moved');
                    }
                }, function () {

                }
            );
        },

        onClickNonClickable: function (e) {
            e.preventDefault();
        },

        showCat: function (e) {
            e.preventDefault();
            var self = this;
            var random = Math.round(Math.random() * (2 - 0) + 0);
            var showButton = $(e.currentTarget);
            if (showButton.hasClass(self.nonClickableClass)) {
                return;
            }
            showButton.addClass(self.nonClickableClass);
            if (random < 1) {
                this.showRightCat();
            } else if (random < 2) {
                this.showLeftCat();
            } else {
                this.showBottomCat();
            }
            setTimeout(function () {
                showButton.removeClass(self.nonClickableClass);
            }, (self.animateDuration * 2) + self.animateDelay);
        },

        showRightCat: function () {
            var self = this;
            $('.k1')
                .fadeIn(function () {
                    $(this).animate({'right': '+=92px'}, self.animateDuration);
                })
                .delay(self.animateDelay).animate({'right': '-=92px'}, self.animateDuration);
        },

        showLeftCat: function () {
            var self = this;
            $('.k3')
                .fadeIn(function () {
                    $(this).animate({'left': '+=139px'}, self.animateDuration);
                })
                .delay(self.animateDelay).animate({'left': '-=139px'}, self.animateDuration);
        },

        showBottomCat: function () {
            var self = this;
            $('.k4')
                .fadeIn(function () {
                    $(this).animate({'bottom': '+=150px'}, self.animateDuration);
                })
                .delay(self.animateDelay).animate({'bottom': '-=150px'}, self.animateDuration);
        },

    });
    new InitView();
});

