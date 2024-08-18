<?php
require("connection.php");
// Create Database

// Define tables and columns
$tables = [
    "applicant" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255) UNIQUE",
        "status BOOLEAN",
        "PRIMARY KEY (id)"
    ],
    "personal_information" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "surname VARCHAR(255)",
        "first_name VARCHAR(255)",
        "middle_name VARCHAR(255)",
        "dob DATE",
        "place_of_birth VARCHAR(255)",
        "citizenship VARCHAR(255)",
        "sex ENUM('male', 'female')",
        "civil_status ENUM('single', 'married', 'widowed', 'separated', 'others')",
        "height DECIMAL(5,2)",
        "weight DECIMAL(5,2)",
        "blood_type ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-')",
        "driver_license VARCHAR(255)",
        "pag_ibig VARCHAR(255)",
        "phil_health VARCHAR(255)",
        "sss VARCHAR(255)",
        "tin VARCHAR(255)",
        "other_id VARCHAR(255)",
        "phone_number VARCHAR(255)",
        "telephone VARCHAR(255)",
        "email VARCHAR(255)",
        "res_address TEXT",
        "perm_address TEXT",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "family_background" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "spouse_surname VARCHAR(255)",
        "spouse_firstname VARCHAR(255)",
        "spouse_middlename VARCHAR(255)",
        "spouse_occupation VARCHAR(255)",
        "father_surname VARCHAR(255)",
        "father_firstname VARCHAR(255)",
        "father_middlename VARCHAR(255)",
        "mother_maidenname VARCHAR(255)",
        "mother_firstname VARCHAR(255)",
        "mother_middlename VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "educational_background" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "elementary_name VARCHAR(255)",
        "elementary_degree VARCHAR(255)",
        "elementary_attendance VARCHAR(255)",
        "elementary_levelearned VARCHAR(255)",
        "elementary_yeargraduated VARCHAR(255)",
        "elementary_honors VARCHAR(255)",
        "secondary_name VARCHAR(255)",
        "secondary_degree VARCHAR(255)",
        "secondary_attendance VARCHAR(255)",
        "secondary_levelearned VARCHAR(255)",
        "secondary_yeargraduated VARCHAR(255)",
        "secondary_honors VARCHAR(255)",
        "vocational_name VARCHAR(255)",
        "vocational_degree VARCHAR(255)",
        "vocational_attendance VARCHAR(255)",
        "vocational_levelearned VARCHAR(255)",
        "vocational_yeargraduated VARCHAR(255)",
        "college_name VARCHAR(255)",
        "college_year_graduated INT",
        "college_period_attendance VARCHAR(255)",
        "college_highest_level_earned VARCHAR(255)",
        "college_year_graduated_again INT",
        "graduate_studies_name VARCHAR(255)",
        "graduate_studies_degree VARCHAR(255)",
        "graduate_studies_attendance VARCHAR(255)",
        "graduate_studies_levelearned VARCHAR(255)",
        "graduate_studies_yeargraduated VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "work_background" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "Fdates VARCHAR(255)",
        "Fposition_title VARCHAR(255)",
        "Fdepartment VARCHAR(255)",
        "Fmonthly_salary DECIMAL(10,2)",
        "Fpay_grade VARCHAR(255)",
        "Fstatus_of_appointment VARCHAR(255)",
        "Fgovt_service VARCHAR(255)",
        "Sdates VARCHAR(255)",
        "Sposition_title VARCHAR(255)",
        "Sdepartment VARCHAR(255)",
        "Smonthly_salary DECIMAL(10,2)",
        "Spay_grade VARCHAR(255)",
        "Sstatus_of_appointment VARCHAR(255)",
        "Sgovt_service VARCHAR(255)",
        "Tdates VARCHAR(255)",
        "Tposition_title VARCHAR(255)",
        "Tdepartment VARCHAR(255)",
        "Tmonthly_salary DECIMAL(10,2)",
        "Tpay_grade VARCHAR(255)",
        "Tstatus_of_appointment VARCHAR(255)",
        "Tgovt_service VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "voluntary_work" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "Forg_name VARCHAR(255)",
        "Fdates VARCHAR(255)",
        "Fhours VARCHAR(255)",
        "Fid_type VARCHAR(255)",
        "Fposition VARCHAR(255)",
        "Sorg_name VARCHAR(255)",
        "Sdates VARCHAR(255)",
        "Shours VARCHAR(255)",
        "Sid_type VARCHAR(255)",
        "Sposition VARCHAR(255)",
        "Torg_name VARCHAR(255)",
        "Tdates VARCHAR(255)",
        "Thours VARCHAR(255)",
        "Tid_type VARCHAR(255)",
        "Tposition VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "learning_and_development" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "Ftraining_program VARCHAR(255)",
        "Ftraining_dates VARCHAR(255)",
        "Ftraining_hours VARCHAR(255)",
        "Fid_type VARCHAR(255)",
        "Fconducted_sponsored_by VARCHAR(255)",
        "Straining_program VARCHAR(255)",
        "Straining_dates VARCHAR(255)",
        "Straining_hours VARCHAR(255)",
        "Sid_type VARCHAR(255)",
        "Sconducted_sponsored_by VARCHAR(255)",
        "Ttraining_program VARCHAR(255)",
        "Ttraining_dates VARCHAR(255)",
        "Ttraining_hours VARCHAR(255)",
        "Tid_type VARCHAR(255)",
        "Tconducted_sponsored_by VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "other_information" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "special_skills VARCHAR(255)",
        "non_academic_distinctions VARCHAR(255)",
        "membership_in_association VARCHAR(255)",
        "contact_person VARCHAR(255)",
        "contact_relationship VARCHAR(255)",
        "contact_address VARCHAR(255)",
        "contact_number VARCHAR(255)",
        "reference1 VARCHAR(255)",
        "reference1_add VARCHAR(255)",
        "reference1_tel VARCHAR(255)",
        "reference2 VARCHAR(255)",
        "reference2_add VARCHAR(255)",
        "reference2_tel VARCHAR(255)",
        "reference3 VARCHAR(255)",
        "reference3_add VARCHAR(255)",
        "reference3_tel VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ]
];

function create_table($sql_connection, $table, $columns) {
    $columns_sql = implode(", ", $columns);
    $sql_query = "CREATE TABLE `$table` ($columns_sql)";
    
    if (mysqli_query($sql_connection, $sql_query)) {
        echo "";
    } else {
        echo "Error creating table '$table': " . mysqli_error($sql_connection) . "<br>";
    }
}

function check_table($sql_connection, $table) {
    $query = "SHOW TABLES LIKE '$table'";
    $check_result = mysqli_query($sql_connection, $query);
    
    return mysqli_num_rows($check_result) > 0;
}

foreach ($tables as $table => $columns) {
    if (check_table($sql_connection, $table)) {
        echo "";
    } else {
        create_table($sql_connection, $table, $columns);
    }
}
?>