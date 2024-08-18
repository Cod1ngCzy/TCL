<?php
require("./static/connection.php");
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
        "spouse_first_name VARCHAR(255)",
        "spouse_middle_name VARCHAR(255)",
        "spouse_occupation VARCHAR(255)",
        "father_surname VARCHAR(255)",
        "father_first_name VARCHAR(255)",
        "father_middle_name VARCHAR(255)",
        "mother_maiden_name VARCHAR(255)",
        "mother_first_name VARCHAR(255)",
        "mother_middle_name VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "educational_background" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "elementary_name VARCHAR(255)",
        "elementary_year_graduated INT",
        "elementary_period_attendance VARCHAR(255)",
        "elementary_highest_level_earned VARCHAR(255)",
        "elementary_year_graduated_again INT",
        "secondary_name VARCHAR(255)",
        "secondary_year_graduated INT",
        "secondary_period_attendance VARCHAR(255)",
        "secondary_highest_level_earned VARCHAR(255)",
        "secondary_year_graduated_again INT",
        "vocational_name VARCHAR(255)",
        "vocational_year_graduated INT",
        "vocational_period_attendance VARCHAR(255)",
        "vocational_highest_level_earned VARCHAR(255)",
        "vocational_year_graduated_again INT",
        "college_name VARCHAR(255)",
        "college_year_graduated INT",
        "college_period_attendance VARCHAR(255)",
        "college_highest_level_earned VARCHAR(255)",
        "college_year_graduated_again INT",
        "graduate_studies_name VARCHAR(255)",
        "graduate_studies_year_graduated INT",
        "graduate_studies_period_attendance VARCHAR(255)",
        "graduate_studies_highest_level_earned VARCHAR(255)",
        "graduate_studies_year_graduated_again INT",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "work_experience" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "work_from DATE",
        "work_to DATE",
        "position_title VARCHAR(255)",
        "department VARCHAR(255)",
        "monthly_salary DECIMAL(10,2)",
        "salary_job_pay_grade VARCHAR(255)",
        "status_of_appointment VARCHAR(255)",
        "govt_service VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "voluntary_work" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "org_name VARCHAR(255)",
        "work_from DATE",
        "work_to DATE",
        "num_hours INT",
        "position VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "learning_and_development" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "training_program VARCHAR(255)",
        "training_from DATE",
        "training_to DATE",
        "training_hours INT",
        "type_of_ld VARCHAR(255)",
        "conducted_sponsored_by VARCHAR(255)",
        "PRIMARY KEY (id)",
        "FOREIGN KEY (user_id) REFERENCES applicant (user_id) ON DELETE SET NULL"
    ],
    "other_information" => [
        "id INT(10) NOT NULL AUTO_INCREMENT",
        "user_id VARCHAR(255)",
        "special_skills VARCHAR(255)",
        "non_academic_distinctions VARCHAR(255)",
        "membership_in_association VARCHAR(255)",
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