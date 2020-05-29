<!DOCTYPE html>
<html>
<head>
	<title>AJAX CRUD+S</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style>
		.MediumSeaGreen{background-color:MediumSeaGreen;}
		.DodgerBlue{background-color:DodgerBlue;}
		.Orange{background-color:Orange;}
		.Tomato{background-color:Tomato;}
		button:hover{filter: brightness(90%);}
		.custom-control-label:before{
		  background-color:white;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before{
		  background-color:Tomato;
		  border-color: Tomato;
		  box-shadow: none;
		}
	</style>
</head>
<body>

<div class="container" style="padding:40px 250px;"> <!--container-->
<div class="shadow p-4 mb-4 bg-white"><!--shadow-->
<div>
	<h1 class="text-center">AJAX CRUD+S</h1>
	<h3 class="text-center">Vanilla JS</h3>
</div>
	<div class="row p-4"> <!--row-->
		<div class="col-sm-6 px-1"><!--column1-->
			<div class="float-right"> <!--create button-->
				<button type="button" class="btn text-light MediumSeaGreen" style="width: 200px;height: 150px;font-size: 30px;" data-toggle="modal" data-target="#create">Create</button>	
				<?php require('process/createModal.php');?>
			</div> <!--create button-->
			<div class="float-right mt-2"> <!--update button-->
				<button type="button" class="btn text-light Orange" style="width: 200px;height: 150px;font-size: 30px;" id="updateButton" data-toggle="modal" data-target="#update">Update</button>
				<?php require('process/updateModal.php');?>				
			</div> <!--update button-->
		</div>
		<div class="col-sm-6 px-1"><!--column2-->
			<div> <!--read button-->
				<button type="button" class="btn text-light DodgerBlue" style="width: 200px;height: 150px;font-size: 30px;" id="readButton" data-toggle="modal" data-target="#read">Read</button>	
				<?php require('process/readModal.php');?>			
			</div> <!--read button-->
			<div class="mt-2"> <!--delete button-->
				<button type="button" class="btn text-light Tomato" style="width: 200px;height: 150px;font-size: 30px;" id="deleteButton" data-toggle="modal" data-target="#delete">Delete</button>
				<?php require('process/deleteModal.php');?>				
			</div> <!--delete button-->
		</div>			
		</div>
	</div> <!--row-->
</div><!--shadow-->
</div> <!--container-->

<script>

document.getElementById('createForm').addEventListener('submit',ajaxCreate);
document.getElementById('readButton').addEventListener('click',ajaxRead);
document.getElementById('updateButton').addEventListener('click',ajaxUpdate);
document.getElementById('deleteButton').addEventListener('click',ajaxDelete);

function ajaxCreate(e){
	//prevents the modal to close
	e.preventDefault();
	//get the values from form and remove spaces 
	var name = document.getElementById('name').value.trim();
	var age = document.getElementById('age').value.trim();
	var address = document.getElementById('address').value.trim();
	var year = document.getElementById('year').value.trim();
	var email = document.getElementById('email').value.trim();
	var description = document.getElementById('description').value.trim();

	//parameters to send in POST
	var params = 'name='+name+'&age='+age+'&address='+address+'&year='+year+'&email='+email+'&description='+description;

	//check if all fields were filled then clear all fields
	if(name!="" && age!="" && address!="" && year!="" && email!="" && description!=""){
		document.getElementById("createForm").reset();
	}

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  
	}
	};
	xhttp.open("POST", "process/createModal.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);
	
}

function ajaxRead(){
	//get request to readPersons.php
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	var persons = JSON.parse(this.responseText);
	    	var output = '';
	    	// using card to output data with for loop
	    	for(var i in persons){
	    		output+=
	    		'<div class="card m-2">'+
	    		'<div class="card-body pb-2">'+
	    		'<div class="row">'+
	    			'<div class="col-sm-12 clearfix">'+
	    				'<button type="button" class="btn text-light DodgerBlue float-right mt-2" onclick="ajaxReadPerson('+ persons[i].id+')">Read</button>'+
	    				'<h6>'+ persons[i].name +'</h6>'+
	    				'<p>'+ persons[i].date +'</p>'+
	    			'</div>'+
	    		'</div>'+
	    		'</div>'+
	    		'</div>'		  
	    	}
	    	document.getElementById('readModal').innerHTML = output;      
	    }
	  };
	  xhttp.open("GET", "process/readPersons.php", true);
	  xhttp.send();
}

