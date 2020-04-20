<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//Не сохраняем номер страницыв в сессии
CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

//Устанавливаем параметры
$order = array('id' => 'asc');
$tmp = 'asc';
$filter = array();
$navParams = array("nPageSize" => $arParams["PAGE_ELEMENTS"]);
$filds = array('ID', 'LOGIN', 'EMAIL');
$arParameters = array(
    'NAV_PARAMS' => $navParams,
    'FIELDS' => $filds);
$arNavigation = CDBResult::GetNavParams($navParams);

if($this->startResultCache(false, array($arNavigation, $filter))) {

    //Делаем выборку элементов
    $rsUsers = CUser::GetList($order, $tmp, $filter, $arParameters);

    //Вставляем навигацию в массив
    $arResult["NAV_STRING"] = $rsUsers->GetPageNavStringEx($navComponentObject, 'Список', '', 'Y');

    //Вставляем элементы в массив
    while ($arUser = $rsUsers->Fetch()) {
        $arResult["ITEMS"][] = $arUser;
    }

    //Кэшируем
    $this->setResultCacheKeys(array(
        "ITEMS"
    ));

    //Подгружаем шаблон
    $this->includeComponentTemplate();
}
