<section class="content-section">

	<h3> Bookmarks </h3>
	<hr>
	
	<div class="form-horizontal">
	
		<ul style="list-style-type:circle">
			{% for i in bookmarks %}
				<li>
					{{ link_to("employer/student-cv/" ~i.student.id, i.student.fname~' '~i.student.lname) }}
				
					<a href="{{ url('employer/bookmark/delete/'~i.student.id) }}">
						<span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span>
					</a>
				</li>
			{% endfor %}
		</ul>
		
	</div>
	
</section>