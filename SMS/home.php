<?php
session_start();
if(isset($_SESSION["users"])){


?>

<html>
<head>
  <link href="css/style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="images/sms.png"/></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="student/view/student.php">STUDENT</a></li>
      <li><a href="instructor/view/instructor.php">INSTRUCTOR</a></li>
      <li><a href="class/view/class.php">CLASS</a></li>
      <li><a href="subject/view/subject.php">SUBJECT</a></li>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php echo($_SESSION["users"]); ?></a></li>
      <li><a href="login/controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
  </nav>

  <div class="homecontainer">
        <div id="home-panel-left">
        <table border="1" width="100%">
            <tr align="center">
                <td>
                <img src="images/student.png"/> <br/>
                <a href="student/view/student.php" class="btn btn-primary btn-lg">STUDENT </a><br/><br/>
                </td>
            </tr>
        </table>
        </div>
        <div id="home-panel-middle">
        <table border="1" width="100%">
            <tr align="center">
                <td>
                <img src="images/instructor.png"/> <br/>
                <a href="instructor/view/instructor.php" class="btn btn-info btn-lg">INSTRUCTOR </a><br/><br/>
                </td>
            </tr>
        </table>
        </div>
        <div id="home-panel-middle2">
        <table border="1" width="100%">
            <tr align="center">
                <td>
                <img src="images/class.png" /> <br/>
                <a href="class/view/class.php" class="btn btn-success btn-lg">CLASS </a><br/><br/>
                </td>
            </tr>
        </table>
        </div>
        <div id="home-panel-right">
        <table border="1" width="100%">
            <tr align="center">
                <td>
                <img src="images/subject.png"/> <br/>
                <a href="subject/view/subject.php" class="btn btn-warning btn-lg">SUBJECT </a><br/><br/>
                </td>
            </tr>
        </table>
        </div>
  </div>
  </body>

  </html>

  <?php
    }

    else{
        header("location:index.php?err=2");
    }
  ?>

