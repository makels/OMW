<?php /* Smarty version 2.6.25, created on 2017-11-03 06:09:39
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/orders/tmpl/orders.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin//modules/orders/tmpl/orders.tpl', 17, false),array('modifier', 'date_format', '/home/admin/web/bulag.tk/public_html/admin//modules/orders/tmpl/orders.tpl', 67, false),)), $this); ?>
<?php echo '
    <style>
        .orders_list .cell_center{
            text-align: center;
        }
    </style>
'; ?>

<script>
    var OrdersList = JSON.parse('<?php echo $this->_tpl_vars['orders_json']; ?>
');
</script>
<div class="products module">
    <div class="module-title gradient">Заказы</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/orders/" method="post">
            <input type="hidden" name="action" id="form_action" value="">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');"><?php echo smarty_function_fa_icon(array('name' => "user-plus"), $this);?>
Создать заказ</button>
                <button type="submit" onclick="$('#form_action').val('delete');"><?php echo smarty_function_fa_icon(array('name' => "user-times"), $this);?>
Удалить заказ</button>
                <button type="button" onclick="modalMap.openOrders(OrdersList);return false;"><?php echo smarty_function_fa_icon(array('name' => 'map'), $this);?>
Показать на карте</button>
            </div>
            <div class="filter-wrapper">
                <label>Статус:&nbsp;</label>
                <select name="filter_status" onchange="document.location.href = '/admin/orders/?filter_status=' + $(this).val();">
                    <option <?php if ($this->_tpl_vars['filter_status'] == -1): ?>selected<?php endif; ?> value="-1">Все</option>
                    <option <?php if ($this->_tpl_vars['filter_status'] == 0): ?>selected<?php endif; ?> value="0">Новый</option>
                    <option <?php if ($this->_tpl_vars['filter_status'] == 1): ?>selected<?php endif; ?> value="1">Принятый</option>
                    <option <?php if ($this->_tpl_vars['filter_status'] == 2): ?>selected<?php endif; ?> value="2">В работе</option>
                    <option <?php if ($this->_tpl_vars['filter_status'] == 3): ?>selected<?php endif; ?> value="3">Завершен</option>
                </select>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
                <th>Телефон</th>
                <th>Услуга</th>
                <th>Модель</th>
                <th>Номер</th>
                <th>Адрес</th>
                <th>Время</th>
                <th>Создана</th>
                </thead>
                <tbody>
                <?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_order_checkbox" type="checkbox" name="order[<?php echo $this->_tpl_vars['order']['id']; ?>
]" /></td>
                        <td><a href="/admin/orders/edit?id=<?php echo $this->_tpl_vars['order']['id']; ?>
"><?php echo $this->_tpl_vars['order']['name']; ?>
</a></td>
                        <td><a href="/admin/orders/edit?id=<?php echo $this->_tpl_vars['order']['id']; ?>
"><?php if ($this->_tpl_vars['order']['client']): ?><?php echo $this->_tpl_vars['order']['client']['email']; ?>
<?php endif; ?></a></td>
                        <td class="cell_center">
                            <?php if ($this->_tpl_vars['order']['status'] == 0): ?>
                                <span style="color:red;">Новый</span>
                            <?php elseif ($this->_tpl_vars['order']['status'] == 1): ?>
                                <span style="color:dodgerblue;">Принят</span>
                            <?php elseif ($this->_tpl_vars['order']['status'] == 2): ?>
                                <span style="color:#1e5799;">В работе</span>
                            <?php elseif ($this->_tpl_vars['order']['status'] == 3): ?>
                                <span style="color:green;">Завершен</span>
                            <?php endif; ?>
                        </td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['order']['phone']; ?>
</td>
                        <td class="cell_center"><?php if ($this->_tpl_vars['order']['service'] == 0): ?>Стандарт<?php elseif ($this->_tpl_vars['order']['service'] == 1): ?>Премиум<?php elseif ($this->_tpl_vars['order']['service'] == 2): ?>Полный<?php endif; ?></td>
                        <td class="cell_center"><?php if ($this->_tpl_vars['order']['model'] == 0): ?>Седан<?php else: ?>Джип<?php endif; ?></td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['order']['number']; ?>
</td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['order']['address']; ?>
</td>
                        <td class="cell_center"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['date_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%y %H:%M")); ?>
</td>
                        <td class="cell_center"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['create_order'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%y %H:%M")); ?>
</td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->_tpl_vars['GOOGLE_KEY']; ?>
&libraries=places"></script>