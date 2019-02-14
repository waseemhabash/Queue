@extends('dashboard.layouts.index')

@section('content')
<a href="">
	<button class="btn btn-success">
		<i class="fa fa-plus"></i>
	</button>
</a>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- start: BASIC TABLE PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Basic table
				<div class="panel-tools">
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
					</a>
					<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
						<i class="fa fa-wrench"></i>
					</a>
					<a class="btn btn-xs btn-link panel-refresh" href="#">
						<i class="fa fa-refresh"></i>
					</a>
					<a class="btn btn-xs btn-link panel-expand" href="#">
						<i class="fa fa-resize-full"></i>
					</a>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hover" id="sample-table-1">
					<thead>
						<tr>
							<th class="center">#</th>
							<th>Browser</th>
							<th class="hidden-xs">Creator</th>
							<th>Software license</th>
							<th class="hidden-xs">Current layout engine</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="center">1</td>
							<td class="hidden-xs">Google Chrome</td>
							<td>Google</td>
							<td>
								<a href="#" rel="nofollow" target="_blank">
									Terms of Service
								</a></td>
								<td class="hidden-xs">Blink</td>
								<td class="center">
									<div class="visible-md visible-lg hidden-sm hidden-xs">
										<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
										<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
									</div>
									<div class="visible-xs visible-sm hidden-md hidden-lg">
										<div class="btn-group">
											<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
												<i class="fa fa-cog"></i> <span class="caret"></span>
											</a>
											<ul role="menu" class="dropdown-menu pull-right">
												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="#">
														<i class="fa fa-edit"></i> Edit
													</a>
												</li>
												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="#">
														<i class="fa fa-share"></i> Share
													</a>
												</li>
												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="#">
														<i class="fa fa-times"></i> Remove
													</a>
												</li>
											</ul>
										</div>
									</div></td>
								</tr>
								<tr>
									<td class="center">2</td>
									<td>Internet Explorer</td>
									<td class="hidden-xs">Microsoft, Spyglass</td>
									<td>
										<a href="#" rel="nofollow" target="_blank">
											Proprietary
										</a></td>
										<td class="hidden-xs">Trident</td>
										<td class="center">
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
												<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
												<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
											</div>
											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="btn-group">
													<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
														<i class="fa fa-cog"></i> <span class="caret"></span>
													</a>
													<ul role="menu" class="dropdown-menu pull-right">
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-edit"></i> Edit
															</a>
														</li>
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-share"></i> Share
															</a>
														</li>
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-times"></i> Remove
															</a>
														</li>
													</ul>
												</div>
											</div></td>
										</tr>
										<tr>
											<td class="center">3</td>
											<td>Mozilla Firefox</td>
											<td class="hidden-xs">Mozilla Foundation</td>
											<td>
												<a href="#" rel="nofollow" target="_blank">
													MPR
												</a></td>
												<td class="hidden-xs">Gecko</td>
												<td class="center">
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
														<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
														<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
													</div>
													<div class="visible-xs visible-sm hidden-md hidden-lg">
														<div class="btn-group">
															<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																<i class="fa fa-cog"></i> <span class="caret"></span>
															</a>
															<ul role="menu" class="dropdown-menu pull-right">
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#">
																		<i class="fa fa-edit"></i> Edit
																	</a>
																</li>
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#">
																		<i class="fa fa-share"></i> Share
																	</a>
																</li>
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#">
																		<i class="fa fa-times"></i> Remove
																	</a>
																</li>
															</ul>
														</div>
													</div></td>
												</tr>
												<tr>
													<td class="center">4</td>
													<td>Safari</td>
													<td class="hidden-xs">Apple Inc.</td>
													<td>
														<a href="#" rel="nofollow" target="_blank">
															Proprietary
														</a></td>
														<td class="hidden-xs">WebKit</td>
														<td class="center">
															<div class="visible-md visible-lg hidden-sm hidden-xs">
																<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
																<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
																<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
															</div>
															<div class="visible-xs visible-sm hidden-md hidden-lg">
																<div class="btn-group">
																	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																		<i class="fa fa-cog"></i> <span class="caret"></span>
																	</a>
																	<ul role="menu" class="dropdown-menu pull-right">
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#">
																				<i class="fa fa-edit"></i> Edit
																			</a>
																		</li>
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#">
																				<i class="fa fa-share"></i> Share
																			</a>
																		</li>
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#">
																				<i class="fa fa-times"></i> Remove
																			</a>
																		</li>
																	</ul>
																</div>
															</div></td>
														</tr>
														<tr>
															<td class="center">5</td>
															<td>Opera</td>
															<td class="hidden-xs">Opera Software</td>
															<td>
																<a href="#" rel="nofollow" target="_blank">
																	Proprietary
																</a></td>
																<td class="hidden-xs">Presto</td>
																<td class="center">
																	<div class="visible-md visible-lg hidden-sm hidden-xs">
																		<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
																		<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
																		<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
																	</div>
																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="btn-group">
																			<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<!-- end: BASIC TABLE PANEL -->
											</div>
										</div>
										@endsection
