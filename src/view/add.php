<?php
/**
 * Created by PhpStorm.
 * User: booneny
 * Date: 19/11/2017
 * Time: 14:31
 */
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
</head>
<style>

</style>
<body bgcolor="gray" text="white">
<h1 align="center">Add a new contact</h1>
<form>
    <label>First Name</label>
    <input type="text" id="firstName"/>
    <br/>
    <label>Last Name</label>
    <input type="text" id="lastName"/>
    <br/>
    <label>Email address</label>
    <input type="text" id="emailAddress"/>
    <br/>
    <button type="button" id="saveButton">Save</button>
    <button type="button" id="cancelButton">Cancel</button>
</form>

<script type="text/javascript" src="inputControl.js"></script>
<script type="text/javascript" src="add.js"></script>
</body>
</html>
