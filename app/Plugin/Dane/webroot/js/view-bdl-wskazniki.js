/**
 * jQuery table-sort v0.1.1
 * https://github.com/gajus/table-sort
 *
 * Licensed under the BSD.
 * https://github.com/gajus/table-sort/blob/master/LICENSE
 *
 * Author: Gajus Kuizinas <g.kuizinas@anuary.com>
 */
(function ($) {
    $.ay = $.ay || {};
    $.ay.tableSort = function (options) {
        var settings = $.extend({
            'debug': false
        }, options);

        var table_to_array = function (columns, row_width) {
            if (settings.debug) {
                console.time('table to array');
            }

            var columns = Array.prototype.slice.call(columns, 0),
                rows = [],
                row_index = 0;

            for (var i = 0, j = columns.length; i < j; i += row_width) {
                var row = [];

                for (var k = 0, l = row_width; k < l; k++) {
                    var e = columns[i + k],
                        data = e.dataset.aySortWeight;

                    if (data === undefined) {
                        var data = e.textContent || e.innerText;
                    }

                    var number = parseFloat(data),
                        data = isNaN(number) ? data : number;

                    row.push(data);
                }

                rows.push({index: row_index++, data: row});
            }

            if (settings.debug) {
                console.timeEnd('table to array');
            }

            return rows;
        };

        if (!settings.target || !settings.target instanceof $) {
            throw 'Target is not defined or it is not instance of jQuery.';
        }

        settings.target.each(function () {
            var table = $(this);

            table.find('thead th > span.ay-sort').on('click', function () {
                $(this).parents('thead').find('th > span').not($(this)).removeClass('ay-sort-asc ay-sort-desc');

                var desc;

                if ($(this).hasClass('ay-sort-asc')) {
                    $(this).removeClass('ay-sort-asc').addClass('ay-sort-desc');
                    desc = 1;
                } else {
                    $(this).removeClass('ay-sort-desc').addClass('ay-sort-asc');
                    desc = 0;
                }

                var index = ($(this).data('ay-sort-index') === undefined ? $(this).index() : $(this).data('ay-sort-index'));

                table.find('tbody:not(.ay-sort-no)').each(function () {
                    var tbody = $(this),
                        rows = this.rows,
                        anomalies = $(rows).has('[colspan]').detach(),
                        columns = this.getElementsByClassName('sortOption');

                    if (this.data_matrix === undefined) {
                        this.data_matrix = table_to_array(columns, $(rows[0]).find('.sortOption').length);
                    }

                    var data = this.data_matrix;

                    if (settings.debug) {
                        console.time('sort data');
                    }

                    data.sort(function (a, b) {
                        if (typeof(a.data[index]) == 'string' && typeof(b.data[index]) == 'string') {
                            if (a.data[index].toLowerCase() == b.data[index].toLowerCase()) {
                                return 0;
                            }
                            return (desc ? a.data[index].toLowerCase() > b.data[index].toLowerCase() : a.data[index].toLowerCase() < b.data[index].toLowerCase()) ? -1 : 1;
                        } else {
                            if (a.data[index] == b.data[index]) {
                                return 0;
                            }
                            return (desc ? a.data[index] > b.data[index] : a.data[index] < b.data[index]) ? -1 : 1;
                        }
                    });

                    if (settings.debug) {
                        console.timeEnd('sort data');
                        console.time('build table');
                    }

                    rows = Array.prototype.slice.call(rows, 0);

                    var table = tbody.parent(),
                        tbody = tbody.detach(),
                        last_row = rows[data[data.length - 1].index];

                    for (var i = 0, j = data.length - 1; i < j; i++) {
                        tbody[0].insertBefore(rows[data[i].index], last_row);
                        data[i].index = i;
                    }

                    data[data.length - 1].index = data.length - 1;
                    tbody.prepend(anomalies);
                    table.append(tbody);

                    if (settings.debug) {
                        console.timeEnd('build table');
                    }
                });
            });
        });
    };
})(jQuery);

