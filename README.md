# mozarellamaniac
Rendszerfejlesztés projekt - Pizza

# GET
<br />A kliens által küldött kérések (GET). A kéréseket kiszolgáló fájlok a szerver gyökerében létrehozott 'api' mappában legyenek.<br />
<ul>
<li>/api/items //Az összes pizzát lekéri</li>
<li>/api/item?id=<i>numericValue</i> // Az id alapján lekéri a pizza tartalmát</li>
</ul>

# JSON minták
/api/items:<br />
[{pizza_id:0,"name":"pizza_name","price":0,"image":"image"},{...}]<br />
/api/item?id=0<br />
{pizza_id:0,"pizza_name":"name","price":0,"topping_sub":[{"topping_name":"topping"}],"image":"image"}
