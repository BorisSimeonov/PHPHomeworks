<form method="post" action="cVitae.php">
    <! -------------------------------------- Personal >
    <fieldset>
        <legend>Personal information</legend>
        <input type="text" name="fName" id="fName" placeholder="First Name" required=""/>
        <br />
        <input type="text" name="lName" id="lName" placeholder="Last name" required=""/>
        <br />
        <input type="text" name="eMail" id="eMail" placeholder="E-mail" required=""/>
        <br />
        <input type="text" name="phoneNum" id="phone" placeholder="Phone Number" required=""/>
        <br />
        Female <input type="radio" name="gender" value="female" checked/>
        Male <input type="radio" name="gender" value="male" />
        <br />
        Birth Date
        <br />
        <input type="date" value="dd/mm/yyyy" name="bDate"/>
        <br />
        Nationality
        <br />
        <select name="selectNation" id="select">
            <option value="Bulgarian">Bulgarian</option>
            <option value="Romanian">Romanian</option>
            <option value="Serbian">Serbian</option>
        </select>
    </fieldset>
    <! -------------------------------------- Work >
    <fieldset>
        <legend>Last Work Position</legend>
        Company Name
        <input type="text" name="companyName" id="compName"/>
        <br />
        From
        <input type="date" value="dd/mm/yyyy" name="fromDate"/>
        <br />
        To
        <input type="date" value="dd/mm/yyyy" name="toDate"/>
    </fieldset>
    <! -------------------------------------- Comp Skills >
    <fieldset>
        <legend>Computer Skills</legend>
        Programming Languages
        <br />
        <div id="compBox">
            <div id="num0">
                <input type="text" name="progLanguages[]" id="progField"/>
                <select name="skillLevel[]" id="selectProgSkill">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
        </div>
        <br />
        <button name="removeLang" onclick="removeField(); return false;">Remove Language</button><button onclick="addField(); return false;">Add Language</button>
    </fieldset>
    <! -------------------------------------- Other Skills >
    <fieldset>
        <legend>Other Skills</legend>
        Languages
        <br />
        <div id="langContainer">
            <div id="lang0">
                <input type="text" name="commonLanguages[]" id="langField"/>
                <select name="Comprehension[]">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
                <select name="Reading[]">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
                <select name="Writing[]">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
        </div>
        <br />
        <button name="removeLang" onclick="removeLanguage(); return false">Remove Language</button><button onclick="addLanguage(); return false">Add Language</button>
        <br />
        Driver's License
        <br />
        B <input type="checkbox" name="license[]" value="B"/>
        A <input type="checkbox" name="license[]" value="A"/>
        C <input type="checkbox" name="license[]" value="C"/>
    </fieldset>
    <input type="submit" name="submit" value="Generate CV"/>
</form>

