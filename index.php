<html>
	<head>
		<title>
			Todo Note app
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script language="javascript" type="text/javascript" src="jquery.js"></script>
		<script language="javascript" type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<div class="main">
			<div class="submit">
				 <div class="heading_sur">
					<section class="heading">
						Recall
					</section>
				</div>
				<?php
				
					$file="todo.txt";
					$file1="done.txt";
					
					$show_start="<div class = 'container'>";
					$show_end="</div>";

					$lines=file($file);
					$x=sizeof($lines);

					$liness=file($file1);
					$ss=sizeof($liness);
					
					echo '
							<div id="10">
								 <form class="form">
									Newer Todo List<br> 
									<input type="text" name="todo" placeholder=" Add you Task here..." autofocus="true" class="text_area" id="inputfield" onkeydown="return keypres(this.form,'.$x.",".$ss.')">
									<input type="submit" value="Submit" id="button" onclick="return sendform(this.form,'.$x.",".$ss.')">
								</form>
							</div>
						</div>
						<div class="php_data_todo">
							ToDO
							<div id="11">';
					
					if($_REQUEST['todo'])
					{
						$file_write=fopen($file, 'a') or die("Can't open file");
						$stat = fstat($file_write);
						ftruncate($file, $stat['size']-1);
						$a = $_REQUEST["todo"];
						$lines_temp=file($file);
						$size=sizeof($lines_temp);
						if($size!=0)
						{
							$a="\n".$a;
						}
						fwrite($file_write,$a);
						fclose($file_write);
					}
					
					if($_REQUEST['delete']=="true")
					{
						$index=$_REQUEST['index'];

						$file_adddata=fopen($file1, 'a') or die("Can't open file");
						
						$lines=file($file);
						
						$file_removedata=fopen($file, 'w') or die("Can't open file");
						fclose($file_removedata);

						$file_removedata=fopen($file, 'a') or die("Can't open file");
						for($i=0;$i<sizeof($lines);$i++)
						{	if($i!=$index)
							{
								fwrite($file_removedata,$lines[$i]);
							}
							else
							{
								$lines_temp=file($file1);
								$length=sizeof($lines_temp);
								if($length==0)
								{
									$lines[$i].="\n";
								}
								fwrite($file_adddata,$lines[$i]);
							}
						}

						fclose($file_adddata);
						fclose($file_removedata);

					}

					if($_REQUEST['edit'])
					{
						$index=$_REQUEST['index'];
						$a=$_REQUEST['edit'];
						$a.="\n";

						$lines=file($file);

						$file_removedata=fopen($file, 'w') or die("Can't open file");
						fclose($file_removedata);

						$file_removedata=fopen($file, 'a') or die("Can't open file");
						for($i=0;$i<sizeof($lines);$i++)
						{	if($i!=$index)
							{
								fwrite($file_removedata,$lines[$i]);
							}
						   	else 
							{
								fwrite($file_removedata,$a);
							}
						}
					}

					for($i=sizeof($lines)-1;$i>=0;$i--)
					{
						$length=strlen($lines[$i]);
						$div_start="<div class = 'type' id = 'div".$i."'>";
						$div_end="</div>";
						$edit="<input type='button' value='e' onclick='editdata(".$length.",".$i.",".$ss.")' class='cross' id='edit".$i."'>";
						$cross="<input type='button' value='x' onclick='deletedata(".$length.",".$i.",".$ss.")' class='cross' id='input".$i."'>";
						$hr="<hr class = 'horizontal-ruler' id='hor".$i."'>";
						echo $show_start;
						echo $div_start;
						echo $lines[$i];
						echo $cross;
						echo $edit;
						echo $div_end;
						echo $show_end;
						echo $hr;
					} 
				?>
				</div>
			</div>
			<div class="php_data_done">
				Recently Done
				<div id="12">
					<?php
						$file="done.txt";

						$file_read=fopen($file,'r') or die("Cant open file");
						$lines=file($file);

						$show_start="<div class = 'container'>";
						$div_start="<div class = 'type'>";
						$div_end="</div>";
						$show_end="</div>";
						$hr="<hr class = 'horizontal-ruler'>";
						
						for($i=sizeof($lines)-1;$i>=0;$i--)
						{
							$cross="<input type='button' value='x' onclick='totaldelete(".$i.")' class='cross' id='output".$i."'>";
							$hr="<hr class = 'horizontal-ruler' id='hor_out".$i."'>";

							echo $show_start;
							echo $div_start;
							echo $lines[$i];
							echo $cross;
							echo $div_end;
							echo $show_end;
							echo $hr;
						} 

						if($_REQUEST['totaldelete'])
						{
							$index=$_REQUEST['index'];

							$liness=file($file1);
							
							$file_deletedata=fopen($file1,'w') or die("Cant open file");
							fclose($file_deletedata);

							$file_deletedata=fopen($file1,'a') or die("Cant open file");
						
							for($i=0;$i<sizeof($liness);$i++)
							{
								if($i!=$index)
								{
									fwrite($file_deletedata,$liness[$i]);
								}
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>