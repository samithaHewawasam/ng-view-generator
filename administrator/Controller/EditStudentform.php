 <?php
session_start();
$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator    = $_SESSION['Sys_U_Name'];
$Today          = date('Y-m-d');
include("../../Modal/config.php");
$esoftConfig = new PDO("mysql:host=127.0.0.1;dbname=" . DATABASE, USERNAME, PASSWORD);

include("../Modal/arrays.php");
if (!empty($_POST['StudentCode'])) {
    $StudentCode = trim($_POST['StudentCode']);
    $str         = "SELECT `student_master`.*  FROM `student_master` WHERE `SM_ID` LIKE ? LIMIT 1";
    $STH         = $esoftConfig->prepare($str);
    $STH->execute(array(
        $StudentCode
    ));
    $result = $STH->fetchAll(PDO::FETCH_ASSOC);
    if ($STH->rowCount()) {
        foreach ($result as $row) {
            $SM_ID_Type       = $row['SM_ID_Type'];
            $SM_ID            = $row['SM_ID'];
            $SM_Branch_Code   = $row['SM_Branch_Code'];
            $SM_Title         = $row['SM_Title'];
            $SM_Initials      = $row['SM_Initials'];
            $SM_First_Name    = $row['SM_First_Name'];
            $SM_Last_Name     = $row['SM_Last_Name'];
            $SM_Full_Name     = $row['SM_Full_Name'];
            $SM_Gender        = $row['SM_Gender'];
            $SM_Date_of_Birth = null;
            if ($row['SM_Date_of_Birth'] != 0) {
                $SM_Date_of_Birth = $row['SM_Date_of_Birth'];
            }
            $SM_House_NO = $row['SM_House_NO'];
            $SM_Lane     = $row['SM_Lane'];
            $SM_Town     = $row['SM_Town'];
            $SM_City     = $row['SM_City'];
            $SM_Country  = 'Srilanka';
            if ($row['SM_Country'] != '') {
                $SM_Country = $row['SM_Country'];
            }
            $SM_Postal_Code   = $row['SM_Postal_Code'];
            $SM_Tel_Residance = $row['SM_Tel_Residance'];
            $SM_Tell_Work     = $row['SM_Tell_Work'];
            $SM_Tell_Mobile   = str_replace('-', '', $row['SM_Tell_Mobile']);
            $SM_Mail_Personal = $row['SM_Mail_Personal'];
            $SM_Mail_Work     = $row['SM_Mail_Work'];
            $SM_Use_Parent_ID = $row['SM_Use_Parent_ID'];
            $SM_Parent_Name   = $row['SM_Parent_Name'];
            $SM_Parent_Phone  = $row['SM_Parent_Phone'];
            $SM_Status        = $row['SM_Status'];
            $SM_Source        = $row['SM_Source'];
            $SM_Operator      = $row['SM_Operator'];
            $SM_Reg_Date      = $row['SM_Reg_Date'];
            
            
            
?>
   
    <div class="modal-body well">
 <div class="row"><!--row start-->
    <div class="span8"><!--span start-->
    <form  method="post" class="form-horizontal" id="EditStudentMasterForm" accept-charset="utf-8"><!--Student form start-->
<input type="hidden" name="Old_SM_ID" value="<?php
            echo $SM_ID;
?>" >
 <input type="hidden"  value="UpdateStudentMaster" name="UpdateStudentMaster" >
   <input type="hidden" id="SM_Operator" value="" name="SM_Operator" >
   <input type="hidden" id="SM_Branch_Code" value="" name="SM_Branch_Code" >
  
  
    
    
  
    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">    
    ID Type:
    </label>
    <div class="controls">
    <select class="input-medium"  name="SM_ID_Type">

                <option value="NIC">
                  NIC
                </option>

                <option value="Postal_ID">
                  Postal ID
                </option>

                <option value="Passport_Number">
                  Passport Number
                </option>
                
                <option selected="selected" value="<?php
            echo $SM_ID_Type;
?>">
                 <?php
            echo $SM_ID_Type;
?>
               </option>
              </select>
    </div>
    </div>
  
    <div class="control-group">
    <label for="idNumber" class="control-label">    
    ID Number:
    </label>
    <div class="controls"><input type="text"   class="form-control" name="SM_ID" value="<?php
            echo $SM_ID;
?>" >
    </div>
    </div>
    
    <div class="control-group">
    <label for="SM_Title" class="control-label">    
     Title:
    </label>
    <div class="controls"><select class="input-medium"  name="SM_Title">

                <option value="Rev">
                  Rev
                </option>

                <option value="Dr">
                  Dr
                </option>

                <option value="Mr">
                  Mr
                </option>

                <option value="Mrs">
                  Mrs
                </option>

                <option value="Miss">
                  Miss
                </option>
                
                <option value="<?php
            echo $SM_Title;
?>" selected="selected">
                 <?php
            echo $SM_Title;
?>
               </option>
              </select>
    </div>
    </div>
    
    <div class="control-group hide">
        <label for="SM_Initials" class="control-label">Initials: </label>
    <div class="controls"><input  class="form-control input-medium" name="SM_Initials" value="<?php
            echo $SM_Initials;
?>"
              type="hidden">
  
    </div>
    </div>
  <div class="control-group hide">
  <label for="SM_Full_Name" class="control-label">Full Name:</label>
    <div class="controls">
      <input type="hidden" class="form-control input-xxlarge" name="SM_Full_Name" value="<?php
            echo $SM_Full_Name;
?>" placeholder="John Smith Elisabeth Francisco">
    </div>
  </div>
  <div class="control-group">
   <label for="SM_First_Name" class="control-label">First Name:</label>
    <div class="controls">
      <input type="text" class="form-control" value="<?php
            echo $SM_First_Name;
?>"  name="SM_First_Name" placeholder="First Name">
    </div>
  </div>
 <div class="control-group">
  <label for="SM_Last_Name" class="control-label">Last Name:</label>
    <div class="controls">
      <input type="text" class="form-control"  value="<?php
            echo $SM_Last_Name;
?>" name="SM_Last_Name" placeholder="Last Name">
    </div>
  </div>

 <div class="control-group">
  <label for="SM_Gender" class="control-label"> Sex:</label>
    <div class="controls">
      <select class="selectpicker input-small"  name="SM_Gender">

                <option value="male">
                  Male
                </option>

               <option value="female">
                 Female
                </option>
                 <option selected="selected" value="<?php
            echo $SM_Gender;
?>">
                 <?php
            echo $SM_Gender;
?>
               </option>
              </select>
    </div>
  </div>


 <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label">Date Of Birth:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" name="SM_Date_of_Birth"  value="<?php
            echo $SM_Date_of_Birth;
?>" size="16" type="text" placeholder="yyyy-mm-dd" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>



<h3>ADDRESS</h3><hr>
 <div class="control-group">
  <label for="SM_Address_1" class="control-label">House No:</label>
    <div class="controls">
      <input type="text" class="form-control input-small" value="<?php
            echo $SM_House_NO;
?>"  name="SM_House_NO" placeholder="211/A">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Address_2" class="control-label">Lane:</label>
    <div class="controls">
      <input type="text" class="form-control"  value="<?php
            echo $SM_Lane;
?>" name="SM_Lane" placeholder="1st Lane">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Address_3" class="control-label">Town:</label>
    <div class="controls">
      <input type="text" class="form-control" value="<?php
            echo $SM_Town;
?>" name="SM_Town" placeholder="Bambalapitiya">
    </div>
  </div>

<div class="control-group">
 <label for="SM_City" class="control-label">City:</label>
    <div class="controls">
      <input type="text" class="form-control" value="<?php
            echo $SM_City;
?>" id="SM_City" name="SM_City" placeholder="Colombo">
    </div>
  </div>

    <div class="control-group">
<label for="country" class="control-label">    
Country
</label>
<div class="controls">
<select name="SM_Country" >
<option selected="selected" value="<?php
            echo $SM_Country;
?>"><?php
            echo $SM_Country;
?></option>
<option value="Srilanka">Srilanka</option>
<option value="AR">Argentina</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BR">Brazil</option>
<option value="BG">Bulgaria</option>
<option value="CA">Canada</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CO">Colombia</option>
<option value="CR">Costa Rica</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DO">Dominican Republic</option>
<option value="EG">Egypt</option>
<option value="EE">Estonia</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="HK">Hong Kong S.A.R., China</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="KZ">Kazakhstan</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Laos</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MK">Macedonia</option>
<option value="MY">Malaysia</option>
<option value="MT">Malta</option>
<option value="MX">Mexico</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="ME">Montenegro</option>
<option value="MA">Morocco</option>
<option value="NL">Netherlands</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="KP">North Korea</option>
<option value="NO">Norway</option>
<option value="PK">Pakistan</option>
<option value="PS">Palestinian Territory</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RO">Romania</option>
<option value="RU">Russia</option>
<option value="SA">Saudi Arabia</option>
<option value="RS">Serbia</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="ZA">South Africa</option>
<option value="KR">South Korea</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="TW">Taiwan</option>
<option value="TH">Thailand</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">USA</option>
<option value="UZ">Uzbekistan</option>
<option value="VN">Vietnam</option>
</select>
</div>
</div>
 

<div class="control-group">
 <label for="SM_Postal_Code" class="control-label">Postal Code:</label>
    <div class="controls">
      <input type="text" class="form-control input-small"  value="<?php
            echo $SM_Postal_Code;
?>" name="SM_Postal_Code" placeholder="11126">
    </div>
  </div>
    
<h3>CONTACT DETAILS</h3><hr>

<div class="control-group">
 <label for="SM_Tel_Residance" class="control-label">Phone Home:</label>
    <div class="controls">
      <input type="text" class="form-control"  value="<?php
            echo $SM_Tel_Residance;
?>" name="SM_Tel_Residance" placeholder="Phone Home">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Tell_Work" class="control-label">Phone Work:</label>
    <div class="controls">
      <input type="text" class="form-control" value="<?php
            echo $SM_Tell_Work;
?>"  name="SM_Tell_Work" placeholder="Phone Work">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Tell_Mobile" class="control-label">Mobile:</label>
    <div class="controls">
      <input type="text" class="form-control" value="<?php
            echo $SM_Tell_Mobile;
?>" name="SM_Tell_Mobile" placeholder="Mobile">
    </div>
  </div>
  
  <div class="control-group">
  <label for="SM_Gender" class="control-label"> How did you know about us?</label>
    <div class="controls">
      <select class="selectpicker" id="SM_Source" name="SM_Source" value="<?php
            echo $SM_Source;
?>">
              <option value="<?php
            echo $SM_Source;
?>">
                 <?php
            echo $SM_Source;
?>
               </option>
                <option value="News Paper Ad">
                  News Paper Ad
                </option>
               <option value="Press Article">
                 Press Article
                </option>
               <option value="Seminar/Event">
                 Seminar/Event
                </option>
               <option value="Exhibition">
                 Exhibition
                </option>
               <option value="School Presentation">
                 School Presentation
                </option>
               <option value="Invitation">
                 Invitation
                </option>
               <option value="World of mouth">
                 Word of mouth
                </option>
               <option value="Telemarketing">
                 Telemarketing
                </option>
               <option value="Referral Scheme">
                 Referral Scheme
                </option>
               <option value="Agent">
                 Agent
                </option>
               <option value="Web/E-mail">
                 Web/E-mail
                </option>
                <option value="Facebook">
                Facebook
                </option>
                <option value="From Friend">
                From Friend
                </option>
              </select>
    </div>
  </div>

<div class="control-group">
 <label for="SM_Mail_Personal" class="control-label">E-Mail Personal:</label>
    <div class="controls">
      <input type="text" class="form-control"  value="<?php
            echo $SM_Mail_Personal;
?>" name="SM_Mail_Personal"  placeholder="E-Mail Personal">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Mail_Work" class="control-label">E-Mail Work:</label>
    <div class="controls">
      <input type="text" class="form-control"  value="<?php
            echo $SM_Mail_Work;
?>" name="SM_Mail_Work"  placeholder="E-Mail Work">
    </div>
  </div>

<h3>PARENT DETAILS</h3><hr>

<div class="control-group">
 <label for="SM_Use_Parent_ID" class="control-label">Parent ID:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Use_Parent_ID" value="<?php
            echo $SM_Use_Parent_ID;
?>" name="SM_Use_Parent_ID"  placeholder="Parent ID">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Parent_Name" class="control-label">Name:</label>
    <div class="controls">
      <input type="text" class="form-control" name="SM_Parent_Name" value="<?php
            echo $SM_Parent_Name;
?>" placeholder="Name">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Parent_Phone" class="control-label">Phone:</label>
    <div class="controls">
      <input type="text" class="form-control"  name="SM_Parent_Phone" value="<?php
            echo $SM_Parent_Phone;
?>"   placeholder="Phone">
    </div>
  </div>
  <hr />
<div class="control-group">
    <label for="BM_Status" class="control-label">    
   Student Status:
    </label>
    <div class="controls">
    <select name="SM_Status" >
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="<?php
            echo $SM_Status;
?>" selected="selected"><?php
            echo $SM_Status;
?></option>
    </select>
    </div>
    </div>
<div class="centerButton">
<!-- Indicates a successful or positive action -->
<input type="button" id="StudentMasterUpdate" class="btn btn-large btn-primary" value="submit" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-large">Clear</button>
</div>
      </form>
 
    </div> <!-- .span8 -->
    </div>
 
</div>






<?php
        }
    } else {
        echo '<h3>No Records Found</h3>';
        
    }
}

