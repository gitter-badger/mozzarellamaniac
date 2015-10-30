# mozarellamaniac

[![Join the chat at https://gitter.im/arpadjuhasz/mozzarellamaniac](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/arpadjuhasz/mozzarellamaniac?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
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
