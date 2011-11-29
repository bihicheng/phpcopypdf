<?php
/**
 * copy pdf file from downloads directory to documents
 *
 * @author bihicheng
 * @version 1.0
 * @copyright bihicheng, 29 November, 2011
 * @package default
 **/

$d = array(
    'path' => '/Users/bihicheng/Downloads',
    'copy' => '/Users/bihicheng/Documents'
    );

$pdf = array();
$count = 0;
$it = new DirectoryIterator($d['path']);
foreach ($it as $fn) {
    if ($fn->isFile() && $fn->getExtension() == 'pdf' || $fn->getExtension() == 'chm') {
        $pdf[] = $fn->getFilename();
        echo $fn->getFilename(). PHP_EOL;
        if (!file_exists($d['copy'].DIRECTORY_SEPARATOR.$fn->getFilename())) {
            if (!copy($d['path'].DIRECTORY_SEPARATOR.$fn->getFilename(),$d['copy'].DIRECTORY_SEPARATOR.$fn->getFilename())) {
                echo <<<EOL
    Oops.
EOL;
            }
            else {
                echo $d['path'].DIRECTORY_SEPARATOR.$fn->getFilename() . '===========>'.$d['copy'].PHP_EOL;
                $count += 1;
            }
            }
        else {
            echo "File:{$fn->getFilename()} already exists.";
        }
    }
}

if ($count == count($pdf)) {
    echo 'copy all completely.'. $count;
}
