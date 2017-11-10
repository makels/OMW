/**
 * Created by Zerg on 08.12.2015.
 */
var App = function() {

  this.system_config = {};

  this.alert = function(text) {
    var wnd = new ZWindow({
      width: 'auto',
      title: "<span class='fa fa-warning'>&nbsp;</span> Внимание",
      text: text,
      buttons: [
        {
          text: "Ок",
          click: function() {
            wnd.hide();
          }
        }
      ]
    });
    wnd.show();
  }

  this.confirm = function(text, callback) {
    var wnd = new ZWindow({
      width: 'auto',
      title: "<span class='fa fa-question-circle'>&nbsp;</span> Вопрос",
      text: text,
      buttons: [
        {
          text: "Нет",
          click: function() {
            if(typeof(callback) != 'undefined') callback(false);
            wnd.hide();
          }
        },
        {
          text: "Да",
          click: function() {
            wnd.hide();
            if(typeof(callback) != 'undefined') callback(true);
          }
        }
      ]
    });
    wnd.show();
  }

  this.init = function() {
    this.system_config = JSON.parse(window.system_config_json);
    if(this.system_config.length > 0)
      this.system_config = this.system_config[0];
    this.initMask();
    this.initGroupCheckBoxes();
  }

  this.initGroupCheckBoxes = function() {
    $("input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });
  }

  this.initMask = function() {
    $('.zmask').height($(window).height());
  }

  this.deleteUsers = function() {
    this.confirm("Вы уверенны что хотите удалить выбранных пользователей ?", function(res) {
      if(res === true) {
        $("#users_delete_form").submit();
      }
    });
  }

  this.deleteOrders = function() {
    this.confirm("Вы уверенны что хотите удалить выбранные заказы ?", function(res) {
      if(res === true) {
        $("#orders_delete_form").submit();
      }
    });
  }

  this.deleteGroups = function() {
    this.confirm("Вы уверенны что хотите удалить выбранные группы пользователей ?", function(res) {
      if(res === true) {
        $("#groups_delete_form").submit();
      }
    });
  }

  this.checkAddUser = function() {
    var name = $("#user_name").val();
    var display_name = $("#user_display_name").val();
    var email = $("#user_email").val();
    var pass = $("#user_pass").val();
    var pass_confirm = $("#user_pass_confirm").val();
    var msg = [];
    if(name == "") msg.push("Введите логин пользователя");
    if(display_name == "") msg.push("Введите имя пользователя");
    if(pass == "") msg.push("Введите пароль пользователя");
    if(pass_confirm == "") msg.push("Введите подтверждение пароля");
    if(pass != pass_confirm) msg.push("Не совпадают введенные пароли");

    if(msg.length > 0) {
      var msgstr = "При проверке введенной информации обнаружены следующие ошибки:<br>";
      $.each(msg, function(index, error) {
        msgstr += error + "<br>";
      });
      app.alert(msgstr);
      return false;
    } else return true;
  }

  this.checkEditUser = function() {
    var name = $("#user_name").val();
    var display_name = $("#user_display_name").val();
    var email = $("#user_email").val();
    var pass = $("#user_pass").val();
    var pass_confirm = $("#user_pass_confirm").val();
    var msg = [];
    if(name == "") msg.push("Введите логин пользователя");
    if(display_name == "") msg.push("Введите имя пользователя");
    if(pass != "" || pass_confirm != "") {
      if(pass != pass_confirm) msg.push("Не совпадают введенные пароли");
    }

    if(msg.length > 0) {
      var msgstr = "При проверке введенной информации обнаружены следующие ошибки:<br>";
      $.each(msg, function(index, error) {
        msgstr += error + "<br>";
      });
      app.alert(msgstr);
      return false;
    } else return true;
  }

  this.checkAddGroup = function() {
    var name = $('#group_name').val();
    var description = $('#group_description').val();
    var msg = [];
    if(name == "") msg.push("Введите название группы");
    if(description == "") msg.push("Введите описание группы");
    if(msg.length > 0) {
      var msgstr = "При проверке введенной информации обнаружены следующие ошибки:<br>";
      $.each(msg, function(index, error) {
        msgstr += error + "<br>";
      });
      app.alert(msgstr);
      return false;
    } else return true;
  }

  this.checkEditGroup = function() {
    var name = $('#group_name').val();
    var description = $('#group_description').val();
    var msg = [];
    if(name == "") msg.push("Введіть назву групи");
    if(description == "") msg.push("Введіть пояснення для групи");
    if(msg.length > 0) {
      var msgstr = "При перевірці введених даних виникли наступні помилки:<br>";
      $.each(msg, function(index, error) {
        msgstr += error + "<br>";
      });
      app.alert(msgstr);
      return false;
    } else return true;
  }

  this.autoComplete = function(el, form_id) {
    if($(el).val() == "") return;
    var scope = this;
    var $form = $("#" + form_id);
    var url = $form.attr("action");
    var data = $form.serializeArray();
    $.ajax({
      url: url,
      dataType: 'json',
      data: data,
      type: "post",
      success: function(result) {
        scope.setAutoCompleteResult(el, result);
      }
    });
  }

  this.setAutoCompleteResult = function(el, result) {
    var scope = this;
    if(result.length == 0) return;
    var id = $(el).attr("id") + "_auto_complete";
    $("#" + id).remove();
    $('body').append("<select size='5' id='" + id + "' class='select_auto_complete'></select>");
    var selEl = $("#" + id);
    $.each(result, function(index, item) {
      $(selEl).append("<option value='" + item.id + "'>" + item.name + "</option>");
    });
    $(selEl).css({
      left: $(el).position().left,
      top: $(el).position().top + 28,
      width: $(el).width() + 13
    });
    $(selEl).change(function() {
      var v = $(this).find("option:selected").val();
      $(el).val($(this).find("option:selected").text());
      $(el).attr("a_val", v);
      $(this).remove();

      scope.autoCompleteCallback();
    });
    $(selEl).focusout(
        function() {
          $(this).remove();
        }
    );
  }

  this.clearProducts = function() {
    this.confirm("Вы уверены что хотите очистить базу товаров ?", function(answer) {
      if(answer === true) {
        $.ajax({
          url: "/admin/excel",
          type: "post",
          dataType: "json",
          data: {
            action: "clear_products"
          },
          success: function(data) {
            if(data.result == 1) app.alert("Все товары удалены успешно");
            else app.alert("Ошибка удаления товаров");
          },
          error: function() {
            app.alert("Ошибка удаления товаров");
          }
        });
      }
    });
  }
}

var app = new App();

$(function() {
  app.init();
});