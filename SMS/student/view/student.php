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
  document.getElementById("tdname"+id).readOnly = false;
  document.getElementById("tdaddress"+id).readOnly = false;
  document.getElementById("tdemail"+id).readOnly = false;
  document.getElementById("tdcontact"+id).readOnly = false;

  document.getElementById("tdid"+id).style.background="#F0E6FA";
  document.getElementById("tdname"+id).style.background="#F0E6FA";
  document.getElementById("tdaddress"+id).style.background="#F0E6FA";
  document.getElementById("tdemail"+id).style.background="#F0E6FA";
  document.getElementById("tdcontact"+id).style.background="#F0E6FA";

  document.getElementById("btnedit"+id).style.display = "none";
  document.getElementById("btnupdate"+id).style.display = "block";
  if(lastid!=0){
    document.getElementById("tdid"+lastid).readOnly = true;
    document.getElementById("tdname"+lastid).readOnly = true;
    document.getElementById("tdaddress"+lastid).readOnly = true;
    document.getElementById("tdemail"+lastid).readOnly = true;
    document.getElementById("tdcontact"+lastid).readOnly = true;

    document.getElementById("tdid"+lastid).style.background="#D1B2F0";
    document.getElementById("tdname"+lastid).style.background="#D1B2F0";
    document.getElementById("tdaddress"+lastid).style.background="#D1B2F0";
    document.getElementById("tdemail"+lastid).style.background="#D1B2F0";
    document.getElementById("tdcontact"+lastid).style.background="#D1B2F0";

    document.getElementById("btnedit"+lastid).style.display = "block";
    document.getElementById("btnupdate"+lastid).style.display = "none";
  }
  lastid = id;
}

function updaterecord(id){
  std_id = document.getElementById("tdid"+id).value;
  name = document.getElementById("tdname"+id).value;
  address = document.getElementById("tdaddress"+id).value;
  email = document.getElementById("tdemail"+id).value;
  contact_no = document.getElementById("tdcontact"+id).value;
  ins = document.getElementById("tdinss"+id).value;
  
  url = "../model/student_process.php?std_id="+std_id+"&name="+name+"&address="+address+"&email="+email+"&contact_no="+contact_no+"&ins="+ins;
  //alert(url);
  window.location.href = url;
}

