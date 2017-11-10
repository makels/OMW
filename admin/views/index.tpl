<!DOCTYPE html>
<html>
<head>
  {include file="head.tpl"}
</head>
<body>

{include file="zwindow.tpl"}

<div class="content-wrapper">

  <!--HEADER -->
  <div class="header gradient">
    {include file="header.tpl"}
  </div>

  <div class="main-content">
    <table>
      <tr>
        <!-- LEFT SIDE -->
        {if $left_side != ""}
          <td class="left-side">
            {$left_side}
          </td>
        {/if}

        <!-- CENTER SIDE -->
        {if $center_side != ""}
          <td class="center-side">
            {$center_side}
          </td>
        {/if}

        <!-- RIGHT SIDE -->
        {if $right_side != ""}
          <td class="right-side">
            {$right_side}
          </td>
        {/if}
      </tr>
    </table>
  </div>

  <!-- FOOTER -->
  <div class="footer gradient">
    {include file="footer.tpl"}
  </div>

</div>
</body>
</html>