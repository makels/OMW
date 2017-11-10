Новый заказ № <b>{$order.id}</b><br>
Имя: <b>{$order.name}</b><br>
Телефон: <b>{$order.phone}</b><br>
Модель: <b>{if $order.model == 0}Седан{else}Джип{/if}</b><br>
Адрес: <b>{$order.address}</b><br>
Услуга: <b>{if $order.service == 0}Стандарт{elseif $order.service == 1}Премиум{elseif $order.service == 2}Полный{/if}</b><br>
На время: <b>{$order.date_time}</b><br>
{if $order.flyer_number != ""}Номер флаера: <b>{$order.flyer_number}</b><br>{/if}