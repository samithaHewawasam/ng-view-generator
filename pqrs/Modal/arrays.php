<?php 
$Table_List_Array=array(
'batch_master'=>array(
'Table'=>'batch_master',
'Primary'=>'BM_ID',
'Columns'=>array('BM_ID', 'BM_Branch_Code', 'BM_Course_Code', 'BM_Batch_Code', 'BM_Commence_Date', 'BM_End_Date', 'BM_Target_Exam', 'BM_Status', 'BM_Intake')
),



'payments_master'=>array(
'Table'=>'payments_master',
'Primary'=>'PM_ID',
'Columns'=>array('PM_ID','PM_Receipt_No', 'RG_Reg_No', 'PM_Date','PM_Amount', 'PM_Type', 'PM_Cheque_NO', 'PM_Cheque_Bank', 'PM_Cheque_Due_Date', 'PM_Card_Holder_Name', 'PM_Card_Type', 'PM_Card_NO','PM_Operator')
),

'registrations'=>array(
'Table'=>'registrations',
'Primary'=>'RG_ID',
'Columns'=>array('RG_ID', 'RG_Branch_Code', 'RG_Reg_NO','Default_Batch', 'RG_Stu_ID', 'RG_Reg_Type', 'RG_Fee_Structure', 'RG_Discount_Plan', 'RG_Total_Fee','RG_Final_Fee','RG_Reg_Fee', 'RG_Total_Paid', 'RG_FullPay_Dis_Amount','RG_Dis_Amount','RG_Dis_Comment','RG_Status', 'RG_Operator', 'RG_Date')
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
)





);


?>

 
