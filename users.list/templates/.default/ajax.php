<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {

    //Создание массива со списком пользователей
    $order = array('id' => 'asc');
    $tmp = 'asc';
    $filter = array();
    $filds = array('ID', 'LOGIN', 'EMAIL');
    $arParameters = array(
        'FIELDS' => $filds);
    $rsUsers = CUser::GetList($order, $tmp, $filter, $arParameters);
    while ($arUser = $rsUsers->Fetch()) {
        $arResult[] = $arUser;
    }

    $action = $_REQUEST['action'];
    $AJAX = new OurAjax();
    if (method_exists($AJAX, $action)) {
        $AJAX->$action($arResult);
    }

} else {
    echo 'Action is not used';
}

class OurAjax
{
    public function getUsersCvs($arResult) {

        $fp = fopen('/home/bitrix/www/upload/users.csv', 'w');

        //add BOM to fix UTF-8 in Excel
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        foreach ($arResult as $item) {
            fputcsv($fp, $item,';', '"');
        }

        fclose($fp);
        echo ('/upload/users.csv');
    }

    public function getUsersXml($arResult) {

        $export =  new \Bitrix\Main\XmlWriter(array(
            'file' => '/upload/users.xml',
            'create_file' => true,
            'lowercase' => true
        ));

        $export->openFile();
        $export->writeBeginTag('items');

        foreach ($arResult as $item) {
            $export->writeItem($item, 'item');
        }

        $export->writeEndTag('items');
        $export->closeFile();

        echo ('/upload/users.xml');;
    }
}