function ajaxReadPerson(id){
  	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      	var person = JSON.parse(this.responseText);
	    var output = 

	    '<div class="card m-2">' +
		'<div class="card-body pb-2 px-5">' +
		// back button -> ajaxRead()
		'<button type="button" class="btn btn-dark" onclick="ajaxRead()">Back</button>' +
			'<h3 class="text-center py-3"> I am '+ person.name +'</h3>' +
			'<p>Age: '+ person.age +'</p>' +
			'<p>Address: '+ person.address +'</p>' +
		  	'<p>Year: '+ person.year +'</p>' +
		  	'<p>Email: '+ person.email +'</p>' +
		  	'<p>Description: </p>' +
		  	'<p>'+ person.description +'</p>' +
		'</div>' +
		'</div>';

		document.getElementById('readModal').innerHTML = output;   
    }
  };
  xhttp.open("GET", "process/readPerson.php?id="+id, true);
  xhttp.send();
}

function ajaxUpdate(){
	//get request to readPersons.php
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	var persons = JSON.parse(this.responseText);
	    	var output = '';
	    	for(var i in persons){
	    		output+=
	    		'<div class="card m-2">'+
	    		'<div class="card-body pb-2">'+
	    		'<div class="row">'+
	    			'<div class="col-sm-12 clearfix">'+
	    				'<button type="button" class="btn text-light Orange float-right mt-2" onclick="ajaxUpdatePerson('+ persons[i].id+')">Update</button>'+
	    				'<h6>'+ persons[i].name +'</h6>'+
	    				'<p>'+ persons[i].date +'</p>'+
	    			'</div>'+
	    		'</div>'+
	    		'</div>'+
	    		'</div>'		  
	    	}
	    	document.getElementById('updateModal').innerHTML = output;      
	    }
	  };
	  xhttp.open("GET", "process/readPersons.php", true);
	  xhttp.send();
}

function ajaxUpdateSubmit(id,values){
	//trimming values
	var name = values.name.trim();
	var age = values.age.trim();
	var address = values.address.trim();
	var year = values.year.trim();
	var email = values.email.trim();
	var description = values.description.trim();

	//parameters to send in POST
	var params = 'id='+id+'&name='+name+'&age='+age+'&address='+address+'&year='+year+'&email='+email+'&description='+description;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  ajaxUpdate();
	}
	};
	xhttp.open("POST", "process/updateData.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);


}

function getValues(){
	//getting form values
	var name = document.getElementById('updateForm').elements[0].value;
	var address = document.getElementById('updateForm').elements[1].value;
	var email = document.getElementById('updateForm').elements[2].value;
	var age = document.getElementById('updateForm').elements[3].value;
	var year = document.getElementById('updateForm').elements[4].value;
	var description = document.getElementById('updateForm').elements[5].value;

	return {
		name: name,
		address: address,
		email: email,
		age: age,
		year: year,
		description: description
	}
	
}

function ajaxUpdatePerson(id){
  	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		document.getElementById('updateModal').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "process/updateForm.php?id="+id, true);
  xhttp.send();	
}

function confirmDelete(id){

	var checkbox = document.getElementById("customCheck"+id);
	if(checkbox.checked == true){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			ajaxDelete();
		}
		};
		xhttp.open("GET", "process/deleteData.php?id="+id, true);
		xhttp.send();	
	}

}


function ajaxDelete(){
	//get request to readPersons.php
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var persons = JSON.parse(this.responseText);
		var output = '';
		for(var i in persons){
			output+=
			'<div class="card m-2">'+
			'<div class="card-body pb-2">'+
			'<div class="row">'+
				'<div class="col-sm-12 clearfix">'+
					'<button type="button" class="btn text-light Tomato float-right mt-2" onclick="confirmDelete('+ persons[i].id+')">Delete</button>'+
				    '<div class="custom-control custom-checkbox float-right mt-3 mr-2">'+
				    '<p class="d-inline-block mr-4 pr-2">Confirm</p>'+
      				'<input type="checkbox" class="custom-control-input" id="customCheck'+ persons[i].id+'" +name="example1">'+
      				'<label class="custom-control-label" for="customCheck'+ persons[i].id+'"></label>'+
          			'</div>'+

					'<h6>'+ persons[i].name +'</h6>'+
					'<p>'+ persons[i].date +'</p>'+
				'</div>'+
			'</div>'+
			'</div>'+
			'</div>'		  
		}
		document.getElementById('deleteModal').innerHTML = output;      
	}
	};
	xhttp.open("GET", "process/readPersons.php", true);
	xhttp.send();
}

$(document).ready(function(){
  $("#myInputRead").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#readModal div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInputUpdate").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#updateModal div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInputDelete").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#deleteModal div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


</script>

</body>
</html>