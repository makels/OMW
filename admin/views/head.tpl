<title>Brilliant Ulag</title>
<meta charset = "utf-8" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/font-opensans.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/main.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/zwindow.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/daterangepicker.css" />


<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="/theme/css/ie.css" />
<![endif]-->

<!-- Themes -->
{if $current_theme == "green"}
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/green-theme.css" />
{/if}

{if $current_theme == "blue"}
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/blue-theme.css" />
{/if}

{if $current_theme == "bw"}
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/bw-theme.css" />
{/if}

{if $current_theme == "red"}
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/red-theme.css" />
{/if}


<script type="text/javascript" src="/admin/theme/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/admin/theme/js/moment.min.js"></script>
<script type="text/javascript" src="/admin/theme/js/daterangepicker.js"></script>
<script type="text/javascript" src="/admin/theme/js/zwindow.js"></script>
<script type="text/javascript" src="/admin/theme/js/app.js"></script>

{literal}
<script type="text/javascript">
  window.system_config_json = '{/literal}{$system_config|escape:javascript}{literal}';
</script>
{/literal}