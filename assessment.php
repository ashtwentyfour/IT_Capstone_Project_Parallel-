<!DOCTYPE html>
<html lang="en" style = "visibility:visible;">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>Deloitte Consulting: Maturity Assessment</title>

        <link href="css/app.css" type="text/css" rel="stylesheet"/>
        <link href="materialize/css/materialize.css" type="text/css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

<?php

  $id = $_GET['id'];
  $dom_id = $_GET['dom_id'];
  $c_id = $_GET['c_id'];

  include ('db_conn.php');

  $loc = "SELECT `client_location` FROM `client` WHERE `client_id` = '" . $id . "'";
  $result_loc = $conn->query($loc);
  $ind = "SELECT `client_industry` FROM `client` WHERE `client_id` = '" . $id . "'";
  $result_ind = $conn->query($ind);

  $sql = "SELECT  `question_text` FROM `questions` where `question_number` = '" . $id . "' AND `domain_id` ='" . $dom_id . "'";
  $result = $conn->query($sql);
  $row = array();


  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      $question =  $row["question_text"];
    }
  } else {

    /** call Java **/

    $PATH="/System/Library/Java/JavaVirtualMachines/1.6.0.jdk/Contents/Home";

    echo shell_exec("javac jsrc/Driver.java jsrc/Calculation.java jsrc/Client.java jsrc/Scoring.java  2>&1");//shows # of errors

    $output = shell_exec("java -cp jsrc Driver $loc $ind 2>&1");//this line executes it
    echo $output;

    //header("location: /dashboard_int.php?c_id=" . $c_id . "");
    echo '<script>window.location = "dashboard_int.php?c_id=' . $c_id . '";</script>';

  }

  $sql = "SELECT  `domain_name` FROM `domain` where `domain_id` ='" . $dom_id . "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      $dom_name =  $row["domain_name"];
    }
  } else {
    header("location:dashboard_int.php");
  }

  //close connection
  $conn->close();
?>

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
          <h4 class="green-text-deloitte center">Cybersecurity Maturity Assessment</h4>
          <div class="row">
            <!-- <div class="col s12">
              <h6 class=" grey-text right">Page: 1 / 10</h6>
            </div> -->
            <div class="col s12 grey-deloitte z-depth-1 grey-text darken-4">
              <?php echo "<h5 class='navy-text-deloitte' style='font-weight:600;'>" . $dom_name . "</h5>" ?>
              <div class="col s11 offset-s1">
                <?php echo "<h5 class='navy-text-deloitte' style='font-weight:300;'>Question " . $id . ": <span class='bright-blue-text-deloitte'>" . $question . "</span></h5>" ?>
                <div class="row">
                  <div class="col s10 offset-s1">
                    <?php echo "<form id='assessment-q' action='post.php?id=" . $id . "&dom_id=" . $dom_id . "&c_id=" . $c_id . " ' method='post'>" ?>
                      <table>
                        <tbody>
                          <tr>
                            <td>0</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                          </tr>
                          
                            <tr>
                              <td>
                                  <p>
                                    <input name="score" type="radio" id="score0" value="0"/>
                                    <label for="score0"> </label>
                                  </p>
                              </td>
                              <td>
                                  <p>
                                    <input name="score" type="radio" id="score1" value="1"/>
                                    <label for="score1"> </label>
                                  </p>
                              </td>
                              <td>
                                  <p>
                                    <input name="score" type="radio" id="score2" value="2"/>
                                    <label for="score2"> </label>
                                  </p>
                              </td>
                              <td>
                                  <p>
                                    <input name="score" type="radio" id="score3" value="3"/>
                                    <label for="score3"> </label>
                                  </p>
                              </td>
                              <td>
                                  <p>
                                    <input name="score" type="radio" id="score4" value="4"/>
                                    <label for="score4"> </label>
                                  </p>
                              </td>
                            </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="input-field col s11">
                          <textarea id="textarea1" name="comments" class="materialize-textarea"></textarea>
                          <label for="textarea1">Comments</label>
                        </div>
                      </div>
                      <div class="row center-align">
<!--                         <button class="btn-floating btn-large waves-effect waves-light green-deloitte disabled" type="submit" name="prev" id="q-prev"><i class="material-icons" style="font-size:3.6rem;">chevron_left</i>
                        </button>
 -->                        <button class="btn-floating btn-large waves-effect waves-light green-deloitte" type="submit" name="next" id="q-sub" disabled><i class="material-icons right" style="font-size:3.6rem;">chevron_right</i>
                        </button>
                      </div>
                    </form>
                  </div>
                </row>
              </div>
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

        </div>

    <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
    </body>
    