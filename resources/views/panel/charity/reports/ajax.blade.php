<div class="row pt-2">
    <?php $color = ['indigo', 'danger', 'blue']; ?>
    <?php $i = 0; ?>

    @foreach($reports as $report=>$val)
        <?php $sum = 0; ?>
        @foreach($val as $v=>$ff)
            @foreach($ff as $f)
                @php $sum +=$f['price'] @endphp
            @endforeach
        @endforeach
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-{{$color[$i]}}-400 has-bg-image">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{number_format($sum)}}
                            <small>{{__('messages.rial')}}</small>
                        </h3>
                        <div class="list-icons ml-auto">
                            <a class="list-icons-item" data-action="reload"></a>
                        </div>
                    </div>

                    <div>
                        {{__('messages.'.$report)}}
                        <div class="text-muted font-size-sm"></div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div id="line_chart_color_{{$report}}"></div>
                </div>
            </div>
        </div>
        <?php $i++; ?>
    @endforeach
</div>
<div class="row">
    @foreach($reportPort as $port)
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-enter6 icon-3x text-indigo-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="font-weight-semibold mb-0">{{number_format($port['price'])}}</h3>
                        <span class="text-uppercase font-size-sm text-muted">{{$port['port']}}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="container-fluid">
    <table class="table datatable-basic">
        <thead>
        <tr>
            <th>{{__('messages.id')}}</th>
            <th>{{__('messages.gateway')}}</th>
            <th>{{__('messages.ref_id')}}</th>
            <th>{{__('messages.tracking_code')}}</th>
            <th>{{__('messages.card_number')}}</th>
            <th>{{__('messages.status')}}</th>
            <th>{{__('messages.ip')}}</th>
            <th>{{__('messages.date')}}</th>
            <th>{{__('messages.amount')}}</th>
            <th>{{__('messages.type')}}</th>
            <th>{{__('messages.type')}}</th>
        </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
        @foreach($reportRow as $row)
            <tr>
                <td>{{$row['id']}}</td>
                <td>{{$row['port']}}</td>
                <td><span dir="ltr">{{$row['ref_id']}}</span></td>
                <td><span dir="ltr">{{$row['tracking_code']}}</span></td>
                <td><span dir="ltr">{{$row['card_number']}}</span></td>
                <td>{{__('messages.'.$row['status'])}}</td>
                <td><span dir="ltr">{{$row['ip']}}</span></td>
                <td><span dir="ltr">{{jdate("Y-m-d H:i:s",strtotime($row['payment_date']),'','','en')}}</span></td>
                <td>{{number_format($row['price'])}}</td>
                <td>{{__('messages.'.$row['module'])}}</td>
                <td>{{$row['charity_info']['title']['title']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    var DatatableBasic = function () {
        var _componentDatatableBasic = function () {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }
            $.extend($.fn.dataTable.defaults, {
                autoWidth: true,
                columnDefs: [{
                    orderable: false,
                    targets: [6]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',

                language: {
                    search: '<span>{{__('messages.filter')}}:</span> _INPUT_',
                    searchPlaceholder: '{{__('messages.search')}}...',
                    lengthMenu: '<span>{{__('messages.show')}}:</span> _MENU_',
                    paginate: {
                        'first': '{{__('messages.first')}}',
                        'last': '{{__('messages.last')}}',
                        'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                    }
                }
            });
            // Basic datatable
            $('.datatable-basic').DataTable({
                pagingType: "simple",
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        charset: 'utf-8',
                        extension: '.xls',
                        bom: true,
                    }
                ],
                language: {
                    paginate: {
                        'next': $('html').attr('dir') == 'rtl' ? '{{__('messages.next')}} &larr;' : '{{__('messages.next')}} &rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr; {{__('messages.prev')}}' : '&larr; {{__('messages.prev')}}'
                    }
                },
                stateSave: true,
                autoWidth: true,
            });

            // Resize scrollable table when sidebar width changes
            $('.sidebar-control').on('click', function () {
                table.columns.adjust().draw();
            });
        };
        var _componentSelect2 = function () {
            if (!$().select2) {
                console.warn('Warning - select2.min.js is not loaded.');
                return;
            }
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        };
        return {
            init: function () {
                _componentDatatableBasic();
                _componentSelect2();
            }
        }
    }();

    DatatableBasic.init();

</script>
<script>
    var StatisticWidgets = function () {
                @foreach($reports as $report=>$val)

        var _barChartWidget_{{$report}} = function (element, chartHeight, lineColor, pathColor, pointerLineColor, pointerBgColor) {
                if (typeof d3 == 'undefined') {
                    console.warn('Warning - d3.min.js is not loaded.');
                    return;
                }
                if (element) {
                    var dataset = [];
                    @foreach($val as $v=>$ff)
                        @php
                            $sum=0;
                            $i=0;
                        @endphp
                        @foreach($ff as $f)
                        @php
                            $sum +=$f['price'];
                            $i++;
                        @endphp
                        @endforeach
                        dataset.push({date: '{!! jdate("Y-m-d",strtotime($v),'','','en') !!}', price: '{{$sum}}', count: '{{$i}}'});
                    @endforeach
                    var d3Container = d3.select(element),
                        margin = {top: 0, right: 0, bottom: 0, left: 0},
                        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
                        height = chartHeight - margin.top - margin.bottom,
                        padding = 20;
                    var parseDate = d3.time.format("%Y-%m-%d").parse, formatDate = d3.time.format("%Y/%m/%d");
                    var tooltip = d3.tip()
                        .attr('class', 'd3-tip')
                        .html(function (d) {
                            return "<ul class='list-unstyled mb-1'>" +
                                "<li>" + "<div class='font-size-base my-1'><i class='icon-check2 mr-2'></i>" + formatDate(d.date) + "</div>" + "</li>" +
                                "<li>" + "{{__('messages.transaction_count')}}: &nbsp;" + "<span class='font-weight-semibold float-right'>" + d.count + "</span>" + "</li>" +
                                "<li>" + "{{__('messages.sum_price')}}: &nbsp; " + "<span class='font-weight-semibold float-right'>" + d.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " <small>{{__('messages.rial')}}</small></span>" + "</li>" +
                                "</ul>";
                        });
                    var container = d3Container.append('svg');
                    var svg = container
                        .attr('width', width + margin.left + margin.right)
                        .attr('height', height + margin.top + margin.bottom)
                        .append("g")
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
                        .call(tooltip);
                    dataset.forEach(function (d) {
                        d.date = parseDate(d.date);
                    });
                    var x = d3.time.scale()
                        .range([padding, width - padding]);
                    var y = d3.scale.linear()
                        .range([height, 5]);

                    // Horizontal
                    x.domain(d3.extent(dataset, function (d) {
                        return d.date;
                    }));
                    y.domain([0, d3.max(dataset, function (d) {
                        return Math.max(d.price);
                    })]);

                    var line = d3.svg.line()
                        .x(function (d) {
                            return x(d.date);
                        })
                        .y(function (d) {
                            return y(d.price);
                        });

                    var clip = svg.append("defs")
                        .append("clipPath")
                        .attr("id", "clip-line-small");
                    var clipRect = clip.append("rect")
                        .attr('class', 'clip')
                        .attr("width", 0)
                        .attr("height", height);
                    clipRect
                        .transition()
                        .duration(1000)
                        .ease('linear')
                        .attr("width", width);

                    var path = svg.append('path')
                        .attr({
                            'd': line(dataset),
                            "clip-path": "url(#clip-line-small)",
                            'class': 'd3-line d3-line-medium'
                        })
                        .style('stroke', lineColor);

                    svg.select('.line-tickets')
                        .transition()
                        .duration(1000)
                        .ease('linear');
                    var guide = svg.append('g')
                        .selectAll('.d3-line-guides-group')
                        .data(dataset);

                    // Append lines
                    guide
                        .enter()
                        .append('line')
                        .attr('class', 'd3-line-guides')
                        .attr('x1', function (d, i) {
                            return x(d.date);
                        })
                        .attr('y1', function (d, i) {
                            return height;
                        })
                        .attr('x2', function (d, i) {
                            return x(d.date);
                        })
                        .attr('y2', function (d, i) {
                            return height;
                        })
                        .style('stroke', pathColor)
                        .style('stroke-dasharray', '4,2')
                        .style('shape-rendering', 'crispEdges');

                    // Animate guide lines
                    guide
                        .transition()
                        .duration(1000)
                        .delay(function (d, i) {
                            return i * 150;
                        })
                        .attr('y2', function (d, i) {
                            return y(d.price);
                        });

                    var points = svg.insert('g')
                        .selectAll('.d3-line-circle')
                        .data(dataset)
                        .enter()
                        .append('circle')
                        .attr('class', 'd3-line-circle d3-line-circle-medium')
                        .attr("cx", line.x())
                        .attr("cy", line.y())
                        .attr("r", 3)
                        .style({
                            'stroke': pointerLineColor,
                            'fill': pointerBgColor
                        });

                    // Animate points on page load
                    points
                        .style('opacity', 0)
                        .transition()
                        .duration(250)
                        .ease('linear')
                        .delay(1000)
                        .style('opacity', 1);

                    // Add user interaction
                    points
                        .on("mouseover", function (d) {
                            tooltip.offset([-10, 0]).show(d);

                            // Animate circle radius
                            d3.select(this).transition().duration(250).attr('r', 4);
                        })

                        // Hide tooltip
                        .on("mouseout", function (d) {
                            tooltip.hide(d);

                            // Animate circle radius
                            d3.select(this).transition().duration(250).attr('r', 3);
                        });

                    // Change tooltip direction of first point
                    d3.select(points[0][0])
                        .on("mouseover", function (d) {
                            tooltip.offset([0, 10]).direction('e').show(d);
                            d3.select(this).transition().duration(250).attr('r', 4);
                        })
                        .on("mouseout", function (d) {
                            tooltip.direction('n').hide(d);
                            d3.select(this).transition().duration(250).attr('r', 3);
                        });

                    d3.select(points[0][points.size() - 1])
                        .on("mouseover", function (d) {
                            tooltip.offset([0, -10]).direction('w').show(d);
                            d3.select(this).transition().duration(250).attr('r', 4);
                        })
                        .on("mouseout", function (d) {
                            tooltip.direction('n').hide(d);
                            d3.select(this).transition().duration(250).attr('r', 3);
                        });

                    $(window).on('resize', lineChartResize);
                    $(document).on('click', '.sidebar-control', lineChartResize);

                    function lineChartResize() {
                        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;
                        container.attr("width", width + margin.left + margin.right);
                        svg.attr("width", width + margin.left + margin.right);
                        x.range([padding, width - padding]);
                        clipRect.attr("width", width);
                        svg.selectAll('.d3-line').attr("d", line(dataset));
                        svg.selectAll('.d3-line-circle').attr("cx", line.x());
                        svg.selectAll('.d3-line-guides')
                            .attr('x1', function (d, i) {
                                return x(d.date);
                            })
                            .attr('x2', function (d, i) {
                                return x(d.date);
                            });
                    }
                }
            };
        @endforeach
            return {
            init: function () {
                @foreach($reports as $report=>$val)
                _barChartWidget_{{$report}}('#line_chart_color_{{$report}}', 50, '#fff', 'rgba(255,255,255,0.5)', '#fff', '#29B6F6');
                @endforeach

            }
        }
    }();
    StatisticWidgets.init();
</script>
