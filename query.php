<?php
$query = "A continuación se presenta la query para Mercadería Antigua:<br><br>

<b style='color: red;'>Mercadería Antigua por MHT: </b><br><br>

<b>SELECT Stock701722730.SIZE_DESC, Stock701722730.LOCN_BRCD, Stock701722730.Disponible, Stock701722730.Tipo, Stock701722730.WHSE, Stock701722730.LPN<br><br>

FROM   Stock_Cd.dbo.Stock701722730 Stock701722730<br><br>

WHERE  Stock701722730.WHSE = '200' and Stock701722730.Disponible > 0 ORDER BY Stock701722730.DISPONIBLE ASC</b><br><br>

<b style='color: red;'>Mercadería Antigua por EOM:</b><br><br>

<b>SELECT distinct ITEM_CBO.ITEM_NAME, FACILITY_ALIAS.FACILITY_ALIAS_ID, FACILITY_ALIAS.FACILITY_NAME, I_PERPETUAL.AVAILABLE_QUANTITY, I_PERPETUAL.UNAVAILABLE_QUANTITY, I_ALLOCATION.ALLOCATED_QUANTITY, SKU_LOCATION.INV_PROTECTION_1<br><br>

FROM SKU_LOCATION RIGHT JOIN (FACILITY_ALIAS INNER JOIN (I_ALLOCATION INNER JOIN (I_PERPETUAL INNER JOIN ITEM_CBO ON I_PERPETUAL.ITEM_ID = ITEM_CBO.ITEM_ID) ON I_ALLOCATION.INVENTORY_ID = I_PERPETUAL.INVENTORY_ID) ON FACILITY_ALIAS.FACILITY_ID = I_PERPETUAL.FACILITY_ID) ON SKU_LOCATION.SKU_ID = I_PERPETUAL.ITEM_ID<br><br>

WHERE (((I_PERPETUAL.OBJECT_TYPE_ID)=16661)) and FACILITY_ALIAS.FACILITY_ALIAS_ID = 200;</br>";

echo "<p style='font-family: Calibri;'>$query</p>";