<?php
$page_no = $_SESSION['page_no'];
$previous_page = $page_no-1;
$next_page = $page_no +1;
$total_no_of_pages = $_SESSION['total_no_of_pages'];

?>

<div class="container">
<ul class="pagination" style="margin-top: 3em;">
	<li>
		<?php if($page_no > 1): ?>

		<a <?php echo "  class='nav-tabs active page_btn'  href='?page_no=$previous_page'"; ?> >
			Previous
		</a>
	<?php endif; ?>
	</li>

	<?php for($counter=1; $counter <=$total_no_of_pages; ++$counter): ?>
		<?php if($counter < 6): ?>
			<li>
				<a class='nav-tabs active page_btn' href="?page_no=<?php echo $counter; ?>"><?php echo $counter;?></a>
			</li>
	<?php elseif($counter > 6) : ?>
		<li>
			<a class='nav-tabs active page_btn' href="?page_no=<?php echo $counter; ?>"><?php echo $counter;?></a>
		</li>
	<?php endif; ?>
<?php endfor; ?>
	<?php
	 if(($page_no < $total_no_of_pages) ): ?>
	<li>
		<a  <?php echo  "  class='nav-tabs active page_btn' href='?page_no=$next_page'";?> >
			Next
		</a>
	</li>
<?php endif;?>

	<?php
		if($page_no > $total_no_of_pages)
		{
			echo "<li><a  class='nav-tabs active page_btn'  href='?page_no=$total_no_of_pages'> $total_no_of_pages &rsaquo;&rsaquo;</a></li>";
		}
	?>
</ul>
</div>


