function deleterec(eid){
  var res = confirm("Do you want to delete student "+eid+"?");
  if(res){
    window.location.href ="../model/student_process.php?delete=yes&stdid="+eid;
  }
}
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
      <li class="active"><a href="#">STUDENT</a></li>
      <li><a href="../../instructor/view/instructor.php">INSTRUCTOR</a></li>
      <li><a href="../../class/view/class.php">CLASS</a></li>
      <li><a href="../../subject/view/subject.php">SUBJECT</a></li>
     

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php echo($_SESSION["users"]); ?></a></li>
      <li><a href="../../login/controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
  </nav>

  <div class="homecontainer"> 
      <div id="divheading"><h3 id="heading"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Students Information</h3>
      </div>
      <button id="btnadd" class="btn btn-success" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;ADD NEW STUDENT </button>

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
          if($error=='name'){
              $name_error="Please Enter Valid Name"; 
          } 
          else if($error=='address'){
              $address_error="Please Enter Address";
          }
          else if($error=='email'){
              $email_error="Please Enter Valid Email";
          }
          else if($error=='contact'){
              $contact_error="Please Enter Valid Contact No";
          }
          else if($error=='success'){
              $success_error="Successfully Inserted";
          }

        }
      else{
        unset($_SESSION['std']);
      }

    ?>
      <?php
        if(isset($success_error)){
            echo("<div class='alert alert-success' style='width:70%'>".$success_error."</div>"); 
          }
      ?>
      <table id="mytable" class="table table-bordred table-striped">
                   
      <thead>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Class Code</th>
        <th>Edit</th>
        <th>Delete</th>
      </thead>
      <tbody>
      <?php
          $conn = new Connection();
          $sql = "SELECT * FROM  tbl_student";
          $result = $conn->query($sql);
          $nor = mysqli_num_rows($result);

        if($nor>0){
          $i = 1;
          while($rec=mysqli_fetch_assoc($result)){
            echo("<tr>");
            echo("<td><input type='text' id='tdid".$i."' value='".$rec["std_id"]."' size='10' readonly /></td>");
            echo("<td><input type='text' id='tdname".$i."' value='".$rec["std_name"]."' size='20' readonly /></td>");
            echo("<td><input type='text' id='tdaddress".$i."' value='".$rec["addess"]."' size='15' readonly /></td>");
            echo("<td><input type='text' id='tdemail".$i."' value='".$rec["email"]."' size='20' readonly /></td>");
            echo("<td><input type='text' id='tdcontact".$i."' value='".$rec["contact_no"]."' size='15' readonly /></td>");
            echo("<td id='insselect".$i."'><input type='text' id='tdins".$i."' value='".$rec["class_id"]."' size='15' readonly /></td>");
            $conn = new Connection();
              $sql_ins1 = "SELECT * FROM  tbl_class";
              $result_ins1 = $conn->query($sql_ins1);
              echo('<td id="inslist'.$i.'" style="display:none;">'); 
              echo('<select name="txtclass" id="tdinss'.$i.'">'); 
         
                      while ($rowins = mysqli_fetch_array($result_ins1)) {
                          echo "<option value='" . $rowins['cls_code'] ."'>" . $rowins['cls_code'] ."</option>";
                      }
                 
              echo('</select></td>');

            echo("<td><a id='btnedit".$i."' href='javascript:void(0);' onclick='editrecord(\"$i\");'><span class='glyphicon glyphicon-pencil'></span></a><a style='display:none' id='btnupdate".$i."' href='javascript:void(0);' onclick='updaterecord(\"$i\");'><span class='glyphicon glyphicon-edit'></span></a></td>");
            echo("<td id='btndelete'><a href='javascript:void(0);' onclick='deleterec(\"".$rec["std_id"]."\")'><span class='glyphicon glyphicon-remove-circle'></span></a></td>");
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

    
    


    <!--Add new student-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Add New Student</h4>
          </div>
          <form id="frmadd" method="post" action="../controller/student.php">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control " type="text" name="txtname" id="txtname" placeholder="Student Name" value="<?php if(isset($_SESSION['std']['txtname'])) echo($_SESSION['std']['txtname']); ?>">
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
            <div class="form-group">
              <textarea rows="2" class="form-control" name="txtaddress" id="txtaddress"  placeholder="Address"><?php if(isset($_SESSION['std']['txtaddress'])) echo($_SESSION['std']['txtaddress']); ?></textarea>
              <?php if(isset($address_error)){?>
                      <div class="alert alert-danger">
              <?php if(isset($address_error)) echo($address_error); ?>
              </div> 
              <script>
                  $(document).ready(function(){
                  $('#add').modal({show: true});
                  });
              </script>
              <?php } ?>

            </div>
            <div class="form-group">
              <input class="form-control " type="text" name="txtemail" id="txtemail"  placeholder="Email" value="<?php if(isset($_SESSION['std']['txtemail'])) echo($_SESSION['std']['txtemail']); ?>">
              <?php if(isset($email_error)){?>
                      <div class="alert alert-danger">
              <?php if(isset($email_error)) echo($email_error); ?>
              </div> 
              <script>
                  $(document).ready(function(){
                  $('#add').modal({show: true});
                  });
              </script>
              <?php } ?>

            </div>
            <div class="form-group">
              <input class="form-control " type="text" name="txtcontact" id="txtcontact"  placeholder="Contact" value="<?php if(isset($_SESSION['std']['txtcontact'])) echo($_SESSION['std']['txtcontact']); ?>">
              <?php if(isset($contact_error)){?>
                      <div class="alert alert-danger">
              <?php if(isset($contact_error)) echo($contact_error); ?>
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
              $sql_cls = "SELECT * FROM  tbl_class";
              $result_cls = $conn->query($sql_cls);
            ?>


            <div class="form-group">
            <label>Class : </label>
              <select name="txtclass" id="txtclass" class="form-control">
                  <?php
                      while ($row = mysqli_fetch_array($result_cls)) {
                          echo "<option value='" . $row['cls_code'] ."'>" . $row['cls_code'] ."</option>";
                      }
                  ?>

              </select>

            </div>


          </div>
          <div class="modal-footer ">
                <script>
                function formReset(){
                    $("#txtname").val('');
                    $("#txtaddress").val('');
                    $("#txtemail").val('');
                    $("#txtcontact").val('');
                    $('#add').modal({show: true});
                }
                </script>
            <button type="submit" class="btn btn-primary" id="btnaddstudent" name="btnaddstudent"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Add</button>
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