<style>.dashboard-tabs a { text-decoration:none; color:inherit; } .table_chart th,.table_chart td { padding : 5px; } </style>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin">
			<div class="d-flex justify-content-between flex-wrap">
				<div class="d-flex align-items-end flex-wrap">
					<div class="mr-md-3 mr-xl-5">
						<h2>Welcome back, <?php if(isset($session_data->name)) echo $session_data->name; else echo 'Admin';  ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row grid-margin">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body d-flex justify-content-between">
					<div class="float-start">
						<h1 class="text-muted">4</h1>
						<p class="mt-3 text-grey">Total Banners</p>
					</div>
					<div class="float-end">
						<i class="mdi mdi mdi-application dash-icon"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body d-flex justify-content-between">
					<div class="float-start">
						<h1 class="text-muted">10</h1>
						<p class="mt-3 text-grey">Total Testimonials</p>
					</div>
					<div class="float-end">
						<i class="mdi mdi mdi-star-half dash-icon"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body d-flex justify-content-between">
					<div class="float-start">
						<h1 class="text-muted">8</h1>
						<p class="mt-3 text-grey">Total Services</p>
					</div>
					<div class="float-end">
						<i class="mdi mdi mdi-passport dash-icon"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body d-flex justify-content-between">
					<div class="float-start">
						<h1 class="text-muted">9</h1>
						<p class="mt-3 text-grey">Total Blogs</p>
					</div>
					<div class="float-end">
						<i class="mdi mdi-application dash-icon"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row grid-margin">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h5>Testimonial Ratings</h5>
					<hr>
					<div class="box">
						<div class="box-content">
							<div class="pt-3 pb-3 text-center">
								<div class="border-right">
									<h4 class="strong mb-1 mt-0 text-primary">3</h4>
									<span class="mt-1">Total</span>
								</div>
							</div>
						</div>
						<div class="box-content">
							<div class="pt-3 pb-3 text-center">
								<div class="border-right">
									<h4 class="strong mb-1 mt-0 text-success">2</h4>
									<span class="mt-1">Active</span>
								</div>
							</div>
						</div>
						<div class="box-content">
							<div class="pt-3 pb-3 text-center">
								<div class="border-right">
									<h4 class="strong mb-1 mt-0 text-danger">1</h4>
									<span class="mt-1">Inactive</span>
								</div>
							</div>
						</div>
					</div>
					<div class="progress mt-4">
						<div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card blog-card">
				<div class="card-body">
					<h5>Lastest Blog</h5>
					<div class="box">
						<div class="table-responsive blog-table">
							<table class="table table-hover DataTable">
								<thead>
									<tr>
										<th>Title</th>
										<th>Publish Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Unlocking Productivity: Top 10 Tips to Maximize Your Efficiency</td>
										<td>21-01-2025</td>
										<td><button type="button" style="cursor:default" class="btn btn-success">Active</button></td>
									</tr>
									<tr>
										<td>Top 8 Tips to Increase Your knowledge</td>
										<td>21-01-2025</td>
										<td><button type="button" style="cursor:default" class="btn btn-danger">Inactive</button></td>
									</tr>
									<tr>
										<td>Discover actionable strategies to boost your productivity and achieve more in less time.</td>
										<td>22-01-2025</td>
										<td><button type="button" style="cursor:default" class="btn btn-danger">Active</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>