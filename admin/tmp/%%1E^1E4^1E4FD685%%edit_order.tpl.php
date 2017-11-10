<?php /* Smarty version 2.6.25, created on 2017-11-03 06:09:42
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/orders/tmpl/edit_order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin//modules/orders/tmpl/edit_order.tpl', 20, false),)), $this); ?>
<script src="/admin/modules/orders/js/orders.js"></script>

<div class="product module">
    <div class="module-title gradient">Заказ</div>
    <div class="module-wrapper">
        <?php if (! $this->_tpl_vars['user']->has_permission('orders')): ?>
            У Вас недостаточно прав для работы с данным режимом
        <?php else: ?>
            <form method="post" action="/admin/orders"  enctype="multipart/form-data">
                <input type="hidden" name="action" id="form_action" value="save">
                <input type="hidden" name="order[id]" value="<?php echo $this->_tpl_vars['order']['id']; ?>
">
                <input type="hidden" name="order[lat]" id="place_lat" value="<?php echo $this->_tpl_vars['order']['lat']; ?>
"/>
                <input type="hidden" name="order[lng]" id="place_lng" value="<?php echo $this->_tpl_vars['order']['lng']; ?>
"/>
                <input type="hidden" name="order[date_time]" value="<?php echo $this->_tpl_vars['order']['date_time']; ?>
" />
                <?php if ($this->_tpl_vars['order']['photo'] != ""): ?>
                    <b>Изображение:</b>
                    <input style="display:none;width: 200px;margin-left: 10px;margin-bottom: 10px;" name="exist_photo" value="<?php echo $this->_tpl_vars['order']['photo']; ?>
">
                    <div class="thumb-image">
                        <img src="/admin/uploads/<?php echo $this->_tpl_vars['order']['photo']; ?>
" />
                        <button style="float: none;margin-left: 10px;" onclick="$('#form_action').val('delete_image');"type="submit"><?php echo smarty_function_fa_icon(array('name' => 'delete'), $this);?>
Удалить</button>
                    </div>
                <?php endif; ?>
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=order[name]" value="<?php echo $this->_tpl_vars['order']['name']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Клиент:</td>
                        <td>
                            <select name="order[user_id]">
                                <option <?php if ($this->_tpl_vars['order']['user_id'] == 0): ?>selected<?php endif; ?> value="0">Не выбран</option>
                                <?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['client']):
?>
                                    <option <?php if ($this->_tpl_vars['order']['user_id'] == $this->_tpl_vars['client']['id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['client']['id']; ?>
"><?php echo $this->_tpl_vars['client']['name']; ?>
 (<?php echo $this->_tpl_vars['client']['email']; ?>
)</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Мойщик:</td>
                        <td>
                            <select name="order[washer_id]">
                                <option <?php if ($this->_tpl_vars['order']['washer_id'] == 0): ?>selected<?php endif; ?> value="0">Не выбран</option>
                                <?php $_from = $this->_tpl_vars['washers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['washer']):
?>
                                    <option <?php if ($this->_tpl_vars['order']['washer_id'] == $this->_tpl_vars['washer']['id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['washer']['id']; ?>
"><?php echo $this->_tpl_vars['washer']['name']; ?>
 (<?php echo $this->_tpl_vars['washer']['email']; ?>
)</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Статус:</td>
                        <td>
                            <select name="order[status]">
                                <option <?php if ($this->_tpl_vars['order']['status'] == 0): ?>selected<?php endif; ?> value="0">Новый</option>
                                <option <?php if ($this->_tpl_vars['order']['status'] == 1): ?>selected<?php endif; ?> value="1">Принят</option>
                                <option <?php if ($this->_tpl_vars['order']['status'] == 2): ?>selected<?php endif; ?> value="2">В работе</option>
                                <option <?php if ($this->_tpl_vars['order']['status'] == 3): ?>selected<?php endif; ?> value="3">Завершен</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=order[phone]" value="<?php echo $this->_tpl_vars['order']['phone']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Модель:</td>
                        <td>
                            <select name="order[model]">
                                <option <?php if ($this->_tpl_vars['order']['model'] == 0): ?>selected<?php endif; ?> value="0">Седан</option>
                                <option <?php if ($this->_tpl_vars['order']['model'] == 1): ?>selected<?php endif; ?> value="1">Джип</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер:</td>
                        <td><input type="text" name=order[number]" value="<?php echo $this->_tpl_vars['order']['number']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Адрес:</td>
                        <td><input id="order_autocomplete" type="text" name=order[address]" value="<?php echo $this->_tpl_vars['order']['address']; ?>
" /><button style="float: none;margin-left: 10px;" onclick="modalMap.open(<?php echo $this->_tpl_vars['order']['id']; ?>
, <?php echo $this->_tpl_vars['order']['lat']; ?>
, <?php echo $this->_tpl_vars['order']['lng']; ?>
);return false;">Показать на карте</button></td>
                    </tr>
                    <tr>
                        <td class="var_name">Услуга:</td>
                        <td>
                            <select name="order[service]">
                                <option <?php if ($this->_tpl_vars['order']['service'] == 0): ?>selected<?php endif; ?> value="0">Стандарт</option>
                                <option <?php if ($this->_tpl_vars['order']['service'] == 1): ?>selected<?php endif; ?> value="1">Премиум</option>
                                <option <?php if ($this->_tpl_vars['order']['service'] == 2): ?>selected<?php endif; ?> value="2">Полный</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">На время:</td>
                        <td><input type="text" id="order_date_id" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Фото:</td>
                        <td><input type="file" value="" name="photo"></td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер флаера:</td>
                        <td><input type="text" name=order[flyer_number]" value="<?php echo $this->_tpl_vars['order']['flyer_number']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" onclick="document.location.href='/admin/orders?filter_status=-1';return false;"><?php echo smarty_function_fa_icon(array('name' => "arrow-circle-left"), $this);?>
Отмена</button>
                            <button type="submit"><?php echo smarty_function_fa_icon(array('name' => 'save'), $this);?>
Сохранить</button>
                        </td>
                    </tr>
                </table>
            </form>
        <?php endif; ?>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->_tpl_vars['GOOGLE_KEY']; ?>
&libraries=places&callback=orders.initAutocomplete"></script>