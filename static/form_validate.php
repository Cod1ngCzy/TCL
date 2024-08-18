<?php
    require("connection.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $personal = array(
            "surname" => isset($_POST['surname']) ? mysqli_real_escape_string($sql_connection, $_POST['surname']) : null,
            "firstname" => isset($_POST['firstname']) ? mysqli_real_escape_string($sql_connection, $_POST['firstname']) : null,
            "middlename" => isset($_POST['middlename']) ? mysqli_real_escape_string($sql_connection, $_POST['middlename']) : null,
            "dob" => isset($_POST['dob']) ? mysqli_real_escape_string($sql_connection, $_POST['dob']) : null,
            "placeofbirth" => isset($_POST['placeofbirth']) ? mysqli_real_escape_string($sql_connection, $_POST['placeofbirth']) : null,
            "citizenship" => isset($_POST['citizenship']) ? mysqli_real_escape_string($sql_connection, $_POST['citizenship']) : null,
            "sex" => isset($_POST['sex']) ? mysqli_real_escape_string($sql_connection, $_POST['sex']) : null,
            "civilstatus" => isset($_POST['civilstatus']) ? mysqli_real_escape_string($sql_connection, $_POST['civilstatus']) : null,
            "height" => isset($_POST['height']) ? mysqli_real_escape_string($sql_connection, $_POST['height']) : null,
            "weight" => isset($_POST['weight']) ? mysqli_real_escape_string($sql_connection, $_POST['weight']) : null,
            "bloodtype" => isset($_POST['bloodtype']) ? mysqli_real_escape_string($sql_connection, $_POST['bloodtype']) : null,
            "driverlicense" => isset($_POST['driverlicense']) ? mysqli_real_escape_string($sql_connection, $_POST['driverlicense']) : null,
            "pagibig" => isset($_POST['pagibig']) ? mysqli_real_escape_string($sql_connection, $_POST['pagibig']) : null,
            "philhealth" => isset($_POST['philhealth']) ? mysqli_real_escape_string($sql_connection, $_POST['philhealth']) : null,
            "sss" => isset($_POST['sss']) ? mysqli_real_escape_string($sql_connection, $_POST['sss']) : null,
            "tin" => isset($_POST['tin']) ? mysqli_real_escape_string($sql_connection, $_POST['tin']) : null,
            "otherid" => isset($_POST['otherid']) ? mysqli_real_escape_string($sql_connection, $_POST['otherid']) : null,
            "phonenumber" => isset($_POST['phonenumber']) ? mysqli_real_escape_string($sql_connection, $_POST['phonenumber']) : null,
            "telephone" => isset($_POST['telephone']) ? mysqli_real_escape_string($sql_connection, $_POST['telephone']) : null,
            "email" => isset($_POST['email']) ? mysqli_real_escape_string($sql_connection, $_POST['email']) : null,
            "resaddress" => isset($_POST['resaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['resaddress']) : null,
            "permaddress" => isset($_POST['permaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['permaddress']) : null
        );
        
        $family = array(
            "spousesurname" => isset($_POST['spousesurname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousesurname']) : null,
            "spousefirstname" => isset($_POST['spousefirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['spousefirstname']) : null,
            "spousemiddlename" => isset($_POST['spousemiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['spousemiddlename']) : null,
            "spouseoccupation" => isset($_POST['spouseoccupation']) ? mysqli_real_escape_string($sql_connection, $_POST['spouseoccupation']) : null,
            "fathersurname" => isset($_POST['fathersurname']) ? mysqli_real_escape_string($sql_connection, $_POST['fathersurname']) : null,
            "fatherfirstname" => isset($_POST['fatherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['fatherfirstname']) : null,
            "fathermiddlename" => isset($_POST['fathermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['fathermiddlename']) : null,
            "mothermaidenname" => isset($_POST['mothermaidenname']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermaidenname']) : null,
            "motherfirstname" => isset($_POST['motherfirstname']) ? mysqli_real_escape_string($sql_connection, $_POST['motherfirstname']) : null,
            "mothermiddlename" => isset($_POST['mothermiddlename']) ? mysqli_real_escape_string($sql_connection, $_POST['mothermiddlename']) : null
        );
        
        $education = array(
            "Eschoolname" => isset($_POST['Eschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Eschoolname']) : null,
            "Edegree" => isset($_POST['Edegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Edegree']) : null,
            "Eattendace" => isset($_POST['Eattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Eattendace']) : null,
            "Ehighestlevel" => isset($_POST['Ehighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Ehighestlevel']) : null,
            "Eyeargraduate" => isset($_POST['Eyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Eyeargraduate']) : null,
            "Eacadhonors" => isset($_POST['Eacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Eacadhonors']) : null,
        
            "Sschoolname" => isset($_POST['Sschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Sschoolname']) : null,
            "Sdegree" => isset($_POST['Sdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdegree']) : null,
            "Sattendace" => isset($_POST['Sattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Sattendace']) : null,
            "Shighestlevel" => isset($_POST['Shighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Shighestlevel']) : null,
            "Syeargraduate" => isset($_POST['Syeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Syeargraduate']) : null,
            "Sacadhonors" => isset($_POST['Sacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Sacadhonors']) : null,
        
            "Vschoolname" => isset($_POST['Vschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Vschoolname']) : null,
            "Vdegree" => isset($_POST['Vdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Vdegree']) : null,
            "Vattendace" => isset($_POST['Vattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Vattendace']) : null,
            "Vhighestlevel" => isset($_POST['Vhighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Vhighestlevel']) : null,
            "Vyeargraduate" => isset($_POST['Vyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Vyeargraduate']) : null,
            "Vacadhonors" => isset($_POST['Vacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Vacadhonors']) : null,
        
            "Cschoolname" => isset($_POST['Cschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Cschoolname']) : null,
            "Cdegree" => isset($_POST['Cdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Cdegree']) : null,
            "Cattendace" => isset($_POST['Cattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Cattendace']) : null,
            "Chighestlevel" => isset($_POST['Chighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Chighestlevel']) : null,
            "Cyeargraduate" => isset($_POST['Cyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Cyeargraduate']) : null,
            "Cacadhonors" => isset($_POST['Cacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Cacadhonors']) : null,
        
            "Gschoolname" => isset($_POST['Gschoolname']) ? mysqli_real_escape_string($sql_connection, $_POST['Gschoolname']) : null,
            "Gdegree" => isset($_POST['Gdegree']) ? mysqli_real_escape_string($sql_connection, $_POST['Gdegree']) : null,
            "Gattendace" => isset($_POST['Gattendace']) ? mysqli_real_escape_string($sql_connection, $_POST['Gattendace']) : null,
            "Ghighestlevel" => isset($_POST['Ghighestlevel']) ? mysqli_real_escape_string($sql_connection, $_POST['Ghighestlevel']) : null,
            "Gyeargraduate" => isset($_POST['Gyeargraduate']) ? mysqli_real_escape_string($sql_connection, $_POST['Gyeargraduate']) : null,
            "Gacadhonors" => isset($_POST['Gacadhonors']) ? mysqli_real_escape_string($sql_connection, $_POST['Gacadhonors']) : null
        );
        
        $work = array(
            "Fworkdate" => isset($_POST['Fworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Fworkdate']) : null,
            "Fposition" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
            "Fcompany" => isset($_POST['Fcompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Fcompany']) : null,
            "Fmonthlysalary" => isset($_POST['Fmonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Fmonthlysalary']) : null,
            "Fpaygrade" => isset($_POST['Fpaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Fpaygrade']) : null,
            "Fstatusofappointment" => isset($_POST['Fstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Fstatusofappointment']) : null,
            "Fgoverment" => isset($_POST['Fgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Fgoverment']) : null,
        
            "Sworkdate" => isset($_POST['Sworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Sworkdate']) : null,
            "Sposition" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
            "Scompany" => isset($_POST['Scompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Scompany']) : null,
            "Smonthlysalary" => isset($_POST['Smonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Smonthlysalary']) : null,
            "Spaygrade" => isset($_POST['Spaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Spaygrade']) : null,
            "Sstatusofappointment" => isset($_POST['Sstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Sstatusofappointment']) : null,
            "Sgoverment" => isset($_POST['Sgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Sgoverment']) : null,
        
            "Tworkdate" => isset($_POST['Tworkdate']) ? mysqli_real_escape_string($sql_connection, $_POST['Tworkdate']) : null,
            "Tposition" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null,
            "Tcompany" => isset($_POST['Tcompany']) ? mysqli_real_escape_string($sql_connection, $_POST['Tcompany']) : null,
            "Tmonthlysalary" => isset($_POST['Tmonthlysalary']) ? mysqli_real_escape_string($sql_connection, $_POST['Tmonthlysalary']) : null,
            "Tpaygrade" => isset($_POST['Tpaygrade']) ? mysqli_real_escape_string($sql_connection, $_POST['Tpaygrade']) : null,
            "Tstatusofappointment" => isset($_POST['Tstatusofappointment']) ? mysqli_real_escape_string($sql_connection, $_POST['Tstatusofappointment']) : null,
            "Tgoverment" => isset($_POST['Tgoverment']) ? mysqli_real_escape_string($sql_connection, $_POST['Tgoverment']) : null
        );
        
        $organization_details = array(
            "Fnameoforg" => isset($_POST['Fnameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Fnameoforg']) : null,
            "Fdates" => isset($_POST['Fdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Fdates']) : null,
            "Fhours" => isset($_POST['Fhours']) ? mysqli_real_escape_string($sql_connection, $_POST['Fhours']) : null,
            "Fid" => isset($_POST['Fid']) ? mysqli_real_escape_string($sql_connection, $_POST['Fid']) : null,
            "Fposition" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
        
            "Snameoforg" => isset($_POST['Snameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Snameoforg']) : null,
            "Sdates" => isset($_POST['Sdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdates']) : null,
            "Shours" => isset($_POST['Shours']) ? mysqli_real_escape_string($sql_connection, $_POST['Shours']) : null,
            "Sid" => isset($_POST['Sid']) ? mysqli_real_escape_string($sql_connection, $_POST['Sid']) : null,
            "Sposition" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
        
            "Tnameoforg" => isset($_POST['Tnameoforg']) ? mysqli_real_escape_string($sql_connection, $_POST['Tnameoforg']) : null,
            "Tdates" => isset($_POST['Tdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Tdates']) : null,
            "Thours" => isset($_POST['Thours']) ? mysqli_real_escape_string($sql_connection, $_POST['Thours']) : null,
            "Tid" => isset($_POST['Tid']) ? mysqli_real_escape_string($sql_connection, $_POST['Tid']) : null,
            "Tposition" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null
        );

        $training_programs = array(
            "Ftitle" => isset($_POST['Ftitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Ftitle']) : null,
            "Fdates" => isset($_POST['Fdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Fdates']) : null,
            "Fhours" => isset($_POST['Fhours']) ? mysqli_real_escape_string($sql_connection, $_POST['Fhours']) : null,
            "Fid" => isset($_POST['Fid']) ? mysqli_real_escape_string($sql_connection, $_POST['Fid']) : null,
            "Fposition" => isset($_POST['Fposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Fposition']) : null,
        
            "Stitle" => isset($_POST['Stitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Stitle']) : null,
            "Sdates" => isset($_POST['Sdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Sdates']) : null,
            "Shours" => isset($_POST['Shours']) ? mysqli_real_escape_string($sql_connection, $_POST['Shours']) : null,
            "Sid" => isset($_POST['Sid']) ? mysqli_real_escape_string($sql_connection, $_POST['Sid']) : null,
            "Sposition" => isset($_POST['Sposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Sposition']) : null,
        
            "Ttitle" => isset($_POST['Ttitle']) ? mysqli_real_escape_string($sql_connection, $_POST['Ttitle']) : null,
            "Tdates" => isset($_POST['Tdates']) ? mysqli_real_escape_string($sql_connection, $_POST['Tdates']) : null,
            "Thours" => isset($_POST['Thours']) ? mysqli_real_escape_string($sql_connection, $_POST['Thours']) : null,
            "Tid" => isset($_POST['Tid']) ? mysqli_real_escape_string($sql_connection, $_POST['Tid']) : null,
            "Tposition" => isset($_POST['Tposition']) ? mysqli_real_escape_string($sql_connection, $_POST['Tposition']) : null,
        );
        
        
        $other_information = array(
            // Skills, Academic Distinctions, and Membership
            "Fskills" => isset($_POST['Fskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Fskills']) : null,
            "Facademicdistictions" => isset($_POST['Facademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Facademicdistictions']) : null,
            "Fmembership" => isset($_POST['Fmembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Fmembership']) : null,
        
            "Sskills" => isset($_POST['Sskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Sskills']) : null,
            "Sacademicdistictions" => isset($_POST['Sacademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Sacademicdistictions']) : null,
            "Smembership" => isset($_POST['Smembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Smembership']) : null,
        
            "Tskills" => isset($_POST['Tskills']) ? mysqli_real_escape_string($sql_connection, $_POST['Tskills']) : null,
            "Tacademicdistictions" => isset($_POST['Tacademicdistictions']) ? mysqli_real_escape_string($sql_connection, $_POST['Tacademicdistictions']) : null,
            "Tmembership" => isset($_POST['Tmembership']) ? mysqli_real_escape_string($sql_connection, $_POST['Tmembership']) : null,
        
            // Emergency Contact Information
            "contactfullname" => isset($_POST['contactfullname']) ? mysqli_real_escape_string($sql_connection, $_POST['contactfullname']) : null,
            "contactrelationship" => isset($_POST['contactrelationship']) ? mysqli_real_escape_string($sql_connection, $_POST['contactrelationship']) : null,
            "contactaddress" => isset($_POST['contactaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['contactaddress']) : null,
            "contactnumber" => isset($_POST['contactnumber']) ? mysqli_real_escape_string($sql_connection, $_POST['contactnumber']) : null,
        
            // Reference Information
            "Freferencename" => isset($_POST['Freferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferencename']) : null,
            "Freferenceaddress" => isset($_POST['Freferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferenceaddress']) : null,
            "Freferencetel" => isset($_POST['Freferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Freferencetel']) : null,
        
            "Sreferencename" => isset($_POST['Sreferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferencename']) : null,
            "Sreferenceaddress" => isset($_POST['Sreferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferenceaddress']) : null,
            "Sreferencetel" => isset($_POST['Sreferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Sreferencetel']) : null,
        
            "Treferencename" => isset($_POST['Treferencename']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferencename']) : null,
            "Treferenceaddress" => isset($_POST['Treferenceaddress']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferenceaddress']) : null,
            "Treferencetel" => isset($_POST['Treferencetel']) ? mysqli_real_escape_string($sql_connection, $_POST['Treferencetel']) : null,
        );
    }

?>
