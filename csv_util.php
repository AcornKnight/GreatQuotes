<?php
	// ASE 230 Great Quotes Project
	// Noah Gestiehr
	function readContent($file) {
			$csvFile = fopen($file,"r") or die("File does not exist.");
			while(!feof($csvFile)) {
				$contentArray[] = fgetcsv($csvFile);
			}
			fclose($csvFile);
			return $contentArray;
	}
	
	function readContentIndex($file, $index) {
			$csvFile = fopen($file,"r") or die("File does not exist.");
			while(!feof($file)) {
				$contentArray[] = fgetcsv($csvFile);
			}
			fclose($file);
			return $contentArray[$index];
	}
	
	function addContent($userFile, $author,$newContent) {
			$newFile = fopen($userFile,"a") or die("That CSV file does not exist.");
			fputcsv($newFile,$author,$newContent);
			fclose($newFile);
	}
	
	function modifyLine($userFile,$line, $change) {
			
			$contentArray=readContentHeader($userFile);
			$headers=getHeader($userFile);
			//$modify = fopen($userFile,'r+') or die("That csv file does not exist.");
			//while(!feof($modify)) {
			//	$contentArray[]= fgetcsv($modify);
			//}
			//fclose($modify);
			//print_r($line);
			$contentArray[$line]['Quote']= $change;
			array_unshift($contentArray,$headers);
			//print_r($contentArray);
			//print_r($change);
			//echo '<hr>';
			//echo 'Alien';
			print_r(quoteToString($contentArray));
			//fwrite($modify, implode(',',$contentArray));
			file_put_contents($userFile,quoteToString($contentArray));
			//rewind($modify);
			//array_map(fn($value): int => fwrite($modify, quoteToString($value)),$contentArray);
			//fclose($modify);
	}
	
	function emptyContent($userFile,$line) {
			modifyLine($userFile, $line, '');
	}
	
	function quoteToString($quote) {
		//print_r($quote);
		if (is_array($quote)){
			$result = [];
			foreach ($quote as $val) {
					if(is_array($val)) {
						if(array_key_exists("Author",$val) && array_key_exists("Quote",$val)) {
							$result[]= $val['Author'].','.$val['Quote']."\n";
						}
					}
					else {
						print('$val was not array');
						print_r($val);
					}
			}
			return $result;
		}
		else {
			//if(array_key_exists("Author",$quote) && array_key_exists("Quote",$quote)) {
			//	return $quote['Author'].','.$quote['Quote']."\n";
			//}
			//else {
				return null;
			//}
		}
		
	}
	
	function deleteContent($userFile,$line) {
			$modify = fopen($userFile,'r+') or die("That csv file does not exist.");
			
			
			$contentArray=readContentHeader($userFile);
			$headers=getHeader($userFile);
			array_unshift($contentArray,$headers);
			print_r($contentArray);
			//print_r(quoteToString($contentArray));
			
			//while(!feof($modify)) {
			//	$contentArray = fgetcsv($modify);
			//}
			//echo '<h4>line</h4>';
			//print_r($line);
			//echo '<br>';
			//print_r($contentArray);
			//echo '<br>';
			array_splice($contentArray, $line+1, 1);
			//unset($contentArray[$line]);
			//echo '<br>spliced<br>';
			//print_r($contentArray);
			//fwrite($modify, $contentArray);
			//fclose($modify);
			file_put_contents($userFile,quoteToString($contentArray));
	}
	
	function getHeader($file){
		$csv = array_map('str_getcsv', file($file));
		//print_r($csv);
		if (count($csv) < 1) { return [];}
		$headers = $csv[0];
		foreach ($csv as $row) {
			$newRow = [];
			foreach ($headers as $k => $key) {
				$newRow[$key] = $row[$k];
			}
			return $newRow;
		}
	}
	
	function readContentHeader($file){
		//echo $file;
		$csv = array_map('str_getcsv', file($file));
		//print_r($csv);
		if (count($csv) < 1) { return [];}
		$headers = $csv[0];
		unset($csv[0]);
		$rowsWithKeys = [];
		foreach ($csv as $row) {
			$newRow = [];
			foreach ($headers as $k => $key) {
				$newRow[$key] = $row[$k];
			}
			$rowsWithKeys[] = $newRow;
		}
		
		return $rowsWithKeys;
	}
	// Function Calls
	//writeMsg(); // call the function
	
?>