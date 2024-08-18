<?php
session_start();
    include("./static/connection.php");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $userId = $_GET['userId'] ?? 'No value provided';
        $query = "SELECT * FROM applicant WHERE user_id = '$userId' limit 1";
        $query_response = mysqli_query($sql_connection, $query);
        $user = mysqli_fetch_assoc($query_response);
        $user_id = $user['user_id'];

        $user_query_data = [];

        $queries = [
            'personal' => "SELECT * FROM personal_information WHERE user_id = '$user_id'",
            'family' =>  "SELECT * FROM family_background WHERE user_id = '$user_id'",
            'educational' => "SELECT * FROM educational_background WHERE user_id = '$user_id'",
            'work' => "SELECT * FROM work_background WHERE user_id = '$user_id'",
            'voluntary' =>  "SELECT * FROM voluntary_work WHERE user_id = '$user_id'",
            'ld' => "SELECT * FROM learning_and_development WHERE user_id = '$user_id'",
            'other' => "SELECT * FROM other_information WHERE user_id = '$user_id'"
        ];

        foreach($queries as $property => $value){
            $query_response = mysqli_query($sql_connection, $value);
            $user_query_data[$property] = mysqli_fetch_assoc($query_response);
        }
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
            font-size: 12px;
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
            font-size: 8px;
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
            font-size: 10px;
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
            font-size: .5em;
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
            position: absolute;
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
            min-height: 100vh;
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
            
            .other-info-span{
                border-top: 1px solid black;
                margin-top: 300px;
            }
            
            button{
                display: none;
            }
        }

    </style>
