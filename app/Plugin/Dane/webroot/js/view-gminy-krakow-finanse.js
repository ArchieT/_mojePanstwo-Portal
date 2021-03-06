/*global mPHeart, Highcharts*/
$(document).ready(function () {
	var lastChoose,
		$dataForm = $('#dataForm'),
		$administracja = lastChoose = $('#mp-sections');

	graphInit('#mainChart');

	$dataForm.find('select').change(function () {
		$dataForm.submit();
	});

	$.each($administracja.find('.item a'), function () {
		var that = $(this),
			block = that.parents('.block'),
			items = $(block.parent('.items'));

		that.click(function (e) {
			var next = block.nextAll('.block:first'),
				targetPos = block.position().top,
				slideMark;

			e.preventDefault();

			if (block[0] === lastChoose[0]) {
				lastChoose = false;
				items.removeClass('focus-control');
				items.find('.block.focus').removeClass('focus');
				$administracja.find('.infoBlock').addClass('old').css({
					'height': 0,
					'border-width': 0
				}).stop(true, true).animate({'margin-top': 0}, 500, function () {
					$administracja.find('.infoBlock.old').remove()
				});

				return;
			} else {
				items.find('.block.focus').removeClass('focus');
				items.addClass('focus-control');
				block.addClass('focus');
				lastChoose = block;
			}

			var nextPrev = block;
			if (next.length == 0) {
				slideMark = block;
			} else {
				while (next.length != 0) {
					if (Math.floor(next.position().top) != Math.floor(targetPos)) {
						slideMark = nextPrev;
						break;
					}
					nextPrev = next;
					next = next.nextAll('.block:first');
				}

				if (typeof(slideMark) == "undefined")
					slideMark = nextPrev;
			}

			var infoBlock = $('<div></div>').addClass('infoBlock _chart current active col-xs-12').css('height', 0).append(
				$('<div></div>').addClass('arrow')
			).append(
				$('<div></div>').addClass('content').append(
					$('<div></div>').addClass('container')
				)
			);

			if ($administracja.find('.infoBlock').length !== 0) {
				if ($administracja.find('.infoBlock').data('marker')[0] === slideMark[0]) {
					infoBlock = $administracja.find('.infoBlock');
					infoBlock.addClass('current active');

					$('html, body').animate({
						scrollTop: block.offset().top
					}, 600);
				} else {
					$administracja.find('.infoBlock.active').addClass('old').removeClass('active').css({
						'height': 0,
						'border-width': 0
					}).stop(true, true).animate({'margin-top': 0}, 500, function () {
						$administracja.find('.infoBlock.old').remove();

						$('html, body').animate({
							scrollTop: block.offset().top
						}, 600);
					});
					slideMark.after(infoBlock);
				}
			} else {

				$('html, body').animate({
					scrollTop: block.offset().top
				}, 600);
				slideMark.after(infoBlock);
			}

			infoBlock.data('marker', slideMark).find('.container').empty().append(function () {
				var slug = $(this),
					leftCol = $('<div></div>').addClass('leftSide col-xs-12'),
					rightCol = $('<div></div>').addClass('rightSide col-xs-12');

				leftCol.append($('<div></div>'));

				slug.append(leftCol).append(rightCol);
			});

			infoBlock.find('.arrow').css('left', block.position().left + (block.outerWidth() / 2) + 'px');
			infoBlock.removeClass('current');

			rozdzialy(that);
		})
	})
});

function rozdzialy(item) {
	var infoBlock = $('._chart.active').attr('data-itemid', item.parent().attr('data-id')),
		rozdzialy = item.find('table.rozdzialy'),
		subtitle = item.find('.subtitle'),
		chart = item.find('.chart');

	infoBlock.find('.leftSide').html(chart.html());
	graphInit(infoBlock);

	infoBlock.find('.rightSide').html( $(subtitle.html() + '<table>' + rozdzialy.html() + '</table>').addClass('table table-condensed') );
	infoBlock.css('height', infoBlock.find('.container').outerHeight(true));
}

function graphInit(section) {
	var $section = $(section),
		histogram_div = jQuery($section.find('.histogram')),
		data = histogram_div.data('histogram'),
		interval = histogram_div.data('interval') || 0,
		mode = histogram_div.data('mode') || 'absolute',
		charts_data = [],
		i = $section.attr('data-itemid'),
		title = $section.find('.histogram').data('title'),
		subtitle = $section.find('.histogram').data('subtitle');

	for (var d = 0; d < data.length; d++) {
		if (data[d]) {
			var v = Number(data[d]['doc_count']);

			charts_data.push({
				x: data[d]['key'],
				y: v
			});
		}
	}

	histogram_div.attr('id', 'h' + i);

	new Highcharts.Chart({
		chart: {
			renderTo: 'h' + i,
			type: 'column',
			height: 300,
			backgroundColor: null,
			spacingTop: 0,
			marginBottom : 100
		},

		tooltip: {
			enabled: true,
			formatter: function(){
				var y = Number(this.y);
				return 'Liczba gmin, których wydatki ' + (mode != 'absolute' ? 'na 1 osobę' : '') + ' mieszczą się w przedziale ' + pl_currency_format(this.x , 1) + ' - ' + pl_currency_format(this.x + interval , 1) + ' : <b>' + y + '</b>';
			},
			positioner: function() {
				return {
					x: 250,
					y: 230
				}
			}
		},

		credits: {
			enabled: false
		},

		legend: {
			enabled: false
		},

		title: {
			text: title,
			y: 20
		},

		subtitle: {
			text: subtitle,
			y: 40
		},

		xAxis: {
			labels: {
				enabled: true,
				formatter: function () {
					return pl_number_format(this.value, 1);
				}
			},
			gridLineWidth: 0,
			title: null
		},

		yAxis: {
			labels: {
				enabled: false
			},
			gridLineWidth: 0,
			title: {
				text: '',
				offset: 20,
				style: {
					color: '#AAA',
					'font-family': '"Helvetica Neue",Helvetica,Arial,sans-serif',
					'font-size': '13px',
					'font-weight': '300'
				}
			}
		},

		plotOptions: {
			column: {
				groupPadding: 0,
				pointPadding: 0,
				borderWidth: 0,
				minPointLength: 10
			},
			series: {
				pointPlacement: "on"
			}
		},

		series: [{
			data: charts_data
		}]

	});
}
