var News = function() {

    this.init = function() {
        CKEDITOR.config.height = 150;
        CKEDITOR.config.width = 'auto';
        CKEDITOR.replace( 'editor' );

        $("#news_date_id").datepicker($.extend($.datepicker.regional['ru']));
    }


}

var news = new News();

$(function() {
    news.init();
});