</head>
<body>
    <button class="shrink" type="button" id="back">Back</button>
    <main class="flex">
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
                    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user_query_data['personal']['surname'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user_query_data['personal']['first_name'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="middlename">Middle Name</label>
                    <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($user_query_data['personal']['middle_name'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user_query_data['personal']['dob'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="place-of-birth">Place of Birth</label>
                    <input type="text" id="place-of-birth" name="placeofbirth" value="<?php echo htmlspecialchars($user_query_data['personal']['place_of_birth'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="citizenship">Citizenship</label>
                    <input type="text" id="citizenship" name="citizenship" value="<?php echo htmlspecialchars($user_query_data['personal']['citizenship'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="sex">Sex</label>
                    <input type="text" id="sex" name="sex" value="<?php echo htmlspecialchars($user_query_data['personal']['sex'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="civil-status">Civil Status</label>
                    <input type="text" id="civil-status" name="civilstatus" value="<?php echo htmlspecialchars($user_query_data['personal']['civil_status'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="height">Height (cm)</label>
                    <input type="number" id="height" name="height" step="0.01" value="<?php echo htmlspecialchars($user_query_data['personal']['height'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" step="0.01" value="<?php echo htmlspecialchars($user_query_data['personal']['weight'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="blood-type">Blood Type</label>
                    <input type="text" id="blood-type" name="bloodtype" value="<?php echo htmlspecialchars($user_query_data['personal']['blood_type'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="driverlicense">Driver's License ID</label>
                    <input type="text" id="driverlicense" name="driverlicense" value="<?php echo htmlspecialchars($user_query_data['personal']['driver_license'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="pag-ibig">Pag Ibig NO.</label>
                    <input type="text" id="pag-ibig" name="pagibig" value="<?php echo htmlspecialchars($user_query_data['personal']['pag_ibig'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="phil-health">Philhealth NO.</label>
                    <input type="text" id="phil-health" name="philhealth" value="<?php echo htmlspecialchars($user_query_data['personal']['phil_health'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="sss">SSS NO.</label>
                    <input type="text" id="sss" name="sss" value="<?php echo htmlspecialchars($user_query_data['personal']['sss'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="tin">TIN NO.</label>
                    <input type="text" id="tin" name="tin" value="<?php echo htmlspecialchars($user_query_data['personal']['tin'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="other-id">Other ID</label>
                    <input type="text" id="other-id" name="otherid" value="<?php echo htmlspecialchars($user_query_data['personal']['other_id'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" id="phone-number" name="phonenumber" value="<?php echo htmlspecialchars($user_query_data['personal']['phone_number'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="telephone">Telephone</label>
                    <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($user_query_data['personal']['telephone'] ?? ''); ?>" readonly>
                </div>
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_query_data['personal']['email'] ?? ''); ?>" readonly>
                </div>
                <div class="group span">
                    <label for="res-address">Residential Address</label>
                    <textarea id="res-address" name="resaddress" readonly><?php echo htmlspecialchars($user_query_data['personal']['res_address'] ?? ''); ?></textarea>
                </div>
                <div class="group span">
                    <label for="perm-address">Permanent Address</label>
                    <textarea id="perm-address" name="permaddress" readonly><?php echo htmlspecialchars($user_query_data['personal']['perm_address'] ?? ''); ?></textarea>
                </div>      
            </div>
            <!--PERSONAL INFO INPUTS-->
            <!--FAMILY INFO INPUTS-->
            <!-- FAMILY BACKGROUND INPUTS -->
            <h1 class="header-span">II. Family Background</h1>
            <div class="family-background wrapper-span-full flex">
                <!-- Spouse's Information -->
                <div class="span no-border group">
                    <label for="spouse">Spouse's Information</label>
                    <div class="column">
                        <input type="text" id="spouse-surname" name="spousesurname" value="<?php echo htmlspecialchars($user_query_data['family']['spouse_surname'] ?? ''); ?>" readonly placeholder="Spouse's Surname">
                        <input type="text" id="spouse-first-name" name="spousefirstname" value="<?php echo htmlspecialchars($user_query_data['family']['spouse_firstname'] ?? ''); ?>" readonly placeholder="Spouse's First Name">
                    </div>
                    <div class="column">
                        <input type="text" id="spouse-middle-name" name="spousemiddlename" value="<?php echo htmlspecialchars($user_query_data['family']['spouse_middlename'] ?? ''); ?>" readonly placeholder="Spouse's Middle Name">
                        <input type="text" id="spouse-occupation" name="spouseoccupation" value="<?php echo htmlspecialchars($user_query_data['family']['spouse_occupation'] ?? ''); ?>" readonly placeholder="Spouse's Occupation">
                    </div>
                </div>

                <!-- Father's Information -->
                <div class="span height-max no-border group">
                    <label for="father">Father's Information</label>
                    <div class="width-max column">
                        <input type="text" id="father-surname" name="fathersurname" value="<?php echo htmlspecialchars($user_query_data['family']['father_surname'] ?? ''); ?>" readonly placeholder="Father's Surname">
                        <input type="text" id="father-first-name" name="fatherfirstname" value="<?php echo htmlspecialchars($user_query_data['family']['father_firstname'] ?? ''); ?>" readonly placeholder="Father's First Name">
                        <input type="text" id="father-middle-name" name="fathermiddlename" value="<?php echo htmlspecialchars($user_query_data['family']['father_middlename'] ?? ''); ?>" readonly placeholder="Father's Middle Name">
                    </div>
                </div>

                <!-- Mother's Information -->
                <div class="span height-max no-border group">
                    <label for="mother">Mother's Information</label>
                    <div class="width-max column">
                        <input type="text" id="mother-maiden-name" name="mothermaidenname" value="<?php echo htmlspecialchars($user_query_data['family']['mother_maidenname'] ?? ''); ?>" readonly placeholder="Mother's Maiden Name">
                        <input type="text" id="mother-first-name" name="motherfirstname" value="<?php echo htmlspecialchars($user_query_data['family']['mother_firstname'] ?? ''); ?>" readonly placeholder="Mother's First Name">
                        <input type="text" id="mother-middle-name" name="mothermiddlename" value="<?php echo htmlspecialchars($user_query_data['family']['mother_middlename'] ?? ''); ?>" readonly placeholder="Mother's Middle Name">
                    </div>
                </div>
            </div>
            <!--FAMILY INFO INPUTS-->
            <!--EDUCATIONAL INFO INPUTS-->
            <!-- EDUCATIONAL BACKGROUND INPUTS -->
            <h1 class="header-span">III. Educational Background</h1>
            <div class="educational-background wrapper-span-full flex">
                <!-- Headers -->
                <div class="group-inline header group span ">
                    <label class="header-middle">LEVEL</label>
                    <label class="header-middle">NAME OF SCHOOL</label>
                    <label class="header-middle">BASIC EDUCATION DEGREE/COURSE</label>
                    <label class="header-middle">PERIOD OF ATTENDANCE</label>
                    <label class="header-middle">HIGHEST LEVEL/UNIT EARNED (IF NOT GRADUATE)</label>
                    <label class="header-middle">YEAR GRADUATE</label>
                    <label class="header-middle">SCHOLARSHIP/ACADEMIC HONORS</label>
                </div>

                <!-- Elementary -->
                <div class="group-inline group" id="elementary">
                    <input class="border" type="text" value="ELEMENTARY" readonly style="background-color: #efefef;">
                    <input type="text" name="elementary_name" id="elementary-schoolname" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_name'] ?? ''); ?>" readonly placeholder="School Name">
                    <input type="text" name="elementary_degree" id="elementary-degree" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_degree'] ?? ''); ?>" readonly placeholder="Degree">
                    <input type="text" name="elementary_attendance" id="elementary-attendance" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_attendance'] ?? 'From - To | Ex. 2020-2021'); ?>" readonly placeholder="Period of Attendance">
                    <input type="text" name="elementary_levelearned" id="elementary-levelearned" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_levelearned'] ?? ''); ?>" readonly placeholder="Highest Level">
                    <input type="text" name="elementary_yeargraduated" id="elementary-yeargraduated" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_yeargraduated'] ?? ''); ?>" readonly placeholder="Year Graduate">
                    <input type="text" name="elementary_honors" id="elementary-honors" value="<?php echo htmlspecialchars($user_query_data['education']['elementary_honors'] ?? ''); ?>" readonly placeholder="Academic Honors">
                </div>

                <!-- Secondary -->
                <div class="group-inline group" id="secondary">
                    <input class="border" type="text" style="background-color: #efefef;" value="SECONDARY" readonly>
                    <input type="text" name="secondary_name" id="secondary-schoolname" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_name'] ?? ''); ?>" readonly placeholder="School Name">
                    <input type="text" name="secondary_degree" id="secondary-degree" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_degree'] ?? ''); ?>" readonly placeholder="Degree">
                    <input type="text" name="secondary_attendance" id="secondary-attendance" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_attendance'] ?? 'From - To | Ex. 2020-2021'); ?>" readonly placeholder="Period of Attendance">
                    <input type="text" name="secondary_levelearned" id="secondary-levelearned" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_levelearned'] ?? ''); ?>" readonly placeholder="Highest Level">
                    <input type="text" name="secondary_yeargraduated" id="secondary-yeargraduated" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_yeargraduated'] ?? ''); ?>" readonly placeholder="Year Graduate">
                    <input type="text" name="secondary_honors" id="secondary-honors" value="<?php echo htmlspecialchars($user_query_data['education']['secondary_honors'] ?? ''); ?>" readonly placeholder="Academic Honors">
                </div>

                <!-- Vocational -->
                <div class="group-inline group" id="vocational">
                    <input class="border" type="text" style="background-color: #efefef;" value="VOCATIONAL/TRADE" readonly>
                    <input type="text" name="vocational_name" id="vocational-schoolname" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_name'] ?? ''); ?>" readonly placeholder="School Name">
                    <input type="text" name="vocational_degree" id="vocational-degree" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_degree'] ?? ''); ?>" readonly placeholder="Degree">
                    <input type="text" name="vocational_attendance" id="vocational-attendance" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_attendance'] ?? 'From - To | Ex. 2020-2021'); ?>" readonly placeholder="Period of Attendance">
                    <input type="text" name="vocational_levelearned" id="vocational-levelearned" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_levelearned'] ?? ''); ?>" readonly placeholder="Highest Level">
                    <input type="text" name="vocational_yeargraduated" id="vocational-yeargraduated" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_yeargraduated'] ?? ''); ?>" readonly placeholder="Year Graduate">
                    <input type="text" name="vocational_honors" id="vocational-honors" value="<?php echo htmlspecialchars($user_query_data['education']['vocational_honors'] ?? ''); ?>" readonly placeholder="Academic Honors">
                </div>

                <!-- College -->
                <div class="group-inline group" id="college">
                    <input class="border" type="text" style="background-color: #efefef;" value="COLLEGE" readonly>
                    <input type="text" name="college_name" id="college-schoolname" value="<?php echo htmlspecialchars($user_query_data['education']['college_name'] ?? ''); ?>" readonly placeholder="School Name">
                    <input type="text" name="college_degree" id="college-degree" value="<?php echo htmlspecialchars($user_query_data['education']['college_degree'] ?? ''); ?>" readonly placeholder="Degree">
                    <input type="text" name="college_attendance" id="college-attendance" value="<?php echo htmlspecialchars($user_query_data['education']['college_attendance'] ?? 'From - To | Ex. 2020-2021'); ?>" readonly placeholder="Period of Attendance">
                    <input type="text" name="college_levelearned" id="college-levelearned" value="<?php echo htmlspecialchars($user_query_data['education']['college_levelearned'] ?? ''); ?>" readonly placeholder="Highest Level">
                    <input type="text" name="college_yeargraduated" id="college-yeargraduated" value="<?php echo htmlspecialchars($user_query_data['education']['college_yeargraduated'] ?? ''); ?>" readonly placeholder="Year Graduate">
                    <input type="text" name="college_honors" id="college-honors" value="<?php echo htmlspecialchars($user_query_data['education']['college_honors'] ?? ''); ?>" readonly placeholder="Academic Honors">
                </div>

                <!-- Graduate Studies -->
                <div class="group-inline group" id="graduate-studies">
                    <input class="border" type="text" style="background-color: #efefef;" value="GRADUATE STUDIES" readonly>
                    <input type="text" name="graduate_studies_name" id="graduate-studies-schoolname" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_name'] ?? ''); ?>" readonly placeholder="School Name">
                    <input type="text" name="graduate_studies_degree" id="graduate-studies-degree" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_degree'] ?? ''); ?>" readonly placeholder="Degree">
                    <input type="text" name="graduate_studies_attendance" id="graduate-studies-attendance" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_attendance'] ?? 'From - To | Ex. 2020-2021'); ?>" readonly placeholder="Period of Attendance">
                    <input type="text" name="graduate_studies_levelearned" id="graduate-studies-levelearned" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_levelearned'] ?? ''); ?>" readonly placeholder="Highest Level">
                    <input type="text" name="graduate_studies_yeargraduated" id="graduate-studies-yeargraduated" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_yeargraduated'] ?? ''); ?>" readonly placeholder="Year Graduate">
                    <input type="text" name="graduate_studies_honors" id="graduate-studies-honors" value="<?php echo htmlspecialchars($user_query_data['education']['graduate_studies_honors'] ?? ''); ?>" readonly placeholder="Academic Honors">
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
                    <input type="text" name="Fworkdate" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fdates'] ?? 'From - To | Ex. 2020-2021'); ?>" placeholder="Work Experience 1" readonly>
                    <input type="text" name="Fposition" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fposition_title'] ?? ''); ?>" placeholder="Position" readonly>
                    <input type="text" name="Fcompany" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fdepartment'] ?? ''); ?>" placeholder="Company" readonly>
                    <input type="text" name="Fmonthlysalary" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fmonthly_salary'] ?? ''); ?>" placeholder="Monthly Salary" readonly>
                    <input type="text" name="Fpaygrade" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fpay_grade'] ?? ''); ?>" placeholder="Pay Grade" readonly>
                    <input type="text" name="Fstatusofappointment" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Fstatus_of_appointment'] ?? ''); ?>" placeholder="Status of Appointment" readonly>
                    <select name="Fgoverment" id="Government" readonly>
                        <option value="yes" <?php echo ($user_query_data['work']['Fgovt_service'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo ($user_query_data['work']['Fgovt_service'] === 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                <div class="group-inline group">
                    <input type="text" name="Sworkdate" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Sdates'] ?? 'From - To | Ex. 2020-2021'); ?>" placeholder="Work Experience 2" readonly>
                    <input type="text" name="Sposition" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Sposition_title'] ?? ''); ?>" placeholder="Position" readonly>
                    <input type="text" name="Scompany" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Sdepartment'] ?? ''); ?>" placeholder="Company" readonly>
                    <input type="text" name="Smonthlysalary" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Smonthly_salary'] ?? ''); ?>" placeholder="Monthly Salary" readonly>
                    <input type="text" name="Spaygrade" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Spay_grade'] ?? ''); ?>" placeholder="Pay Grade" readonly>
                    <input type="text" name="Sstatusofappointment" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Sstatus_of_appointment'] ?? ''); ?>" placeholder="Status of Appointment" readonly>
                    <select name="Sgoverment" id="goverment" readonly>
                        <option value="yes" <?php echo ($user_query_data['work']['Sgovt_service'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo ($user_query_data['work']['Sgovt_service'] === 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                <div class="group-inline group">
                    <input type="text" name="Tworkdate" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tdates'] ?? 'From - To | Ex. 2020-2021'); ?>" placeholder="Work Experience 3" readonly>
                    <input type="text" name="Tposition" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tposition_title'] ?? ''); ?>" placeholder="Position" readonly>
                    <input type="text" name="Tcompany" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tdepartment'] ?? ''); ?>" placeholder="Company" readonly>
                    <input type="text" name="Tmonthlysalary" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tmonthly_salary'] ?? ''); ?>" placeholder="Monthly Salary" readonly>
                    <input type="text" name="Tpaygrade" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tpay_grade'] ?? ''); ?>" placeholder="Pay Grade" readonly>
                    <input type="text" name="Tstatusofappointment" id="level" value="<?php echo htmlspecialchars($user_query_data['work']['Tstatus_of_appointment'] ?? ''); ?>" placeholder="Status of Appointment" readonly>
                    <select name="Tgoverment" id="goverment" readonly>
                        <option value="yes" <?php echo ($user_query_data['work']['Tgovt_service'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo ($user_query_data['work']['Tgovt_service'] === 'no') ? 'selected' : ''; ?>>No</option>
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
                    <input type="text" name="Fnameoforg" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Forg_name'] ?? ''); ?>" placeholder="Organization Name" readonly>
                    <input type="text" name="Fdates" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Fdates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Fhours" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Fhours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Fid" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Fid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Fposition" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Fposition'] ?? ''); ?>" placeholder="Position" readonly>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Snameoforg" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Sorg_name'] ?? ''); ?>" placeholder="Organization Name" readonly>
                    <input type="text" name="Sdates" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Sdates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Shours" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Shours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Sid" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Sid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Sposition" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Sposition'] ?? ''); ?>" placeholder="Position" readonly>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Tnameoforg" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Torg_name'] ?? ''); ?>" placeholder="Organization Name" readonly>
                    <input type="text" name="Tdates" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Tdates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Thours" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Thours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Tid" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Tid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Tposition" id="level" value="<?php echo htmlspecialchars($user_query_data['voluntary']['Tposition'] ?? ''); ?>" placeholder="Position" readonly>
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
                    <input type="text" name="Ftitle" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ftraining_program'] ?? ''); ?>" placeholder="Title" readonly>
                    <input type="text" name="Fdates" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ftraining_dates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Fhours" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ftraining_hours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Fid" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Fid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Fposition" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Fconducted_sponsored_by'] ?? ''); ?>" placeholder="Conducted / Sponsored By" readonly>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Stitle" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Straining_program'] ?? ''); ?>" placeholder="Title" readonly>
                    <input type="text" name="Sdates" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Straining_dates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Shours" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Straining_hours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Sid" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Sid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Sposition" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Sconducted_sponsored_by'] ?? ''); ?>" placeholder="Conducted / Sponsored By" readonly>
                </div>
                <div class="odd-headers group">
                    <input type="text" name="Ttitle" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ttraining_program'] ?? ''); ?>" placeholder="Title" readonly>
                    <input type="text" name="Tdates" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ttraining_dates'] ?? 'From - To'); ?>" placeholder="Dates" readonly>
                    <input type="text" name="Thours" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Ttraining_hours'] ?? ''); ?>" placeholder="No. Hours" readonly>
                    <input type="text" name="Tid" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Tid_type'] ?? ''); ?>" placeholder="Type of ID" readonly>
                    <input type="text" name="Tposition" id="level" value="<?php echo htmlspecialchars($user_query_data['ld']['Tconducted_sponsored_by'] ?? ''); ?>" placeholder="Conducted / Sponsored By" readonly>
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
                    <input type="text" name="Fskills" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['special_skills'] ?? ''); ?>" placeholder="Skills" readonly>
                    <input type="text" name="Facademicdistictions" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['non_academic_distinctions'] ?? ''); ?>" placeholder="Academic Distinctions" readonly>
                    <input type="text" name="Fmembership" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['membership_in_association'] ?? ''); ?>" placeholder="Membership in Association Organization" readonly>
                </div>
                <div class="odd-headers-three group">
                    <input type="text" name="Sskills" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['special_skills_2'] ?? ''); ?>" placeholder="Skills" readonly>
                    <input type="text" name="Sacademicdistictions" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['non_academic_distinctions_2'] ?? ''); ?>" placeholder="Academic Distinctions" readonly>
                    <input type="text" name="Smembership" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['membership_in_association_2'] ?? ''); ?>" placeholder="Membership in Association Organization" readonly>
                </div>
                <div class="odd-headers-three group">
                    <input type="text" name="Tskills" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['special_skills_3'] ?? ''); ?>" placeholder="Skills" readonly>
                    <input type="text" name="Tacademicdistictions" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['non_academic_distinctions_3'] ?? ''); ?>" placeholder="Academic Distinctions" readonly>
                    <input type="text" name="Tmembership" id="level" value="<?php echo htmlspecialchars($user_query_data['other']['membership_in_association_3'] ?? ''); ?>" placeholder="Membership in Association Organization" readonly>
                </div>
                <div class="other-info-span">
                    <div class="contact">
                        <label class="group">CONTACT PERSON IN CASE OF EMERGENCY</label>
                        <div class="group">
                            <label class="label-width">A. FULL NAME</label>
                            <input type="text" id="contactfullname" name="contactfullname" value="<?php echo htmlspecialchars($user_query_data['other']['contact_person'] ?? ''); ?>" placeholder="Full Name" readonly>
                        </div>
                        <div class="group">
                            <label class="label-width">B. RELATIONSHIP</label>
                            <input type="text" id="contactrelationship" name="contactrelationship" value="<?php echo htmlspecialchars($user_query_data['other']['contact_relationship'] ?? ''); ?>" placeholder="Relationship" readonly>
                        </div>
                        <div class="group">
                            <label class="label-width">C. ADDRESS</label>
                            <input type="text" id="contactaddress" name="contactaddress" value="<?php echo htmlspecialchars($user_query_data['other']['contact_address'] ?? ''); ?>" placeholder="Contact Address" readonly>
                        </div>
                        <div class="group">
                            <label class="label-width">D. NUMBER</label>
                            <input type="text" id="contactnumber" name="contactnumber" value="<?php echo htmlspecialchars($user_query_data['other']['contact_number'] ?? ''); ?>" placeholder="Contact Number" readonly>
                        </div>
                        <label class="group">REFERENCES</label>
                        <div class="odd-headers-three">
                            <label class="header-middle">NAME</label>
                            <label class="header-middle">ADDRESS</label>
                            <label class="header-middle">TEL NO</label>
                        </div>
                        <div class="group-contact group">
                            <input type="text" name="Freferencename" id="referencename" value="<?php echo htmlspecialchars($user_query_data['other']['reference1'] ?? ''); ?>" placeholder="Reference 1 Name" readonly>
                            <input type="text" name="Freferenceaddress" id="referenceaddress" value="<?php echo htmlspecialchars($user_query_data['other']['reference1_add'] ?? ''); ?>" placeholder="Reference 1 Address" readonly>
                            <input type="text" name="Freferencetel" id="referencetel" value="<?php echo htmlspecialchars($user_query_data['other']['reference1_tel'] ?? ''); ?>" placeholder="Reference 1 Tel No." readonly>
                        </div>
                        <div class="group-contact group">
                            <input type="text" name="Sreferencename" id="referencename" value="<?php echo htmlspecialchars($user_query_data['other']['reference2'] ?? ''); ?>" placeholder="Reference 2 Name" readonly>
                            <input type="text" name="Sreferenceaddress" id="referenceaddress" value="<?php echo htmlspecialchars($user_query_data['other']['reference2_add'] ?? ''); ?>" placeholder="Reference 2 Address" readonly>
                            <input type="text" name="Sreferencetel" id="referencetel" value="<?php echo htmlspecialchars($user_query_data['other']['reference2_tel'] ?? ''); ?>" placeholder="Reference 2 Tel No." readonly>
                        </div>
                        <div class="group-contact group">
                            <input type="text" name="Treferencename" id="referencename" value="<?php echo htmlspecialchars($user_query_data['other']['reference3'] ?? ''); ?>" placeholder="Reference 3 Name" readonly>
                            <input type="text" name="Treferenceaddress" id="referenceaddress" value="<?php echo htmlspecialchars($user_query_data['other']['reference3_add'] ?? ''); ?>" placeholder="Reference 3 Address" readonly>
                            <input type="text" name="Treferencetel" id="referencetel" value="<?php echo htmlspecialchars($user_query_data['other']['reference3_tel'] ?? ''); ?>" placeholder="Reference 3 Tel No." readonly>
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
                    <h3>SUBSCRIBED AND SWORN to before me this ________________________, affiant exhibiting his/her validity issued government id as indicated above</h3>
                    <input type="text" id="block" readonly>
                    <input type="text" id="block" placeholder="Person Administering Oath" readonly>
                </div>
                </div>

            <!--OTHER INFORMATION-->
        </form>
    </main>
    <script>
        document.getElementById('back').addEventListener("click", () => {
            window.location.href = "dashboard.php";
            <?php $_SESSION['ADMIN'] = true; ?>
        });

;
    </script>
</body>
</html>