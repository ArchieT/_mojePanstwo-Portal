/*global jQuery,window*/

(function ($) {
    "use strict";

    var appHeader = $('.appHeader');

    if (window.screen.width > 768) {
        var statusBar = appHeader.find('.status'),
            statusLi = statusBar.find('ul.dataHighlights > li'),
            statusLiTop,
            appMenu = $('.appMenu'),
            appMenuLi = appMenu.find('ul.nav > li'),
            appMenuLiTop,
            appMenuLiActive;

        if (statusLi.length > 0) {
            if (statusLi.first().offset().top !== statusLi.last().offset().top) {
                statusLiTop = statusLi.first().offset().top;
                $.each(statusLi, function () {
                    if ($(this).offset().top > statusLiTop) {
                        $(this).addClass('hideMenu');
                    }
                });
                statusBar.find('.hideMenu:first').addClass('first');
                statusBar.find('.hideMenu:last').after(
                    $('<li></li>').addClass('dataHighlight show_hide_status').append(
                        $('<a></a>').addClass('glyphicon glyphicon-chevron-down').attr({
                            'href': '#',
                            'data-status': 'more'
                        }).click(function (e) {
                            e.preventDefault();
                            if ($(this).data('status') === 'more') {
                                $(this).data('status', 'less').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
                                statusBar.find('.hideMenu').stop(true, true).slideDown();
                            } else {
                                $(this).data('status', 'more').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
                                statusBar.find('.hideMenu').stop(true, true).slideUp();
                            }
                        })
                    )
                );
                statusBar.find('.hideMenu').hide();
            }
        }

        if (appMenuLi.length > 0) {
            if (appMenuLi.first().offset().top !== appMenuLi.last().offset().top) {
                appMenuLiTop = appMenuLi.first().offset().top;
                $.each(appMenuLi, function () {
                    if ($(this).offset().top > appMenuLiTop) {
                        $(this).addClass('hideMenu');
                    }
                });
                appMenu.find('.hideMenu:first').prev().addClass('hideMenu first').before(
                    $('<li></li>').addClass('show_hide').append(
                        $('<a></a>').attr({
                            'href': '#'
                        }).click(function (e) {
                            e.preventDefault();

                            if ($(this).data('status') === 'more') {
                                $(this).data('status', 'less');
                                appMenu.find('.hideMenu').stop(true, true).slideDown();
                            } else {
                                $(this).data('status', 'more');
                                appMenu.find('.hideMenu').stop(true, true).slideUp();
                            }
                        })
                    )
                );
                appMenuLi.map(function (index, block) {
                    if ($(block).hasClass('active')) {
                        appMenuLiActive = $(block).offset().top;
                    }
                });
                if (!appMenuLiActive || (appMenuLiActive && (appMenuLiTop == appMenuLiActive))) {
                    appMenu.find('a.show_hide').attr('data-status', 'more');
                    appMenu.find('.hideMenu').hide();
                } else {
                    appMenu.find('a.show_hide').attr('data-status', 'less');
                }
            }
        }
    }

    if (appHeader.hasClass('dataobject-cover')) {
        var object_id = appHeader.attr('data-object_id'),
            dataset = appHeader.attr('data-dataset'),
            changeLogo = $('#modalAdminAddLogo'),
            changeBackground = $('#modalAdminAddBackground');


        if (changeLogo.length) {
            var image = changeLogo.find('.cropit-image-preview').attr('data-image');

            appHeader.find('.addLogoBtn').click(function () {
                changeLogo.modal('show');
            });
            changeLogo.find('.image-editor').cropit({
                imageState: {
                    src: (image) ? image : 'http://lorempixel.com/180/180/'
                },
                width: 180,
                height: 180
            });
            changeLogo.find('.export').click(function () {
                var self = $(this),
                    imageData = changeLogo.find('.image-editor').cropit('export', {
                        type: 'image/png'
                    });
                $.ajax({
                    url: '/dane/' + dataset + '/' + object_id + '/page/logo.json',
                    method: "POST",
                    data: {'image': imageData},
                    before: function () {
                        self.addClass('loading disabled')
                    },
                    success: function () {
                        location.reload(true)
                    },
                    error: function () {
                        //location.reload(true)
                    }
                });
            });
        }

        if (changeBackground.length) {
            var image = changeBackground.find('.cropit-image-preview').attr('data-image');

            appHeader.find('.addBackgroundBtn').click(function () {
                changeBackground.modal('show');
            });
            changeBackground.find('.image-editor').cropit({
                imageState: {
                    src: (image) ? image : 'http://lorempixel.com/1500/400/'
                },
                width: 750,
                height: 200,
                exportZoom: 2
            });
            changeBackground.find('.export').click(function () {
                var self = $(this),
                    imageData = changeBackground.find('.image-editor').cropit('export', {
                        type: 'image/jpeg',
                        quality: .9
                    });
                $.ajax({
                    url: '/dane/' + dataset + '/' + object_id + '/page/cover.json',
                    method: "POST",
                    data: {'image': imageData},
                    before: function () {
                        self.addClass('loading disabled')
                    },
                    success: function () {
                        location.reload(true)
                    },
                    error: function () {
                        //location.reload(true)
                    }
                });
            });
        }
        if (changeLogo.length || changeBackground.length) {
            changeBackground.on('change', '.btn-file :file', function () {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            changeBackground.find('.delete').click(function () {
                var self = $(this);

                $.ajax({
                    url: '/dane/' + dataset + '/' + object_id + '/page/' + $(this).attr('data-type') + '.json',
                    method: "DELETE",
                    before: function () {
                        self.addClass('loading disabled')
                    },
                    success: function () {
                        location.reload(true)
                    },
                    error: function () {
                        //location.reload(true)
                    }
                });
            });
        }
    }
}(jQuery));