/** BDL WSKAZNIKI PAGE CODE */
jQuery(document).ready(function () {
    var main = jQuery('#bdl-wskazniki'),
        wskazniki = main.find('.wskaznik'),
        wskaznikiStatic = main.find('.wskaznikStatic'),
        wskaznikiString = '';

    wskazniki.each(function () {
        if (wskaznikiString != '')
            wskaznikiString += ',';
        wskaznikiString += jQuery(this).data('dim_id');
    });

    jQuery.ajax({
        url: "/dane/bdl_wskazniki/chart_data_for_dimmensions.json?dims=" + wskaznikiString,
        type: "POST",
        dataType: "json",
        beforeSend: function () {
            wskazniki.find('.chart .progress-bar').attr('aria-valuenow', '45').css('width', '45%');
        },
        always: function () {
            wskazniki.find('.chart .progress-bar').attr('aria-valuenow', '80').css('width', '80%');
        },
        complete: function (res) {
            var data = res.responseJSON.data;

            jQuery.each(data, function () {
                var chart = this,
                    wskaznik = jQuery('.wskaznik[data-dim_id="' + chart.id + '"]').find('.chart'),
                    wskaznikBackground = (wskaznik.data('chart-background') != undefined) ? wskaznik.data('chart-background') : '#FFFFFF',
                    label = [],
                    value = [];

                jQuery.each(chart.data, function () {
                    label.push(this.y);
                    value.push(Number(this.v));
                });

                wskaznik.highcharts({
                    title: {
                        text: ''
                    },
                    chart: {
                        backgroundColor: wskaznikBackground
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: {
                        categories: label
                    },
                    yAxis: {
                        title: ''
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        enabled: false,
                        align: 'left'
                    },
                    series: [
                        {
                            name: "Wartość",
                            data: value
                        }
                    ]
                });
            })
        }
    });

    if (wskaznikiStatic.length > 0) {
        jQuery.ay.tableSort({target: main.find('.content table'), debug: false});

        wskaznikiStatic.click(function () {
            var wskaznik = jQuery(this),
                wskaznikwidth = jQuery(this).outerWidth(),
                wskaznikData = wskaznik.data(),
                wskaznikChart = wskaznik.find('.wskaznikChart');

            wskaznikChart.css({'width': wskaznikwidth});

            jQuery.ajax({
                url: "/dane/bdl_wskazniki/chart_data_for_dimmensions.json?dims=" + wskaznikData.dim_id + '&localtype=' + wskaznikData.local_type + '&localid=' + wskaznikData.local_id,
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    wskaznikChart.slideDown();
                    wskaznikChart.find('.chart .progress-bar').attr('aria-valuenow', '45').css('width', '45%');
                },
                always: function () {
                    wskazniki.find('.chart .progress-bar').attr('aria-valuenow', '80').css('width', '80%');
                },
                complete: function (res) {
                    var data = res.responseJSON.data;

                    jQuery.each(data, function () {
                        var chart = this,
                            label = [],
                            value = [];

                        jQuery.each(chart.data, function () {
                            label.push(this.y);
                            value.push(Number(this.v));
                        });

                        wskaznikChart.highcharts({
                            title: {
                                text: ''
                            },
                            credits: {
                                enabled: false
                            },
                            xAxis: {
                                categories: label
                            },
                            yAxis: {
                                title: ''
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            legend: {
                                enabled: false,
                                align: 'left'
                            },
                            series: [
                                {
                                    name: "Wartość",
                                    data: value
                                }
                            ]
                        });
                    })
                }
            });

            wskaznik.addClass('clicked');
            wskaznik.unbind('click');
        });

        /*var wskaznik = jQuery(this).find('.chart'),
         chart = wskaznik.data('chart-datas'),
         label = [],
         value = [];

         jQuery.each(chart, function () {
         label.push(this['rocznik']);
         value.push(Number(this['v']));
         });

         wskaznik.highcharts({
         title: {
         text: ''
         },
         credits: {
         enabled: false
         },
         xAxis: {
         categories: label
         },
         yAxis: {
         title: ''
         },
         tooltip: {
         valueSuffix: ''
         },
         legend: {
         enabled: false,
         align: 'left'
         },
         series: [
         {
         name: "Wartość",
         data: value
         }
         ]
         });*/
    }
})
;