<?php
 if(isset($_POST['submit'])){
     echo "<style>
        td, th, table{
        border: 1px solid black;
        }
    </style>";
     $checker = true;
     if (!(preg_match('/^[A-Za-z]{2,20}$/i', $_POST['fName'])) || !(preg_match('/^[A-Za-z]{2,20}$/i', $_POST['lName'])))
     {
         $checker = false;
     }

     if((strlen($_POST['fName'])<2) || (strlen($_POST['lName'])<2)){
         $checker = false;
     }

     if(!(preg_match('/^\+?[0-9]{0,4}\s?[0-9\s\-]{7,17}$/i', $_POST['phoneNum']))) {
        $checker = false;
     }

     if(!(preg_match('/^[a-z0-9]{1}[a-z\_\0-9]{1,}+[@]{1}[a-z]{2,}[\.]{1}[a-z]{2,4}$/i', $_POST['eMail']))) {
         $checker = false;
     }

     if($_POST['bDate'] !=="dd/mm/yyyy"){
         if(!(preg_match('/^[0-9]{1,2}[\/]{1}[0-9]{1,2}[\/]{1}[1-2]{1}[90]{1}[0-9]{2}$/i', $_POST['bDate']))){
             //needs more validation here for all the numbers inside!!
             $checker = false;
         }
     }

     //populate Data

     if($checker){
         $result =
         "<h1>CV</h1>
         <br />
         <table>
         <th colspan='2'><b>Personal Information</b></th>
         <tr>
         <td>First Name</td>
         <td>".$_POST['fName']."</td>
         </tr>
         <tr>
         <td>Last Name</td>
         <td>".$_POST['lName']."</td>
         </tr>
         <tr>
         <td>E-mail</td>
         <td>".$_POST['eMail']."</td>
         </tr>
         <td>Phone number</td>
         <td>".$_POST['phoneNum']."</td>
         </tr>
         <td>Gender</td>
         <td>".$_POST['gender']."</td>
         </tr>
         <td>Birth Date</td>
         <td>".$_POST['bDate']."</td>
         </tr>
         <td>Nationality</td>
         <td>".$_POST['selectNation']."</td>
         </tr>
         </table>
         <br />
         <table>
         <th colspan=\"2\"><b>Last Work Position</b></th>
         <tr>
         <td>Company Name</td>
         <td>".$_POST['companyName']."</td>
         </tr>
         <tr>
         <td>Form</td>
         <td>".$_POST['fromDate']."</td>
         </tr>
         <tr>
         <td>To</td>
         <td>".$_POST['toDate']."</td>
         </tr>
         </table>
         <br />
         <table>
         <th colspan=\"3\"><b>Computer Skills</b></th>
         ";
         $compSkills = $_POST['progLanguages'];
         $progSkills = $_POST['skillLevel'];
         $result = $result."<tr><td rowspan=\"".(string)(count($compSkills)+1)."\">Programming Languages</td>
         <td><b>Language</b></td><td><b>Skill Level</b></td></tr>
         ";
         if($compSkills[0]!==""){
             for($cnt = 0; $cnt<count($compSkills); $cnt++){
                 $result = $result."<tr><td>".$compSkills[$cnt]."</td><td>".$progSkills[$cnt]."</td></tr>";
             }
         }
         $result = $result."</td></table><br />";
         //add languages
         $langArray = $_POST['commonLanguages'];
         $comprArray = $_POST['Comprehension'];
         $readArray = $_POST['Reading'];
         $writeArray = $_POST['Writing'];
         $result = $result."<table><th colspan='5'><b>Other Skills<b></th><tr>
         <td rowspan=\"".(string)(count($langArray)+1)."\">Languages</td><td><b>Language</b></td>
         <td><b>Comprehension</b></td><td><b>Reading</b></td><td><b>Writing</b></td></tr>";

         if($langArray[0]!==""){
             for($cnt = 0; $cnt<count($langArray); $cnt++){
                 $result = $result."<tr><td>".$langArray[$cnt]."</td><td>".$comprArray[$cnt]."</td><td>".
                     $readArray[$cnt]."</td><td>".$writeArray[$cnt]."</td></tr>";
             }
         }
         $result = $result."</tr><tr><td>Driver's license</td>";
         //drivers license
         if(isset($_POST['license'])){
             $licenses = $_POST['license'];
                 $result = $result."<td colspan='4'>";
                 foreach($licenses as $x){
                     $result = $result."$x, ";
                 }
                 $result = substr($result, 0, count($result)-3);
         }else{
             $result = $result."<td colspan='4'>No license";
         }
         $result = $result."</td></tr></table>";

         echo $result;
     }else{
         echo "<h1>Invalid Input</h1>";
     }
 }
?>

<script>
    var nextId = 0;
    var nextLang = 0;
    function addField() {
        nextId++;
        var inputDiv = document.createElement("div");
        inputDiv.setAttribute("id", "num" + nextId);
        inputDiv.innerHTML = document.getElementById('num0').innerHTML;
        document.getElementById('compBox').appendChild(inputDiv);
    }

    function removeField(){
        if(nextId>0){
            var element = document.getElementById("num"+nextId);
            element.parentNode.removeChild(element);
            nextId--;
        }
    }

    function addLanguage(){
        nextLang++;
        var newLang = document.createElement("div");
        newLang.setAttribute("id", "lang" + nextLang);
        newLang.innerHTML = document.getElementById('lang0').innerHTML;
        document.getElementById('langContainer').appendChild(newLang);
    }

    function removeLanguage(){
        if(nextLang>0){
            var element = document.getElementById("lang"+nextLang);
            element.parentNode.removeChild(element);
            nextLang--;
        }
    }

</script>