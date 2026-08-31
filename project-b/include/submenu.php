<?php 
@include_once "../api/db.php";
$mainId = $_GET['id'] ?? 1;
?>
<div style="padding:15px; box-sizing:border-box;">
    <h3 class="cent" style="color:var(--j-primary); font-size:16px; margin-bottom:12px; border-bottom:2px solid var(--j-pink-accent); padding-bottom:8px;">
        🌸 編輯美學次選單 (Submenu Editor)
    </h3>

    <form action="api/submenu.php?table=menu" method="post" enctype="multipart/form-data">
        <table class="all" style="width:92%; margin:15px auto; border-collapse:collapse; table-layout:fixed;" id="subMenu">
            <thead>
                <tr style="background:var(--j-sakura); color:var(--j-primary-dark); font-size:13px; font-weight:600;">
                    <td style="padding:8px; border-radius:8px 0 0 8px;" width="42%">次選單名稱 (Submenu)</td>
                    <td style="padding:8px;" width="42%">次選單連結網址 (URL)</td>
                    <td style="padding:8px; border-radius:0 8px 8px 0;" width="16%" class="cent">刪除</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $rows = [];
            if (isset($Menu)) {
                $rows = $Menu->all(['main_id' => $mainId]);
            }
            if (empty($rows) && $mainId == 1) {
                $rows = [
                    ['id'=>101, 'text'=>'光彩前導精華', 'href'=>'?do=main'],
                    ['id'=>102, 'text'=>'櫻花水感保濕乳', 'href'=>'?do=main']
                ];
            } elseif (empty($rows) && $mainId == 2) {
                $rows = [
                    ['id'=>201, 'text'=>'無瑕光透底妝', 'href'=>'?do=main'],
                    ['id'=>202, 'text'=>'日系柔霧唇膏', 'href'=>'?do=main']
                ];
            }
            foreach($rows as $row):
            ?>
            <tr>
                <td style="padding:6px;"><input type="text" name="text[]" value="<?= htmlspecialchars($row['text']); ?>" style="width:95%; font-size:12.5px;"></td>
                <td style="padding:6px;"><input type="text" name="href[]" value="<?= htmlspecialchars($row['href']); ?>" style="width:95%; font-size:12.5px;"></td>
                <td style="padding:6px;" class="cent"><input type="checkbox" name="del[]" value="<?= $row['id']; ?>"></td>
                <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cent" style="margin-top:20px;">
            <input type="hidden" name="main_id" value="<?= htmlspecialchars($mainId); ?>">
            <input type="button" value="➕ 更多次選單" onclick="more()" style="padding:6px 14px; margin-right:8px;">
            <input type="submit" value="修改確定 Save" style="padding:6px 18px;">
            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:6px 14px;">
        </div>
    </form>
</div>

<script>
function more(){
    let row = `<tr>
        <td style="padding:6px;"><input type="text" name="text2[]" style="width:95%; font-size:12.5px;" placeholder="新次選單名稱"></td>
        <td style="padding:6px;"><input type="text" name="href2[]" style="width:95%; font-size:12.5px;" placeholder="?do=main"></td>
        <td style="padding:6px;" class="cent"></td>
    </tr>`;
    $('#subMenu tbody').append(row);
}
</script>