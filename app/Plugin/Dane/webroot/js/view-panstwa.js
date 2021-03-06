$(document).ready(function () {

    var data = _chartImpEksData;
    var categories = [];
    var series;
    var seriesImportData = [];
    var seriesExportData = [];
    var seriesImport2014Data = [];
    var seriesExport2014Data = [];

    for (var i = 0; i < data.length; i++) {
        $('#selectYear').append('<option value="' + data[i].rocznik + '">' + data[i].rocznik + '</option>');
        categories.push(parseInt(data[i].rocznik));
        if (parseInt(data[i].rocznik) === 2015 || parseInt(data[i].rocznik) === 2014) {
            seriesImport2014Data.push(parseInt(data[i].import_pln));
            seriesExport2014Data.push(parseInt(data[i].eksport_pln));
            if (parseInt(data[i].rocznik) === 2014) {
                seriesImportData.push(parseInt(data[i].import_pln));
                seriesExportData.push(parseInt(data[i].eksport_pln));
            }
            continue;
        }
        seriesImport2014Data.push(null);
        seriesExport2014Data.push(null);
        seriesImportData.push(parseInt(data[i].import_pln));
        seriesExportData.push(parseInt(data[i].eksport_pln));
    }

    series = [
        {
            name: 'Import',
            data: seriesImportData
        },
        {
            name: 'Eksport',
            data: seriesExportData
        },
        {
            name: 'Import (dane wstępne)',
            dashStyle: 'shortdot',
            data: seriesImport2014Data,
            color: '#7cb5ec',
            showInLegend: false
        },
        {
            name: 'Export (dane wstępne)',
            dashStyle: 'shortdot',
            data: seriesExport2014Data,
            color: '#434348',
            showInLegend: false
        }
    ];

    $('#highchartImportExport').highcharts({
        title: {
            text: 'Import i Eksport'
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: 'Wartość (zł)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            min: 0,
            labels: {
                formatter: function () {
                    return pl_currency_format(this.value, true);
                }
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            valueSuffix: ' zł'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        chart: {
			backgroundColor: null
        },
        series: series
    });

    var loadTopData = function (year) {
		$.getJSON(mPHeart.constant.ajax.api + '/handel_zagraniczny/stats/towary.json?panstwo_id=' + _objectData.id + '&rocznik=' + year + '&order=import', function (data) {
            $('#topImportList').html('');
            $.each(data, function (key, val) {
                $('#topImportList').append('<li class="list-group-item"><span class="badge">' + pl_currency_format(val.wartosc_pln) + ' zł</span>' + val.nazwa + '</li>');
            });
        });

		$.getJSON(mPHeart.constant.ajax.api + '/handel_zagraniczny/stats/towary.json?panstwo_id=' + _objectData.id + '&rocznik=' + year + '&order=eksport', function (data) {
            $('#topExportList').html('');
            $.each(data, function (key, val) {
                $('#topExportList').append('<li class="list-group-item"><span class="badge">' + pl_currency_format(val.wartosc_pln) + ' zł</span>' + val.nazwa + '</li>');
            });
        });
    };

    $('#selectYear').change(function () {
        var year = $(this).find("option:selected").text();
        // loadTopData(year);
        tree.setYear(year);
    });

    $('#selectYear').val(_year);
    // loadTopData(parseInt(_year)); // default

    var tree = {
        $import: $('#import'),
        import_data: [],

        $export: $('#export'),
        export_data: [],

        country_id: 0,
        year: 0,

        setYear: function (year) {
            this.year = parseInt(year);
            var k = this.year + '_0';
            var t = this;
            if (t.import_data[k] === undefined) {
                t.get(t.year, 'import', 0, function (data) {
                    t.import_data[k] = data;
                    t.get(t.year, 'export', 0, function (data) {
                        t.export_data[k] = data;
                        t.update();
                    });
                });
            } else {
                t.update();
            }
        },

        update: function () {
            var k = this.year + '_0';
            this.$import.html('');
            for (var i = 0; i < this.import_data[k].length; i++) {
                var row = this.import_data[k][i];
                this.$import.append(
                    this.template(row)
                );
            }
            this.$export.html('');
            for (var i = 0; i < this.export_data[k].length; i++) {
                var row = this.export_data[k][i];
                this.$export.append(
                    this.template(row)
                );
            }

            var t = this;

            $('#import li').click(function () {
                if ($(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).find('ul').remove();
                    return false;
                }
                $(this).addClass('open');
                var parent_id = parseInt($(this).attr('id'));
                var k = t.year + '_' + parent_id;
                if (t.import_data[k] === undefined) {
                    t.get(t.year, 'import', parent_id, function (data) {
                        t.import_data[k] = data;
                        t.update_childs('import', parent_id);
                    });
                } else {
                    t.update_childs('import', parent_id);
                }
            });

            $('#export li').click(function () {
                if ($(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).find('ul').remove();
                    return false;
                }
                $(this).addClass('open');
                var parent_id = parseInt($(this).attr('id'));
                var k = t.year + '_' + parent_id;
                if (t.export_data[k] === undefined) {
                    t.get(t.year, 'export', parent_id, function (data) {
                        t.export_data[k] = data;
                        t.update_childs('export', parent_id);
                    });
                } else {
                    t.update_childs('export', parent_id);
                }
            });
        },

        update_childs: function (type, parent_id) {
            var k = this.year + '_' + parent_id;
            switch (type) {
                default: // import
                    var t = this;
                    $('#import #' + parent_id).find('ul').remove();
                    if (this.import_data[k].length === 0) {
                        return false;
                    }
                    $('#import #' + parent_id).append('<ul></ul>');
                    for (var i = 0; i < this.import_data[k].length; i++) {
                        var row = this.import_data[k][i];
                        $('#import #' + parent_id + ' ul').append(this.template(row));
                    }
                    $('#import #' + parent_id + ' ul li').click(function () {
                        if ($(this).hasClass('open')) {
                            $(this).removeClass('open');
                            $(this).find('ul').remove();
                            return false;
                        }
                        $(this).addClass('open');
                        var parent_id = parseInt($(this).attr('id'));
                        var k = t.year + '_' + parent_id;
                        if (t.import_data[k] === undefined) {
                            t.get(t.year, 'import', parent_id, function (data) {
                                t.import_data[k] = data;
                                t.update_childs('import', parent_id);
                            });
                        } else {
                            t.update_childs('import', parent_id);
                        }
                        return false;
                    });
                    break;

                case 'export':
                    var t = this;
                    $('#export #' + parent_id).find('ul').remove();
                    if (this.export_data[k].length === 0) {
                        return false;
                    }
                    $('#export #' + parent_id).append('<ul></ul>');
                    for (var i = 0; i < this.export_data[k].length; i++) {
                        var row = this.export_data[k][i];
                        $('#export #' + parent_id + ' ul').append(this.template(row));
                    }
                    $('#export #' + parent_id + ' ul li').click(function () {
                        if ($(this).hasClass('open')) {
                            $(this).removeClass('open');
                            $(this).find('ul').remove();
                            return false;
                        }
                        $(this).addClass('open');
                        var parent_id = parseInt($(this).attr('id'));
                        var k = t.year + '_' + parent_id;
                        if (t.export_data[k] === undefined) {
                            t.get(t.year, 'export', parent_id, function (data) {
                                t.export_data[k] = data;
                                t.update_childs('export', parent_id);
                            });
                        } else {
                            t.update_childs('export', parent_id);
                        }
                        return false;
                    });
                    break;
            }
        },

        template: function (row) {
            return '<li id="' + row.id + '"><span class="currency">' + pl_currency_format(row.wartosc_pln) + ' zł</span><p>' + row.nazwa + ' <a href="/dane/handel_zagraniczny_towary/' + row.id + '" title="Zobacz szczegóły dotyczące tego towaru">więcej</a></p></li>';
        },

        get: function (year, type, parent_id, done_function) {
            $.getJSON(
				mPHeart.constant.ajax.api + '/handel_zagraniczny/stats/getSymbols.json' +
                '?parent_id=' + parent_id +
                '&year=' + year +
                '&type=' + type +
                '&country_id=' + this.country_id +
                '&limit=9999',
                done_function
            );
        }
    };

    tree.country_id = parseInt(_objectData.id);
    tree.setYear(_year);

});
