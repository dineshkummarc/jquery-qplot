<?php 
    $title = "Block Plots";
    // $plotTargets = array('chart1', 'chart2', 'chart3');
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

 <p>Below is an example block plot.  This plot also uses the Enhanced Legend Renderer plugin.  Clicking on an item in the legend will toggle display of the appropriate series.</p>

    <div id="chart1" class="plot" style="width:500px;height:300px;margin-bottom:30px;"></div>

<p>Blocks can be moved by selecting the series, the point, and an optional duration parameter.  If specified, duration will animate the movement.  Duration is either a number in milliseconds, or the keywords 'fast' or 'slow'.  Higher numbers will cause a slower animation.</p>
    Series: <select id="seriesId">
        <option value="0" selected>First</option>
        <option value="1">Second</option>
        <option value="2">Third</option>
    </select>
    Point: <select id="pointId">
        <option value="0" selected>first</option>
        <option value="1">second</option>
        <option value="2">third</option>
        <option value="3">fourth</option>
        <option value="4">fifth</option>
        <option value="5">six</option>
    </select>
    Duration: <select id="duration">
        <option value="" selected>None</option>
        <option value="150">100</option>
        <option value="fast">fast</option>
        <option value="300">300</option>
        <option value="300">400</option>
        <option value="300">500</option>
        <option value="slow">slow</option>
        <option value="900">700</option>
        <option value="900">800</option>
        <option value="900">900</option>
    </select>
    X: <button id="mxval" type="button" value="-0.5" onclick="move('x', -1);">-1</button> <button id="pxval" type="button" value="-0.5" onclick="move('x', 0.5);">0.5</button>
    Y: <button id="myval" type="button" name="myval" value="-10" onclick="move('y', -30);">-30</button> <button id="pyval" type="button" name="pyval" value="10" onclick="move('y', 15);">15</button>

    <pre class="code brush:js"></pre>
    
    
    <p>This second chart is like the first except the "varyBlockColors" renderer option is set to true.  This will vary the color of each block in a series separately.  This allows displaying a third dimension to the data such as grouping beverage products by producer and by category such as "cola", "tea", "energy drink", etc.</p>
    
    <p>Also, the legend has it's "showSwathces" option set to false, since the blocks of each series will be of varying color and won't correspond to one swatch color.  This still enables the user to show and hide the series by clicking on a label in the legend.</p>
    
    <div id="chart2" class="plot" style="width:500px;height:300px;margin-bottom:30px;"></div>


<script class="code" type="text/javascript">
$(document).ready(function(){

    var s1 = [[0.9, 120, 'Vernors'], [1.8, 140, 'Fanta'], [3.2, 90, 'Barqs', {background:'#ddbb33'}], 
    [4.1, 140, 'Arizon Iced Tea'], [4.5, 91, 'Red Bull'], [6.8, 17, 'Go Girl']];
    var s2 = [[1.3, 44, 'Pepsi'], [2.1, 170, 'Sierra Mist'], [2.6, 66, 'Moutain Dew'], 
    [4, 52, 'Sobe'], [5.4, 16, 'Amp'], [6, 48, 'Aquafina']];
    var s3 = [[1, 59, 'Coca-Cola', {background:'rgb(250, 160, 160)'}], [2, 50, 'Ambasa'], 
    [3, 90, 'Mello Yello'], [4, 90, 'Sprite'], [5, 71, 'Squirt'], [5, 155, 'Youki']];

    var plot1 = $.jqplot('chart1',[s1, s2, s3],{
        seriesDefaults:{
            renderer:$.jqplot.BlockRenderer
        }, 
       legend:{
           renderer: $.jqplot.EnhancedLegendRenderer,
           show:true
        },
        series: [
           {},
           {rendererOptions: {
               css:{background:'#A1EED6'}
           }},
           {rendererOptions: {
               css:{background:'#D3E4A0'}
           }}
        ],
        axes: {
            xaxis: {
                min:0,
                max: 8
            },
            yaxis: {
                min:0,
                max: 200
            }
        }
    });
});
</script>

<script class="code" type="text/javascript">
$(document).ready(function(){
    var s1 = [[0.9, 120, 'Vernors'], [1.8, 140, 'Fanta'], [3.2, 90, 'Barqs'], 
    [4.1, 140, 'Arizon Iced Tea'], [4.5, 91, 'Red Bull'], [6.8, 17, 'Go Girl']];
    var s2 = [[1.3, 44, 'Pepsi'], [2.1, 170, 'Sierra Mist'], [2.6, 66, 'Moutain Dew'], 
    [4, 52, 'Sobe'], [5.4, 16, 'Amp'], [6, 48, 'Aquafina']];
    var s3 = [[1, 59, 'Coca-Cola'], [2, 50, 'Sprite'], [3, 90, 'Mello Yello'], 
    [4, 90, 'Ambasa'], [5, 71, 'Squirt'], [5, 155, 'Youki']];


    var plot2 = $.jqplot('chart2',[s1, s2, s3],{
        seriesDefaults:{
            renderer:$.jqplot.BlockRenderer,
            rendererOptions: {
                varyBlockColors: true
            },
            pointLabels:{
                show: false
            }
        }, 
       legend:{
           renderer: $.jqplot.EnhancedLegendRenderer,
           show:true,
           showSwatches: false
        },
        series: [{label: 'Independent Brands'}, {label: 'Pepsi Brands'}, {label: 'Coke Brands'}],
        axes: {
            xaxis: {
                min:0,
                max: 8
            },
            yaxis: {
                min:0,
                max: 200
            }
        }
    });
   
 });
 
 function move(dir, val) {
     val = parseFloat(val);
     var sidx = parseInt($('#seriesId').val());
     var pidx = parseInt($('#pointId').val());
     var duration = $('#duration').val();
     var x = plot1.series[sidx].data[pidx][0];
     var y = plot1.series[sidx].data[pidx][1];
     (dir == 'x') ? x += val : y += val; 
     plot1.series[sidx].moveBlock(pidx, x, y, duration);
 }
 
</script>

<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- Additional plugins go here -->

  <script class="include" type="text/javascript" src="../src/plugins/jqplot.blockRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.enhancedLegendRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.pointLabels.js"></script>

<!-- End additional plugins -->

<?php include "closer.html"; ?>
