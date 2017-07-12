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
  ins_id = document.getElementById("tdid"+id).value;
  name = document.getElementById("tdname"+id).value;
  address = document.getElementById("tdaddress"+id).value;
  email = document.getElementById("tdemail"+id).value;
  contact_no = document.getElementById("tdcontact"+id).value;
  
  url = "../model/instructor_process.php?ins_id="+ins_id+"&name="+name+"&address="+address+"&email="+email+"&contact_no="+contact_no;
  //alert(url);
  window.location.href = url;
}

function deleterec(eid){
  var res = confirm("Do you want to delete instructor "+eid+"?");
  if(res){
    window.location.href ="../model/instructor_process.php?delete=yes&insid="+eid;
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
      <li ><a href="../../student/view/student.php">STUDENT</a></li>
      <li class="active"><a href="#">INSTRUCTOR</a></li>
      <li><a href="../../class/view/class.php">CLASS</a></li>
      <li><a href="../../subject/view/subject.php">SUBJECT</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php echo($_SESSION["users"]); ?></a></li>
      <li><a href="login/controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
  </nav>

  <div class="homecontainer"> 
      <div id="divheading"><h3 id="heading"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Instructors Information</h3>
      </div>
      <button id="btnadd" class="btn btn-success" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;ADD NEW INSTRUCTOR </button>

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
        unset($_SESSION['ins']);
      }

    ?>
      <?php
        if(isset($success_error)){
            echo("<div class='alert alert-success' style='width:70%'>".$success_error."</div>"); 
          }
      ?>
      <table id="mytable" class="table table-bordred table-striped">
                   
      <thead>
        <th>Instructor ID</th>
        <th>Instructor Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Subjects</th>
        <th>Edit</th>
        <th>Delete</th>
      </thead>
      <tbody>
      <?php
          $conn = new Connection();
          $sql = "SELECT * FROM  tbl_instructor";
          $result = $conn->query($sql);
          $nor = mysqli_num_rows($result);

        if($nor>0){
          $i = 1;
          while($rec=mysqli_fetch_assoc($result)){
            echo("<tr>");
            echo("<td><input type='text' id='tdid".$i."' value='".$rec["ins_id"]."' size='10' readonly /></td>");
            echo("<td><input type='text' id='tdname".$i."' value='".$rec["ins_name"]."' size='20' readonly /></td>");
            echo("<td><input type='text' id='tdaddress".$i."' value='".$rec["address"]."' size='15' readonly /></td>");
            echo("<td><input type='text' id='tdemail".$i."' value='".$rec["email"]."' size='20' readonly /></td>");
            echo("<td><input type='text' id='tdcontact".$i."' value='".$rec["contact_no"]."' size='15' readonly /></td>");
            $ins_id = $rec["ins_id"];
            $sql_sub = "SELECT * FROM  tbl_subject where ins_id='$ins_id'";
            $result_sub = $conn->query($sql_sub);
            echo("<td>");
            while($rec1=mysqli_fetch_assoc($result_sub)){
                echo("<input type='text' id='' value='".$rec1["sub_name"]."' size='20' readonly /><br/>");
            }
            echo("</td>");
            echo("<td><a id='btnedit".$i."' href='javascript:void(0);' onclick='editrecord(\"$i\");'><span class='glyphicon glyphicon-pencil'></span></a><a style='display:none' id='btnupdate".$i."' href='javascript:void(0);' onclick='updaterecord(\"$i\");'><span class='glyphicon glyphicon-edit'></span></a></td>");
            echo("<td id='btndelete'><a href='javascript:void(0);' onclick='deleterec(\"".$rec["ins_id"]."\")'><span class='glyphicon glyphicon-remove-circle'></span></a></td>");
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
              <h4 class="modal-title custom_align" id="Heading">Add New Instructor</h4>
          </div>
          <form id="frmadd" method="post" action="../controller/instructor.php">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control " type="text" name="txtname" id="txtname" placeholder="Instructor Name" value="<?php if(isset($_SESSION['ins']['txtname'])) echo($_SESSION['ins']['txtname']); ?>">
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
              <textarea rows="2" class="form-control" name="txtaddress" id="txtaddress"  placeholder="Address"><?php if(isset($_SESSION['ins']['txtaddress'])) echo($_SESSION['ins']['txtaddress']); ?></textarea>
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
              <input class="form-control " type="text" name="txtemail" id="txtemail"  placeholder="Email" value="<?php if(isset($_SESSION['ins']['txtemail'])) echo($_SESSION['ins']['txtemail']); ?>">
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
              <input class="form-control " type="text" name="txtcontact" id="txtcontact"  placeholder="Contact" value="<?php if(isset($_SESSION['ins']['txtcontact'])) echo($_SESSION['ins']['txtcontact']); ?>">
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
            <button type="submit" class="btn btn-primary" id="btnaddinstructor" name="btnaddinstructor"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Add</button>
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