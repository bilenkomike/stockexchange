<footer class="footer" id="footer">
	<div class="footer__inner">
		<?php if($pagination_last_item > 1): ?>
		<ul class="pagination">
			<li class="pagination__item">
				<a class="pagination__link" href="<?php echo $location; ?><?php  if(isset($category)){echo $category.'/'; } ?>1/">
					<i class="fas fa-fast-backward"></i>
				</a>
			</li>
			<?php if($page_num - 1 >= 1): ?>
				<li class="pagination__item">
					<a href="<?php echo $location; ?><?php if(isset($category)){echo $category.'/';} ?><?php echo $page_num -1; ?>/" class="pagination__link">
						<i class="fas fa-step-backward"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if($pagination_last_item <= 10): ?>
				<?php for($i = 1; $i <= $pagination_last_item; $i++): ?>
				<li class="pagination__item">
					<a href="<?php echo $location; ?><?php if(!empty($category)) echo $category.'/'; ?><?php echo $i; ?>/" class="pagination__link">
						<?php echo $i; ?>
					</a>
				</li>
				<?php endfor; ?>
			<?php else: ?>
				<li class="pagination__item">
					<a href="<?php echo $location; ?><?php echo $category; ?>/1/" class="pagination__link">
						1
					</a>
				</li>
				<li class="pagination__item">
					<a href="<?php echo $location; ?><?php echo $category; ?>/2/" class="pagination__link">
						2
					</a>
				</li>

				<li class="pagination__item">
					<form action="" method="POST">
						<input type="text" autocomplete="off" name="pagination__num" class="pagination__link" placeholder="...">
					</form>
				</li>

				<li class="pagination__item">
					<a href="<?php echo $location; ?><?php echo $category; ?>/<?php echo $pagination_last_item; ?>/" class="pagination__link">
						<?php echo $pagination_last_item; ?>
					</a>
				</li>
			<?php endif; ?>
			<!-- <li class="pagination__item">
				<a href="" class="pagination__link">
					99
				</a>
			<li> -->
			<?php if($page_num + 1 <= $pagination_last_item): ?>
				<li class="pagination__item">		
					<a class="pagination__link" href="<?php echo $location; ?><?php if(isset($category)){echo $category.'/'; }?><?php echo $page_num + 1; ?>/">
						<i class="fas fa-step-forward"></i>
					</a>
				<li>
			<?php endif; ?>
			<li class="pagination__item">
				<a href="<?php echo $location; ?><?php  if(isset($category)){echo $category.'/'; } ?><?php echo $pagination_last_item; ?>/" class="pagination__link">
					<i class="fas fa-fast-forward"></i>
				</a>
			</li>
		</ul>
	<?php endif; ?>
	</div>
</footer><!--/.footer-->
