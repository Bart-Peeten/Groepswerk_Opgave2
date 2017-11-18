<?php
/**
 * Created by PhpStorm.
 * User: booneny
 * Date: 18/11/2017
 * Time: 16:51
 */
$id;
if(isset($_GET['id']) AND is_numeric($_GET['id']))
{
    $id=$_GET['id'];

} else {
    header("Location: index.html");
}


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
</head>
<style>

</style>
<body>
<form>
    <input type="hidden" id="contactid" value="<?php echo $id ?>">
    <label>First Name</label>
    <input type="text" id="firstName"/>
    <br/>
    <label>Last Name</label>
    <input type="text" id="lastName"/>
    <br/>
    <label>Email address</label>
    <input type="text" id="emailAddress"/>
    <br/>
    <button type="button" onclick="submitForm()">Save</button>
    <button type="button" onclick="cancelForm()">Cancel</button>
</form>


<script type="text/javascript" src="edit.js"></script>
</body>
</html>

