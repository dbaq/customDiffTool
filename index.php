<?php
error_reporting(E_ALL | E_STRICT);

if(isset($_POST['een'])){ 
        $textSource = trim($_POST['een']);
        $textSourceAr = explode("\n", $textSource); 
        $textNew = trim($_POST['twee']);
        $textNewAr = explode("\n", $textNew); 

        
	// first, we are looking for each lines of the SOURCE input into the NEW input
	$sourceLinesMissingIntheNew = array(); 
   	foreach ($textSourceAr as $line) { 
	        $found = false; 
	        foreach($textNewAr as $testedLine){
                        if (strcasecmp(trim($line), trim($testedLine)) == 0) {
                                $found = true;
                                break;
                        }
                } 
                if(!$found){
                        $sourceLinesMissingIntheNew[] = $line;
                }
        }  
	
	//next
	$newLinesMissingIntheSource = array(); 
   	foreach ($textNewAr as $line) { 
	        $found = false; 
	        foreach($textSourceAr as $testedLine){
                        if (strcasecmp(trim($line), trim($testedLine)) == 0) {
                                $found = true;
                                break;
                        }
                } 
                if(!$found){
                        $newLinesMissingIntheSource[] = $line;
                }
        }  
}

?>


<!DOCTYPE html> 
<html lang="en-US"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Quick Diff Online Tool</title> 
<link rel="stylesheet" type="text/css" href="styles.css">
 
<body data-twttr-rendered="true">

<h1 style="clear:both;">An Online Tool to do a 'quick and dirty' diff of two text or code fragments</h1>
  
<p>Simply paste your first text into the left text box and the other text into the right box and hit 'Submit' to see the results.</p>

<div style="clear:both;" id="wrapper">
		

		<form action="" id="diffForm" method="POST">
			<div class="clearfix">

				<p class="links">

					<label for="een">SOURCE</label>

					<textarea name="een" id="een" cols="30" rows="10"><?php if(isset($_POST['een'])) echo $_POST['een']?></textarea>

				</p>
				<p class="rechts">

					<label for="twee">NEW</label>

					<textarea name="twee" id="twee" cols="30" rows="10"><?php if(isset($_POST['twee'])) echo $_POST['twee']?></textarea>

				</p>
			</div>

			<p class="button"><input type="submit" class="awesome white" id="submit" value="Compare"></p>

		</form>
<?php if(isset($_POST['een'])){ ?>
		<table>
			<thead>
				<tr>
					<th colspan="4">Output</th>
				</tr>
			</thead>
			<tbody id="res">
                                <tr>
                                        <td colspan="2" style="text-align:center;font-weight:bold">Following BASE lines are not in the NEW lines</td>
                                        <td colspan="2" style="text-align:center;font-weight:bold">Following NEW lines are not in the BASE lines</td>
                                </tr>
                                <tr>
                                        <td colspan="2">
                                                <?php foreach($sourceLinesMissingIntheNew as $line) echo $line . "</br>"?>

                                        </td>
                                        <td colspan="2">
                                                <?php foreach($newLinesMissingIntheSource as $line) echo $line . "</br>"?>

                                        </td>
                                </tr>
                                
                        </tbody>
		</table>
<?php } ?>
	</div> 
</body></html>
