<?php
require_once 'model.php';
class Setup extends Model
{
    public function index()
    {
        $filename = 'camagru.sql';
		$templine = '';
		
        $lines = file($filename);
        foreach ($lines as $line) {
		// Skip if comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
		// Add this line to the current segment
            $templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $this->db->exec($templine);
                $templine = '';
            }
        }
        echo "Tables imported successfully";
    }
}
$setup = new Setup();
$setup->index();