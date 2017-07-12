<?php
session_start();
require_once '../../db/connection.php';
if(isset($_SESSION["users"])){


?>

<html>
<head>
  <link href="../../css/style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


 <script type="text/javascript">
lastid=0;
function editrecord(id){

   document.getElementById("insselect"+id).style.display = "none";
  document.getElementById("inslist"+id).style.display = "block";

  //document.getElementById("txtid"+id).readOnly = false;
  document.getElementById("tdcode"+id).readOnly = false;
  document.getElementById("tdname"+id).readOnly = false;
  document.getElementById("tdins"+id).readOnly = false;

  document.getElementById("tdid"+id).style.background="#F0E6FA";
  document.getElementById("tdcode"+id).style.background="#F0E6FA";
  document.getElementById("tdname"+id).style.background="#F0E6FA";
  document.getElementById("tdins"+id).style.background="#F0E6FA";
  

  document.getElementById("btnedit"+id).style.display = "none";
  document.getElementById("btnupdate"+id).style.display = "block";
  if(lastid!=0){
    document.getElementById("tdid"+lastid).readOnly = true;
    document.getElementById("tdcode"+lastid).readOnly = true;
    document.getElementById("tdname"+lastid).readOnly = true;
    document.getElementById("tdins"+lastid).readOnly = true;

    document.getElementById("tdid"+lastid).style.background="#D1B2F0";
    document.getElementById("tdcode"+lastid).style.background="#D1B2F0";
    document.getElementById("tdname"+lastid).style.background="#D1B2F0";
    document.getElementById("tdins"+lastid).style.background="#D1B2F0";
    
    document.getElementById("btnedit"+lastid).style.display = "block";
    document.getElementById("btnupdate"+lastid).style.display = "none";
  }
  lastid = id;
}

function updaterecord(id){

  cls_id = document.getElementById("tdid"+id).value;
  code = document.getElementById("tdcode"+id).value;
  name = document.getElementById("tdname"+id).value;
  subjects = document.getElementById("tdinss"+id).value;
  
  url = "../model/class_process.php?cls_id="+cls_id+"&code="+code+"&name="+name+"&subjects="+subjects;
  //alert(url);
  window.location.href = url;
}

function deleterec(eid,clscode){
  var res = confirm("Do you want to delete class "+eid+"?");
  if(res){
    window.location.href ="../model/class_process.php?delete=yes&clsid="+eid+"&code="+clscode;
  }
}

$( document ).ready(function() {
   // $('#inslist').hide();
});


</script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="../../images/sms.png"/></a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="../../home.php">Home</a></li>
      <li ><a href="../../student/view/student.php">STUDENT</a></li>
      <li ><a href="../../instructor/view/instructor.php">INSTRUCTOR</a></li>
      <li class="active"><a href="#">CLASS</a></li>
      <li><a href="../../subject/view/subject.php">SUBJECT</a></li>
      

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php echo($_SESSION["users"]); ?></a></li>
      <li><a href="login/controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
  </nav>

  <div class="homecontainer"> 
      <div id="divheading"><h3 id="heading"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Class Information</h3>
      </div>
      <button id="btnadd" class="btn btn-success" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;ADD NEW CLASS</button>

      <?php
        if(isset($_GET["msg"])){
          if($_GET["msg"]==1){
            echo("<div class='alert alert-success' style='width:70%'>Successfully updated</div>"); 
          }
          if($_GET["msg"]==2){
            echo("<div class='alert alert-success' style='width:70%'>Successfully Deleted</div>"); 
          }
        }
      ?>

      <?php
      if(isset($_GET['error'])){
          $error=$_GET['error'];
          if($error=='code'){
              $code_error="Please Enter Class Code"; 
          } 
          else if($error=='name'){
              $name_error="Please Enter Class Name";
          }
          
          else if($error=='success'){
              $success_error="Successfully Inserted";
          }

        }
      else{
        unset($_SESSION['sub']);
      }

    ?>
      <?php
        if(isset($success_error)){
            echo("<div class='alert alert-success' style='width:70%'>".$success_error."</div>"); 
          }
      ?>
      <table id="mytable" class="table table-bordred table-striped">
                   
      <thead>
        <th>Class ID</th>
        <th>Class Code</th>
        <th>Class Name</th>
        <th>Subjects</th>
        <th>Edit</th>
        <th>Delete</th>
      </thead>
      <tbody>
      <?php
          $conn = new Connection();
          $sql = "SELECT * FROM  tbl_class";
          $result = $conn->query($sql);
          $nor = mysqli_num_rows($result);

        if($nor>0){
          $i = 1;
          while($rec=mysqli_fetch_assoc($result)){
            echo("<tr>");
            echo("<td><input type='text' id='tdid".$i."' value='".$rec["cls_id"]."' size='10' readonly /></td>");
            echo("<td><input type='text' id='tdcode".$i."' value='".$rec["cls_code"]."' size='20' readonly /></td>");
            echo("<td><input type='text' id='tdname".$i."' value='".$rec["cls_name"]."' size='15' readonly /></td>");
            $cls_id = $rec["cls_code"];
            $sql_cls = "SELECT sub_id FROM  tbl_class_subjects where cls_id='$cls_id'";
            $result_cls = $conn->query($sql_cls);
            echo("<td id='insselect".$i."'>");
            while($rec1=mysqli_fetch_assoc($result_cls)){
              $sub_id = $rec1["sub_id"];
              $sql_sub = "SELECT sub_name FROM  tbl_subject where sub_id='$sub_id'";
              $result_sub = $conn->query($sql_sub);
              while($rec2=mysqli_fetch_assoc($result_sub)){
                echo("<input type='text' id='tdins".$i."' value='".$rec2["sub_name"]."' size='20' readonly /><br/>");
              }
              
            }
            echo("</td>");


              $conn = new Connection();
              $sql_sub2 = "SELECT * FROM  tbl_subject";
              $result_sub2 = $conn->query($sql_sub2);
                echo("<td id='inslist".$i."' style='display:none;'>");
                while ($rec3 = mysqli_fetch_array($result_sub2)) {
                    echo('<input type="checkbox" name="subjects[]" id="tdinss'.$i.'" value="'.$rec3["sub_id"].'">');
                    echo(" ".$rec3["sub_name"]."  ");      
                }
                 
              echo('</td>');
   
            
            echo("<td><a id='btnedit".$i."' href='javascript:void(0);' onclick='editrecord(\"$i\");'><span class='glyphicon glyphicon-pencil'></span></a><a style='display:none' id='btnupdate".$i."' href='javascript:void(0);' onclick='updaterecord(\"$i\");'><span class='glyphicon glyphicon-edit'></span></a></td>");
            echo("<td id='btndelete'><a href='javascript:void(0);' onclick='deleterec(\"".$rec["cls_id"]."\",\"".$rec["cls_code"]."\")'><span class='glyphicon glyphicon-remove-circle'></span></a></td>");
            echo ("</tr>");    
          $i++;
          }
         
        }
        else{
          echo("No records found");
        }
      ?> 
    </tbody>
    </table>

    
    


    <!--Add new instructor-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Add New Class</h4>
          </div>
          <form id="frmadd" method="post" action="../controller/class.php">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control " type="text" name="txtcode" id="txtcode" placeholder="Class Code" value="<?php if(isset($_SESSION['cls']['txtcode'])) echo($_SESSION['cls']['txtcode']); ?>">
                    <?php if(isset($code_error)){?>
                      <div class="alert alert-danger">
                    <?php if(isset($code_error)) echo($code_error); ?>
                      </div> 
                <script>
                  $(document).ready(function(){
                  $('#add').modal({show: true});
                  });
                </script>
                    <?php } ?>
            </div>
            <div class="form-group">
              <input class="form-control " type="text" name="txtname" id="txtname" placeholder="Class Name" value="<?php if(isset($_SESSION['cls']['txtname'])) echo($_SESSION['cls']['txtname']); ?>">
                    <?php if(isset($name_error)){?>
                      <div class="alert alert-danger">
                    <?php if(isset($name_error)) echo($name_error); ?>
                      </div> 
                <script>
                  $(document).ready(function(){
                  $('#add').modal({show: true});
                  });
                </script>
                    <?php } ?>

            </div>

            <?php
              $conn = new Connection();
              $sql = "SELECT * FROM  tbl_subject";
              $result = $conn->query($sql);
            ?>


            <div class="form-group">
            <label>Subjects : </label>
              
                  <?php
                      while ($row = mysqli_fetch_array($result)) {
                          echo('<input type="checkbox" name="subjects[]" value="'.$row["sub_id"].'">');
                          echo(" ".$row["sub_name"]."  ");      
                      }
                  ?>

            </div>
            
          </div>
          <div class="modal-footer ">
                <script>
                function formReset(){
                    $("#txtcode").val('');
                    $("#txtname").val('');
                    $('#add').modal({show: true});
                }
                </script>
            <button type="submit" class="btn btn-primary" id="btnaddclass" name="btnaddclass"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Add</button>
            <button id="btnreset" type="button" class="btn btn-danger" onclick="formReset();"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Reset</button>
          </div>
          </form>
    </div> 
    </div>
    </div>


  </div>

  </body>

  </html>

  <?php
    }

    else{
        header("location:../../index.php?err=2");
    }
  ?>