<?php 
$Table_List_Array=array(
'batch_master'=>array(
'Table'=>'batch_master',
'Primary'=>'BM_ID',
'Columns'=>array('BM_ID', 'BM_Branch_Code', 'BM_Course_Code', 'BM_Batch_Code', 'BM_Commence_Date', 'BM_End_Date', 'BM_Target_Exam', 'BM_Status', 'BM_Intake')
),



'branches'=>array(
'Table'=>'branches',
'Primary'=>'B_ID',
'Columns'=>array('B_ID','B_CODE','B_Branch_Name','B_OwnerShip','System','B_Province')
),


'course'=>array(
'Table'=>'course',
'Primary'=>'C_ID',
'Columns'=>array('C_ID', 'C_Code', 'C_Name', 'C_Status', 'C_Type','Duration','C_Intake','C_Ins_Method','Branch')
),

'course_type'=>array(
'Table'=>'course_type',
'Primary'=>'CT_ID',
'Columns'=>array('CT_ID', 'CT_Type_Code', 'CT_Course_Code', 'CT_No_Of_Subjects')
),

'discount_plan'=>array(
'Table'=>'discount_plan',
'Primary'=>'DP_ID',
'Columns'=>array('DP_ID', 'DP_Code', 'DP_Name', 'DP_Start_Date', 'DP_End_Date', 'DP_Type', 'DP_Rate', 'DP_Status')
),

'discount_types'=>array(
'Table'=>'discount_types',
'Primary'=>'DT_ID',
'Columns'=>array('DT_ID', 'DT_Dis_Plan', 'DT_Reg_Types', 'DT_Status')
),

'division'=>array(
'Table'=>'division',
'Primary'=>'D_ID',
'Columns'=>array('D_ID', 'D_Code', 'D_Name')
),

'fee_installments'=>array(
'Table'=>'fee_installments',
'Primary'=>'FI_ID',
'Columns'=>array('FI_ID', 'FI_Stru_Code', 'FI_Ins_NO', 'FI_Type', 'FI_Ins_Amount')
),

'fee_structure'=>array(
'Table'=>'fee_structure',
'Primary'=>'FS_ID',
'Columns'=>array('FS_ID', 'FS_Code', 'FS_Reg_Type', 'FS_Price', 'FS_No_of_Installments', 'FS_Registration_Fee', 'FS_Status')
),

'intakes'=>array(
'Table'=>'intakes',
'Primary'=>'Intake_ID',
'Columns'=>array('Intake_ID', 'Intake', 'C_Code')
),

'payments_master'=>array(
'Table'=>'payments_master',
'Primary'=>'PM_ID',
'Columns'=>array('PM_ID','PM_Receipt_No', 'RG_Reg_No', 'PM_Date','PM_Amount','excessPayment', 'PM_Type', 'PM_Cheque_NO', 'PM_Cheque_Bank', 'PM_Cheque_Due_Date', 'PM_Card_Holder_Name', 'PM_Card_Type', 'PM_Card_NO','PM_Operator')
),
'other_payments'=>array(
'Table'=>'other_payments',
'Primary'=>'OP_ID',
'Columns'=>array('OP_ID','OP_Receipt_No', 'RG_Reg_No', 'Comment','Currency','Currency_rate', 'OP_Amount', 'OP_Type', 'OP_Cheque_NO', 'OP_Cheque_Bank', 'OP_Cheque_Due_Date', 'OP_Card_Holder_Name', 'OP_Card_Type','OP_Card_NO','OP_Operator')
),


'registrations'=>array(
'Table'=>'registrations',
'Primary'=>'RG_ID',
'Columns'=>array('RG_ID', 'RG_Branch_Code', 'RG_Reg_NO','Default_Batch', 'RG_Stu_ID', 'RG_Reg_Type', 'RG_Fee_Structure', 'RG_Discount_Plan', 'RG_Total_Fee','RG_Final_Fee','RG_Reg_Fee', 'RG_Total_Paid', 'RG_FullPay_Dis_Amount','RG_Dis_Amount','RG_Dis_Comment','couponCode','RG_Status', 'RG_Operator', 'RG_Date')
),


'registration_type'=>array(
'Table'=>'registration_type',
'Primary'=>'RT_ID',
'Columns'=>array('RT_ID', 'RT_Code', 'D_Code', 'RT_Name', 'RT_Category','RT_Status')
),

'student_installments'=>array(
'Table'=>'student_installments',
'Primary'=>'SI_ID',
'Columns'=>array('SI_ID', 'SI_Reg_No', 'SI_Ins_NO', 'SI_Ins_Amount', 'SI_Due_Date', 'SI_Paid_Amount', 'SI_Paid_Date')
),

'student_master'=>array(
'Table'=>'student_master',
'Primary'=>'SM_NO',
'Columns'=>array('SM_NO', 'SM_ID_Type', 'SM_ID', 'SM_Branch_Code', 'SM_Title', 'SM_Initials', 'SM_First_Name', 'SM_Last_Name', 'SM_Full_Name', 'SM_Gender', 'SM_Date_of_Birth', 'SM_House_NO', 'SM_Lane', 'SM_Town', 'SM_City', 'SM_Country', 'SM_Postal_Code', 'SM_Tel_Residance', 'SM_Tell_Work', 'SM_Tell_Mobile', 'SM_Mail_Personal', 'SM_Mail_Work', 'SM_Use_Parent_ID', 'SM_Parent_Name', 'SM_Parent_Phone', 'SM_Status', 'SM_Operator','SM_Reg_Date')
),

'student_subjects'=>array(
'Table'=>'student_subjects',
'Primary'=>'SS_ID',
'Columns'=>array('SS_ID', 'SS_REG_NO', 'SS_Batch_No', 'SS_Subject', 'SS_Status')
),


'subjects'=>array(
'Table'=>'subjects',
'Primary'=>'S_ID',
'Columns'=>array('S_ID', 'S_CODE', 'C_CODE', 'S_Name', 'S_Status', 'S_Hours', 'S_Float_Hours', 'S_Type')
),


'system_users'=>array(
'Table'=>'system_users',
'Primary'=>'Sys_U_ID',
'Columns'=>array('Sys_U_ID', 'Sys_U_Branch', 'Sys_U_Name', 'Sys_U_Designaion', 'Sys_U_mail', 'Sys_U_Username', 'Sys_U_Level', 'Sys_U_AccessLevel',  'Sys_U_JoinedDate')
)

);


function SyncInsert($con,$query,$BindData){
$SyncSql='INSERT INTO `sync_log` (`query`,`data`) VALUES (?,?)';

$sthSync = $con->prepare($SyncSql);
$sthSync->execute(array($query,serialize($BindData)));
return $Syncresult=$sthSync->rowCount();
}
function HistoryLogInsert($con,$HistroyLogArry){
$HistorySql="INSERT INTO `history_log`(`log`, `date`, `operator`, `branch`, `action`, `comment`) VALUES (?,?,?,?,?,?)";

$sthHistory = $con->prepare($HistorySql);
$sthHistory->execute($HistroyLogArry);
if($Historyresult=$sthHistory->rowCount()){
return SyncInsert($con,$HistorySql,$HistroyLogArry);
}
}


?> 
