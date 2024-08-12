<?
$rsElement = CIBlockElement::GetList($arSort, $arFilter);

while ($arItemElement = $rsElement->GetNextElement()) {
    $arItem = $arItemElement->GetFields();
    $elProps = $arItemElement->GetProperties();
    foreach ($elProps as $elProp) {


        

        $arItem["PROPERTY_" . $elProp['CODE'] . "_VALUE"] = $elProp['VALUE'];
        if ($elProp['CODE'] == 'KMR' && $elProp['VALUE']) {

            $arItem["PROPERTY_KMR_NAME"] = '';
            $KMRRes = CIBlockElement::GetList([], ['ID' => $elProp['VALUE']], false, false, ['NAME']);
            while ($KMRResData = $KMRRes->GetNext()) {
                $arItem["PROPERTY_KMR_NAME"] .= $KMRResData['NAME'] . '<br>';
            }
        }
        if ($elProp['CODE'] == 'QST' && $elProp['VALUE']) {
            $arItem["PROPERTY_QST_NAME"] = CIBlockElement::GetByID($elProp['VALUE'])->GetNext()['NAME'];
        }
        if ($elProp['CODE'] == 'VDP' && $elProp['VALUE']) {
            $arItem["PROPERTY_VDP_NAME"] = CIBlockElement::GetByID($elProp['VALUE'])->GetNext()['NAME'];
        }
        if ($elProp['CODE'] == 'CID' && $elProp['VALUE']) {
            $CIDRes = CIBlockElement::GetList([], ['ID' => $elProp['VALUE']], false, false, ['NAME', 'PROPERTY_K_YUN']);
            if ($CIDResData = $CIDRes->GetNext()) {
                $arItem["PROPERTY_CID_NAME"] = $CIDResData['NAME'];
                $arItem["PROPERTY_CID_PROPERTY_K_YUN_VALUE"] = $CIDResData['PROPERTY_K_YUN_VALUE'];
            }
        }
    }
