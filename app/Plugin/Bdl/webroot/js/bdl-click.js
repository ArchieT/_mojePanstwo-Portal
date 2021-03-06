/*global $, document, window*/

var bdlClick;

$(document).ready(function () {
	var lastChoose,
		$bdl = $('.bdlClickEngine');

	bdlClick = function (block) {
		block = $(block);

		var openCenterBlock = function () {
			var offset = block.offset();
			$('html').animate({scrollTop: offset.top});
		};

		if (typeof lastChoose === "undefined") {
			lastChoose = $bdl;
		}

		var items = block.parent('.items'),
			next = block.next('.bdlBlock'),
			targetPos = block.position().top,
			slideMark;

		if (block[0] === lastChoose[0]) {
			lastChoose = false;
			items.removeClass('focus-control');
			items.find('.bdlBlock.focus').removeClass('focus');
			$bdl.find('.infoBlock').addClass('old').css({
				'height': 0,
				'border-width': 0
			}).stop(true, true).animate({'margin-top': 0}, 500, function () {
				$bdl.find('.infoBlock.old').remove();
				openCenterBlock();
			});

			return;
		} else {
			items.find('.bdlBlock.focus').removeClass('focus');
			items.addClass('focus-control');
			block.addClass('focus');
			lastChoose = block;
			openCenterBlock();
		}

		if (next.length === 0) {
			slideMark = block;
		} else {
			while (next.length !== 0) {
				if (next.next('.bdlBlock').length === 0) {
					if (next.position().top !== targetPos) {
						slideMark = next.prev('.bdlBlock');
					} else {
						slideMark = next;
					}
					break;
				} else {
					if (next.position().top !== targetPos) {
						slideMark = next.prev('.bdlBlock');
						break;
					}
					next = next.next('.bdlBlock');
				}
			}
		}

		var infoBlock = $('<div></div>').addClass('infoBlock current active col-xs-12').css('height', 0).append(
			$('<div></div>').addClass('arrow')
		).append(
			$('<div></div>').addClass('content').append(
				$('<div></div>').addClass('container')
			)
		);


		if ($bdl.find('.infoBlock').length !== 0) {
			if ($bdl.find('.infoBlock').data('marker')[0] === slideMark[0]) {
				infoBlock = $bdl.find('.infoBlock');
				infoBlock.addClass('current active');
			} else {
				$bdl.find('.infoBlock').addClass('old').removeClass('active').css({
					'height': 0,
					'border-width': 0
				}).stop(true, true).animate({'margin-top': 0}, 500, function () {
					$bdl.find('.infoBlock.old').remove();
					openCenterBlock();
				});
				slideMark.after(infoBlock);
			}
		} else {
			slideMark.after(infoBlock);
		}

		infoBlock.data('marker', slideMark).find('.container').empty().append(function () {
			var slug = $(this),
				leftCol = $('<div></div>').addClass('leftSide col-xs-12'),
				content = block.find('.text').html();

			if (!(typeof $bdl.attr('data-bdllabel') !== "undefined" && $bdl.attr('data-bdllabel') === "false")) {
				leftCol.append(
					$('<div></div>').addClass('block-nav').append(
						$('<div></div>').addClass('row').append(
							$('<div></div>').addClass('col-xs-8').append(
								$('<span></span>').addClass('nazwa').text('Nazwa wskaźnika')
							)
						).append(
							$('<div></div>').addClass('col-xs-2').text('Ostatni rocznik')
						).append(
							$('<div></div>').addClass('col-xs-2').text('Poziom agregacji')
						)
					)
				);
			}

			leftCol.append(content.replace(/span/g, 'a'));
			slug.append(leftCol);
		});


		infoBlock.find('.arrow').css('left', (block.position().left - $bdl.position().left) + (block.outerWidth() / 2) + 'px');
		infoBlock.removeClass('current').css('height', infoBlock.find('.container').outerHeight(true));
	};
});
