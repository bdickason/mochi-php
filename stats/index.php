<HTML>
  <HEAD>
    <TITLE>Bloom Stats v1.0</TITLE>
    <script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js" /></script>
    
    <script type="text/javascript">
        var chart;
                $(document).ready(function() {
                    var options = {
                        chart: {
                            renderTo: 'container',
                            defaultSeriesType: 'line',
                            marginRight: 130,
                            marginBottom: 25
                        },
                        title: {
                            text: 'Clients',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        xAxis: {
                            type: 'datetime',
                            tickInterval: 30 * 24 * 3600 * 1000, // one month (roughly)
                            tickWidth: 0,
                            gridLineWidth: 1,
                            labels: {
                                align: 'center',
                                x: -3,
                                y: 20,
                                formatter: function() {
                                    return Highcharts.dateFormat('%b \'%y', this.value);
                                }
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Clients/month'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                            }]
                        },
                        plotOptions: {
                                series: {
                                    events: {
                                        legendItemClick: function(event) {
                                                            var selected = this.index;
                                                            var allSeries = this.chart.series;

                                                            $.each(allSeries, function(index, series) {
                                                                selected == index ? series.show() : series.hide();
                                                            });

                                                            return false;
                                                        }
                                    }
                                }
                            },
                        tooltip: {
                            formatter: function() {
                                    return Highcharts.dateFormat('%b \'%y', this.x) +': <b>'+ this.y + '</b>';
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 100,
                            borderWidth: 0
                        },
                        series: []
                    };
                    
                    /* Define stylists names */
                    names = [];
                    names[3703] = "Clarissa Malek";
                    names[3704] = "House";
                    names[3705] = "Elle Kinney";
                    names[3706] = "Mune Tran";
                    names[3712] = "Paula Casano";
                    names[3713] = "Leeann McDermott";
                    names[3714] = "Claudia Parrilla";
                    names[3715] = "Kristen Traina";
                    names[3737] = "Sal LoGerfo";
                    names[3738] = "Nadira Morgan";
                    names[3739] = "Reena Thakurprashad";
                    names[3747] = "Justin Born";
                    names[8932] = "Machiko Makabe";
                    names[8933] = "Claire Liscouski";

                    // Load data asynchronously using jQuery. On success, add the data
                    // to the options and initiate the chart.
                    // This data is obtained by exporting a GA custom report to TSV.
                    // http://api.jquery.com/jQuery.get/
                    
                    jQuery.get('data.php?report=<? echo $_GET['report']; ?>', null, function(tsv) {
                        var lines = [];
                        traffic = [];
                        stylists = [];
                        try {
                            // split the data return into lines and parse them
                            tsv = tsv.split(/\n/g);
                            stylists = {};
                            jQuery.each(tsv, function(i, line) {
                                line = line.split(/\t/);
                                date = Date.parse(line[0] +' UTC');
                                stylist = line[1];
                                clients = line[2];
                                if(stylists[stylist] == null) {
                                  stylists[stylist] = {
                                    id: stylist,
                                    name: names[stylist],
                                    data: []
                                  }
                                }
                                stylists[stylist].data.push([
                                  date,
                                  parseInt(clients.replace(',', ''), 10),
                                  ]);
                            });
                        } catch (e) {  }
                        
                        delete stylists[undefined];
                        jQuery.each(stylists, function() {
                          options.series.push(this);

                        });
                        
                        chart = new Highcharts.Chart(options);
                    });
                });
</script>
    
  </HEAD>
</HTML>
  
<BODY>
  <div id="container" width="80%">
  </div>
</BODY>