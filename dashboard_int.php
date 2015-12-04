<!DOCTYPE html>
<html lang="en" style = "visibility:visible;">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>Deloitte Consulting: Dashboard</title>

        <link href="css/app.css" type="text/css" rel="stylesheet"/>
        <link href="materialize/css/materialize.css" type="text/css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">
          function set_client(cid){
            $('#client_select').val(cid);
          }
        </script>

        <!-- *********************** GOOGLE CHARTS ********************* -->

         <!--Load the AJAX API. Do this only once per web page! -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

         <script type="text/javascript">
          google.load('visualization', '1.1', {packages: ['line', 'scatter']});
          google.setOnLoadCallback(drawChart);

          function drawChart() {

            /***** CONDITIONAL CHART DRAWING *****/

            var data = google.visualization.arrayToDataTable([
              ['Year', 'Your Score', 'Industry Average'],
                  <?php
                    $id = $_GET['c_id'];

                    include ('db_conn.php');

                    $sql = "SELECT  `assess_date`,`global_rel_score` FROM `assessments` WHERE `client_id` = '" . $id . "' ORDER BY assess_date asc";
                    $result = $conn->query($sql);

                  if ($result->num_rows > 1) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $rows_returned = $result->num_rows;
                      echo "['" . $row['assess_date'] . "'," . $row['global_rel_score'] . ",46],";
                    }
                    
                    echo "]);";

                      /***** CHART OPTIONS *****/

                      echo "var options = {
                        legend: 'none',
                        chart: {
                          title: 'Assessment Score',
                          subtitle: ''
                        },
                        width: 800,
                        height: 400,
                        hAxis: {
                          // format: 'M/d/yy',
                          gridlines: {count: 7}
                        }
                      };";

                    echo "var chart = new google.charts.Line(document.getElementById('linechart_material'));";
                  
                  } else if ($result->num_rows == 1){
                    while($row = $result->fetch_assoc()) {
                      $rows_returned = $result->num_rows;
                      echo "['" . $row['assess_date'] . "'," . $row['global_rel_score'] . ",46],";
                    }

                    echo "]);";

                     /***** CHART OPTIONS *****/

                      echo "var options = {
                        legend: 'none',
                        chart: {
                          title: 'Assessment Score',
                          subtitle: ''
                        },
                        width: 800,
                        height: 400,
                      };";

                    echo "var chart = new google.charts.Scatter(document.getElementById('linechart_material'));";
                  }

                  else{
                    header("location:dashboard_int.php");
                  }
                  
                    //close connection
                    $conn->close();
                  ?>
            

            chart.draw(data, options);
          }
        </script>

         <!-- ******************* END GOOGLE CHARTS ********************* -->

    </head>

    <body>
        <div class="row">
        
            <nav>
                <div class="nav-wrapper white">
                  <a href="http://www2.deloitte.com/us/en.html" class="brand-logo"><img src="img/deloitte-logo.jpg" id="logo" class="responsive-img"></img></a>
                  <ul class="right hide-on-med-and-down">
                    <li class="pad-right"><a class="btn-floating btn waves-effect waves-light green-deloitte modal-trigger" href="#modal1"><i class="material-icons">help_outline</i></a></li>
                    <li class="pad-right"><a class="btn-floating btn waves-effect waves-light bright-blue-deloitte" href="profile.html"><i class="material-icons">face</i></a></li>
                    <li class="pad-right"><a class="btn-floating btn waves-effect waves-light bright-blue-deloitte" href="dashboard_int.php"><i class="material-icons">home</i></a></li>
                    <li class="pad-right"><a class="btn-floating btn waves-effect waves-light dark-grey-deloitte" href="login.html"><i class="material-icons">exit_to_app</i></a></li>
                  </ul>
                  <ul id="drop" class="right">
                    <li class="pad-right"><a class="btn-floating btn waves-effect waves-light dark-grey-deloitte"><i class="material-icons">more_horiz</i></a></li>
                    <ul id="drop-menu" class="right">
                        <li class="pad-right"><a class="btn-floating btn waves-effect waves-light green-deloitte modal-trigger" href="#modal1"><i class="material-icons">help_outline</i></a></li>
                        <li class="pad-right"><a class="btn-floating btn waves-effect waves-light bright-blue-deloitte" href="profile.html"><i class="material-icons">face</i></a></li>
                        <li class="pad-right"><a class="btn-floating btn waves-effect waves-light bright-blue-deloitte" href="dashboard_int.php"><i class="material-icons">home</i></a></li>
                        <li class="pad-right"><a class="btn-floating btn waves-effect waves-light dark-grey-deloitte" href="login.html"><i class="material-icons">exit_to_app</i></a></li>
                    </ul>
                  </ul>
                </div>
            </nav>
        </div>
        <div class="container" style="width:90%;">
            <div class="row"></div>
            <div class="row">
                <div class="col s12 m4">
                  <h5 class="bright-blue-text-deloitte" style="font-weight:300;"><span class="bright-blue-text-deloitte" style="font-weight:300;">Select a Client</h5>
                  <div class="input-field col s12">
                        <select id="client_select">
                            <option value="0" disabled selected>Choose your option</option>
                            <option value="1">General Electric</option>
                            <option value="2">Proctor &amp; Gamble</option>
                            <option value="3">Facebook</option>
                        <?php 
                          if (isset($_GET['c_id'])){
                              echo "<script>set_client(" . $id . ");</script>";
                          }
                        ?>
                        </select>
                        <label>Client</label>
                    </div>
                  <?php 

                    include ('db_conn.php');

                    if (isset($_GET['c_id'])){
                      $sql = "SELECT  `client_name` FROM `client` WHERE `client_id` = '" . $_GET['c_id'] . "'";
                      $sql2 = "SELECT `global_rel_score` FROM `assessments` WHERE `client_id` = '" . $id . "' LIMIT 1";
                      $result = $conn->query($sql);
                      $result2 = $conn->query($sql2);
                      $row = array();

                      if ($result->num_rows > 0) {
                      // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<h4 class='bright-blue-text-deloitte' style='font-weight:300;''><span class='green-text-deloitte' style='font-weight:400;'>" . $row['client_name'] . "</h4>";
                        }
                      } else {
                        header("location:dashboard_int.php");
                      } 

                      if ($result2->num_rows > 0) {
                      // output data of each row
                        while($row = $result2->fetch_assoc()) {
                          echo "<h5 class='navy-text-deloitte'>Most Recent Score: <span class='bright-blue-text-deloitte'>" . $row['global_rel_score'] . "</span></h5>"; 
                        }
                      }
                      else {
                        echo "<h5 class='navy-text-deloitte'>Most Recent Score: <span class='bright-blue-text-deloitte'>None</span></h5>"; 
                      }
                    }

                    else {
                      echo "<h4 class='bright-blue-text-deloitte' style='font-weight:300;''><span class='green-text-deloitte' style='font-weight:400;'>Client Name</h4>";
                      echo "<h5 class='navy-text-deloitte'>Most Recent Score: <span class='bright-blue-text-deloitte'>None</span></h5>"; 
                    }
                  ?>
                 
                </div>
                <div class="col s12 m4">
                    <a class="waves-effect waves-light btn-large full green-deloitte modal-trigger" href="#modal2"><i class="material-icons right">chevron_right</i>Create Assessment</a>
                    <div class="row"></div>
                    <a class="waves-effect waves-light btn-large bright-blue-deloitte right full"><i class="material-icons right">chevron_right</i>Browse Assessments</a>
                </div>
                <div class="col s12 m4">
                    <a class="waves-effect waves-light btn-large dark-grey-deloitte" id="archive"><i class="material-icons right">import_export</i>Export Report</a>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m4">
                     <div class="card grey-deloitte">
                        <div class="card-content dark-grey-text-deloitte">
                          <span class="card-title green-text-deloitte">Risk Factors</span>
                          <p style="font-weight:400;">Risk:</p>
                          <p style="font-weight:400;">Recommendation:</p>
                          <p>Here is what you should do. This section should repeat for every recommendation outputted</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m8">
                    <!-- <div class="row"></div>
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">United States</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Domain</label>
                    </div> -->
                    <div class="row"></div>
                    <div class="card white">
                        <div class="card-content dark-grey-text-deloitte">
                          <span class="card-title bright-blue-text-deloitte">Comparative Analysis</span>
                          <div id="linechart_material"></div>
                          </div>
                    </div>
                    <!-- <div class="row">
                        <div class="s6">
                            <label>Year(s)</label>
                            <form action="#">
                                <p>
                                  <input type="checkbox" id="test1" />
                                  <label for="test1">2016</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test2" />
                                  <label for="test2">2015</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test3" />
                                  <label for="test3">2014</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test4" />
                                  <label for="test4">2013</label>
                                </p>
                            </form>
                        </div>
                        <div class="s6">
                            <form action="#">
                                <p>
                                  <input type="checkbox" id="test5" />
                                  <label for="test5">2012</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test6" />
                                  <label for="test6">2011</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test7" />
                                  <label for="test7">2010</label>
                                </p>
                                <p>
                                  <input type="checkbox" id="test8" />
                                  <label for="test8">2009</label>
                                </p>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>

            <div id="modal1" class="modal bottom-sheet">
                <div class="modal-content bright-blue-text-deloitte">
                    <h4>Response Key</h4>
                    <h6 class="green-text-deloitte">0 - Not Practiced</h6>
                    <h6 class="green-text-deloitte">1 - Ad Hoc</h6>
                    <h6 class="green-text-deloitte">2 - Progressing</h6>
                    <h6 class="green-text-deloitte">3 - Mature</h6>
                    <h6 class="green-text-deloitte">4 - Innovative</h6>
                </div>
            </div> 

            <div id="modal2" class="modal">
                <div class="modal-content bright-blue-text-deloitte">
                  <div class="input-field col s12">
                        <select id="domain_select">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Healthcare</option>
                            <option value="2">Finance</option>
                            <option value="3">Consumer Goods</option>
                        </select>
                        <label>Domain</label>
                    </div>
                    <h5 class="green-text-deloitte">Upload Assessment</h5>
                    <form action="#">
                      <div class="file-field input-field">
                        <div class="btn">
                          <span>File</span>
                          <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text" placeholder="Upload assessment">
                        </div>
                      </div>
                    </form>
                    <div class="row center-align">
                        <a class="btn-floating btn-large waves-effect waves-light green-deloitte" type="submit" id="req" href="assessment.php?id=1&amp;dom_id="><i class="material-icons" style="font-size:2.6rem;">done</i></a>
                    </div>
                </div>
            </div>     

        </div>

    <!-- Compiled and minified JavaScript -->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
    </body>
    