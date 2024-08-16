<?php
session_start();

require("./static/functions.php");
require("./static/connection.php");

$flash_message = new FlashMessage();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = unique_id($sql_connection); 
    $statuss = false;

    $query = "INSERT INTO applicant (user_id, status) VALUES ('$user_id', '$statuss')";

    mysqli_query($sql_connection,$query);

    // Check if user already posted application //
    $query_user_personal = "SELECT * FROM personal_information WHERE user_id = '$user_id' limit 1";
    $query_user_family = "SELECT * FROM family_background WHERE user_id = '$user_id' limit 1";
    $query_user_program = "SELECT * FROM learning_and_development WHERE user_id = '$user_id' limit 1";
    $query_user_other = "SELECT * FROM other_information WHERE user_id = '$user_id' limit 1";
    $query_user_voluntary = "SELECT * FROM voluntary_work WHERE user_id = '$user_id' limit 1";
    $query_user_work = "SELECT * FROM work_experience WHERE user_id = '$user_id' limit 1";
    $query_user_educational = "SELECT * FROM educational_background WHERE user_id = '$user_id' limit 1";
    
    // Results
    $result_personal = mysqli_query($sql_connection, $query_user_personal);
    $result_family = mysqli_query($sql_connection, $query_user_family);
    $result_program = mysqli_query($sql_connection, $query_user_program);
    $result_other = mysqli_query($sql_connection, $query_user_other);
    $result_voluntary = mysqli_query($sql_connection, $query_user_voluntary);
    $result_work = mysqli_query($sql_connection, $query_user_work);
    $result_educational = mysqli_query($sql_connection, $query_user_educational);
    
    if (mysqli_num_rows($result_personal) > 0 || mysqli_num_rows($result_family) > 0 || mysqli_num_rows($result_program) > 0 || 
        mysqli_num_rows($result_other) > 0 || mysqli_num_rows($result_voluntary) > 0 || mysqli_num_rows($result_work) > 0 || 
        mysqli_num_rows($result_educational) > 0){
        $flash_message->Set("You Already Submitted","error");
    }
    else {
        // Personal Information Post Data
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($sql_connection, $_POST['surname']) : null;
        $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($sql_connection, $_POST['firstname']) : null;
        $middlename = isset($_POST['middlename']) ? mysqli_real_escape_string($sql_connection, $_POST['middlename']) : null;
        $dob = isset($_POST['dob']) ? mysqli_real_escape_string($sql_connection, $_POST['dob']) : null;
        $place_of_birth = isset($_POST['placeofbirth']) ? mysqli_real_escape_string($sql_connection, $_POST['placeofbirth']) : null;
        $citizenship = isset($_POST['citizenship']) ? mysqli_real_escape_string($sql_connection, $_POST['citizenship']) : null;
        $sex = isset($_POST['sex']) ? mysqli_real_escape_string($sql_connection, $_POST['sex']) : null;
        $civil_status = isset($_POST['civilstatus']) ? mysqli_real_escape_string($sql_connection, $_POST['civilstatus']) : null;
        $height = isset($_POST['height']) ? mysqli_real_escape_string($sql_connection, $_POST['height']) : null;
        $weight = isset($_POST['weight']) ? mysqli_real_escape_string($sql_connection, $_POST['weight']) : null;
        $blood_type = isset($_POST['bloodtype']) ? mysqli_real_escape_string($sql_connection, $_POST['bloodtype']) : null;
        $driver_license = isset($_POST['driverlicense']) ? mysqli_real_escape_string($sql_connection, $_POST['driverlicense']) : null;
        $pag_ibig = isset($_POST['pagibig']) ? mysqli_real_escape_string($sql_connection, $_POST['pagibig']) : null;
        $phil_health = isset($_POST['philhealth']) ? mysqli_real_escape_string($sql_connection, $_POST['philhealth']) : null;
        $sss = isset($_POST['sss']) ? mysqli_real_escape_string($sql_connection, $_POST['sss']) : null;
        $tin = isset($_POST['tin']) ? mysqli_real_escape_string($sql_connection, $_POST['tin']) : null;
        $other_id = isset($_POST['otherid']) ? mysqli_real_escape_string($sql_connection, $_POST['otherid']) : null;
        $phone_number = isset($_POST['phonenumber']) ? mysqli_real_escape_string($sql_connection, $_POST['phonenumber']) : null;
        $telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($sql_connection, $_POST['telephone']) : null;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($sql_connection, $_POST['email']) : null;
        $res_address = isset($_POST['resaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['resaddress']) : null;
        $perm_address = isset($_POST['permaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['permaddress']) : null;

        // Family Post Data
        $spouse_surname = isset($_POST['spousesurname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousesurname']) : null;
        $spouse_first_name = isset($_POST['spousefirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousefirstname']) : null;
        $spouse_middle_name = isset($_POST['spousemiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['spousemiddlename']) : null;
        $spouse_occupation = isset($_POST['spouseoccupation']) ? mysqli_real_escape_string($sql_connection, $_POST['spouseoccupation']) : null;

        $father_surname = isset($_POST['fathersurname']) ? mysqli_real_escape_string($sql_connection, $_POST['fathersurname']) : null;
        $father_first_name = isset($_POST['fatherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['fatherfirstname']) : null;
        $father_middle_name = isset($_POST['fathermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['fathermiddlename']) : null;

        $mother_maiden_name = isset($_POST['mothermaidenname']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermaidenname']) : null;
        $mother_first_name = isset($_POST['motherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['motherfirstname']) : null;
        $mother_middle_name = isset($_POST['mothermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermiddlename']) : null;

        // Education Post Data
        $elementary_name = isset($_POST['elementaryname']) ? mysqli_real_escape_string($sql_connection, $_POST['elementaryname']) : null;
        $elementary_year_graduated = isset($_POST['elementaryyearGraduated']) ? mysqli_real_escape_string($sql_connection, $_POST['elementaryyearGraduated']) : null;
        $elementary_period_attendance = isset($_POST['elementaryperiodAttendance']) ? mysqli_real_escape_string($sql_connection, $_POST['elementaryperiodAttendance']) : null;
        $elementary_highest_level_earned = isset($_POST['elementaryhighestLevelEarned']) ? mysqli_real_escape_string($sql_connection, $_POST['elementaryhighestLevelEarned']) : null;
        $elementary_year_graduated_again = isset($_POST['elementaryyearGraduatedAgain']) ? mysqli_real_escape_string($sql_connection, $_POST['elementaryyearGraduatedAgain']) : null;

        $secondary_name = isset($_POST['secondaryname']) ? mysqli_real_escape_string($sql_connection, $_POST['secondaryname']) : null;
        $secondary_year_graduated = isset($_POST['secondaryyearGraduated']) ? mysqli_real_escape_string($sql_connection, $_POST['secondaryyearGraduated']) : null;
        $secondary_period_attendance = isset($_POST['secondaryperiodAttendance']) ? mysqli_real_escape_string($sql_connection, $_POST['secondaryperiodAttendance']) : null;
        $secondary_highest_level_earned = isset($_POST['secondaryhighestLevelEarned']) ? mysqli_real_escape_string($sql_connection, $_POST['secondaryhighestLevelEarned']) : null;
        $secondary_year_graduated_again = isset($_POST['secondaryyearGraduatedAgain']) ? mysqli_real_escape_string($sql_connection, $_POST['secondaryyearGraduatedAgain']) : null;

        $vocational_name = isset($_POST['vocationalname']) ? mysqli_real_escape_string($sql_connection, $_POST['vocationalname']) : null;
        $vocational_year_graduated = isset($_POST['vocationalyearGraduated']) ? mysqli_real_escape_string($sql_connection, $_POST['vocationalyearGraduated']) : null;
        $vocational_period_attendance = isset($_POST['vocationalperiodAttendance']) ? mysqli_real_escape_string($sql_connection, $_POST['vocationalperiodAttendance']) : null;
        $vocational_highest_level_earned = isset($_POST['vocationalhighestLevelEarned']) ? mysqli_real_escape_string($sql_connection, $_POST['vocationalhighestLevelEarned']) : null;
        $vocational_year_graduated_again = isset($_POST['vocationalyearGraduatedAgain']) ? mysqli_real_escape_string($sql_connection, $_POST['vocationalyearGraduatedAgain']) : null;

        $college_name = isset($_POST['collegename']) ? mysqli_real_escape_string($sql_connection, $_POST['collegename']) : null;
        $college_year_graduated = isset($_POST['collegeyearGraduated']) ? mysqli_real_escape_string($sql_connection, $_POST['collegeyearGraduated']) : null;
        $college_period_attendance = isset($_POST['collegeperiodAttendance']) ? mysqli_real_escape_string($sql_connection, $_POST['collegeperiodAttendance']) : null;
        $college_highest_level_earned = isset($_POST['collegehighestLevelEarned']) ? mysqli_real_escape_string($sql_connection, $_POST['collegehighestLevelEarned']) : null;
        $college_year_graduated_again = isset($_POST['collegeyearGraduatedAgain']) ? mysqli_real_escape_string($sql_connection, $_POST['collegeyearGraduatedAgain']) : null;

        $graduate_name = isset($_POST['graduatename']) ? mysqli_real_escape_string($sql_connection, $_POST['graduatename']) : null;
        $graduate_year_graduated = isset($_POST['graduateyearGraduated']) ? mysqli_real_escape_string($sql_connection, $_POST['graduateyearGraduated']) : null;
        $graduate_period_attendance = isset($_POST['graduateperiodAttendance']) ? mysqli_real_escape_string($sql_connection, $_POST['graduateperiodAttendance']) : null;
        $graduate_highest_level_earned = isset($_POST['graduatehighestLevelEarned']) ? mysqli_real_escape_string($sql_connection, $_POST['graduatehighestLevelEarned']) : null;
        $graduate_year_graduated_again = isset($_POST['graduateyearGraduatedAgain']) ? mysqli_real_escape_string($sql_connection, $_POST['graduateyearGraduatedAgain']) : null;

        // Work Experience Post Data
        $work_from_exp = isset($_POST['workfrom']) ? mysqli_real_escape_string($sql_connection, $_POST['workfrom']) : null;
        $work_to_exp = isset($_POST['workto']) ? mysqli_real_escape_string($sql_connection, $_POST['workto']) : null;
        $work_position_title = isset($_POST['workpositionTitle']) ? mysqli_real_escape_string($sql_connection, $_POST['workpositionTitle']) : null;
        $work_department = isset($_POST['workdepartment']) ? mysqli_real_escape_string($sql_connection, $_POST['workdepartment']) : null;
        $work_monthly_salary = isset($_POST['workmonthlySalary']) ? mysqli_real_escape_string($sql_connection, $_POST['workmonthlySalary']) : null;
        $work_grade_pay = isset($_POST['workgradepay']) ? mysqli_real_escape_string($sql_connection, $_POST['workgradepay']) : null;
        $work_status = isset($_POST['workstatus']) ? mysqli_real_escape_string($sql_connection, $_POST['workstatus']) : null;
        $work_govt_service = isset($_POST['workgovtService']) ? mysqli_real_escape_string($sql_connection, $_POST['workgovtService']) : null;

        // Voluntary Work Post Data
        $org_name = isset($_POST['orgname']) ? mysqli_real_escape_string($sql_connection, $_POST['orgname']) : null;
        $work_from = isset($_POST['workfrom']) ? mysqli_real_escape_string($sql_connection, $_POST['workfrom']) : null;
        $work_to = isset($_POST['workto']) ? mysqli_real_escape_string($sql_connection, $_POST['workto']) : null;
        $num_hours = isset($_POST['numhours']) ? mysqli_real_escape_string($sql_connection, $_POST['numhours']) : null;
        $position = isset($_POST['position']) ? mysqli_real_escape_string($sql_connection, $_POST['position']) : null;

        // Learning and Development Post Data
        $training_program = isset($_POST['trainingprogram']) ? mysqli_real_escape_string($sql_connection, $_POST['trainingprogram']) : null;
        $training_from = isset($_POST['trainingfrom']) ? mysqli_real_escape_string($sql_connection, $_POST['trainingfrom']) : null;
        $training_to = isset($_POST['trainingto']) ? mysqli_real_escape_string($sql_connection, $_POST['trainingto']) : null;
        $training_hours = isset($_POST['traininghours']) ? mysqli_real_escape_string($sql_connection, $_POST['traininghours']) : null;
        $type_of_ld = isset($_POST['typeofld']) ? mysqli_real_escape_string($sql_connection, $_POST['typeofld']) : null;
        $conducted_sponsored_by = isset($_POST['conductedsponsoredby']) ? mysqli_real_escape_string($sql_connection, $_POST['conductedsponsoredby']) : null;

        // Other Information Post Data
        $special_skills = isset($_POST['specialskills']) ? mysqli_real_escape_string($sql_connection, $_POST['specialskills']) : null;
        $non_academic_distinctions = isset($_POST['nonacademicdistinctions']) ? mysqli_real_escape_string($sql_connection, $_POST['nonacademicdistinctions']) : null;
        $membership_association = isset($_POST['membershipassociation']) ? mysqli_real_escape_string($sql_connection, $_POST['membershipassociation']) : null;

        $sql_personal = "INSERT INTO personal_information (
            user_id, surname, firstname, middlename, dob, place_of_birth, citizenship, sex, civil_status, 
            height, weight, blood_type, driver_license, pag_ibig, phil_health, sss, tin, other_id, 
            phone_number, telephone, email, res_address, perm_address
        ) VALUES (
            '$user_id', '$surname', '$firstname', '$middlename', '$dob', '$place_of_birth', '$citizenship', 
            '$sex', '$civil_status', '$height', '$weight', '$blood_type', '$driver_license', '$pag_ibig', 
            '$phil_health', '$sss', '$tin', '$other_id', '$phone_number', '$telephone', '$email', 
            '$res_address', '$perm_address'
        )";

        $sql_family = "INSERT INTO family_background (
            user_id, spouse_surname, spouse_first_name, spouse_middle_name, spouse_occupation, 
            father_surname, father_first_name, father_middle_name, mother_maiden_name, mother_first_name, 
            mother_middle_name
        ) VALUES (
            '$user_id', '$spouse_surname', '$spouse_first_name', '$spouse_middle_name', '$spouse_occupation', 
            '$father_surname', '$father_first_name', '$father_middle_name', '$mother_maiden_name', 
            '$mother_first_name', '$mother_middle_name'
        )";

        $sql_education = "INSERT INTO educational_background (
            user_id, elementary_name, elementary_year_graduated, elementary_period_attendance, 
            elementary_highest_level_earned, elementary_year_graduated_again, secondary_name, 
            secondary_year_graduated, secondary_period_attendance, secondary_highest_level_earned, 
            secondary_year_graduated_again, vocational_name, vocational_year_graduated, 
            vocational_period_attendance, vocational_highest_level_earned, vocational_year_graduated_again, 
            college_name, college_year_graduated, college_period_attendance, college_highest_level_earned, 
            college_year_graduated_again, graduate_studies_name, graduate_studies_year_graduated, 
            graduate_studies_period_attendance, graduate_studies_highest_level_earned, 
            graduate_studies_year_graduated_again
        ) VALUES (
            '$user_id', '$elementary_name', '$elementary_year_graduated', '$elementary_period_attendance', 
            '$elementary_highest_level_earned', '$elementary_year_graduated_again', '$secondary_name', 
            '$secondary_year_graduated', '$secondary_period_attendance', '$secondary_highest_level_earned', 
            '$secondary_year_graduated_again', '$vocational_name', '$vocational_year_graduated', 
            '$vocational_period_attendance', '$vocational_highest_level_earned', '$vocational_year_graduated_again', 
            '$college_name', '$college_year_graduated', '$college_period_attendance', '$college_highest_level_earned', 
            '$college_year_graduated_again', '$graduate_name', '$graduate_year_graduated', 
            '$graduate_period_attendance', '$graduate_highest_level_earned', 
            '$graduate_year_graduated_again'
        )";

        $sql_work = "INSERT INTO work_experience (
            user_id, work_from, work_to, position_title, department, monthly_salary, salary_job_pay_grade, 
            status_of_appointment, govt_service
        ) VALUES (
            '$user_id', '$work_from_exp', '$work_to_exp', '$work_position_title', '$work_department', '$work_monthly_salary', 
            '$work_grade_pay', '$work_status', '$work_govt_service'
        )";

        $sql_voluntary = "INSERT INTO voluntary_work (
            user_id, org_name, work_from, work_to, num_hours, position
        ) VALUES (
            '$user_id', '$org_name', '$work_from', '$work_to', '$num_hours', '$position'
        )";

        $sql_program = "INSERT INTO learning_and_development (
            user_id, training_program, training_from, training_to, training_hours, type_of_ld, 
            conducted_sponsored_by
        ) VALUES (
            '$user_id', '$training_program', '$training_from', '$training_to', '$training_hours', '$type_of_ld', 
            '$conducted_sponsored_by'
        )";

        $sql_other = "INSERT INTO other_information (
            user_id, special_skills, non_academic_distinctions, membership_in_association
        ) VALUES (
            '$user_id', '$special_skills', '$non_academic_distinctions', '$membership_association'
        )";

        // Array of queries
        $queries = [$sql_personal, $sql_family, $sql_education, $sql_work, $sql_voluntary, $sql_program, $sql_other];

        // Execute queries
        foreach ($queries as $query) {
            if (mysqli_query($sql_connection, $query)) {
                $flash_message->Set("Application Submitted", "success");
                header("Location: applicant.php");
                $_SESSION['user_id'] = $user_id;
            } else {
                $flash_message->Set("Application Failed", "error");
                return;
            }
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" type="text/css" href="./static/apply.css"/>
</head>
<body>
    <?php $flash_message->Display(); // Display the flash message ?>
    <div class="confirm" id="confirm">
        <button class="shrink pad-bot" type="button" id="back-apply">Back</button>
            <form class ="form-group-confirm" id="form-group-confirm" method="POST">
                
            </form>
    </div>
    <main class="wrapper">
        <button class="shrink" type="button" id="back">Back</button>
        <form id="form" method="POST">
            <div class="header">
                <img src="./assets/nav-logo.png" alt="Company Logo" class="logo">
                <h1>Job Application Form</h1>
            </div>
            <fieldset class="flex">
                <legend>PERSONAL INFORMATION</legend>
                <div class="form-group">
                    <div class="flex-left">
                        <label for="surname">Surname</label>
                        <label for="first-name">First Name</label>
                        <label for="middle-name">Middle Name</label>
                    </div>
                    <div class="flex-right">
                        <input type="text" id="surname" name="surname" placeholder="Surname">
                        <input type="text" id="firstname" name="firstname" placeholder="First Name">
                        <input type="text" id="middlename" name="middlename" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="flex-left">
                        <label for="dob">Date of Birth</label>
                        <label for="place-of-birth">Place of Birth</label>
                        <label for="citizenship">Citizenship</label>
                        <label for="sex">Sex</label>
                        <label for="civil-status">Civil Status</label>
                        <label for="height">Height (cm)</label>
                        <label for="weight">Weight (kg)</label>
                        <label for="blood-type">Blood Type</label>
                        <label for="driver-license">Drivers License ID</label>
                        <label for="pag-ibig">Pag Ibig NO.</label>
                        <label for="phil-health">Philhealth NO.</label>
                        <label for="sss">SSS NO.</label>
                        <label for="tin">TIN NO.</label>
                        <label for="other-id">Other ID</label>
                        <label for="phone-number">Phone Number</label>
                        <label for="telephone">Telephone</label>
                        <label for="email">Email</label>
                        <label for="res-address">Residential Address</label>
                        <label for="perm-address">Permanent Address</label>
                    </div>
                    <div class="flex-right">
                        <input type="date" id="dob" name="dob" placeholder="Date of Birth">
                        <input type="text" id="place-of-birth" name="placeofbirth" placeholder="Place of Birth">
                        <input type="text" id="citizenship" name="citizenship" placeholder="Citizenship">
                        <select id="sex" name="sex">
                            <option value="" disabled selected>Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <select id="civil-status" name="civilstatus">
                            <option value="" disabled selected>Select Civil Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separated">Separated</option>
                            <option value="others">Others</option>
                        </select>
                        <input type="number" id="height" name="height" step="0.01" placeholder="Height (cm)">
                        <input type="number" id="weight" name="weight" step="0.01" placeholder="Weight (kg)">
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
                        <input type="text" id="driverlicense" name="driverlicense" placeholder="Driver's License ID">
                        <input type="text" id="pag-ibig" name="pagibig" placeholder="Pag Ibig NO.">
                        <input type="text" id="phil-health" name="philhealth" placeholder="Philhealth NO.">
                        <input type="text" id="sss" name="sss" placeholder="SSS NO.">
                        <input type="text" id="tin" name="tin" placeholder="TIN NO.">
                        <input type="text" id="other-id" name="otherid" placeholder="Other ID">
                        <input type="text" id="phone-number" name="phonenumber" placeholder="Phone Number">
                        <input type="text" id="telephone" name="telephone" placeholder="Telephone">
                        <input type="email" id="email" name="email" placeholder="Email">
                        <textarea id="res-address" name="resaddress" placeholder="House | Street | Subdivision | Baranggay | City/Municipality | Provice"></textarea>
                        <textarea id="perm-address" name="permaddress" placeholder="House | Street | Subdivision | Baranggay | City/Municipality | Provice"></textarea>
                    </div>
                </div>
            </fieldset>
    
            <fieldset class="flex">
                <legend>Family Background</legend>
                <div class="form-group">
                    <div class="flex-left">
                        <label for="spouse-information">Spouse's Information</label>
                        <label for="father-information">Father's Information</label>
                        <label for="mother-information">Mother's Information</label>
                    </div>
                    <div class="flex-right">
                        <div class="inline">
                            <input type="text" id="spouse-surname" name="spousesurname" placeholder="Enter spouse's surname">
                            <input type="text" id="spouse-first-name" name="spousefirstname" placeholder="Enter spouse's first name">
                            <input type="text" id="spouse-middle-name" name="spousemiddlename" placeholder="Enter spouse's middle name">
                            <input type="text" id="spouse-occupation" name="spouseoccupation" placeholder="Enter spouse's occupation">
                        </div>
                        <div class="inline">
                            <input type="text" id="father-surname" name="fathersurname" placeholder="Enter father's surname">
                            <input type="text" id="father-first-name" name="fatherfirstname" placeholder="Enter father's first name">
                            <input type="text" id="father-middle-name" name="fathermiddlename" placeholder="Enter father's middle name">
                        </div>
                        <div class="inline">
                            <input type="text" id="mother-maiden-name" name="mothermaidenname" placeholder="Enter mother's maiden name">
                            <input type="text" id="mother-first-name" name="motherfirstname" placeholder="Enter mother's first name">
                            <input type="text" id="mother-middle-name" name="mothermiddlename" placeholder="Enter mother's middle name">
                        </div>
                    </div>
                </div>
            </fieldset>
    
            <fieldset class="flex">
                <legend>Educational Background</legend>
                <div class="form-group">
                    <div class="flex-left">
                        <label for="elementary">Elementary</label>
                        <label for="secondary">Secondary</label>
                        <label for="vocational">Vocational/Trade Course</label>
                        <label for="college">College</label>
                        <label for="college-course">Graduate Studies</label>
                    </div>
                    <div class="flex-right">
                        <div class="inline">
                            <input type="text" id="elementary-name" name="elementaryname" placeholder="Name of Elementary School">
                            <input type="number" id="elementary-yearGraduated" name="elementaryyearGraduated" placeholder="Year Graduated">
                            <input type="text" id="elementary-periodAttendance" name="elementaryperiodAttendance" placeholder="Period of Attendance">
                            <input type="text" id="elementary-highestLevelEarned" name="elementaryhighestLevelEarned" placeholder="Highest Level (if not graduate)">
                            <input type="number" id="elementary-yearGraduatedAgain" name="elementaryyearGraduatedAgain" placeholder="Year Graduated Again">
                        </div>
                        <div class="inline">
                            <input type="text" id="secondary-name" name="secondaryname" placeholder="Name of Secondary School">
                            <input type="number" id="secondary-yearGraduated" name="secondaryyearGraduated" placeholder="Year Graduated">
                            <input type="text" id="secondary-periodAttendance" name="secondaryperiodAttendance" placeholder="Period of Attendance">
                            <input type="text" id="secondary-highestLevelEarned" name="secondaryhighestLevelEarned" placeholder="Highest Level (if not graduate)">
                            <input type="number" id="secondary-yearGraduatedAgain" name="secondaryyearGraduatedAgain" placeholder="Year Graduated Again">
                        </div>
                        <div class="inline">
                            <input type="text" id="vocational-name" name="vocationalname" placeholder="Name of Vocational/Trade Course">
                            <input type="number" id="vocational-yearGraduated" name="vocationalyearGraduated" placeholder="Year Graduated">
                            <input type="text" id="vocational-periodAttendance" name="vocationalperiodAttendance" placeholder="Period of Attendance">
                            <input type="text" id="vocational-highestLevelEarned" name="vocationalhighestLevelEarned" placeholder="Highest Level (if not graduate)">
                            <input type="number" id="vocational-yearGraduatedAgain" name="vocationalyearGraduatedAgain" placeholder="Year Graduated Again">
                        </div>
                        <div class="inline">
                            <input type="text" id="college-name" name="collegename" placeholder="Name of College">
                            <input type="number" id="college-yearGraduated" name="collegeyearGraduated" placeholder="Year Graduated">
                            <input type="text" id="college-periodAttendance" name="collegeperiodAttendance" placeholder="Period of Attendance">
                            <input type="text" id="college-highestLevelEarned" name="collegehighestLevelEarned" placeholder="Highest Level (if not graduate)">
                            <input type="number" id="college-yearGraduatedAgain" name="collegeyearGraduatedAgain" placeholder="Year Graduated Again">
                        </div>
                        <div class="inline">
                            <input type="text" id="graduate-name" name="graduatename" placeholder="Name of Graduate Studies">
                            <input type="number" id="graduate-yearGraduated" name="graduateyearGraduated" placeholder="Year Graduated">
                            <input type="text" id="graduate-periodAttendance" name="graduateperiodAttendance" placeholder="Period of Attendance">
                            <input type="text" id="graduate-highestLevelEarned" name="graduatehighestLevelEarned" placeholder="Highest Level (if not graduate)">
                            <input type="number" id="graduate-yearGraduatedAgain" name="graduateyearGraduatedAgain" placeholder="Year Graduated Again">
                        </div>
                    </div>
                </div>                
            </fieldset>
            <fieldset class="flex">
                <legend>Work Experience</legend>
                <div class="form-group">
                    <div class="flex-right" style="width: 100%;">
                        <div class="inline">
                            <input type="text" id="work-from" name="workfrom" placeholder="From">
                            <input type="text" id="work-to" name="workto" placeholder="To">
                            <input type="text" id="work-positionTitle" name="workpositionTitle" placeholder="Position Title">
                            <input type="text" id="work-department" name="workdepartment" placeholder="Department/Agency/Office/Company">
                            <input type="number" id="work-monthlySalary" name="workmonthlySalary" placeholder="Monthly Salary">
                            <input type="number" id="work-gradepay" name="workgradepay" placeholder="Salary Job Pay Grade">
                            <input type="text" id="work-status" name="workstatus" placeholder="Status of Appointment">
                            <input type="text" id="work-govtService" name="workgovtService" placeholder="Gov't Service">
                        </div>
                    </div>
                </div>
            </fieldset class="flex">
            <fieldset>
                <legend>Voluntary Work</legend>
                <div class="form-group">
                    <div class="flex-right" style="width: 100%;">
                        <div class="inline">
                            <input type="text" id="org-name" name="orgname" placeholder="Name of Organization">
                            <input type="text" id="work-from" name="workfrom" placeholder="From">
                            <input type="text" id="work-to" name="workto" placeholder="To">
                            <input type="number" id="num-hours" name="numhours" placeholder="Number of Hours">
                            <input type="text" id="position" name="position" placeholder="Position">
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="flex">
                <legend>Learning and Development</legend>
                <div class="form-group">
                    <div class="flex-right" style="width: 100%;">
                        <div class="inline">
                            <input type="text" id="training-program" name="trainingprogram" placeholder="Training Programs">
                            <input type="text" id="training-from" name="trainingfrom" placeholder="From">
                            <input type="text" id="training-to" name="trainingto" placeholder="To">
                            <input type="number" id="training-hours" name="traininghours" placeholder="Number of Hours">
                            <input type="text" id="type-of-ld" name="typeofld" placeholder="Type of LD">
                            <input type="text" id="conducted-sponsored-by" name="conductedsponsoredby" placeholder="Conducted/Sponsored By">
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="flex">
                <legend>Other Information</legend>
                <div class="form-group">
                    <div class="flex-right" style="width: 100%;">
                        <div class="inline">
                            <input type="text" id="special-skills" name="specialskills" placeholder="Special Skills and Hobbies">
                            <input type="text" id="non-academic-distinctions" name="nonacademicdistinctions" placeholder="Non-Academic Distinctions">
                            <input type="text" id="membership-association" name="membershipassociation" placeholder="Membership in Association/Organization">
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="button" id="submit">View Form</button>
        </form>
    </main>
    <script>
        const inputs = document.querySelectorAll('form input, form select, form textarea');
        const confirmDiv = document.getElementById("form-group-confirm");
        const main = document.getElementsByTagName('main')[0];
        const showConfirm = document.getElementById("confirm");

            document.addEventListener('DOMContentLoaded', function() {
                var flashMessage = document.querySelector('.flash-message');
                if (flashMessage) {
                    // Set a timeout to start fading out the message after 5 seconds
                    setTimeout(function() {
                        flashMessage.classList.add('fade-out');
                    }, 5000); // 5000 milliseconds = 5 seconds

                    // Optionally, remove the message from the DOM after fading out
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 6000); // 6000 milliseconds = 6 seconds (to ensure it has fully faded out)
                }
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
                    valueLabel.textContent = input.name.charAt(0).toUpperCase() + input.name.slice(1);
            
                    let clone;
            
                    if (input.tagName === 'TEXTAREA') {
                        // Create a new input element with the same attributes as the textarea
                        clone = document.createElement('input');
                        clone.type = 'text'; // Use 'text' type for textarea equivalent
                        clone.name = input.name;
                        clone.value = input.value;
                        clone.readOnly = true;
                    } else if (input.tagName === 'SELECT') {
                        // Create a new input element with the same attributes as the select
                        clone = document.createElement('input');
                        clone.type = 'text'; // Use 'text' type for select equivalent
                        clone.name = input.name;
                        clone.value = input.options[input.selectedIndex].text;
                        clone.readOnly = true;
                    } else {
                        // Clone input elements directly
                        clone = input.cloneNode(true);
                        clone.readOnly = true;
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
            
            document.getElementById('back-apply').addEventListener("click", () => {
                main.style.display = 'block';
                showConfirm.style.display = 'none';
                
                // Optionally clear or reset any temporary data if needed
            });

            document.getElementById('back').addEventListener("click", () => {
                window.location.href = "tcl.php";
            });

        </script>
</body>
</html>