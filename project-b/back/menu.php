<div class="di back-center-panel">
    <!--後台頂部導覽區-->
    <table width="100%" style="margin-bottom:10px;">
        <tbody>
            <tr>
                <td style="width:72%; font-weight:600; text-align:center; padding:6px; background:var(--j-sakura); border-radius:10px; border:1px solid var(--j-pink-accent);">
                    <a href="?do=admin" style="color:var(--j-primary-dark); text-decoration:none; font-size:14px;">🌸 品牌網頁與視覺管理中心 (Admin Control Panel)</a>
                </td>
                <td style="text-align:right;">
                    <button onclick="location.href='admin.php?do=logout'" style="padding:8px 16px; font-size:12.5px;">🔐 管理員登出 Log out</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width:100%; height:460px; margin:auto; overflow:auto; border:1px solid var(--j-pink-accent); border-radius:14px; padding:12px; background:#FFFDF9; box-sizing:border-box;">
        <p class="t cent botli" style="font-size:15px;">🌸 美學導覽選單與次選單管理</p>
        <form method="post" action="./api/edit.php?table=<?= $do ?>">
            <table width="100%" style="table-layout:fixed; word-wrap:break-word; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--j-sakura); color:var(--j-primary-dark); font-weight:600; font-size:13px;">
                        <td width="26%" style="padding:6px 8px;">主選單名稱 (Menu)</td>
                        <td width="26%" style="padding:6px 8px;">選單超連結 (URL)</td>
                        <td width="10%" class="cent" style="padding:6px 2px;">次選單數</td>
                        <td width="8%" class="cent" style="padding:6px 2px;">顯示</td>
                        <td width="8%" class="cent" style="padding:6px 2px;">刪除</td>
                        <td width="22%" class="cent" style="padding:6px 2px;">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $db=${ucfirst($do)};
                    $rows=[];
                    if(isset($db)){
                        $rows=$db->all(['main_id'=>0]);
                    }
                    if(empty($rows)){
                        $rows = [
                            ['id'=>1, 'text'=>'護膚儀式 (Skincare)', 'href'=>'?do=main', 'sh'=>1],
                            ['id'=>2, 'text'=>'彩妝美學 (Makeup)', 'href'=>'?do=main', 'sh'=>1],
                            ['id'=>3, 'text'=>'美粧專欄 (Journal)', 'href'=>'?do=news', 'sh'=>1]
                        ];
                    }
                    foreach($rows as $row):
                    ?>
                    <tr style="border-bottom:1px dashed var(--j-border);">
                        <td width="26%" style="padding:6px 4px;">
                            <input type="text" name="text[]" value="<?= htmlspecialchars($row['text']); ?>" style="width:92%; font-size:12.5px;">
                        </td>
                        <td width="26%" style="padding:6px 4px;">
                            <input type="text" name="href[]" value="<?= htmlspecialchars($row['href']); ?>" style="width:92%; font-size:12.5px;">
                        </td>
                        <td width="10%" class="cent" style="padding:6px 2px;">
                            <?= isset($db) ? $db->count(['main_id'=>$row['id']]) : (($row['id']==1 || $row['id']==2)?2:0); ?>
                        </td>
                        <td width="8%" class="cent" style="padding:6px 2px;">
                            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh']==1)?'checked':''; ?>>
                        </td>
                        <td width="8%" class="cent" style="padding:6px 2px;">
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                        </td>
                        <td width="22%" class="cent" style="padding:6px 2px;">
                            <!-- 修正：包含檔檔名修正為 include/submenu.php 防空白頁，微調欄寬防溢出 -->
                            <input type="button" value="編輯次選單" onclick="op('#cover','#cvr','include/submenu.php?id=<?= $row['id'];?>')" style="padding:4px 10px; font-size:12px; white-space:nowrap;">
                        </td>
                        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table style="margin-top:20px; width:100%;">
                <tbody>
                    <tr>
                        <td width="40%">
                            <input type="button" onclick="op('#cover','#cvr','include/menu.php')" value="➕ 新增主選單" style="padding:6px 14px;">
                        </td>
                        <td class="cent" width="60%">
                            <input type="submit" value="修改確定 Save" style="padding:6px 20px;">
                            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:6px 16px;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>