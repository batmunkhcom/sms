<?php
require_once('config.php');
require_once('common.php');


switch ($_GET['action']) {

    case 'login':
        if (isset($GLOBALS['users'][$_POST['username']]) &&
                $GLOBALS['users'][$_POST['username']] == $_POST['password']) {
            $_SESSION['is_admin'] = 1;
        }
        break;
    case 'logout':
        $_SESSION['is_admin'] = 0;
        break;
}
if ($_SESSION['is_admin'] != 1) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SMS List</title>

        <link rel="STYLESHEET" type="text/css" href="/<?php echo DIR; ?>dhtmlx/dhtmlxCombo/codebase/dhtmlxcombo.css">
        <link rel="STYLESHEET" type="text/css" href="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.css">
        <link rel="stylesheet" type="text/css" href="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css">
        <link rel="stylesheet" type="text/css" href="/<?php echo DIR; ?>dhtmlx/dhtmlxChart/codebase/dhtmlxchart_debug.css">
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_srnd.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxCombo/codebase/dhtmlxcommon.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxCombo/codebase/dhtmlxcombo.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/libCompiler/core.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/libCompiler/export/1310559177/dhtmlx.js"></script>
        <script  src="/<?php echo DIR; ?>dhtmlx/dhtmlxChart/codebase/dhtmlxchart_debug.js"></script>

    </head>
    <body>
        <a href="index.php?action=logout">Logout</a>
        <div style="width: 810px; float: left; margin-right: 10px;">

            <h2>All sms</h2>
            <div id="filterPhone"></div>
            <div id="gridbox" style="width:810px;height:270px;overflow:hidden"></div>


            <input type="button" name="some_name" value="update" onclick="smsDP.sendData();">

            <br clear="all" />
        </div>

        <br clear="all" />
        <div style="width: 400px; float: left; margin-right: 10px;">

            <h2>Validated A</h2>
            <div id="validatedbox1" style="width:400px;height:270px;overflow:hidden;"></div>
            <br clear="all" />
        </div>
        <div style="width: 400px; float: left;">

            <h2>Validated B</h2>
            <div id="validatedbox2" style="width:400px;height:270px;overflow:hidden;"></div>
            <br clear="all" />
        </div>

        <script>
            //init grid and set its parameters (this part as always);
            mygrid = new dhtmlXGridObject('gridbox');
            mygrid.setImagePath("/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/imgs/");
            mygrid.setHeader("#,Operator,Sender,Receiver,SMS,count,Is valid,Date");
            mygrid.attachHeader("&nbsp;,#combo_filter,#combo_filter,&nbsp;,#combo_filter,&nbsp;,&nbsp;,&nbsp;");
            mygrid.setInitWidths("50,100,100,80,*,80,80,120");
            mygrid.setColAlign("center,center,center,center,left,center,center,center");
            mygrid.setColTypes("ro,coro,ed,ed,coro,ed,ch,ro");
            mygrid.setSkin("dhx_skyblue");
            mygrid.setColSorting("int,str,str,int,str,str,str,str,date");
            mygrid.init();
            
            mygrid.enableSmartRendering(true);
            mygrid.loadXML("xml.php?type=sms");
            
            
            
            //used just for demo purposes;
            //============================================================================================;
            smsDP = new dataProcessor("update.php");
            //lock feed url;
            smsDP.setTransactionMode("POST", true);
            //set mode as send-all-by-post;
            smsDP.setUpdateMode("off");
            //disable auto-update;
            smsDP.init(mygrid);
            //link dataprocessor to the grid;
            //============================================================================================;
            
            //validated list 1
            //init grid and set its parameters (this part as always);
            myvalid1 = new dhtmlXGridObject('validatedbox1');
            myvalid1.setImagePath("/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/imgs/");
            myvalid1.setHeader("#,Phone,Str1,Str2,Date");
            myvalid1.setInitWidths("50,*,50,80,120");
            myvalid1.setColAlign("center,center,center,center,center");
            myvalid1.setColTypes("ro,ro,ro,ro,ro");
            myvalid1.setSkin("dhx_skyblue");
            myvalid1.setColSorting("int,str,str,int,date");
            myvalid1.init();
            myvalid1.loadXML("xml.php?type=valid1&limit=30");
            //used just for demo purposes;
            //============================================================================================;
            validDP = new dataProcessor("update.php");
            //lock feed url;
            validDP.setTransactionMode("POST", true);
            //set mode as send-all-by-post;
            validDP.setUpdateMode("off");
            //disable auto-update;
            validDP.init(myvalid1);
            //link dataprocessor to the grid;
            //============================================================================================;
            
            
            //validated list 2
            //init grid and set its parameters (this part as always);
            myvalid2 = new dhtmlXGridObject('validatedbox2');
            myvalid2.setImagePath("/<?php echo DIR; ?>dhtmlx/dhtmlxGrid/codebase/imgs/");
            myvalid2.setHeader("#,Phone,Str1,Str2,Date");
            myvalid2.setInitWidths("50,*,50,80,120");
            myvalid2.setColAlign("center,center,center,center,center");
            myvalid2.setColTypes("ro,ro,ro,ro,ro");
            myvalid2.setSkin("dhx_skyblue");
            myvalid2.setColSorting("int,str,str,int,date");
            myvalid2.init();
            myvalid2.loadXML("xml.php?type=valid2&limit=30");
            //used just for demo purposes;
            //============================================================================================;
            validDP2 = new dataProcessor("update.php");
            //lock feed url;
            validDP2.setTransactionMode("POST", true);
            //set mode as send-all-by-post;
            validDP2.setUpdateMode("off");
            //disable auto-update;
            validDP2.init(myvalid2);
            //link dataprocessor to the grid;
            //============================================================================================;
        </script>


        <br clear="all" />

        <div id="operatorChart" style="width:400px;height:300px;border:1px solid #A4BED4; float: left; display: block; margin: 5px;"></div>
        <div id="validatedChart" style="width:350px;height:300px;border:1px solid #A4BED4; float: left; display: block; margin: 5px;"></div>
        <div id="typeChart" style="width:390px;height:300px;border:1px solid #A4BED4; float: left; display: block; margin: 5px;"></div>
        <div id="topSenders" style="width:980px;height:300px;border:1px solid #A4BED4; float: left; display: block; margin: 5px;"></div>
        <script>
            //chart ehlev
            var operatorChartData = [
<?php
$chartColors = array(
    '#FF00FF',
    '#FFFF00',
    '#0000FF',
    '#e0e56c',
    '#F7941C',
    '#FF00DD',
    '#FFFF00',
    '#00CCFF',
    '#e0e56c',
    '#003663'
);


$ops = countOperators();
for ($i = 0; $i < mysql_num_rows($ops); $i++) {
    echo '{ total: "' . mysql_result($ops, $i, "op") . '", operator: "' . mysql_result($ops, $i, "operator") . '", color: "' . $chartColors[$i] . '"}';
    if ($i + 1 < mysql_num_rows($ops)) {
        echo ',';
    }
}
?>
    ];
    var validatedChartData = [
<?php
$validTotal = getAllIsValid();
$invalidTotal = getAllIsInValid();
echo '{ total: "' . $validTotal . '", is_valid: "Зөв санал ", color: "' . $chartColors[rand(0, count($chartColors))] . '"},';
echo '{ total: "' . $invalidTotal . '", is_valid: "Буруу санал", color: "' . $chartColors[rand(0, count($chartColors))] . '"}';
?>
    ];
    var typeChartData = [
<?php
$typeA = getFromValidated('a');
$typeB = getFromValidated('b');
echo '{ total: "' . $typeA . '", type: "A бараа ", color: "' . $chartColors[rand(0, count($chartColors))] . '"},';
echo '{ total: "' . $typeB . '", type: "B бараа", color: "' . $chartColors[rand(0, count($chartColors))] . '"}';
?>
    ];
           
    var topSendersData = [
<?php
$topSenders = getTopSenders(30);
for ($i = 0; $i < mysql_num_rows($topSenders); $i++) {
    echo '{ total: "' . mysql_result($topSenders, $i, "cnt") . '", num: "'.($i+1).'", phone: "' . mysql_result($topSenders, $i, "sender") . '", color: "' . $chartColors[rand(0, count($chartColors))] . '"},';
}
?>
    ];
        </script>
        <script>     
            window.onload = function() {
                var operatorChart = new dhtmlXChart({
                    view: "pie3D",
                    container: "operatorChart",
                    value: "#total#",
                    color: "#color#",
                    label: "#operator#",
                    legend:{
                        values:[{text:"Операторууд",color:"#ffffff"}],
                        valign:"top",
                        align:"middle"
                    },
                    tooltip: {
                        template: "#operator#"
                    },
                    pieInnerText: "<b>#total#</b>",
                    gradient: true
                });
                operatorChart.parse(operatorChartData, "json");
        
        
                var validatedChart = new dhtmlXChart({
                    view: "pie3D",
                    container: "validatedChart",
                    value: "#total#",
                    color: "#color#",
                    label: "#is_valid#",
                    legend:{
                        values:[{text:"Санал",color:"#ffffff"}],
                        valign:"top",
                        align:"middle"
                    },
                    tooltip: {
                        template: "#is_valid#"
                    },
                    pieInnerText: "<b>#total#</b>",
                    gradient: true
                });
                validatedChart.parse(validatedChartData, "json");
        
        
                var typeChart = new dhtmlXChart({
                    view: "pie3D",
                    container: "typeChart",
                    value: "#total#",
                    color: "#color#",
                    label: "#type#",
                    legend:{
                        values:[{text:"Бараагаар",color:"#ffffff"}],
                        valign:"top",
                        align:"middle"
                    },
                    tooltip: {
                        template: "#type#"
                    },
                    pieInnerText: "<b>#total#</b>",
                    gradient: true
                });
                typeChart.parse(typeChartData, "json");
        
                var topSenders = new dhtmlXChart({
                    view: "bar",
                    container: "topSenders",
                    value: "#total#",
                    color: "#color#",
                    label: "#total#",
                    legend:{
                        values:[{text:"Топууд",color:"#ffffff"}],
                        valign:"top",
                        align:"middle"
                    },
                    tooltip: {
                        template: "#phone#"
                    },
                    xAxis: {
                        title: "Хамгийн их санал өгөгчид",
                        template: "#num#"
                    },
                    pieInnerText: "<b>#total#</b>"
                });
                topSenders.parse(topSendersData, "json");
 
            }

        </script>
        <br clear="all" />
        <br />
        <h2>API</h2>
<?php
echo highlight_string('$top1 = file_get_contents(\'http://' . $_SERVER['HTTP_HOST'] . '/' . DIR . 'api.php?type=top1\');
echo rtrim($top1,\', \');', 1);

//echo phpinfo();
?>
        <br clear="all" />
        <br />
        <br />
        <br />
        by <a href="http://www.mng.cc" target="_blank">mBm TECHNOLOGY LLC</a>
    </body>
</html>
