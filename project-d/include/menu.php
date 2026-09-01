<div style="padding:15px; box-sizing:border-box;">
    <h3 class="cent" style="color:var(--j-primary); font-size:16px; margin-bottom:12px; border-bottom:2px solid var(--j-pink-accent); padding-bottom:8px;">
        🌸 新增美學主選單 (Add Main Menu)
    </h3>

    <form action="api/add.php?table=menu" method="post" enctype="multipart/form-data">
        <table class="all" style="width:85%; margin:20px auto; border-collapse:collapse;">
            <tr>
                <td style="padding:10px; font-weight:600; color:var(--j-primary-dark);" width="35%">主選單名稱：</td>
                <td style="padding:10px;"><input type="text" name="text" style="width:90%; font-size:13px;" placeholder="例如：護膚儀式"></td>
            </tr>
            <tr>
                <td style="padding:10px; font-weight:600; color:var(--j-primary-dark);">選單連結網址：</td>
                <td style="padding:10px;"><input type="text" name="href" style="width:90%; font-size:13px;" placeholder="?do=main"></td>
            </tr>
        </table>
        
        <div class="cent" style="margin-top:20px;">
            <input type="submit" value="➕ 新增 Add" style="padding:6px 20px;">
            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:6px 16px;">
        </div>
    </form>
</div>