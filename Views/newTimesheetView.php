<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
	<link rel="stylesheet" href="../Css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<head/>

<body>
<div class="main-timesheet-container">
	<form class="pure-form pure-form-stacked" action="../Controllers/TimesheetViewController.php" method="post">

		<legend class="">New timesheet</legend>
			<br>
			<fieldset>
				<div class="date-timefrom-timeto-container">
					<div class="date">
			        	<label for="date">Date</label>
			        	<input type="date" name="datetime[1]['date']" placeholder="Date" />
			        </div>
			        <div class="time-from">
				        <label for="time-from">Time From</label>
				        <input type="time" name="datetime[1]['timefrom']" placeholder="Time" />
			    	</div>
			    	<div class="time-to">
				        <label for="time-from">Time To</label>
						<input type="time" name="datetime[1]['timeto']" placeholder="Time" />
					</div>
				</div>

		        <label for="name">Name</label>
		        <input type="text" name="name" placeholder="Name" />

		        <label for="contract">Contract</label>
		        <select name="contract">
		            <option>Telent</option>
		            <option>KNN</option>
		            <option>Virgin Media</option>
		        </select>

		        <label for="jobnumber">Job Number</label>
		        <input type="text" name="jobnumber" placeholder="Job Number" />

		        <label for="estimate">Estimate</label>
		        <input type="text" name="estimate" placeholder="Estimate" />

		        <label for="exchange">Exchange</label>
		        <input type="text" name="exchange" placeholder="Exchange" />

		        <label for="email">Email</label>
		        <input type="text" name="email" placeholder="Email" />

		        <br><br><br>


				<b>Planned work</b><br><br>

				Synthetic <input type="text" name="plannedsynthetic[1]['plannedsynthetic']"> Quantity <input type="text" name="plannedsynthetic[1]['quantity']"><br>
				<button type="button" class="pure-button" id="btn-add-new-planned-synthetic">Add</button>
				
				<br><br><br><br>


				<b>DfE's / Unplanned work</b><br><br>

				Synthetic <input type="text" name="unplannedsynthetic[1]['unplannedsynthetic']"> Quantity <input type="text" name="unplannedsynthetic[1]['quantity']">
				<textarea id="textarea-unplanned-work-comments-box" name="unplannedsynthetic[1]['comments']" placeholder="Comments"></textarea>
				<br>
				<button type="button" class="pure-button" id="btn-add-new-planned-synthetic">Add</button>

				<br><br><br><br>
				<textarea id="textarea-timesheet-comments-box" name="timesheetcomments" placeholder="Timesheet comments"></textarea>
				<br>
				
				
				<br><br>

		        <button type="submit" class="pure-button pure-button-primary">Submit Timesheet</button>
		    </fieldset>
	</form>
</body>


<script src="../Js/timesheetApp.js"></script>

</div>

