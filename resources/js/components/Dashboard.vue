<template>
	<div class="row">
		<div class="col-md-4">
			<a href="report" class="nav-link">
				<div class="card mb-3 shadow mx-3 mycard">
				  	<div class="row no-gutters">
					    <div class="col-md-4">
					      <img v-bind:src="'/img/profit.png'" class="card-img mt-3 p-3" alt="...">
					    </div>
					    <div class="col-md-8">
					      	<div class="card-body">
						        <h5 class="card-title">Income / Expense</h5>
						        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
					      	</div>
					    </div>
				  	</div>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<a href="student" class="nav-link">
				<div class="card mb-3 shadow mx-3 mycard">
				  	<div class="row no-gutters">
					    <div class="col-md-4">
					      <img v-bind:src="'/img/student.png'" class="card-img mt-3 p-3" alt="...">
					    </div>
					    <div class="col-md-8">
					      	<div class="card-body">
						        <h5 class="card-title">Students</h5>
						        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
					      	</div>
					    </div>
				  	</div>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<a href="teacher" class="nav-link">
				<div class="card mb-3 shadow mx-3 mycard">
				  	<div class="row no-gutters">
					    <div class="col-md-4">
					      <img v-bind:src="'/img/classroom.png'" class="card-img mt-3 p-3" alt="...">
					    </div>
					    <div class="col-md-8">
					      	<div class="card-body">
						        <h5 class="card-title">Teachers</h5>
						        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
					      	</div>
					    </div>
				  	</div>
				</div>
			</a>
		</div>
	</div>
	
</template>

<script type="text/javascript">
	export default{

	}
</script>

<style type="text/css">
	.mycard{
		border-radius: 0;
		transition: 0.9s;
	}

	.mycard:hover{
		cursor: pointer;
		transition: 1s;
		transform: scale(1.1);
	}
</style>