<?php
if ( !isset($view_files) )
{
	require '../config.php';
}
?>

<div class="page-title">
	<a class="<?php echo $buttons['create'] ?> pull-right" href="index.php?page=page-create" data-page="page-create"><?php echo $icons['create'] . CREATE_ITEM ?></a>
	<span class="title">
		<?php
		// Get icon and title from Array $files, defined in config.php
		echo $view_files['pages']['icon'] . ' ' . $view_files['pages']['title']
		?>
	</span>
</div>

<div class="card">
	<div class="card-header">
		<div class="card-title">
			<div class="title"><?php echo OVERVIEW_TABLE_HEADER ?></div>
		</div>
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
				<form class="form-inline" data-page="pages">
					<input type="hidden" name="page" value="pages">
					<label class="font-weight-300">
						Vis
						<select class="form-control input-sm" name="page-length" data-change="submit-form">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						elementer
					</label>
				</form>
			</div>
			<div class="col-md-5 col-md-offset-3 text-right">
				<form data-page="pages">
					<input type="hidden" name="page" value="pages">
					<div class="input-group input-group-sm">
						<input type="search" name="search" id="search" class="form-control" placeholder="<?php echo PLACEHOLDER_SEARCH ?>" value="">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><?php echo $icons['search'] ?></button>
						</span>
					</div>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
				<tr>
					<th>
						<a href="index.php?page=pages&sort-by=title&order=desc" data-page="pages" data-params="sort-by=title&order=desc" title="<?php echo SORT_BY_THIS_COLUMN ?>"><?php echo $icons['sort-asc'] . TITLE ?></a>
					</th>
					<th>
						<a href="index.php?page=pages&sort-by=url&order=desc" data-page="pages" data-params="sort-by=address&order=desc" title="<?php echo SORT_BY_THIS_COLUMN ?>"><?php echo URL ?></a>
					</th>
					<th class="icon"></th>
					<th class="toggle">
						<a href="index.php?page=pages&sort-by=locked&order=desc" data-page="pages" data-params="sort-by=locked&order=desc" title="<?php echo SORT_BY_THIS_COLUMN ?>"><?php echo LOCKED ?></a>
					</th>
					<th class="toggle">
						<a href="index.php?page=pages&sort-by=status&order=desc" data-page="pages" data-params="sort-by=status&order=desc" title="<?php echo SORT_BY_THIS_COLUMN ?>"><?php echo STATUS ?></a>
					</th>
					<th class="icon"></th>
					<th class="icon"></th>
				</tr>
				</thead>

				<tbody>
				<tr>
					<td>Blog</td>
					<td><a href="../blog" target="_blank">/blog</a></td>

					<!-- LINK TIL SIDEINDHOLD -->
					<td class="icon">
						<a href="index.php?page=page-content&page-id=1" title="<?php echo $view_files['page-content']['title'] ?>" data-page="page-content" data-params="id=1"><?php echo $view_files['page-content']['icon'] ?></a>
					</td>

					<!-- TOGGLE TIL BESKYT/BESKYT IKKE ELEMENT -->
					<td class="toggle">
						<input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
					</td>

					<!-- TOGGLE TIL AKTIVER/DEAKTIVER ELEMENT -->
					<td class="toggle">
						<input type="checkbox" class="toggle-checkbox" name="my-checkbox" disabled>
					</td>

					<!-- REDIGER LINK -->
					<td class="icon">
						<a class="<?php echo $buttons['edit'] ?>" href="index.php?page=page-edit&id=1" data-page="page-edit" data-params="id=1" title="<?php echo EDIT_ITEM ?>"><?php echo $icons['edit'] ?></a>
					</td>

					<!-- SLET LINK -->
					<td class="icon">
						<a class="<?php echo $buttons['delete'] ?>" data-toggle="confirmation" href="index.php?page=pages&id=1&delete" data-page="pages" data-params="page-id=1&delete" title="<?php echo DELETE_ITEM ?>"><?php echo $icons['delete'] ?></a>
					</td>
				</tr>

				<tr>
					<td>Forside</td>
					<td><a href="../" target="_blank">/</a></td>

					<!-- LINK TIL SIDEINDHOLD -->
					<td class="icon">
						<a href="index.php?page=page-content&page-id=2" title="<?php echo $view_files['page-content']['title'] ?>" data-page="page-content" data-params="page-id=2"><?php echo $view_files['page-content']['icon'] ?></a>
					</td>

					<!-- TOGGLE TIL BESKYT/BESKYT IKKE ELEMENT -->
					<td class="toggle">
						<input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
					</td>

					<!-- TOGGLE TIL AKTIVER/DEAKTIVER ELEMENT -->
					<td class="toggle">
						<input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
					</td>

					<!-- REDIGER LINK -->
					<td class="icon">
						<a class="<?php echo $buttons['edit'] ?>" href="index.php?page=page-edit&id=2" data-page="page-edit" data-params="id=2"  title="<?php echo EDIT_ITEM ?>"><?php echo $icons['edit'] ?></a>
					</td>

					<!-- SLET LINK -->
					<td class="icon">
						<a class="<?php echo $buttons['delete'] ?>" data-toggle="confirmation" href="index.php?page=pages&id=2&delete" data-page="pages" data-params="id=2&delete" title="<?php echo DELETE_ITEM ?>"><?php echo $icons['delete'] ?></a>
					</td>
				</tr>
				</tbody>
			</table>
		</div><!-- /.table-responsive -->

		<div class="row">
			<div class="col-md-3">
				<?php echo sprintf(SHOWING_ITEMS_AMOUNT, 1, 10, 97) ?>
			</div>
			<div class="col-md-9 text-right">
				<ul class="pagination">
					<li class="disabled"><a href=""><?php echo $icons['previous'] ?></a></li>
					<li class="active"><span>1</span></li>
					<li><a href="index.php?page=pages&page-no=2" data-page="pages" data-params="page-no=2">2</a></li>
					<li><a href="index.php?page=pages&page-no=3" data-page="pages" data-params="page-no=3">3</a></li>
					<li><a href="index.php?page=pages&page-no=4" data-page="pages" data-params="page-no=4">4</a></li>
					<li><a href="index.php?page=pages&page-no=5" data-page="pages" data-params="page-no=5">5</a></li>
					<li class="disabled">
						<span>&hellip;</span>
					</li>
					<li><a href="index.php?page=pages&page-no=9" data-page="pages" data-params="page-no=9">9</a></li>
					<li><a href="index.php?page=pages&page-no=2" data-page="pages" data-params="page-no=2"><?php echo $icons['next'] ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php
if (DEVELOPER_STATUS) { show_developer_info(); }
