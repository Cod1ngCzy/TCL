<?php
    require("./static/connection.php");
    require("./static/functions.php");
    session_start();

    $flash_message = new FlashMessage();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $user_id = unique_id($sql_connection);
        $query = "INSERT INTO applicant(user_id, status) VALUES ('$user_id', 'false')";
        
        if(!mysqli_query($sql_connection, $query)){
            throw new Exception("Can't Insert Applicant ID into Database");
        } 

        $personal = array(
            "user_id" => $user_id,
            "surname" => isset($_POST['surname']) ? mysqli_real_escape_string($sql_connection, $_POST['surname']) : null,
            "first_name" => isset($_POST['firstname']) ? mysqli_real_escape_string($sql_connection, $_POST['firstname']) : null,
            "middle_name" => isset($_POST['middlename']) ? mysqli_real_escape_string($sql_connection, $_POST['middlename']) : null,
            "dob" => isset($_POST['dob']) ? mysqli_real_escape_string($sql_connection, $_POST['dob']) : null,
            "place_of_birth" => isset($_POST['placeofbirth']) ? mysqli_real_escape_string($sql_connection, $_POST['placeofbirth']) : null,
            "citizenship" => isset($_POST['citizenship']) ? mysqli_real_escape_string($sql_connection, $_POST['citizenship']) : null,
            "sex" => isset($_POST['sex']) ? mysqli_real_escape_string($sql_connection, $_POST['sex']) : null,
            "civil_status" => isset($_POST['civilstatus']) ? mysqli_real_escape_string($sql_connection, $_POST['civilstatus']) : null,
            "height" => isset($_POST['height']) ? mysqli_real_escape_string($sql_connection, $_POST['height']) : null,
            "weight" => isset($_POST['weight']) ? mysqli_real_escape_string($sql_connection, $_POST['weight']) : null,
            "blood_type" => isset($_POST['bloodtype']) ? mysqli_real_escape_string($sql_connection, $_POST['bloodtype']) : null,
            "driver_license" => isset($_POST['driverlicense']) ? mysqli_real_escape_string($sql_connection, $_POST['driverlicense']) : null,
            "pag_ibig" => isset($_POST['pagibig']) ? mysqli_real_escape_string($sql_connection, $_POST['pagibig']) : null,
            "phil_health" => isset($_POST['philhealth']) ? mysqli_real_escape_string($sql_connection, $_POST['philhealth']) : null,
            "sss" => isset($_POST['sss']) ? mysqli_real_escape_string($sql_connection, $_POST['sss']) : null,
            "tin" => isset($_POST['tin']) ? mysqli_real_escape_string($sql_connection, $_POST['tin']) : null,
            "other_id" => isset($_POST['otherid']) ? mysqli_real_escape_string($sql_connection, $_POST['otherid']) : null,
            "phone_number" => isset($_POST['phonenumber']) ? mysqli_real_escape_string($sql_connection, $_POST['phonenumber']) : null,
            "telephone" => isset($_POST['telephone']) ? mysqli_real_escape_string($sql_connection, $_POST['telephone']) : null,
            "email" => isset($_POST['email']) ? mysqli_real_escape_string($sql_connection, $_POST['email']) : null,
            "res_address" => isset($_POST['resaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['resaddress']) : null,
            "perm_address" => isset($_POST['permaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['permaddress']) : null
        );
        
        $family = array(
            "user_id" => $user_id,
            "spouse_surname" => isset($_POST['spousesurname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousesurname']) : null,
            "spouse_firstname" => isset($_POST['spousefirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousefirstname']) : null,
            "spouse_middlename" => isset($_POST['spousemiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['spousemiddlename']) : null,
            "spouse_occupation" => isset($_POST['spouseoccupation']) ? mysqli_real_escape_string($sql_connection, $_POST['spouseoccupation']) : null,
            "father_surname" => isset($_POST['fathersurname']) ? mysqli_real_escape_string($sql_connection, $_POST['fathersurname']) : null,
            "father_firstname" => isset($_POST['fatherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['fatherfirstname']) : null,
            "father_middlename" => isset($_POST['fathermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['fathermiddlename']) : null,
            "mother_maidenname" => isset($_POST['mothermaidenname']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermaidenname']) : null,
            "mother_firstname" => isset($_POST['motherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['motherfirstname']) : null,
            "mother_middlename" => isset($_POST['mothermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermiddlename']) : null
        );
        
        $education = array(
            "user_id" => $user_id,
            "elementary_name" => isset($_POST['Eschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Eschoolname']) : null,
            "elementary_degree" => isset($_POST['Edegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Edegree']) : null,
            "elementary_attendance" => isset($_POST['Eattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Eattendace']) : null,
            "elementary_levelearned" => isset($_POST['Ehighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Ehighestlevel']) : null,
            "elementary_yeargraduated" => isset($_POST['Eyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Eyeargraduate']) : null,
            "elementary_honors" => isset($_POST['Eacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Eacadhonors']) : null,
        
            "secondary_name" => isset($_POST['Sschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Sschoolname']) : null,
            "secondary_degree" => isset($_POST['Sdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdegree']) : null,
            "secondary_attendance" => isset($_POST['Sattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Sattendace']) : null,
            "secondary_levelearned" => isset($_POST['Shighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Shighestlevel']) : null,
            "secondary_yeargraduated" => isset($_POST['Syeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Syeargraduate']) : null,
            "secondary_honors" => isset($_POST['Sacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Sacadhonors']) : null,
        
            "vocational_name" => isset($_POST['Vschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Vschoolname']) : null,
            "vocational_degree" => isset($_POST['Vdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Vdegree']) : null,
            "vocational_attendance" => isset($_POST['Vattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Vattendace']) : null,
            "vocational_levelearned" => isset($_POST['Vhighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Vhighestlevel']) : null,
            "vocational_yeargraduated" => isset($_POST['Vyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Vyeargraduate']) : null,
            "vocational_honors" => isset($_POST['Vacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Vacadhonors']) : null,
        
            "college_name" => isset($_POST['Cschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Cschoolname']) : null,
            "college_degree" => isset($_POST['Cdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Cdegree']) : null,
            "college_attendance" => isset($_POST['Cattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Cattendace']) : null,
            "college_levelearned" => isset($_POST['Chighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Chighestlevel']) : null,
            "college_yeargraduated" => isset($_POST['Cyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Cyeargraduate']) : null,
            "college_honors" => isset($_POST['Cacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Cacadhonors']) : null,
        
            "graduate_studies_name" => isset($_POST['Gschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Gschoolname']) : null,
            "graduate_studies_degree" => isset($_POST['Gdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Gdegree']) : null,
            "graduate_studies_attendance" => isset($_POST['Gattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Gattendace']) : null,
            "graduate_studies_levelearned" => isset($_POST['Ghighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Ghighestlevel']) : null,
            "graduate_studies_yeargraduated" => isset($_POST['Gyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Gyeargraduate']) : null,
            "graduate_studies_honors" => isset($_POST['Gacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Gacadhonors']) : null
        );
        
        $work = array(
            "user_id" => $user_id,
            "Fdates" => isset($_POST['Fworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Fworkdate']) : null,
            "Fposition_title" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
            "Fdepartment" => isset($_POST['Fcompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Fcompany']) : null,
            "Fmonthly_salary" => isset($_POST['Fmonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Fmonthlysalary']) : null,
            "Fpay_grade" => isset($_POST['Fpaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Fpaygrade']) : null,
            "Fstatus_of_appointment" => isset($_POST['Fstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Fstatusofappointment']) : null,
            "Fgovt_service" => isset($_POST['Fgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Fgoverment']) : null,
            "Sdates" => isset($_POST['Sworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Sworkdate']) : null,
            "Sposition_title" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
            "Sdepartment" => isset($_POST['Scompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Scompany']) : null,
            "Smonthly_salary" => isset($_POST['Smonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Smonthlysalary']) : null,
            "Spay_grade" => isset($_POST['Spaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Spaygrade']) : null,
            "Sstatus_of_appointment" => isset($_POST['Sstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Sstatusofappointment']) : null,
            "Sgovt_service" => isset($_POST['Sgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Sgoverment']) : null,
            "Tdates" => isset($_POST['Tworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Tworkdate']) : null,
            "Tposition_title" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null,
            "Tdepartment" => isset($_POST['Tcompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Tcompany']) : null,
            "Tmonthly_salary" => isset($_POST['Tmonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Tmonthlysalary']) : null,
            "Tpay_grade" => isset($_POST['Tpaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Tpaygrade']) : null,
            "Tstatus_of_appointment" => isset($_POST['Tstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Tstatusofappointment']) : null,
            "Tgovt_service" => isset($_POST['Tgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Tgoverment']) : null
        );
        
        $organization_details = array(
            "user_id" => $user_id,
            "Forg_name" => isset($_POST['Fnameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Fnameoforg']) : null,
            "Fdates" => isset($_POST['Fdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Fdates']) : null,
            "Fhours" => isset($_POST['Fhours']) ? mysqli_real_escape_string($sql_connection, $_POST['Fhours']) : null,
            "Fid_type" => isset($_POST['Fid']) ? mysqli_real_escape_string($sql_connection, $_POST['Fid']) : null,
            "Fposition" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
        
            "Sorg_name" => isset($_POST['Snameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Snameoforg']) : null,
            "Sdates" => isset($_POST['Sdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdates']) : null,
            "Shours" => isset($_POST['Shours']) ? mysqli_real_escape_string($sql_connection, $_POST['Shours']) : null,
            "Sid_type" => isset($_POST['Sid']) ? mysqli_real_escape_string($sql_connection, $_POST['Sid']) : null,
            "Sposition" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
        
            "Torg_name" => isset($_POST['Tnameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Tnameoforg']) : null,
            "Tdates" => isset($_POST['Tdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Tdates']) : null,
            "Thours" => isset($_POST['Thours']) ? mysqli_real_escape_string($sql_connection, $_POST['Thours']) : null,
            "Tid_type" => isset($_POST['Tid']) ? mysqli_real_escape_string($sql_connection, $_POST['Tid']) : null,
            "Tposition" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null
        );
        

        $training_programs = array(
            "user_id" => $user_id,
            "Ftraining_program" => isset($_POST['Ftitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Ftitle']) : null,
            "Ftraining_dates" => isset($_POST['Fdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Fdates']) : null,
            "Ftraining_hours" => isset($_POST['Fhours']) ? mysqli_real_escape_string($sql_connection, $_POST['Fhours']) : null,
            "Fid_type" => isset($_POST['Fid']) ? mysqli_real_escape_string($sql_connection, $_POST['Fid']) : null,
            "Fconducted_sponsored_by" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
        
            "Straining_program" => isset($_POST['Stitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Stitle']) : null,
            "Straining_dates" => isset($_POST['Sdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdates']) : null,
            "Straining_hours" => isset($_POST['Shours']) ? mysqli_real_escape_string($sql_connection, $_POST['Shours']) : null,
            "Sid_type" => isset($_POST['Sid']) ? mysqli_real_escape_string($sql_connection, $_POST['Sid']) : null,
            "Sconducted_sponsored_by" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
        
            "Ttraining_program" => isset($_POST['Ttitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Ttitle']) : null,
            "Ttraining_dates" => isset($_POST['Tdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Tdates']) : null,
            "Ttraining_hours" => isset($_POST['Thours']) ? mysqli_real_escape_string($sql_connection, $_POST['Thours']) : null,
            "Tid_type" => isset($_POST['Tid']) ? mysqli_real_escape_string($sql_connection, $_POST['Tid']) : null,
            "Tconducted_sponsored_by" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null
        );
        
        
        $other_information = array(
            // Skills, Academic Distinctions, and Membership
            "user_id" => $user_id,
            "special_skills" => isset($_POST['Fskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Fskills']) : null,
            "non_academic_distinctions" => isset($_POST['Facademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Facademicdistictions']) : null,
            "membership_in_association" => isset($_POST['Fmembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Fmembership']) : null,
            
            "special_skills_2" => isset($_POST['Sskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Sskills']) : null,
            "non_academic_distinctions_2" => isset($_POST['Sacademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Sacademicdistictions']) : null,
            "membership_in_association_2" => isset($_POST['Smembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Smembership']) : null,
            
            "special_skills_3" => isset($_POST['Tskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Tskills']) : null,
            "non_academic_distinctions_3" => isset($_POST['Tacademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Tacademicdistictions']) : null,
            "membership_in_association_3" => isset($_POST['Tmembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Tmembership']) : null,
        
            // Emergency Contact Information
            "contact_person" => isset($_POST['contactfullname']) ? mysqli_real_escape_string($sql_connection, $_POST['contactfullname']) : null,
            "contact_relationship" => isset($_POST['contactrelationship']) ? mysqli_real_escape_string($sql_connection, $_POST['contactrelationship']) : null,
            "contact_address" => isset($_POST['contactaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['contactaddress']) : null,
            "contact_number" => isset($_POST['contactnumber']) ? mysqli_real_escape_string($sql_connection, $_POST['contactnumber']) : null,
        
            // Reference Information
            "reference1" => isset($_POST['Freferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferencename']) : null,
            "reference1_add" => isset($_POST['Freferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferenceaddress']) : null,
            "reference1_tel" => isset($_POST['Freferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferencetel']) : null,
        
            "reference2" => isset($_POST['Sreferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferencename']) : null,
            "reference2_add" => isset($_POST['Sreferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferenceaddress']) : null,
            "reference2_tel" => isset($_POST['Sreferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferencetel']) : null,
        
            "reference3" => isset($_POST['Treferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferencename']) : null,
            "reference3_add" => isset($_POST['Treferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferenceaddress']) : null,
            "reference3_tel" => isset($_POST['Treferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferencetel']) : null
        );
        
        insert_to_database("personal_information", $personal, $sql_connection);
        insert_to_database("family_background", $family, $sql_connection);
        insert_to_database("educational_background", $education, $sql_connection);
        insert_to_database("work_background", $work, $sql_connection);
        insert_to_database("voluntary_work", $organization_details, $sql_connection);
        insert_to_database("learning_and_development", $training_programs, $sql_connection);
        insert_to_database("other_information", $other_information, $sql_connection);

        $flash_message->Set("Application Submitted", "success");
        $_SESSION['user_id'] = $user_id;
        header("Location: applicant.php");
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Applicant Form</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        /*CSS INHERIT PROPERTIES*/
        .flex{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-title{
            width: 100%;
            border: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .header-title label{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-size: 2.5em;
            color: #f15535;
        }

        .header-title img{
            margin-right: 20px;
        }
        .group,
        .odd-headers,
        .odd-headers-three{
            width: 100%;
            display: flex;
            border: 1px solid black;
        }

        .group label{
            font-size: 16px;
            width: 20%;
            background-color: #efefef;
            padding: 5px 0px 2px 5px;
            border-right: 1px solid black;
            margin-right:1px;
        }

        .group input[type="text"],
        .group input[type="date"],
        .group input[type="dropdown"],
        .group input[type="number"],
        .group input[type="email"],
        select,
        textarea{
            font-size: 12px;
            width: 80%;
            border: none;
            padding: 0px 0px 0px 6px;
        }

        .group-contact input[type="text"]{
            border-right: 1px solid black;
            margin: 0px 1px 0px 0px;
        }

        .group-inline{
            width: 100%;
        }

        .group-inline input[type="text"]{
            border-right: 1px solid black;
            height: 35px;
            margin: 0px 1px 0px 0px;
        }

        .group-inline label{
            width: 100%;
            font-size: 8.5px;
        }

         input:focus,
         select:focus,
         textarea:focus {
            outline: none; /* Removes default focus outline */

        }

        .header-span{
            width: 100%;
            background-color: #efefef;
            font-size: 1.2em;
            border: 1px solid black;
            margin: 1px;
            padding: 2px;
            font-style: italic;
        }

        .header-middle{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .wrapper-span-full{
            width: 100%;
        }

        .span{
            height: 40px;
        }

        .span input[type="text"]{
            height: 15px;
        }
        
        .span label{
            height: 100%;
        }

        .column{
            width: 40%;
        }

        .column input[type='text']{
            width: 100%;
        }

        .height-max{
            height: 60px;
        }

        .width-max{
            width: 80%;
        }

        .no-border input[type='text']{
            border-right: none;
            border: none;
        }

        .border{
            border: 1px solid black;
        }

        .odd-headers label,
        .odd-headers-three label{
            font-size: 10px;
            background-color: #efefef;
            padding: 5px 0px 2px 5px;
            border-right: 1px solid black;
            margin-right:1px;
        }

        .odd-headers label:nth-child(1),
        .odd-headers input[type="text"]:nth-child(1){
            width: 30%;
        }

        .odd-headers label:nth-child(2),
        .odd-headers label:nth-child(3),
        .odd-headers label:nth-child(4),
        .odd-headers input[type="text"]:nth-child(2),
        .odd-headers input[type="text"]:nth-child(3),
        .odd-headers input[type="text"]:nth-child(4){
            width: 13%;
        }

        .odd-headers label:nth-child(5),
        .odd-headers input[type="text"]:nth-child(5){
            width: 50%;
        }
        
        .odd-headers-three label,
        .odd-headers-three input[type="text"]{
            width: 40%;
        }

        .odd-headers input[type="text"],
        .odd-headers-three input[type="text"]{
            border-right:1px solid black ;
            height: 30px;
            margin: 0px 1px 1px 0px;
        }

        .other-info-span{
            width: 100%;
            display: flex;
        }

        .contact{
            width: 65%;
        }

        .contact label{
            font-size: 14px;
            background-color: #efefef;
            padding: 5px 0px 2px 5px;
        }

        .picture-wrapper{
            width: 36%;
            border-right: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .picture{
            width: 4.5cm;
            height: 4.5cm;
            border: 1px solid black;
            font-size: .8em;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: justify;
            padding: 5px;
        }

        .reference input[type="text"]{
            width: 32.4.5%;
        }

        .oath{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: .8em;
            border: 1px solid black;
            padding: 10px;
        }

        .oath h3{
            padding: 0px 0px 10px 0px;
        }

        .oath input{
            width: 50%;
            text-align: center;
            background-color: #efefef;
        }

        .final-btn{
            margin: 10px 0px 0px 0px;
            width: 100%;
        }

        .final-btn:hover{
            cursor: pointer;
            background: red;
            color:white
        }

        .shrink{
            width: 100px;
            position: fixed;
            top: 10px;
            left: 10px
        }

        .shrink:hover{
            cursor: pointer;
            background: red;
            color:white
        }

        .confirm{
            width: 100%;
            height: 100vh;
            position: absolute;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            display: none;
        }

        .confirm-btn{
            width: 100%;
            position: absolute;
            z-index: 11;
        }

        .confirm-submit{
            width: 100%;
        }

        .confirm-submit:hover{
            cursor: pointer;
            background: red;
            color:white
        }


        .form-group-confirm{
            width: 50%;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .inline{
            width: 100%;
        }

        .form-group-confirm input {
            width: 100%;
            padding: 10px;
            margin: 5px;
            word-wrap: break-word; /* or overflow-wrap: break-word; */
        }

        .form-group-confirm label {
            width: 100%;
            padding: 10px;
            font-weight: 700;
        }

        
        /*CSS INHERIT PROPERTIES*/

        main{
            width: 100%;
            font-size: 16px;
        }

        .form-wrapper{
            width: 1000px;
            height: 800px;
            min-width: none;
        }

        .personal-info,
        .family-background,
        .educational-background,
        .work-background,
        .voluntary-work,
        .learning-development{
            flex-direction: column;
        }

        .flash-message.fade-out {
            opacity: 0; 
        }

        .flash-message.success {
            background-color: #4CAF50; /* Green */
        }

        .flash-message.error {
            background-color: #F44336; /* Red */
        }

        .flash-message.info {
            background-color: #2196F3; /* Blue */
        }

        .flash-message.warning {
            background-color: #FFC107; 
            color: #000; 
        }

        .flash-message {
            animation: fadeIn 0.5s ease-out;
        }

        @media screen and (max-width: 850px) {
            .app-wrapper,
            .form-wrapper{
                width: 100%;
            }

            .form-wrapper{
                height: 20vh;
            }

            nav{
                display: none;
            }
        }

        @media print {
            main {
                max-width: 90%; /* Set the maximum width for the printed content */
                margin: 0 auto;   /* Center the content on the page */
            }
        
            /* Additional print-specific styles */
            .no-print {
                display: none; /* Hide elements that should not appear in print */
            }

            .group-inline label{
                width: 100px;
                font-size: 8.5px;
            }

            .group-inline input[type="text"]{
                margin: 0px 1px;
            }

            .group-inline {
                width: 100%;
            }
            
            button{
                display: none;
            }
        }

    </style>
</head>
<body>
    <?php $flash_message->Display(); // Display the flash message ?>
    <div class="confirm" id="confirm">
        <button class="shrink pad-bot" type="button" id="back-apply">Back</button>
            <form class ="form-group-confirm" id="form-group-confirm" method="POST">
                
            </form>
    </div>
    <main class="flex">
        <button class="shrink" type="button" id="back">Back</button>
        <form method="POST" class="form-wrapper">
            <div class="header-title"> 
                <label>
                    <img src="./assets/tcl-logo.svg" alt="tcl logo"> 
                    PERSONAL DATA SHEET
                </label>
            </div>
            <!--PERSONAL INFO INPUTS-->
            <h1 class="header-span">I. Personal Information</h1>
            <div class="personal-info wrapper-span-full flex">
                <div class="group">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" placeholder="Surname">
                </div>
                <div class="group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="First Name">
                </div>

                <div class="group">
                    <label for="middlename">Middle Name</label>
                    <input type="text" id="middlename" name="middlename" placeholder="Middle Name">
                </div>

                <div class="group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" placeholder="Date of Birth">
                </div>
                
                <div class="group">
                    <label for="place-of-birth">Place of Birth</label>
                    <input type="text" id="place-of-birth" name="placeofbirth" placeholder="Place of Birth">
                </div>
                
                <div class="group">
                    <label for="citizenship">Citizenship</label>
                    <input type="text" id="citizenship" name="citizenship" placeholder="Citizenship">
                </div>
                
                <div class="group">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex">
                        <option value="" disabled selected>Select Sex</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                
                <div class="group">
                    <label for="civil-status">Civil Status</label>
                    <select id="civil-status" name="civilstatus">
                        <option value="" disabled selected>Select Civil Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="separated">Separated</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                
                <div class="group">
                    <label for="height">Height (cm)</label>
                    <input type="number" id="height" name="height" step="0.01" placeholder="Height (cm)">
                </div>
                
                <div class="group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" step="0.01" placeholder="Weight (kg)">
                </div>
                
                <div class="group">
                    <label for="blood-type">Blood Type</label>
                    <select id="blood-type" name="bloodtype">
                        <option value="" disabled selected>Select Blood Type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                
                <div class="group">
                    <label for="driverlicense">Driver's License ID</label>
                    <input type="text" id="driverlicense" name="driverlicense" placeholder="Driver's License ID">
                </div>
                
                <div class="group">
                    <label for="pag-ibig">Pag Ibig NO.</label>
                    <input type="text" id="pag-ibig" name="pagibig" placeholder="Pag Ibig NO.">
                </div>
                
                <div class="group">
                    <label for="phil-health">Philhealth NO.</label>
                    <input type="text" id="phil-health" name="philhealth" placeholder="Philhealth NO.">
                </div>
                
                <div class="group">
                    <label for="sss">SSS NO.</label>
                    <input type="text" id="sss" name="sss" placeholder="SSS NO.">
                </div>
                
                <div class="group">
                    <label for="tin">TIN NO.</label>
                    <input type="text" id="tin" name="tin" placeholder="TIN NO.">
                </div>
                
                <div class="group">
                    <label for="other-id">Other ID</label>
                    <input type="text" id="other-id" name="otherid" placeholder="Other ID">
                </div>
                
                <div class="group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" id="phone-number" name="phonenumber" placeholder="Phone Number">
                </div>
                
                <div class="group">
                    <label for="telephone">Telephone</label>
                    <input type="text" id="telephone" name="telephone" placeholder="Telephone">
                </div>
                
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                
                <div class="group span">
                    <label for="res-address">Residential Address</label>
                    <textarea id="res-address" name="resaddress" value="House | Street | Subdivision | Baranggay | City/Municipality | Province" placeholder="Residential Address"></textarea>
                </div>
                
                <div class="group span">
                    <label for="perm-address">Permanent Address</label>
                    <textarea id="perm-address" name="permaddress" value="House | Street | Subdivision | Baranggay | City/Municipality | Province" placeholder="Permanent Address"></textarea>
                </div>      
            </div>
            <!--PERSONAL INFO INPUTS-->
            <!--FAMILY INFO INPUTS-->
            <h1 class="header-span">II. Family Background</h1>
            <div class="family-background  wrapper-span-full flex">
                <div class="span no-border group">
                    <label for="spouse">Spouse's Information</label>
                    <div class="column">
                        <input type="text" id="spouse-surname" name="spousesurname" placeholder="Spouse's Surname">
                        <input type="text" id="spouse-first-name" name="spousefirstname" placeholder="Spouse's First Name">
                    </div>
                    <div class="column">
                        <input type="text" id="spouse-middle-name" name="spousemiddlename" placeholder="Spouse's Middle Name">
                        <input type="text" id="spouse-occupation" name="spouseoccupation" placeholder="Spouse's Occupation">
                    </div>
                </div>
                <div class="span height-max no-border group">
                    <label for="spouse">Father's Information</label>
                    <div class="width-max column">
                        <input type="text" id="father-surname" name="fathersurname" placeholder="Father's Surname">
                        <input type="text" id="father-first-name" name="fatherfirstname" placeholder="Father's First Name">
                        <input type="text" id="father-middle-name" name="fathermiddlename" placeholder="Father's Middle Name">
                    </div>
                </div>
                <div class="span height-max no-border group">
                    <label for="spouse">Mother's Information</label>
                    <div class="width-max column">
                        <input type="text" id="mother-maiden-name" name="mothermaidenname" placeholder="Mother's Maiden Name">
                        <input type="text" id="mother-first-name" name="motherfirstname" placeholder="Mother's First Name">
                        <input type="text" id="mother-middle-name" name="mothermiddlename" placeholder="Mother's Middle Name">
                    </div>
                </div>
            </div>
            <!--FAMILY INFO INPUTS-->
            <!--EDUCATIONAL INFO INPUTS-->
            <h1 class="header-span">III. Educational Background</h1>
            <div class="educational-background wrapper-span-full flex">
                <div class="group-inline header group span ">
                    <label class="header-middle">LEVEL</label>
                    <label class="header-middle">NAME OF SCHOOL</label>
                    <label class="header-middle">BASIC EDUCATION DEGREE/COURSE</label>
                    <label class="header-middle">PERIOD OF ATTENDANCE</label>
                    <label class="header-middle">HIGHEST LEVEL/UNIT EARNED (IF NOT GRADUATE)</label>
                    <label class="header-middle">YEAR GRADUATE</label>
                    <label class="header-middle">SCHOLARSHIP/ACADEMIC HONORS</label>
                </div>
                <div class="group-inline group" id="elementary">
                    <input class="border" type="text" value="ELEMENTARY" readonly style="background-color: #efefef;">
                    <input type="text" name="Eschoolname" id="level" placeholder="School Name">
                    <input type="text" name="Edegree" id="level" placeholder="Degree">
                    <input type="text" name="Eattendace" id="level" value="From - To | Ex. 2020-2021" placeholder="Period of Attendance">
                    <input type="text" name="Ehighestlevel" id="level" placeholder="Highest Level">
                    <input type="text" name="Eyeargraduate" id="level" placeholder="Year Graduate">
                    <input type="text" name="Eacadhonors" id="level" placeholder="Academic Honors">
                </div>
                <div class="group-inline group" id="secondary">
                    <input class="border" type="text" style="background-color: #efefef;" value="SECONDARY" readonly>
                    <input type="text" name="Sschoolname" id="level" placeholder="School Name">
                    <input type="text" name="Sdegree" id="level" placeholder="Degree">
                    <input type="text" name="Sattendace" id="level" value="From - To | Ex. 2020-2021" placeholder="Period of Attendance">
                    <input type="text" name="Shighestlevel" id="level" placeholder="Highest Level">
                    <input type="text" name="Syeargraduate" id="level" placeholder="Year Graduate">
                    <input type="text" name="Sacadhonors" id="level" placeholder="Academic Honors">
                </div>
                <div class="group-inline group" id="vocational">
                    <input class="border" type="text" style="background-color: #efefef;" value="VOCATIONAL/TRADE" readonly>
                    <input type="text" name="Vschoolname" id="level" placeholder="School Name">
                    <input type="text" name="Vdegree" id="level" placeholder="Degree">
                    <input type="text" name="Vattendace" id="level" value="From - To | Ex. 2020-2021" placeholder="Period of Attendance">
                    <input type="text" name="Vhighestlevel" id="level" placeholder="Highest Level">
                    <input type="text" name="Vyeargraduate" id="level" placeholder="Year Graduate">
                    <input type="text" name="Vacadhonors" id="level" placeholder="Academic Honors">
                </div>
                <div class="group-inline group" id="college">
                    <input class="border" type="text" style="background-color: #efefef;" value="COLLEGE" readonly>
                    <input type="text" name="Cschoolname" id="level" placeholder="School Name">
                    <input type="text" name="Cdegree" id="level" placeholder="Degree">
                    <input type="text" name="Cattendace" id="level" value="From - To | Ex. 2020-2021" placeholder="Period of Attendance">
                    <input type="text" name="Chighestlevel" id="level" placeholder="Highest Level">
                    <input type="text" name="Cyeargraduate" id="level" placeholder="Year Graduate">
                    <input type="text" name="Cacadhonors" id="level" placeholder="Academic Honors">
                </div>
                <div class="group-inline group" id="gradute-studies">
                    <input class="border" type="text" style="background-color: #efefef;" value="GRADUATE STUDIES" readonly>
                    <input type="text" name="Gschoolname" id="level" placeholder="School Name">
                    <input type="text" name="Gdegree" id="level" placeholder="Degree">
                    <input type="text" name="Gattendace" id="level" value="From - To | Ex. 2020-2021" placeholder="Period of Attendance">
                    <input type="text" name="Ghighestlevel" id="level" placeholder="Highest Level">
                    <input type="text" name="Gyeargraduate" id="level" placeholder="Year Graduate">
                    <input type="text" name="Gacadhonors" id="level" placeholder="Academic Honors">
                </div>
            </div>
            <!--WORK EXPERIENCE INFO INPUTS-->
            <h1 class="header-span">IV. Work Experience</h1>
            <div class="work-background wrapper-span-full flex">
                <div class="group-inline header group span">
                    <label class="header-middle">INCLUSIVE DATES</label>
                    <label class="header-middle">POSITION TITLE</label>
                    <label class="header-middle">COMPANY</label>
                    <label class="header-middle">MONTHLY SALARY</label>
                    <label class="header-middle">SALARY PAY GRADE</label>
                    <label class="header-middle">STATUS OF APPOINTMENT</label>
                    <label class="header-middle">GOVT SERVICE</label>
                </div>
                <div class="group-inline group">
                    <input type="text" name="Fworkdate" id="level"  value="From - To | Ex. 2020-2021" placeholder="Work Experience 1">
                    <input type="text" name="Fposition" id="level" placeholder="Position">
                    <input type="text" name="Fcompany" id="level" placeholder="Company">
                    <input type="text" name="Fmonthlysalary" id="level" placeholder="Monthly Salary">
                    <input type="text" name="Fpaygrade" id="level" placeholder="Pay Grade">
                    <input type="text" name="Fstatusofappointment" id="level" placeholder="Status of Appointment">
                    <select name="Fgoverment" id="Government" placeholder="Government">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="group-inline group">
                    <input type="text" name="Sworkdate" id="level" value="From - To | Ex. 2020-2021" placeholder="Work Experience 2">
                    <input type="text" name="Sposition" id="level" placeholder="Position">
                    <input type="text" name="Scompany" id="level" placeholder="Company">
                    <input type="text" name="Smonthlysalary" id="level" placeholder="Monthly Salary">
                    <input type="text" name="Spaygrade" id="level" placeholder="Pay Grade">
                    <input type="text" name="Sstatusofappointment" id="level" placeholder="Status of Appointment">
                    <select name="Sgoverment" id="goverment" placeholder="Government">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="group-inline group">
                    <input type="text" name="Tworkdate" id="level" value="From - To | Ex. 2020-2021" placeholder="Work Experience 3">
                    <input type="text" name="Tposition" id="level" placeholder="Position">
                    <input type="text" name="Tcompany" id="level" placeholder="Company">
                    <input type="text" name="Tmonthlysalary" id="level" placeholder="Monthly Salary">
                    <input type="text" name="Tpaygrade" id="level" placeholder="Pay Grade">
                    <input type="text" name="Tstatusofappointment" id="level" placeholder="Status of Appointment">
                    <select name="Tgoverment" id="goverment" placeholder="Government">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            <!--WORK EXPERIENCE INFO INPUTS-->
            <!--VOLUNTARY WORK INFO INPUTS-->
            <h1 class="header-span">V. Voluntary Work Or Involvement In Civic / Non Government / Voluntary Organizations</h1>
            <div class="voluntary-work wrapper-span-full flex">
                <div class="odd-headers">
                    <label class="header-middle">NAME AND ADDRESS OF ORGANIZATION</label>
                    <label class="header-middle">INCLUSIVE DATES</label>
                    <label class="header-middle">NUMBER OF HOURS</label>
                    <label class="header-middle">TYPE OF ID</label>
                    <label class="header-middle">POSITION / NATURE OF WORK</label>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Fnameoforg" id="level" placeholder="Organization Name">
                    <input type="text" name="Fdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Fhours" id="level" placeholder="No. Hours">
                    <input type="text" name="Fid" id="level" placeholder="Type of ID">
                    <input type="text" name="Fposition" id="level" placeholder="Position">
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Snameoforg" id="level" placeholder="Organization Name">
                    <input type="text" name="Sdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Shours" id="level" placeholder="No. Hours">
                    <input type="text" name="Sid" id="level" placeholder="Type of ID">
                    <input type="text" name="Sposition" id="level" placeholder="Position">
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Tnameoforg" id="level" placeholder="Organization Name">
                    <input type="text" name="Tdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Thours" id="level" placeholder="No. Hours">
                    <input type="text" name="Tid" id="level" placeholder="Type of ID">
                    <input type="text" name="Tposition" id="level" placeholder="Position">
                </div>
            </div>
            <!--VOLUNTARY WORK INFO INPUTS-->
            <!--LEARNING AND DEVELOPMENT (L&D) / INTERVENTIONS / TRAINING PROGRAMS ATTENDED-->
            <h1 class="header-span">VI. Learning AND Development (L&D) / Interventions / Training Programs Attended</h1>
            <div class="learning-development wrapper-span-full flex">
                <div class="odd-headers">
                    <label class="header-middle">TITLE OF L&D INTERVENTION OR TRAINING PROGRAMS</label>
                    <label class="header-middle">INCLUSIVE DATES</label>
                    <label class="header-middle">NUMBER OF HOURS</label>
                    <label class="header-middle">TYPE OF ID</label>
                    <label class="header-middle">CONDUCTED / SPONSORED BY (Write Full)</label>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Ftitle" id="level" placeholder="Title">
                    <input type="text" name="Fdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Fhours" id="level" placeholder="No. Hours">
                    <input type="text" name="Fid" id="level" placeholder="Type of ID">
                    <input type="text" name="Fposition" id="level" placeholder="Position">
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Stitle" id="level" placeholder="Title">
                    <input type="text" name="Sdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Shours" id="level" placeholder="No. Hours">
                    <input type="text" name="Sid" id="level" placeholder="Type of ID">
                    <input type="text" name="Sposition" id="level" placeholder="Position">
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Ttitle" id="level" placeholder="Title">
                    <input type="text" name="Tdates" id="level" placeholder="Dates" value="From - To">
                    <input type="text" name="Thours" id="level" placeholder="No. Hours">
                    <input type="text" name="Tid" id="level" placeholder="Type of ID">
                    <input type="text" name="Tposition" id="level" placeholder="Position">
                </div>
            </div>
            <!--LEARNING AND DEVELOPMENT (L&D) / INTERVENTIONS / TRAINING PROGRAMS ATTENDED-->
            <!--OTHER INFORMATION-->
            <h1 class="header-span">VII. Other Information</h1>
            <div class="other-information">
                <div class="odd-headers-three">
                    <label class="header-middle">SPECIAL SKILLS and HOBBIES</label>
                    <label class="header-middle">NON ACADEMIC DISTINCTIONS / RECOGNITION (Write in full)</label>
                    <label class="header-middle">MEMBERSHIP IN ASSOCIATION ORGANIZATION</label>
                </div> 
                <div class="odd-headers-three group">
                    <input type="text" name="Fskills" id="level" placeholder="Skills">
                    <input type="text" name="Facademicdistictions" id="level" placeholder="Academic Distinctions">
                    <input type="text" name="Fmembership" id="level" placeholder="Membership in Association Organization">
                </div>
                <div class="odd-headers-three group">
                    <input type="text" name="Sskills" id="level" placeholder="Skills">
                    <input type="text" name="Sacademicdistictions" id="level" placeholder="Academic Distinctions">
                    <input type="text" name="Smembership" id="level" placeholder="Membership in Association Organization">
                </div>
                <div class="odd-headers-three group">
                    <input type="text" name="Tskills" id="level" placeholder="Skills">
                    <input type="text" name="Tacademicdistictions" id="level" placeholder="Academic Distinctions">
                    <input type="text" name="Tmembership" id="level" placeholder="Membership in Association Organization">
                </div>
                <div class="other-info-span">
                    <div class="contact">
                        <label class="group">CONTACT PERSON IN CASE OF EMERGENCY</label>
                        <div class="group">
                            <label class="label-width">A. FULL NAME</label>
                            <input type="text" id="contactfullname" name="contactfullname" placeholder="Full Name">
                        </div>
                        <div class="group">
                            <label class="label-width">B. RELATIONSHIP</label>
                            <input type="text" id="contactrelationship" name="contactrelationship" placeholder="Relationship">
                        </div>
                        <div class="group">
                            <label class="label-width">C. ADDRESS</label>
                            <input type="text" id="contactaddress" name="contactaddress" placeholder="Contact Address">
                        </div>
                        <div class="group">
                            <label class="label-width">D. NUMBER</label>
                            <input type="text" id="contactnumber" name="contactnumber" placeholder="Contact Number">
                        </div>
                        <label class="group">REFERENCES</label>
                        <div class="odd-headers-three">
                            <label class="header-middle">NAME</label>
                            <label class="header-middle">ADDRESS</label>
                            <label class="header-middle">TEL NO</label>
                        </div> 
                        <div class="group-contact group">
                            <input type="text" name="Freferencename" id="referencename" placeholder="Reference 1 Name">
                            <input type="text" name="Freferenceaddress" id="referenceaddress" placeholder="Reference 1 Address">
                            <input type="text" name="Freferencetel" id="referencetel" placeholder="Reference 1 Tel No.">
                        </div>
                        <div class="group-contact group">
                            <input type="text" name="Sreferencename" id="referencename" placeholder="Reference 2 Name">
                            <input type="text" name="Sreferenceaddress" id="referenceaddress" placeholder="Reference 2 Address">
                            <input type="text" name="Sreferencetel" id="referencetel" placeholder="Reference 2 Tel No.">
                        </div>
                        <div class="group-contact group">
                            <input type="text" name="Treferencename" id="referencename" placeholder="Reference 3 Name">
                            <input type="text" name="Treferenceaddress" id="referenceaddress" placeholder="Reference 3 Address">
                            <input type="text" name="Treferencetel" id="referencetel" placeholder="Reference 3 Tel No.">
                        </div>
                        <label class="group">35. I declare under oath that I have personally accomplished this Personal Data Sheet. I acknowledge and consent to the collection, use, and storage of my data by TCL Sun, Inc. in accordance with the RA 10173 Data Privacy Act of 2012 laws and regulations

                            I agree that any misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s against me.</label>
                    </div>
                    <div class="picture-wrapper">
                        <div class="picture">
                            ID picture taken within
                            the last 6 months
                            3.5 cm. X 4.5 cm
                            (passport size)

                            With full and handwritten
                            name tag and signature over
                            printed name

                            Computer generated
                            or photocopied picture
                            is not acceptable
                        </div>
                    </div>
                </div>
                <div class="oath">
                    <h3>SUBSCRIBED AND SWORN to before me this ________________________, affiant exhibiting his/her validity issued goverment id as indicated above</h3>
                    <input type="text" id="block" readonly>
                    <input type="text" id="block" placeholder="Person Administering Oath" readonly>
                </div>
            </div>
            <!--OTHER INFORMATION-->
            <button class="final-btn" type="button" id="submit">Finalize Form</button>
        </form>
    </main>
    <script>
        const inputs = document.querySelectorAll('form input, form select, form textarea');
        const confirmDiv = document.getElementById("form-group-confirm");
        const main = document.getElementsByTagName('main')[0];
        const showConfirm = document.getElementById("confirm");

        document.getElementById('back').addEventListener("click", () => {
            window.location.href = "tcl.php";
        });

        document.getElementById('back-apply').addEventListener("click", () => {
            main.style.display = 'flex';
            showConfirm.style.display = 'none';
            
        });

        
        document.getElementById('submit').addEventListener("click", () => {
            // Hide main and show confirmation
            main.style.display = 'none';
            showConfirm.style.display = 'block';

            // Empty confirmDiv before appending new elements
            confirmDiv.innerHTML = '';

            // Iterate through each input element
            inputs.forEach(input => {
            // Create a new div to wrap the label and input
            const wrapperDiv = document.createElement('div');
            wrapperDiv.className = 'inline';

            const valueLabel = document.createElement('label');
            valueLabel.textContent = input.placeholder;

            let clone;

            if (input.tagName === 'TEXTAREA') {
                // Create a new input element with the same attributes as the textarea
                clone = document.createElement('input');
                clone.type = 'text'; // Use 'text' type for textarea equivalent
                clone.placeholder = input.placeholder;
                clone.name = input.name;
                clone.value = input.value;
            } else if (input.tagName === 'SELECT') {
                // Create a new input element with the same attributes as the select
                clone = document.createElement('input');
                clone.type = 'text'; // Use 'text' type for select equivalent
                clone.placeholder = input.placeholder;
                clone.name = input.name;
                clone.value = input.options[input.selectedIndex].text;
            } else {
                // Clone input elements directly
                clone = input.cloneNode(true);
            }

            // Append the label and input to the wrapper div
            wrapperDiv.appendChild(valueLabel);
            wrapperDiv.appendChild(clone);

            // Append the wrapper div to confirmDiv
            confirmDiv.appendChild(wrapperDiv);
        });

        // Create and append the submit button
        const submitButton = document.createElement('button');
            submitButton.type = 'submit'; // Ensure this is a submit button
            submitButton.textContent = 'Confirm';
            submitButton.className = 'confirm-submit'; // Optionally, add a class for styling
            confirmDiv.appendChild(submitButton);
        });
    </script>
</body>
</html>