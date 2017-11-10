<?php /* Smarty version 2.6.25, created on 2017-11-03 06:10:37
         compiled from /home/admin/web/bulag.tk/public_html/admin//mails/order.tpl */ ?>
Новый заказ № <b><?php echo $this->_tpl_vars['order']['id']; ?>
</b><br>
Имя: <b><?php echo $this->_tpl_vars['order']['name']; ?>
</b><br>
Телефон: <b><?php echo $this->_tpl_vars['order']['phone']; ?>
</b><br>
Модель: <b><?php if ($this->_tpl_vars['order']['model'] == 0): ?>Седан<?php else: ?>Джип<?php endif; ?></b><br>
Адрес: <b><?php echo $this->_tpl_vars['order']['address']; ?>
</b><br>
Услуга: <b><?php if ($this->_tpl_vars['order']['service'] == 0): ?>Стандарт<?php elseif ($this->_tpl_vars['order']['service'] == 1): ?>Премиум<?php elseif ($this->_tpl_vars['order']['service'] == 2): ?>Полный<?php endif; ?></b><br>
На время: <b><?php echo $this->_tpl_vars['order']['date_time']; ?>
</b><br>
<?php if ($this->_tpl_vars['order']['flyer_number'] != ""): ?>Номер флаера: <b><?php echo $this->_tpl_vars['order']['flyer_number']; ?>
</b><br><?php endif; ?>