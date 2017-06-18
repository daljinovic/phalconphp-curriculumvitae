<section class="content-section" id="divToPrint">
	
	{{ link_to("employer/students/1", "First") }}
	{{ link_to("employer/students/" ~students.before, "Previous") }}
	{{ link_to("employer/students/" ~students.next, "Next") }}
	{{ link_to("employer/students/" ~students.last, "Last") }}
	
	<hr>		
	
	<table class="table table-striped table-responsive">
		<thead class="thead-default">
			<tr>
				<th>#</th>
  			    <th>First Name</th>
			    <th>Last Name</th>
			    <th>Email</th>
			</tr>
		</thead>
		<tbody>
			{% for student in students.items %}
				<tr>
				    <th scope="row">1</th>
				    <td>{{ student.fname }}</td>
				    <td>{{ student.lname }}</td>
				    <td>{{ student.email }}</td>
					<td>{{ link_to("employer/bookmark/" ~student.id, "Bookmark") }}</td>
					<td>{{ link_to("employer/student-cv/" ~student.id, "Show CV") }}</td>
				</tr>
			{% endfor %}
		</tbody>
	</table>
	
	
	<div>Total: {{ students.total_items }}</div>

	<ul class="pagination">
		{% if students.current != 1 %}
			<li>
				<a href="{{ url('employer/students/1') }}">&laquo;</a>
			</li>
		{% endif %}

		{% for i in 1..students.total_pages %}
			<li {% if i == students.current %} class="active" {% endif %}>
				<a href="{{ url('employer/students/' ~i) }}">{{ i }}</a>
			</li>
		{% endfor %}

		{% if students.current != students.last %}
			<li>
				<a href="{{ url('employer/students/' ~students.last) }}">&raquo;</a>
			</li>
		{% endif %}
	</ul>

</section>