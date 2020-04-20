<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="users-list">
    <p id="unload_csv"><a id="form_csv" href="#">Сформировать список в CSV</a></p>
    <p id="unload_xml"><a id="form_xml" href="#">Сформировать список в XML</a></p>
    <table>
        <tr  class="string">
            <td class="colum">
                <span>ID</span>
            </td>
            <td class="colum">
                <span>Login</span>
            </td>
            <td class="colum">
                <span>E-mail</span>
            </td>
        </tr>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <tr class="string">
                <td class="colum"><span><?=$arItem["ID"];?></span></td>
                <td class="colum"><span><?=$arItem["LOGIN"];?></span></td>
                <td class="colum"><span><?=$arItem["EMAIL"];?></span></td>
            </tr>
        <?endforeach;?>
    </table>
    <div class="page-list">
        <br /><?=$arResult["NAV_STRING"]?>
    </div>

    <script>
        $(function() {
            $("#form_csv").on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?echo ($this->GetFolder());?>/ajax.php',
                    type: 'POST',
                    data: {
                        'AJAX': 'Y',
                        'action': 'getUsersCvs'
                    },
                    success: function (data) {
                        $("#unload_csv").html('<a download href="'+data+'">Скачать csv</a>')
                    }
                });
            });
            $("#form_xml").on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?echo ($this->GetFolder());?>/ajax.php',
                    type: 'POST',
                    data: {
                        'AJAX': 'Y',
                        'action': 'getUsersXml'
                    },
                    success: function (data) {
                        $("#unload_xml").html('<a download href="'+data+'">Скачать xml</a>')
                    }
                });
            });
        });
    </script>
</div>
