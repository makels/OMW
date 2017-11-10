<?php /* Smarty version 2.6.25, created on 2017-11-03 06:36:38
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/clients/tmpl/edit_client.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin//modules/clients/tmpl/edit_client.tpl', 44, false),)), $this); ?>
<div class="product module">
    <div class="module-title gradient">Клиент</div>
    <div class="module-wrapper">
        <?php if (! $this->_tpl_vars['user']->has_permission('clients')): ?>
            У Вас недостаточно прав для работы с данным режимом
        <?php else: ?>
            <div class="client-info-wrapper">
                <span>Количество моек в этом месяце: <b><?php echo $this->_tpl_vars['client']['current_wash_count']; ?>
</b></span><br>
                <span>Всего моек: <b><?php echo $this->_tpl_vars['client']['wash_count']; ?>
</b></span><br>
                <?php if ($this->_tpl_vars['client']['current_wash_count'] >= 4): ?>
                    <span class="free-wash">Доступна бесплатная мойка в этом месяце.</span>
                <?php endif; ?>
            </div>
            <form method="post" action="/admin/clients"  enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="client[id]" value="<?php echo $this->_tpl_vars['client']['id']; ?>
"/>
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=client[name]" value="<?php echo $this->_tpl_vars['client']['name']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Email:</td>
                        <td><input type="text" name=client[email]" value="<?php echo $this->_tpl_vars['client']['email']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Пароль:</td>
                        <td><input type="password" name=client[pass]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=client[phone]" value="<?php echo $this->_tpl_vars['client']['phone']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Баланс:</td>
                        <td><input type="text" name=client[rest]" value="<?php echo $this->_tpl_vars['client']['rest']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Баллы:</td>
                        <td><input type="text" name=client[ball]" value="<?php echo $this->_tpl_vars['client']['ball']; ?>
" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" onclick="document.location.href='/admin/clients';return false;"><?php echo smarty_function_fa_icon(array('name' => "arrow-circle-left"), $this);?>
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