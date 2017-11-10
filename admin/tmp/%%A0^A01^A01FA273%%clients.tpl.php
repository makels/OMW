<?php /* Smarty version 2.6.25, created on 2017-11-03 06:11:13
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/clients/tmpl/clients.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin//modules/clients/tmpl/clients.tpl', 7, false),)), $this); ?>
<div class="products module">
    <div class="module-title gradient">Клиенты</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/clients" method="post">
            <input type="hidden" name="action" id="form_action" value="save">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');"><?php echo smarty_function_fa_icon(array('name' => "user-plus"), $this);?>
Добавить клиента</button>
                <button type="submit" onclick="$('#form_action').val('delete');"><?php echo smarty_function_fa_icon(array('name' => "user-times"), $this);?>
Удалить клиента</button>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Баланс</th>
                <th>Баллы</th>
                </thead>
                <tbody>
                <?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['client']):
?>
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_client_checkbox" type="checkbox" name="clients[<?php echo $this->_tpl_vars['client']['id']; ?>
]" /></td>
                        <td><a href="/admin/clients/edit?id=<?php echo $this->_tpl_vars['client']['id']; ?>
"><?php echo $this->_tpl_vars['client']['name']; ?>
</a></td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['client']['email']; ?>
</td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['client']['phone']; ?>
</td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['client']['rest']; ?>
</td>
                        <td class="cell_center"><?php echo $this->_tpl_vars['client']['ball']; ?>
</td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
        </form>
    </div>
</div>