<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
/** Read and validate the workbook before replacing comparison results. */
function agro_read_compare_excel($filename)
{
    require_once __DIR__ . '/Classes/PHPExcel.php';
    $type = PHPExcel_IOFactory::identify($filename);
    if (!in_array($type, array('Excel2007', 'Excel5'), true)) {
        throw new RuntimeException('กรุณาเลือกไฟล์ Excel .xlsx หรือ .xls');
    }
    $reader = PHPExcel_IOFactory::createReader($type);
    $reader->setReadDataOnly(true);
    $book = $reader->load($filename);
    try {
        $sheet = $book->setActiveSheetIndex(0);
        $lastColumn = $sheet->getHighestColumn();
        $headerRow = $sheet->rangeToArray('A1:' . $lastColumn . '1', null, true, true, true);
        $columns = array();
        foreach ($headerRow[1] as $column => $heading) {
            $heading = strtolower(trim((string) $heading));
            if ($heading === 'barcode' || $heading === 'title') {
                $columns[$heading] = $column;
            }
        }
        if (!isset($columns['barcode'], $columns['title'])) {
            throw new RuntimeException('แถวแรกของ Excel ต้องมีหัวคอลัมน์ Barcode และ Title');
        }
        $result = array();
        for ($row = 2; $row <= $sheet->getHighestRow(); ++$row) {
            $cells = $sheet->rangeToArray('A' . $row . ':' . $lastColumn . $row, null, true, true, true);
            $barcode = trim((string) $cells[$row][$columns['barcode']]);
            if ($barcode === '') continue;
            $result[] = array('Barcode' => $barcode, 'Title' => (string) $cells[$row][$columns['title']]);
        }
        if (!$result) {
            throw new RuntimeException('ไม่พบรายการ Barcode ในไฟล์ Excel');
        }
        return $result;
    } finally {
        $book->disconnectWorksheets();
    }
}
