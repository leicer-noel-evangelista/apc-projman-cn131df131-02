					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<?php
		$listOfJS = (isset($listOfJS))?$listOfJS:array();
		foreach($listOfJS as $js) {
			echo '<script src="js/'.$js.'.js"></script>';
		}
		?>
	</body>
</html> 