if (!empty($_POST['UpdateStudentMaster'])) {
    //var_dump($_POST);
    
    $Old_SM_ID        = 'zzz';
    $SM_ID_Type       = "";
    $SM_ID            = "";
    $SM_Branch_Code   = "";
    $SM_Title         = "";
    $SM_Initials      = "";
    $SM_First_Name    = "";
    $SM_Last_Name     = "";
    $SM_Full_Name     = "";
    $SM_Gender        = "";
    $SM_Date_of_Birth = "";
    $SM_House_NO      = "";
    $SM_Lane          = "";
    $SM_Town          = "";
    $SM_City          = "";
    $SM_Country       = "";
    $SM_Postal_Code   = "";
    $SM_Tel_Residance = "";
    $SM_Tell_Work     = "";
    $SM_Tell_Mobile   = "";
    $SM_Mail_Personal = "";
    $SM_Mail_Work     = "";
    $SM_Use_Parent_ID = "";
    $SM_Parent_Name   = "";
    $SM_Parent_Phone  = "";
    $SM_Source        = "";
    $SM_Status        = "";
    $SM_Operator      = "";
    $SM_Reg_Date      = "";
    if (isset($_POST['Old_SM_ID'])) {
        $Old_SM_ID = $_POST['Old_SM_ID'];
    }
    if (isset($_POST['SM_ID_Type'])) {
        $SM_ID_Type = $_POST['SM_ID_Type'];
    }
    
    if (isset($_POST['SM_ID']) && $_POST['SM_ID_Type'] != 'NIC') {
        $SM_ID = $_POST['SM_ID'];
        
    } elseif (isset($_POST['SM_ID']) && $_POST['SM_ID_Type'] == 'NIC' && strlen($_POST['SM_ID']) == 10) {
        
        $SM_ID = $_POST['SM_ID'];
    } else {
        
        echo '<h4>Please Enter valid NIC number</h4>';
        exit();
        
    }
    
    if (isset($_POST['SM_Branch_Code'])) {
        $SM_Branch_Code = $_POST['SM_Branch_Code'];
    }
    if (isset($_POST['SM_Title'])) {
        $SM_Title = ($_POST['SM_Title']);
    }
    if (isset($_POST['SM_Initials'])) {
        $SM_Initials = ($_POST['SM_Initials']);
    }
    
    
    if (!empty($_POST['SM_First_Name']) && ctype_alpha(str_replace(array(
        ' ',
        "."
    ), '', $_POST['SM_First_Name']))) {
        $SM_First_Name = $_POST['SM_First_Name'];
        
    } else {
        
        echo '<h4>Please Enter valid First Name</h4>';
        exit();
        
    }
    if (isset($_POST['SM_Last_Name']) && ctype_alpha(str_replace(array(
        ' ',
        "."
    ), '', $_POST['SM_Last_Name']))) {
        $SM_Last_Name = $_POST['SM_Last_Name'];
    } else {
        
        echo '<h4>Please Enter valid Last Name<h4>';
        exit();
        
    }
    
    
    if (isset($_POST['SM_Full_Name'])) {
        $SM_Full_Name = ($_POST['SM_Full_Name']);
    }
    if (isset($_POST['SM_Gender'])) {
        $SM_Gender = $_POST['SM_Gender'];
    }
    
    
    $getDateForBirth     = explode('-', date("Y-m-d"));
    $getDateOfBirthArray = explode('-', $_POST['SM_Date_of_Birth']);
    
    if (isset($_POST['SM_Date_of_Birth']) && (($getDateForBirth[0] - $getDateOfBirthArray[0]) >= 3)) {
        $SM_Date_of_Birth = $_POST['SM_Date_of_Birth'];
    } else {
        
        echo '<h4>Please check Student date of birth<h4>';
        exit();
        
    }
    
    
    if (isset($_POST['SM_House_NO'])) {
        $SM_House_NO = ($_POST['SM_House_NO']);
    }
    if (isset($_POST['SM_Lane'])) {
        $SM_Lane = ($_POST['SM_Lane']);
    }
    if (isset($_POST['SM_Town'])) {
        $SM_Town = $_POST['SM_Town'];
    }
    if (isset($_POST['SM_City'])) {
        $SM_City = $_POST['SM_City'];
    }
    if (isset($_POST['SM_Country'])) {
        $SM_Country = $_POST['SM_Country'];
    }
    if (isset($_POST['SM_Postal_Code'])) {
        $SM_Postal_Code = $_POST['SM_Postal_Code'];
    }
    if (isset($_POST['SM_Tel_Residance'])) {
        $SM_Tel_Residance = $_POST['SM_Tel_Residance'];
    }
    if (isset($_POST['SM_Tell_Work'])) {
        $SM_Tell_Work = $_POST['SM_Tell_Work'];
    }
    
    
    if (isset($_POST['SM_Tell_Mobile']) && strlen($_POST['SM_Tell_Mobile']) == 10 && ctype_digit($_POST['SM_Tell_Mobile'])) {
        $SM_Tell_Mobile = $_POST['SM_Tell_Mobile'];
    } else {
        
        echo '<h4>Please check the length of mobile number Or Enter only numerics<h4>';
        exit();
        
    }
    
    
    if (isset($_POST['SM_Mail_Personal'])) {
        $SM_Mail_Personal = $_POST['SM_Mail_Personal'];
    }
    if (isset($_POST['SM_Mail_Work'])) {
        $SM_Mail_Work = $_POST['SM_Mail_Work'];
    }
    if (isset($_POST['SM_Use_Parent_ID'])) {
        $SM_Use_Parent_ID = $_POST['SM_Use_Parent_ID'];
    }
    if (isset($_POST['SM_Parent_Name'])) {
        $SM_Parent_Name = ($_POST['SM_Parent_Name']);
    }
    if (!empty($_POST['SM_Source'])) {
    $SM_Source = $_POST['SM_Source'];
	}else{

	echo '<h2>Please Enter the Source</h2>';
     exit();

    }
    if (isset($_POST['SM_Parent_Phone'])) {
        $SM_Parent_Phone = $_POST['SM_Parent_Phone'];
    }
    if (isset($_POST['SM_Status'])) {
        $SM_Status = $_POST['SM_Status'];
    }
    //if(isset($_POST['SM_Operator'])){$SM_Operator = $_POST['SM_Operator'];}
    //if(isset($_POST['SM_Reg_Date'])){$SM_Reg_Date = $_POST['SM_Reg_Date'];} 
    
    $data = array(
        $SM_ID,
        $SM_ID_Type,
        $SM_Branch_Code,
        $SM_Title,
        $SM_Initials,
        $SM_First_Name,
        $SM_Last_Name,
        $SM_Full_Name,
        $SM_Gender,
        $SM_Date_of_Birth,
        $SM_House_NO,
        $SM_Lane,
        $SM_Town,
        $SM_City,
        $SM_Country,
        $SM_Postal_Code,
        $SM_Tel_Residance,
        $SM_Tell_Work,
        $SM_Tell_Mobile,
        $SM_Mail_Personal,
        $SM_Mail_Work,
        $SM_Use_Parent_ID,
        $SM_Parent_Name,
        $SM_Source,
        $SM_Parent_Phone,
        $SM_Status,
        $Old_SM_ID
    );
    $sql  = 'UPDATE `student_master` SET `SM_ID`=?,`SM_ID_Type`=?  ,`SM_Branch_Code`=? ,`SM_Title`=? ,`SM_Initials`=? ,`SM_First_Name`=? ,`SM_Last_Name`=? ,`SM_Full_Name`=? ,`SM_Gender`=? ,`SM_Date_of_Birth`=? ,`SM_House_NO`=? ,`SM_Lane`=? ,`SM_Town`=? ,`SM_City`=? ,`SM_Country`=? ,`SM_Postal_Code`=? ,`SM_Tel_Residance`=? ,`SM_Tell_Work`=? ,`SM_Tell_Mobile`=? ,`SM_Mail_Personal`=? ,`SM_Mail_Work`=? ,`SM_Use_Parent_ID`=? ,`SM_Parent_Name`=? , `SM_Source`=?,`SM_Parent_Phone`=? ,`SM_Status`=?  WHERE `SM_ID`=? LIMIT 1';
    $esoftConfig->beginTransaction();
    $regRES  = true;
    $regSync = true;
    if ($Old_SM_ID != $SM_ID) {
        $RegSql  = "UPDATE `registrations` SET `RG_Stu_ID`=? WHERE  `RG_Stu_ID`=?";
        $regsth  = $esoftConfig->prepare($RegSql);
        $regRES  = $regsth->execute(array(
            $SM_ID,
            $Old_SM_ID
        ));
        $regSync = SyncInsert($esoftConfig, $RegSql, array(
            $SM_ID,
            $Old_SM_ID
        ));
    }
    
    $sth = $esoftConfig->prepare($sql);
    
    //history log 
    $log             = "Student holder of ID No $SM_ID has been edited by the $SM_Operator in $SM_Branch_Code @ " . $Today;
    $action          = 'Edit Student';
    $comment         = '';
    $histroyLogArray = array(
        $log,
        $Today,
        $SM_Operator,
        $SM_Branch_Code,
        $action,
        $comment
    );
    //Sync Query
    
    if ($regRES && $regSync && $sth->execute($data) && SyncInsert($esoftConfig, $sql, $data) && HistoryLogInsert($esoftConfig, $histroyLogArray)) {
        $esoftConfig->commit();
        echo '<h3>Student Updated Successfully</h3>';
        
    } else {
        $esoftConfig->rollback();
        echo '<h3>Student Updating Fail</h3>';
    }
}


?>
